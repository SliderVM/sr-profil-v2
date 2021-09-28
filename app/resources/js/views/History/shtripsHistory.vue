<template>
    <div>
        <b-table
            id="my-table"
            :fields="fields"
            :items="shtrips"
            :per-page="perPage"
            :current-page="currentPage"
            small
        >
        <template #cell(opr)='row'>
            <b-button @click="cancelShtrips(row.item.id)" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon> Откатить прокат бухты</b-button>
        </template>
        </b-table>
        <div class="mt-3">
            <b-pagination
                v-model="currentPage"
                :total-rows="rows"
                :per-page="perPage"
                aria-controls="my-table"
                align="right"
            ></b-pagination>
        </div>
    </div>
</template>

<script>
export default {
    props: ['shtrips'],
    data: () => ({
        fields: [
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
            label: 'Стоимость, руб'},
            {key: 'opr',
            label: ''},
        ],
        perPage: 3,
        currentPage: 1,
    }),
    computed: {
        rows() {
            return this.shtrips.length // опредляет длину массива с данными для разбивки на страницы
        }
    },
    methods: {
        cancelShtrips(id) { //откатить штрипс
            axios.post('otmenashtrips/' + id)
            .then(res => {
                if(res.data.length) {
                    alert(res.data)
                }
                this.$emit('cancel')
            })
        },
    }
}
</script>
