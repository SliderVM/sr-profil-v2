<template>
    <div class="container-fluid">
        <!-- <h5 class="mb-3">Справочники</h5>
        <div class="row">
            <div class="col-3">
                <div class="list-group small">
                     <router-link :to="link.href" v-for="link in links" :key="link.id" class="list-group-item">{{link.title}}</router-link>
                </div>
            </div>
            <div class="col-9">
                <h2 class="mb-3">Размер</h2>
                <div class="input-group my-4">
                    <input placeholder="Добавьте размер в мм" class="form-control">
                    <button class="btn btn-sm btn-outline-primary"><b-icon icon="plus-square"></b-icon> Добавить</button>
                </div>
                <table class="table table-sm mt-3">
                    <thead>
                        <tr>
                            <th>Размер, мм</th>
                            <th width="40"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div> -->
    <div>
        Email: {{user.email}}
        <button @click.prevent="logout">Logout</button>
    </div>
    </div>
</template>

<script>
export default {
data: () => ({
    user: {},
    token: localStorage['token'],
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
        }
    ]
}),
mounted() {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
    axios.get('api/user').then((response) => {
        console.log(response)
        this.user = response.data
    }).catch((errors) => {
        console.log(errors)
    })
},
methods: {
    logout(){
        axios.post('api/logout').then((response) => {
            localStorage.removeItem('token')
            this.$router.push('/login')
        }).catch((errors) => {
            console.log(errors)
        })
    }
}
}
</script>
