<template>
<div>
    <div class="btn-group" role="group" aria-label="Basic example">
         <b-button @click="modalShow=!modalShow" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-pen"></i></b-button>
         <b-button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-times"></i></b-button>
    </div>
        <b-modal v-model="modalShow" title="Редактирование склада">
            <div class="form-group">
                <label>Тип склада</label>


                <multiselect
                v-model="Form.TypeWarehouse"
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
                <button v-on:click="send" size="sm" class="btn btn-primary input-group-addon">Сохранить</button>
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
        Form: {
            // name: "",
            TypeWarehouse: []
        },
        modalShow: false,
    }),

    created: function() {
        axios.get('/api/warehousetype')
            .then(res => {
                this.WarehouseTypeArray = res.data;
            })
    },
    methods: {
        send: function () {
            console.log(this.Form.TypeWarehouse);
            axios.put('api/warehousetype/{warehousetype} ', this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
        }
    }
}
</script>

<style>

</style>
