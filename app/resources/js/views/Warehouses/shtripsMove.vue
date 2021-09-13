<template>
    <div>
        <b-button @click="modalShow=!modalShow" size="sm" variant="outline-primary"><b-icon icon="arrow-left-right"></b-icon> Переместить</b-button>

        <b-modal v-model="modalShow" title="Перемещение штрипса" hide-header-close>
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
                    <input type="number" class="form-control" disabled v-model="available" />
                </div>
                <div class="form-group col">
                    <label>Переместить, шт</label>
                    <input type="number" class="form-control" @input="amount(id)" v-model="count" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label>Общая длина</label>
                    <input type="number" class="form-control" disabled placeholder="0.0" v-model="Form.length" />
                </div>
                <div class="form-group col">
                    <label>Расчетный вес, тн</label>
                    <input type="number" class="form-control" disabled placeholder="0.000" v-model="Form.tonage" />
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
    props: ['wId', 'available', 'id'],
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
            count: ''
        },
        count: '' // количество перемещаемых штрипсов
    }),
    methods: {
        warehouse(data) {
            this.Form.warehouseInComing = data.selected;
        },
        send() { // сделать селект чтобы не выбирался текущий склад
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
            axios.post('sumshtrips/' + id, this.count, {
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
                this.Form.userSending = response.data.id
                console.log(response.data.id)
            })
        }
    }
}
</script>
