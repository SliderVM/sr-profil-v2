<template>
    <div class="hidden" v-if="visible">
        <b-table id="my-table"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            :items="test"
            small
        >
        <template #cell(opr)="row">
            <b-button size="sm" @click="row.row-selected" v-on:click="loadShtrips(row.item.id)" variant='outline-primary' class="mr-2">
            {{ row.detailsShowing ? 'Скрыть' : 'Показать'}} штрипс
            </b-button>
            <b-button @click="restartBuht" :value="row.item.id" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon> Откатить прокат бухты</b-button>
        </template>
        <template #row-details>
            <b-card>
                <b-table
                id="my-table"
                :fields="fieldsShtrips"
                :items="shtrips"
                :per-page="perPage"
                :current-page="currentPage"
                small>
                </b-table>
                <div class="mt-3">
                    <b-pagination
                        v-model="currentPageShtrips"
                        :total-rows="shtripsRows"
                        :per-page="perPage"
                        aria-controls="my-table"
                        align="right"
                    ></b-pagination>
                </div>
            </b-card>
        </template>
        </b-table>
        <b-pagination
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            aria-controls="my-table"
            align="right"
        ></b-pagination>
    </div>
</template>

<script>
export default {
    props: ["wID"],
    data:() => ({
        fieldsShtrips: [ // поля таблицы штрипс
            {key: 'id',
            label: 'ID штрипса'},
            {key: 'buhta_id',
            label: 'ID бухты'},
            {key: 'brigade.name',
            label: 'Наименование бригады'},
            {key: 'date_manufacture',
            label: 'Дата проката'},
            {key: 'counterparties.name',
            label: 'Контрагент'},
            {key: 'types_metals.name',
            label: 'Тип металла'},
            {key: 'width_in_millimeters',
            label: 'Ширина, мм'},
            {key: 'metal_thicknesse.thicknesses',
            label: 'Толщина, мм'},
            {key: 'length_in_meters',
            label: 'Длина, м'},
            {key: 'weight_in_tons',
            label: 'Вес, тн'},
            {key: 'cost',
            label: 'Стоимость, руб'}
        ],
        fields: [ // поля таблицы бухты
            {key: 'name',
            label: 'Наименование'},
            {key: 'counterparties.name',
            label: 'Контрагент'},
            {key: 'types_metals.name',
            label: 'Тип металла'},
            {key: 'width',
            label: 'Ширина, мм'},
            {key: 'metal_thicknesse.thicknesses',
            label: 'Толщина, мм'},
            {key: 'length',
            label: 'Длина, м'},
            {key: 'weight',
            label: 'Вес, тн'},
            {key: 'price',
            label: 'Стоимость, руб'},
            {key: 'opr',
            label: ''}
        ],
        shtrips: [],
        perPage: 3,
        currentPage: 1,
        currentPageShtrips: 1,
        visible: false,
        test: [],
    }),
    mounted() {
        this.loadBuht();
    },
    computed: {
        rows() {
            return this.test.length
        }, // опредляет длину массива с данными для разбивки на страницы для таблицы бухты
        shtripsRows() {
            return this.shtrips.length
        } // опредляет длину массива с данными для разбивки на страницы для таблицы штрипс
    },
    methods: {
        loadBuht() {
            axios.post('history', this.wID, {
                headers: {"Content-type": "application/json"}
            }) // получить все бухты или по складу(если пришел wID)
            .then(res => {
                this.test = res.data;
                this.visible = true;
            })
        },
        loadShtrips(id) { // получить штрипс по айди бухты
            axios.get('/api/shtrips/' + id)
            .then(res => {
                this.shtrips = res.data
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
