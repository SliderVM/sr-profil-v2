<template>
  <div>
      <b-button v-b-modal.modal-1 class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-plus"></i> Приход металла</b-button>

        <b-modal id="modal-1" title="Приход металла">
            <div class="form-group">
                <label>Наименование</label>
                <input type="text" v-model="Form.name" class="form-control" />
            </div>
            <div>
                <label>Тип склада</label>
                <multiselect
                v-model="Value"
                :options="WarehouseTypeArray"
                track-by="id"
                label="name"
                :options-limit="3"
                open-direction="bottom"
                :hide-selected="true"
                :multiple="true"
                @open="LoadWarehouseType"
                @select="Search">
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
    components: { multiselect },
    data: () => ({
        WarehouseTypeArray: [],
        Value: [],
        trackBy: 'id',

        Form: {
            name: "",
            TypeWarehouse: []
        }

    }),
    created: function(){
        axios.get('/api/warehousetype')
            .then(res => {
                this.WarehouseTypeArray = res.data;
            })
    },
    methods: {
        LoadWarehouseType() {
        },
        Search() {
            axios.get('/api/warehousetype')
            .then(res => {
                this.WarehouseTypeArray = res.data;
                this.Form.TypeWarehouse = this.Value;
                console.log(this.Value);
            })

        },
        send: function () {
            console.log(this.Form.TypeWarehouse);
            axios.post('/api/warehousetype', this.Form, {
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
