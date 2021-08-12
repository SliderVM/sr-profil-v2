<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <select v-model="selected" class="form-control col-3" name="sklad" @change="smena">
                <option disabled value="">Выберите склад</option>
                <option size="sm" class="mt-3"
                v-for="warehouse in warehouseArray"
                :key="warehouse.id"
                :value="warehouse.id">
                {{warehouse.name}}
                </option>
            </select>
        </div>
        <div class="col-3">
            <select class="form-control col-3" id="type" @change="loadPage">
                <option value="">Выберите тип склада</option>
                <option size="sm" class="mt-3" v-for="warehouset in warehouseT.warehouse_types"
                :key="warehouset.id"
                :value="warehouset.id">
                {{warehouset.name}}
                </option>
            </select>
        </div>
        <br>
        <h5>История проката</h5>
        <div v-if="visible">
            <b-table
                id="my-table"
                :fields="fields"
                :items="shtripsArray"
                :per-page="perPage"
                :current-page="currentPage"
                small
                bordered
            ></b-table>
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
    </div>
</div>
</template>

<script>
export default {
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
            label: 'Стоимость, руб'}
        ],
        warehouseArray: [],
        options: [
            { warehouseArray: '', value: '' },
        ],
        warehouseT: {},
        selectType: '',
        selected: '',
        visible: true,
        shtripsArray: [],
        perPage: 5,
        currentPage: 1,
        val1: ''
    }),
    computed: {
        rows() {
            return this.shtripsArray.length // опредляет длину массива с данными для разбивки на страницы
        }
    },
    mounted() {
        this.loadwarehouse();
        this.loadShtrips();
    },
    methods: {
        smena(event) { // событие первого селекта, выбрать склад
            axios.get('/api/warehouse/' + event.target.value)
            .then((response) => {
                this.warehouseT = response.data
                this.val1 = event.target.value
                document.getElementById('type')
                console.log( document.getElementById('type'));
                document.getElementById('type') = null;
                console.log( document.getElementById('type'))
            })
        },
        loadwarehouse() { // загрузка складов
            axios.get('/api/warehouse/create')
            .then(res => {
                this.warehouseArray = res.data;
            })
        },
        loadPage(event) { // событие второго селекта, выбрать тип склада
            if(event.target.value == 1) { // если тип == бухта
                this.loadShtrips();
                this.visible = true;
            }
            else {
                alert('Нет бухт с АПР');
                this.visible = false;
            }
        },
        loadShtrips() { // загрузка штрипса по выбранному складу
            axios.get("/api/shtrips/" + this.val1)
            .then(res => {
                this.shtripsArray = res.data;
                console.log(res)
            });
        }
    }
}
</script>
