<template>
    <div class="top">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a href="#" class="top-brand">СР-Профиль</a>
                <nav class="nav-main">
                    <!-- <li class="active" ><a href="#" class="top-brand">СР-Профиль</a></li> -->
                    <router-link
                        :to="link.href"
                        v-for="link in links"
                        :key="link.id"
                        >{{ link.title }}</router-link
                    >
                </nav>

                <!-- <nav class="nav-main">
                    <a href="index.html">Бухта</a>
                    <a href="shtrips.html">Штрипс</a>
                    <a href="truba.html">Труба</a>
                    <a href="demands.html">Заявки <span class="badge badge-pill badge-danger">5</span></a> -->
                <!-- <a href="#"><Обрезь</a>
                    <a href="#"><Теплица</a> -->
                <!-- <a href="info.html">Справочники</a>
                    <a href="info3.html">Производители</a>
                    <a href="info4.html">Клиенты</a>
                </nav>
                -->
                <nav class="nav-extra ml-auto">
                    <a href="#"><i class="fa fa-sign-out"></i> Выход</a>
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
                    title: "Бухта",
                    href: "/buhtas"
                },
                {
                    title: "Штрипс",
                    href: "/shtrips"
                },
                {
                    title: "Труба",
                    href: "/truba"
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
