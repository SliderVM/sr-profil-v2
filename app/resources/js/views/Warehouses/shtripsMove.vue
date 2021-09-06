<template>
    <div>
        <b-button @click="modalShow=!modalShow" size="sm" variant="outline-primary" :value="id"><b-icon icon="arrow-left-right"></b-icon> Переместить</b-button>

        <b-modal v-model="modalShow" title="Перемещение штрипса" hide-header-close>
            <div class="row">
                <div class="col">
                    <warehouse @selectWarehouse="warehouse"></warehouse>
                </div>
                <!-- <div class="form-group col">
                    <label>Дата перемещения</label>
                    <input type="date" v-model="dateSending" class="form-control"/>
                </div> -->
            </div>
            <div class="row">
                <div class="form-group col">
                    <label>Доступно, шт</label>
                    <input type="number" class="form-control" disabled />
                </div>
                <div class="form-group col">
                    <label>Переместить, шт</label>
                    <input type="number" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label>Общая длина</label>
                    <input type="number" class="form-control" disabled />
                </div>
                <div class="form-group col">
                    <label>Расчетный вес, тн</label>
                    <input type="number" class="form-control" disabled />
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
    props: ['id'],
    components: {warehouse},
    data: () => ({
        modalShow: false,
        Form: {
            warehouseInComing: '',
            dateSending: '',
        }
    }),
    methods: {
        loadShrips(id) {
            axios.get("/api/shtrips/" + id + "/edit")
            .then(res => {
                this.shtripsArray = res.data;
            });
        },
        warehouse(data) {
            this.Form.warehouseInComing = data.selected
        },
        send() {
            axios.post('/api/shtrips', this.Form, {
            headers: {"Content-type": "application/json"}
            })
            .then((response) => {
                this.Form = response.data
            })
            .catch((error) => {
                console.log(error);
            });
        }
    }
}
</script>
