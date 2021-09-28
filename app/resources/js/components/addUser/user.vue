<template>
  <tr>
    <td>
        {{user.name}}
    </td>
    <td>
        {{user.role.title}}
    </td>
    <td>
        <div class='btn-group'>
            <editUser :user="user"></editUser>
            <b-button @click="removeUser" :value="user.id" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon></b-button>
        </div>
    </td>
  </tr>
</template>

<script>
import editUser from '../addUser/modalEditUser.vue'
export default {
    components: {editUser},
    name: "user",
    props: ["user"],
    methods:{
        removeUser() {
            axios.delete('api/user/' + this.user.id)
            .then(res => {
                this.$emit('removeUser')
            })
        }
    }
}
</script>

<style>

</style>
