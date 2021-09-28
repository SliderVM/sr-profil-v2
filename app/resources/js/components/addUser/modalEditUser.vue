<template>
<div>
    <div class='btn-group'>
         <b-button @click="modalShow=!modalShow" size="sm" variant='outline-primary' ><b-icon icon="pencil"></b-icon></b-button>
    </div>
    <b-modal v-model="modalShow" title="Обновление информации о пользователе" hide-header-close>
        <div class="form-group">
            <label>Имя</label>
            <input type="text" id="name" v-model="editUser.name" class="form-control">
        </div>
        <div>
            <label>E-Mail</label>
            <input type="email" id="email" v-model="editUser.email" class="form-control" placeholder="user@example.com">
        </div>
            <div class="form-group">
            <label>Пароль</label>
            <input type="password" id="password" v-model="editUser.password" class="form-control" >
        </div>
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
        <div slot="modal-footer">
            <button size="sm" @click="updateUser" class="btn btn-primary input-group-addon">Обновить</button>
        </div>
    </b-modal>
</div>
</template>

<script>
export default {
    props: ["user"],
    data: () => ({
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
            })
            .catch((error) => {
                console.log(error);
            })
        }
    }
}
</script>
