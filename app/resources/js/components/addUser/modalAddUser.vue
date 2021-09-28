<template>
<div>
    <b-button v-b-modal.register size="sm" variant="outline-primary" ><b-icon icon="plus-square"></b-icon> Добавить пользователя</b-button>
    <b-modal id="register" title="Регистрация" hide-header-close>
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
        </div>
        <div class="form-group">
            <select v-model="reg.role_id" class="form-control">
                <option
                    size="sm"
                    class="mt-3"
                    v-for="role in rolesArray"
                    :key="role.id"
                    :value="role.id">
                    {{ role.title }}
                </option>
            </select>
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
        rolesArray: [],
        reg: {
            name: '',
            email: '',
            password: '',
            role_id: ''
        }
    }),
    created() {
        this.loadRole();
    },
    methods: {
        loadRole() {
            axios.get('api/user/create')
            .then ((res) => {
                this.rolesArray = res.data;
            })
        },
        register() {
            axios.post("/register", this.reg, {
                header: "Content-type: application/json"
            })
            .then(response => {
                this.$bvModal.hide('register')
                this.reg = '';
                this.$emit('reg');
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>
