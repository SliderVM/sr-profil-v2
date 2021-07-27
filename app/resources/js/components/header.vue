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
                <nav>
                <ul class="list-inline">
                    <li class="pull-right">
                        <router-link :to="{ name: 'login' }">Login</router-link>
                    </li>
                    <li class="pull-right">
                        <router-link :to="{ name: 'register' }">Register</router-link>
                    </li>
                </ul>
            </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
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
            }
        ]
    }),
}
</script>
