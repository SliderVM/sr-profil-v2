<template>
    <div>
        <b-button @click="modalShow=!modalShow" size="sm" variant="outline-primary"><b-icon icon="arrow-left-right"></b-icon> Переместить</b-button>

        <b-modal v-model="modalShow" title="Перемещение штрипса">
            <div class="row">
                <div class="col">
                    <warehouse @selectWarehouse="warehouse"></warehouse>
                </div>
                <div class="form-group col">
                    <label>Дата перемещения</label>
                    <input type="date" v-model="Form.dateSending" class="form-control"/>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label>Доступно, шт</label>
                    <input v-model.number="available" class="form-control" disabled/>
                </div>
                <div class="form-group col">
                    <label>Переместить, шт</label>
                    <input v-model.number="Form.count" class="form-control" @input="amount(id)"/>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label>Общая длина</label>
                    <input v-model.number="Form.length" class="form-control" disabled placeholder="0.0"/>
                </div>
                <div class="form-group col">
                    <label>Расчетный вес, тн</label>
                    <input v-model.number="Form.tonage" class="form-control" disabled placeholder="0.000"/>
                </div>
            </div>
            <div slot="modal-footer">
                <button size="sm" @click="send" class="btn btn-outline-primary">
                    Сохранить
                </button>
            </div>
        </b-modal>
    </div>
</template>

<script>
import warehouse from '../../components/addbuht/selectwarehouse.vue'
export default {
    props: ['wId', 'available', 'id', 'array'],
    components: {warehouse},
    data: () => ({
        modalShow: false,
        Form: {
            id: '', // айди штрипса
            warehouseInComing: '', // в какой склад отправится
            warehouseOutgoing: '', // из какого склада отправится
            dateSending: '', // дата
            length: '', // длина
            tonage: '', // вес
            available: '', // общее количество
            userSending: '', // айди отправителя
            count: '', // количество перемещаемых штрипсов
            array: {} // массив айди таких же записей
        }
    }),
    methods: {
        warehouse(data) {
            this.Form.warehouseInComing = data.selected;
            this.Form.array = this.array;
        },
        send() { // сделать селект чтобы не выбирался текущий склад
            this.Form.count = Number(this.Form.count);
            this.Form.id = this.id;
            this.Form.warehouseOutgoing = this.wId;
            this.Form.available = this.available;
            axios.post('shtripstransfer', this.Form)
            .then((response) => {
                console.log(response)
            })
            .catch((error) => {
                console.log(error);
            });
        },
        amount(id) {
            axios.post('sumshtrips/' + id, this.Form.count, {
                headers: {"Content-type": "application/json"}
            })
            .then((res) => {
                this.Form.length = res.data[0]; // длина
                this.Form.tonage = res.data[1]; // вес
                this.userCheck();
            })
        },
        userCheck() {
            axios.get('/user')
            .then(response => {
                this.Form.userSending = response.data.id;
            })
        }
    }
}
</script>
