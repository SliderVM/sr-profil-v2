<template>
<div>
    <div class="btn-group" role="group" aria-label="Basic example">
         <b-button @click="modalShow=!modalShow" size="sm"><b-icon icon="pencil"></b-icon></b-button>
         <b-button @click="del" :value="Warehouse.id" size="sm"><b-icon icon="x"></b-icon></b-button>
    </div>
        <b-modal v-model="modalShow" title="Редактирование склада">
            <div>
                <label>Наименование</label>
                <input type="text" v-model="Form.name" class="form-control"  />
            </div>
            <div class="form-group">
                <label>Тип склада</label>
                <multiselect
                v-model="value"
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
                <button size="sm" @click="send" class="btn btn-primary input-group-addon">Сохранить</button>
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
        Form:{
            id: "",
            name: "",
            WarehouseTypes: []
        },
        modalShow: false,
        value:[]
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
        loadForm() {
            this.Form = this.Warehouse;
            this.value = this.Warehouse.warehouse_types;
        },
        send() {
            this.Form.WarehouseTypes = this.value;
            axios.patch('api/warehousetype/' + this.Form.id,  this.Form,  {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
        },
        del() {
            this.$emit('remove', this.Warehouse.id);
            console.log( this.Warehouse.id);
        }
    }
}
</script>
