<template>
<div>
    <div class='btn-group'>
         <b-button @click="modalShow=!modalShow" size="sm" variant='outline-primary' ><b-icon icon="pencil"></b-icon></b-button>
    </div>
    <b-modal v-model="modalShow" title="Обновление информации о пользователе">
        <div class="form-group">
            Имя
            <input type="text" id="name" v-model="editUser.name" class="form-control">
        </div>
        <div>
            E-Mail
            <input type="email" id="email" v-model="editUser.email" class="form-control" placeholder="user@example.com">
        </div>
            <div class="form-group">
            Пароль
            <input type="password" id="password" v-model="editUser.password" class="form-control" >
        </div>
        Роль
        <div class="form-group">
            <select v-model="editUser.role_id" class="form-control">
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
            <button size="sm" @click="updateUser" class="btn btn-primary input-group-addon">Обновить</button>
        </div>
    </b-modal>
</div>
</template>

<script>
import warehouse from './warehouseUser.vue'
export default {
    components: {warehouse},
    props: ["user"],
    data: () => ({
        complects: [{Form: {
            id: 1,
            selected: "",
            selectType: "",
        }}],
        count: 2,
        rolesArray: [],
        modalShow: false,
        editUser: {
            id: '',
            name: '',
            email:'',
            password:'',
            role_id:'',
        }
    }),
    mounted() {
        this.loadEditUser();
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
        loadEditUser() {
            this.editUser = this.user;
        },
        updateUser() {
            axios.patch('api/user/' + this.user.id,  this.editUser,  {
                headers: {'Access-Control-Allow-Origin': true }
            })
            .then((response) => {
                this.modalShow = false;
                this.$emit('updateUser', response.data)
                this.permissions();
            })
            .catch((error) => {
                console.log(error);
            })
        },
        permissions() {
            axios.post('api/user', [this.complects, this.user.id])
            .then((res => {
                console.log(res);
            }))
        },
    }
}
</script>
