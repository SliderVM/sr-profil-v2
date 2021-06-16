<template>
<div>
    <div class="btn-group" role="group" aria-label="Basic example">
         <b-button @click="modalShow=!modalShow" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-pen"></i></b-button>
         <b-button @click="del" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-times"></i></b-button>
    </div>
        <b-modal v-model="modalShow" title="Редактирование склада">
            <div>
                <label>Наименование {{Warehouse.name}} </label>
                <input type="text" v-model="Form.name" class="form-control"  />
            </div>
            <div class="form-group">
                <label>Тип склада</label>
                <multiselect
                v-model="Form.warehouseType"
                :options="WarehouseTypeArray"
                track-by="id"
                label="name"
                :options-limit="3"
                open-direction="bottom"
                :hide-selected="true"
                :multiple="true">
                </multiselect>
            </div>
            <div slot="modal-footer">
                <button size="sm" class="btn btn-primary input-group-addon">Сохранить</button>
            </div>
        </b-modal>
</div>
</template>

<script>
import multiselect from 'vue-multiselect'
Vue.component('multiselect', multiselect)

export default {
    props: ["Warehouse"],
    components: {multiselect},
    data: () => ({
        WarehouseTypeArray: [],
        Form: [],
        modalShow: false,
    }),
    created: function() {
        axios.get('/api/warehousetype')
            .then(res => {
                this.WarehouseTypeArray = res.data;
            })
    },
    mounted() {
        this.loadForm();
    },
    methods: {
        loadForm(id) {
                axios.get('/api/warehouse/up' + this.Warehouse.id)
                .then(res => {
                    this.Form = res.data;
                    console.log(this.Form);
                })
                .catch((error) => {
                console.log(error);
                });
        },
        send: function () {
            axios.patch('api/warehousetype/' + this.Warehouse.id, this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
        },
        del: function (id) {
            axios.post('api/warehousetype/', {
                    params:{
                        id
                    },
            })
                .then((response) => {
                 console.log(response)
                })
                .catch((error) => {
                console.log(error);
            });
    }
    }
}
</script>
