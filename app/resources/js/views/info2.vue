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
                <h5 class="mb-3">Размеры труб</h5>
                <modal @size="loadSize"></modal>
                <table class="table table-sm mt-3">
                    <thead>
                        <tr>
                            <th>Вид трубы</th>
                            <th>Ширина штрипса, мм</th>
                            <th>Толщина металла, мм</th>
                            <th>Труб в пачке, шт</th>
                            <th>Вес одного метра трубы, т</th>
                        </tr>
                    </thead>
                    <tbody>
                        <size v-for="size in sizes" :key="size.id" :sizeProp="size"></size>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import size from '../components/Size.vue'
import modal from '../components/modalSizePipe.vue'
export default {
    components: {modal, size},
    data: () => ({
        sizes: [],
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
        this.loadSize();
    },
    methods: {
        loadSize() {
            axios.get('api/pipetype')
            .then(res => {
                this.sizes = res.data;
            })
        }
    }
}
</script>
