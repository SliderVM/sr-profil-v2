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
                <h5 class="mb-3">Сорт труб</h5>
                <modal @pipe="pipeLoad"></modal>
                <table class="table table-sm mt-3">
                    <thead>
                        <tr>
                            <th>Наименование</th>
                        </tr>
                    </thead>
                    <tbody>
                        <pipe v-for="pipe in pipeArray" :key="pipe.id" :pipe="pipe"></pipe>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import modal from '../components/modalPipeGrade.vue'
import pipe from '../components/pipeGrade.vue'
export default {
    components: {modal, pipe},
    data: () => ({
        pipeArray: [],
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
        this.pipeLoad();
    },
    methods: {
        pipeLoad() {
            axios.get('/api/qualitie')
            .then(res => {
                this.pipeArray = res.data;
            })
        }
    }
}
</script>
