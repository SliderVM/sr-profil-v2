<template>
    <div class="top">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <a href="/welcome" class="top-brand">СР-Профиль</a>
                <nav class="nav-main">
                    <router-link
                        :to="link.href"
                        v-for="link in links"
                        :key="link.id"
                        >{{ link.title }}</router-link>
                </nav>
                <nav class="nav-extra ml-auto">
                    <a href="/logout"><b-icon icon="box-arrow-right"></b-icon> Выход </a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
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
        };
    }
};
</script>
