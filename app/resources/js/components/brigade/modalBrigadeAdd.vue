<template>
  <div>
      <b-button v-b-modal.modal-13 @click="modalShow=!modalShow"  size="sm" variant="outline-primary" ><b-icon icon="plus-square"></b-icon> Добавить смену</b-button>
        <b-modal id="modal-13" title="Добавление бригады">
            <div class="form-group">
                <label>Наименование бригады</label>
                <input type="text" v-model="Form.name" class="form-control" />
            </div>
            <div>
                <label>Доступные заводы</label>
                <multiselect
                v-model="Form.Warehouse"
                :options="WarehouseArray"
                track-by="id"
                label="name"
                placeholder="Выберите завод"
                open-direction="bottom"
                :hide-selected="true"
                :multiple="true">
                </multiselect>
            </div>
            <div slot="modal-footer">
                <button @click="send" size="sm" class="btn btn-primary input-group-addon">Добавить</button>
            </div>
        </b-modal>
  </div>
</template>

<script>
import multiselect from 'vue-multiselect'
export default {
    components: {multiselect},
    data: () => ({
        WarehouseArray: [],
        trackBy: 'id',
        modalShow: false,
        Form: {
            name: "",
            Warehouse: []
        }
    }),
    created: function() {
        axios.get('/api/warehouse')
            .then(res => {
                this.WarehouseArray = res.data;
            })
    },
    methods: {
        send () {
            console.log(this.Form.Warehouse);
            axios.post('/api/brigade', this.Form, {
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
