<template>
  <div>
      <b-button v-b-modal.modal-1 size="sm" variant="outline-primary" ><b-icon icon="plus-square"></b-icon> Добавление склада</b-button>
        <b-modal id="modal-1" title="Добавление склада">
            <div class="form-group">
                <label>Наименование</label>
                <input type="text" v-model="Form.name" class="form-control" />
            </div>
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
                <button @click="send" size="sm" class="btn btn-primary input-group-addon">Сохранить</button>
            </div>
        </b-modal>
  </div>
</template>

<script>
import multiselect from 'vue-multiselect'
export default {
    components: {multiselect},
    data: () => ({
        WarehouseTypeArray: [],
        trackBy: 'id',

        Form: {
            name: "",
            TypeWarehouse: []
        }

    }),
    created: function() {
        axios.get('/api/warehousetype')
            .then(res => {
                this.WarehouseTypeArray = res.data;
            })
    },
    methods: {
        send () {
            console.log(this.Form.TypeWarehouse);
            axios.post('/api/warehousetype', this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data);
                 this.$bvModal.hide('modal-1')
            })
            .catch((error) => {
                console.log(error);
            })
            {
                this.$emit('send', {form: this.Form})
            }
        }
    }
}
</script>
