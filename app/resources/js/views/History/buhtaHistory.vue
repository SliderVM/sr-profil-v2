<template>
    <div v-if="visible">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Контрагент</th>
                    <th>Тип металла</th>
                    <th>Ширина, мм</th>
                    <th>Толщина, мм</th>
                    <th>Длина, м</th>
                    <th>Вес, тн</th>
                    <th>Стоимость, руб</th>
                    <th class="col-2"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="buhta in pageOfItems"
                :key="buhta.id" @click="load(buhta.id)">
                    <td>{{buhta.name}}</td>
                    <td>{{buhta.counterparties.name}}</td>
                    <td>{{buhta.types_metals.name}}</td>
                    <td>{{buhta.width}}</td>
                    <td>{{buhta.metal_thicknesse.thicknesses}}</td>
                    <td>{{buhta.length}}</td>
                    <td>{{buhta.weight}}</td>
                    <td>{{buhta.price}}</td>
                    <td> <b-button @click="restartBuht(buhta.id)" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon> Откатить прокат бухты</b-button></td>
                </tr>
            </tbody>
        </table>
        <shtrips v-if="show" :shtrips="shtrips" @cancel="loadShtrips"></shtrips>
        <div class="d-flex justify-content-end pb-0 pt-3">
            <jw-pagination :items="buhtas" @changePage="onChangePage" :pageSize="3" :labels="customLabels"></jw-pagination>
        </div>
    </div>
</template>

<script>
import shtrips from './shtripsHistory.vue'
const customLabels = {
    first: 'В начало',
    last: 'В конец',
    previous: 'Назад',
    next: 'Вперед'
};
export default {
    components: {shtrips},
    props: ["wID"],
    data:() => ({
        customLabels,
        visible: false,
        buhtas: [],
        pageOfItems: [],
        val: '',
        show: false,
        shtrips: []
    }),
    mounted() {
        this.loadBuht();
    },
    methods: {
        load(id) {
            this.show = true;
            axios.get('/api/shtrips/' + id)
            .then(res => {
                if(res.data.length == 0) {
                    alert('нет штрипса для данной бухты')
                    this.show = false;
                }
                this.shtrips = res.data
            })
        },
        onChangePage(buhtas) {
            this.pageOfItems = buhtas;
        },
        loadBuht() {
            axios.post('history', this.wID, {
                headers: {"Content-type": "application/json"}
            }) // получить все бухты или по складу(если пришел wID)
            .then(res => {
                this.buhtas = res.data;
                this.visible = true;
            })
        },
        loadShtrips(id) { // получить штрипс по айди бухты
            axios.get('/api/shtrips/' + id)
            .then(res => {
                this.shtrips = res.data
                console.log(this.shtrips);
            })
        },
        restartBuht(event) {
            axios.delete('api/shtrips/' + event.target.value) // удалить штрипс по айди бухты
            .then(res => {
                console.log(res)
            })
        }
    }
}
</script>
