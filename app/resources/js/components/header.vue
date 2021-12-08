<template>
    <b-navbar toggleable="lg" type="light" variant="light">
        <b-navbar-brand href="/"> СР-Профиль</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="nav-main" v-if="this.user == 1">
                    <router-link
                        :to="link.href"
                        v-for="link in links"
                        :key="link.id">
                        {{ link.title }}
                    </router-link>
                </b-navbar-nav>
                <b-navbar-nav class="nav-main" v-else>
                    <router-link
                        :to="link.href"
                        v-for="link in links1"
                        :key="link.id">
                        {{ link.title }}
                    </router-link>
                </b-navbar-nav>
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown right>
                    <template #button-content>
                        <em>{{userName}}</em>
                    </template>
                    <b-dropdown-item @click.prevent="logout"><b-icon icon='box-arrow-right'></b-icon> Выход</b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
export default {
    data: () => ({
        user: '',
        userName: '',
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
        this.userName = localStorage.getItem('user_name')
    },
    methods: {
        logout() {
            axios.post('/logout')
            .then((res) => {
                window.location.href = '/'
            })
        }
    }
}
</script>
