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
            <h5 class="mb-3">Смены</h5>
            <v-modalAdd @send="brigadeNew"></v-modalAdd>
            <table class="table table-sm mt-3">
                <thead>
                    <tr>
                        <th>Наименование бригады</th>
                        <th>Доступны на заводах</th>
                        <th class="col-2">Операции</th>
                    </tr>
                </thead>
                <tbody>
                    <brigadeTable v-for="brigade in brigadeArray" :key="brigade.id" :brigade="brigade" @removeBrigade="loadBrigade()"> </brigadeTable>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
import brigadeTable from "../components/brigade/brigadeTable.vue"
export default {
    components: {brigadeTable},
    data: () => ({
        brigadeArray: [],
        form: {},
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
        ]
    }),
    mounted() {
        this.loadBrigade();
    },
    methods: {
        loadBrigade() {
            axios.get('/api/brigade')
            .then(res => {
                this.brigadeArray = res.data;
                console.log(this.brigadeArray)
            })
        },
        brigadeNew(data) {
            this.brigadeArray.push(data);
        }
    }
}
</script>
