<template>
    <div class="container-fluid">
            <h5 class="mb-3">Справочники</h5>
                <div class="row">
                    <div class="col-3">
                        <div class="list-group small">
                            <router-link :to="link.href" v-for="link in links" :key="link.id" class="list-group-item">{{link.title}} </router-link>
                        </div>
                    </div>
                    <div class="col-9">
                        <h2 class="mb-3">Склады</h2>
                        <v-ModalWarehouse></v-ModalWarehouse>
                    </div>
                </div>
    </div>
</template>

<script>
export default {
    data: () => ({
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
        ]
    }),
}
</script>

<style>

</style>
