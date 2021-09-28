<template>
<div class="container-fluid">
        <h5 class="mb-3">Справочники</h5>
        <div class="row">
            <div class="col-3">
                <div class="list-group small">
                    <router-link :to="link.href" v-for="link in links" :key="link.id" class="list-group-item">{{link.title}}</router-link>
                </div>
            </div>
            <div class="col-9">
                <h5 class="mb-3">Пользователи</h5>
                <addUser @reg="loadUsers()"></addUser>
                <table class="table table-sm mt-3 table-metal-weight">
                    <thead>
                        <tr>
                            <th>Пользователь</th>
                            <th>Роль</th>
                            <th class="col-1"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <user v-for="user in UsersArray"
                        :key="user.id" :user="user" @updateUser="loadUsers()" @removeUser="loadUsers()" />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import addUser from '../components/addUser/modalAddUser.vue'
import user from '../components/addUser/user.vue'
export default {
    components: {user, addUser},
    data: () => ({
        UsersArray: [],
        links: [
            {
                title: "Тип металла",
                href:"/info"
            },
            {
                title: "Размеры труб",
                href:"/info2"
            },
            {
                title: "Толщина металла",
                href:"/info5"
            },
            {
                title: "Управление складами",
                href:"/warehouseinfo"
            },
            {
                title: "Смены",
                href:"/brigade"
            },
            {
                title: "Пользователи",
                href:"/users"
            },
            {
                title: "Конфигурации",
                href:"/configuration"
            },
            {
                title: "Сорт труб",
                href:"/pipegrade"
            },
        ]
    }),
    mounted() {
        this.loadUsers();
    },
    methods: {
        loadUsers() {
            axios.get('/api/user')
            .then(res => {
                this.UsersArray = res.data;
            })
        },
    }
}
</script>
