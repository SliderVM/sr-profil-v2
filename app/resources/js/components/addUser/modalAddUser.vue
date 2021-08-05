<template>
<div>
    <b-button v-b-modal.register size="sm" variant="outline-primary" ><b-icon icon="plus-square"></b-icon> Добавить пользователя</b-button>
    <b-modal id="register" title="Регистрация">
        <div class="form-group">
            <label>Имя</label>
            <input type="text" id="name" class="form-control" v-model="reg.name">
        </div>
        <div>
            <label>E-Mail</label>
            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="reg.email">
        </div>
            <div class="form-group">
            <label>Пароль</label>
            <input type="password" id="password" class="form-control" v-model="reg.password">
        </div> <div class="form-group">
            <label>Роль пользователя</label>
            <input type="text" class="form-control" />
        </div>
        <div slot="modal-footer">
            <button @click="register" size="sm" class="btn btn-primary input-group-addon">Зарегистрировать</button>
        </div>
    </b-modal>
</div>
</template>

<script>
export default {
    data: () => ({
        reg: {
            name: '',
            email: '',
            password: '',
        }
    }),
    methods: {
        register() {
            axios.post("/register", this.reg, {
                header: "Content-type: application/json"
            })
            .then(response => {
                this.$bvModal.hide('register')
                this.reg = '';
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>
