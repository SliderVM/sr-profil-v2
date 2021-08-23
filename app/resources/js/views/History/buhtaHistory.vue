<template>
    <div class="hidden" v-if="visible">
         <b-table-simple bordered>
            <b-thead>
                <b-tr>
                    <b-th>Наименование</b-th>
                    <b-th>Контрагент</b-th>
                    <b-th>Тип металла</b-th>
                    <b-th>Ширина, мм</b-th>
                    <b-th>Толщина, мм</b-th>
                    <b-th>Длина, м</b-th>
                    <b-th>Вес, тн</b-th>
                    <b-th>Стоимость, руб</b-th>
                    <b-th>Операции</b-th>
                </b-tr>
            </b-thead>
           <b-tbody v-for="buhta in aprArray" :key="buhta.id">
                <b-tr>
                    <b-td @click="loadShtrips(buhta.id)">{{buhta.name}}</b-td>
                    <b-td>{{buhta.counterparties.name}}</b-td>
                    <b-td>{{buhta.types_metals.name}}</b-td>
                    <b-td>{{buhta.width}}</b-td>
                    <b-td>{{buhta.metal_thicknesse.thicknesses}}</b-td>
                    <b-td>{{buhta.length}}</b-td>
                    <b-td>{{buhta.weight}}</b-td>
                    <b-td>{{buhta.price}}</b-td>
                    <b-td>{{buhta.warehouse_id}}</b-td>
                    <b-td>
                        <div class='btn-group'>
                            <b-button @click="restartBuht" :value="buhta.id" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon> Откатить бухту</b-button>
                        </div>
                    </b-td>
                </b-tr>
                <b-tr class="hidden" v-if="buhta.id === shtripsId">
                    <shtrips :shtrips="shtrips"></shtrips>
                </b-tr>
           </b-tbody>
        </b-table-simple>
        <div class="mt-3">
            <!-- <b-pagination
                v-model="currentPage"
                :total-rows="rows"
                :per-page="perPage"
                align="right"
            ></b-pagination> -->
            <ul>
            <li v-for="p in paginatedData">
            {{p.first}}
            {{p.last}}
            {{p.suffix}}
            </li>
        </ul>
        <button @click="prevPage">
            Previous
        </button>
        <button @click="nextPage">
            Next
        </button>
        </div>
    </div>
</template>

<script>
import shtrips from './shtripsHistory.vue'
export default {
    props: ["warehouseKey"],
    components: {shtrips},
    data:() => ({
        aprArray: [],
        shtrips: [],
        shtripsId: '',
        visible: false,
        pageNumber: 1,
        size: 7
    }),
    computed: {
        rows() {
            let l =  this.aprArray.length, // опредляет длину массива с данными для разбивки на страницы
            s = this.size;
            return Math.ceil(l/s);
        },
        paginatedData(){
            const start = this.pageNumber * this.size,
                end = start + this.size;
            return this.aprArray.slice(start, end);
        }
    },
    mounted() {
        this.loadBuht();
        // this.loadBuhtWarehouse();
    },
    methods: {
        nextPage(){
           this.pageNumber++;
        },
        prevPage(){
           this.pageNumber--;
        },
        loadBuht() {
            axios.get('/histories') // получить бухты
            .then(res => {
                console.log(res);
                this.aprArray = res.data
                if (res.data.length ) {
                    this.visible = true
                }
                else {
                    alert('Нет бухт с АПР');
                    this.visible = false
                }
            })
        },
        // loadBuhtWarehouse() {
        //     console.log(this.warehouseKey)
        //     if(this.warehouseKey != null) {
        //         axios.get('/histories/' + this.warehouseKey) // получить бухты по айди склада
        //         .then(res => {
        //             console.log(res);
        //             this.aprArray = res.data
        //             if (res.data.length ) {
        //                 this.visible = true
        //             }
        //             else {
        //                 alert('Нет бухт с АПР');
        //                 this.visible = false
        //             }
        //         })
        //     }
        // },
        loadShtrips(id) { // получить штрипс по айди бухты
            axios.get('/api/shtrips/' + id)
            .then(res => {
                if(res.data.length == 0) {
                    alert('нет штрипса')
                }
                this.shtrips = res.data;
                this.shtripsId = id;
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
