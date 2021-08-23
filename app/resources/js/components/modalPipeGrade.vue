<template>
    <div>
        <div class='btn-group'>
            <b-button @click="modalShow=!modalShow" size="sm" variant='outline-primary'><b-icon icon="plus-square"></b-icon> Добавить</b-button>
        </div>
        <b-modal v-model="modalShow" title="Добавление сорта трубы" hide-header-close>
            <div class="form-group">
            <label>Наименование</label>
            <input type ="text" v-model="Form.gradeName" class="form-control" />
        </div>
        <div slot="modal-footer">
            <button @click="send" size="sm" class="btn btn-primary input-group-addon">Добавить</button>
        </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    data: () => ({
        modalShow: false,
        Form: {
            gradeName: ''
        },
    }),
    methods: {
        send() {
            axios.post('api/qualitie', this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data)
                this.modalShow = false;
                this.$emit('pipe', response.data)
                this.gradeName = '';
            })
            .catch((error) => {
                console.log(error);
            })
        }
    }
}
</script>

<style>

</style>
