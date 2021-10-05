<template>
<div>
    <b-button v-b-modal.register size="sm" variant="outline-primary" ><b-icon icon="plus-square"></b-icon> Добавить пользователя</b-button>
    <b-modal id="register" title="Регистрация" hide-header-close>
        <div class="form-group">
            Имя
            <input type="text" id="name" class="form-control" v-model="reg.name">
        </div>
        <div>
            E-Mail
            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="reg.email">
        </div>
            <div class="form-group">
            Пароль
            <input type="password" id="password" class="form-control" v-model="reg.password">
        </div>
        <div class="form-group">
            Роль
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
        Какие склады будут доступны?
        <warehouse :complect="complect"
            v-for='complect in complects'
            :key='complect.id'>
        </warehouse>
        <br>
        <span class='btn btn-outline-primary' @click='addNewComplect'>Добавить склад</span>
        <div slot="modal-footer">
            <button @click="register" size="sm" class="btn btn-primary input-group-addon">Зарегистрировать</button>
        </div>
    </b-modal>
</div>
</template>

<script>
import warehouse from './warehouseUser.vue'
export default {
    components: {warehouse},
    data: () => ({
        complects: [{Form: {
            id: 1,
            selected: "",
            selectType: "",
        }}],
        count: 2,
        rolesArray: [],
        reg: {
            name: '',
            email: '',
            password: '',
            role_id: ''
        },
        user: ''
    }),
    created() {
        this.loadRole();
    },
    methods: {
        addNewComplect() { // добавить новый тип резки
			this.complects.push({Form: {
                id: this.count++,
                selected: "",
                selectType: "",
            }})
		},
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
                this.user = response.data.id
                this.permissions();
            })
            .catch(error => {
                console.log(error);
            });
        },
        permissions() {
            axios.post('api/user', [this.complects, this.user])
            .then((res => {
                console.log(res);
            }))
        },
    }
}
</script>
