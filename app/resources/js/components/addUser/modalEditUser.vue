<template>
<div>
    <div class='btn-group'>
         <b-button @click="modalShow=!modalShow" size="sm" variant='outline-primary' ><b-icon icon="pencil"></b-icon></b-button>
    </div>
    <b-modal id="updateUser" v-model="modalShow" title="Обновление информации о пользователе">
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
        </div> <div class="form-group">
            <label>Роль пользователя</label>
            <input type="text" v-model="editUser.role" class="form-control" />
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
        modalShow: false,
        editUser: {
            id: '',
            name: '',
            email:'',
            password:'',
            role:'',
        }
    }),
    mounted() {
        this.loadEditUser();
    },
    methods: {
        loadEditUser() {
            this.editUser = this.user;
        },
        updateUser() {
            axios.patch('api/user/' + this.user.id,  this.editUser,  {
                headers: {'Access-Control-Allow-Origin': true }
            })
            .then((response) => {
                this.$bvModal.hide('updateUser')
                this.$emit('updateUser', response.data)
            })
            .catch((error) => {
                console.log(error);
            })
        }
    }
}
</script>
