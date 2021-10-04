<template>
    <div class="top">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <router-link to="/" class="top-brand">СР-Профиль</router-link>
                <nav class="nav-main" v-if="this.user == 1">
                    <router-link
                        :to="link.href"
                        v-for="link in links"
                        :key="link.id">
                        {{ link.title }}
                    </router-link>
                </nav>
                <nav class="nav-main" v-else>
                    <router-link
                        :to="link.href"
                        v-for="link in links1"
                        :key="link.id">
                        {{ link.title }}
                    </router-link>
                </nav>
                <b-button variant="outline-primary" size="sm" @click.prevent="logout"><b-icon icon='box-arrow-right'></b-icon> Выход</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        user: '',
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
        ],
        links1: [
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
            }
        ]
    }),
    created() {
        this.user = localStorage.getItem('user_role')
    },
    methods: {
        logout() {
            axios.post('/logout')
            .then((response) => {
                console.log(response);
                window.location.href = '/'
            })
            .catch((errors) => {
                console.log(errors)
            })
        }
    }
}
</script>
