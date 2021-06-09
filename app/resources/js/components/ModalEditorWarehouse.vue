<template>
<div>
  <b-button v-b-modal.modal-1 class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-pen"></i></b-button>

        <b-modal id="modal-1" title="Редактирование склада">
            <div>
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
                <button size="sm" class="btn btn-primary input-group-addon">Сохранить</button>
            </div>
        </b-modal>
</div>
</template>

<script>
import multiselect from 'vue-multiselect'
Vue.component('multiselect', multiselect)

export default {
    components: {multiselect},
    data: () => ({
        WarehouseTypeArray: [],
        Form: {
            TypeWarehouse: []
        }
    }),

    created: function() {
        axios.get('/api/warehousetype')
            .then(res => {
                this.WarehouseTypeArray = res.data;
            })
    },
    methods: {}
}
</script>

<style>

</style>
