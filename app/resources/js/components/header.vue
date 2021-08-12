<template>
    <div class="top">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <router-link to="/" class="top-brand">СР-Профиль</router-link>
                <nav class="nav-main">
                    <router-link
                        :to="link.href"
                        v-for="link in links"
                        :key="link.id"
                        >{{ link.title }}</router-link>
                </nav>
                <b-button  variant="outline-primary" size="sm" @click.prevent="logout"><b-icon icon='box-arrow-right'></b-icon> Выход</b-button>
            </div>
            <!-- <b-button size="sm" @click="logged">Проверить юзера</b-button> -->
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        user: {},
        links: [
            {
                title: "Склады",
                href: "/buhtas"
            },
            {
                title: "Управление производством",
                href: "/productionmanagement"
            },
            {
                title: "Заявки",
                href: "/demands"
            },
            {
                title: "Справочники",
                href: "/info"
            },
            {
                title: "Контрагенты",
                href: "/info3"
            },
            {
                title: "История",
                href: "/history"
            }
        ]
    }),
    methods: {
        logout() {
            axios.post('/logout')
            .then((response) => {
                console.log(response);
                localStorage.removeItem('token');
                this.$router.push({ name: 'login'})
            })
            .catch((errors) => {
                console.log(errors)
            })
        },
        logged() { // получить авторизованного пользователя
            axios.get('/user')
            .then((response) => {
                console.log(response)
            })
        }
    }
}
</script>
