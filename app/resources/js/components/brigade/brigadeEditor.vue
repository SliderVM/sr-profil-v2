<template>
<div>
    <div class='btn-group'>
         <b-button @click="modalShow=!modalShow" size="sm" variant='outline-primary' ><b-icon icon="pencil"></b-icon></b-button>
    </div>
        <b-modal v-model="modalShow" title="Редактирование смены">
            <div>
                <label>Наименование смены</label>
                <input type="text" v-model="Form.name" class="form-control"  />
            </div>
            <div class="form-group">
                <label>Доступные заводы</label>
                <multiselect
                v-model="value"
                :options="WarehouseArray"
                track-by="id"
                label="name"
                :options-limit="3"
                open-direction="bottom"
                :hide-selected="true"
                :multiple="true">
                </multiselect>
            </div>
            <div slot="modal-footer">
                <button size="sm" @click="send" class="btn btn-primary">Сохранить</button>
            </div>
        </b-modal>
</div>
</template>

<script>
import multiselect from 'vue-multiselect'
export default {
    props: ["brigade"],
    components: {multiselect},
    data: () => ({
        WarehouseArray: [],
        Form: {
            id: "",
            name: "",
            Warehouse: []
        },
        modalShow: false,
        value:[]
    }),
    created: function() {
        axios.get('/api/warehouse')
            .then(res => {
                this.WarehouseArray = res.data;
            })
    },
    mounted() {
        this.loadForm();
    },
    methods: {
        loadForm() {
            this.Form = this.brigade;
            this.value = this.brigade.warehouse;
        },
        send() {
            this.Form.Warehouse = this.value;
            axios.patch('api/brigade/' + this.Form.id,  this.Form,  {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data);
                this.modalShow = false;
                response.data.warehouse = this.Form.warehouse
                console.log(this.Form.warehouse)
                this.$emit('send', this.Form.warehouse)
            })
            .catch((error) => {
                console.log(error);
            })
        }
    }
}
</script>
