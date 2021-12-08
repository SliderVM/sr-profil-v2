<template>
    <b-container fluid>
        <b-row class="mt-2">
            <b-col cols="3">
                <b-form-select v-model="selected" name="sklad" @change="smena">
                    <option disabled value="">Выберите склад</option>
                    <option v-for="(warehouse, index) in warehouseArray" :key="index" :value="warehouse.id">
                        {{ warehouse.name }}
                    </option>
                </b-form-select>
            </b-col>
            <b-col cols="3">
                <b-form-select v-model="selectType" @change="loadPage">
                    <option value="">Выберите тип склада</option>
                    <option v-for="warehouset in warehouseT.warehouse_types" :key="warehouset.id" :value="warehouset.id">
                        {{ warehouset.name }}
                    </option>
                </b-form-select>
            </b-col>
        </b-row>
        <div v-if="visible">
            <v-modalbuht @send="loadBuhts" class="mt-2 mb-2"></v-modalbuht>
            <b-table-simple>
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
                        <b-th class="col-2"></b-th>
                    </b-tr>
                </b-thead>
                <b-tbody>
                    <buhta
                        v-for="buhta in buhtas"
                        :key="buhta.id"
                        :buhta="buhta"
                        @removeBuhta="loadBuhts"
                    />
                </b-tbody>
                <b-tfoot>
                    <b-tr>
                        <b-td colspan="7">Итого: </b-td>
                        <b-td colspan="4">{{total}}</b-td>
                    </b-tr>
                </b-tfoot>
            </b-table-simple>
        </div>
        <div v-if="show">
            <modal-shtrips :wId="val" class="mt-2 mb-2"></modal-shtrips>
            <shtrips :shtrips="shtripsArray" :wId="val"></shtrips>
        </div>
        <div v-if="view">
            <pipe :pipeArray="pipeArray"></pipe>
        </div>
    </b-container>
</template>

<script>
import pipe from './pipes/pipe.vue'
import shtrips from '../views/Warehouses/Shtrips.vue'
import modalShtrips from '../views/Warehouses/modalShtripsReceipt.vue'
import buhta from "../components/buhta.vue"

export default {
    components: {buhta, shtrips, modalShtrips, pipe},
    data: () => ({
        selected: '',
        warehouseArray: [],
        options: [{ warehouseArray: '', value: '' }],
        warehouseT: {},
        selectType: '',
        visible: false, // бухты
        show: false, // штрипс
        view: false, // труба
        buhtas: [],
        shtripsArray: [],
        pipeArray: [],
        val: '',
    }),
    computed: {
        total() {
            let a = 0;
            return this.buhtas.reduce(function (a, buhta) {
                return a + Number(buhta.price) || 0
            }, 0);
        }
    },
    mounted() {
        this.loadwarehouse();
    },
    methods: {
        loadBuhts() {
            axios.get("/api/buhtas/" + this.val + "/edit")
            .then(res => {
                this.buhtas = res.data;
                this.visible = true;
            })
        },
        loadwarehouse() {
            axios.get("/api/warehouse/create")
            .then(res => {
                this.warehouseArray = res.data;
            });
        },
        loadPage(value) {
            if(value == "") {
                this.show = false;
                this.visible = false;
                this.view = false;
            }
            else if (value == "1") {
                this.loadBuhts();
                this.show = false;
                this.view = false;
            }
            else if(value == "2") {
                this.loadShtrips();
                this.visible = false;
                this.view = false;
            }
            else if(value == "3")
            {
                this.loadPipe();
                this.visible = false;
                this.show = false;
                this.view = true;
            }
        },
        smena(value) { // селект выбора типа склада
            this.val = value;
            this.selectType = '';
            this.show = false;
            this.visible = false;
            this.view = false;
            axios.get("/api/warehouse/" +  value)
            .then(response => {
                this.warehouseT = response.data;
            });
        },
        loadShtrips() {
            axios.get("/api/shtrips/" + this.val + "/edit")
            .then(res => {
                this.shtripsArray = res.data;
                this.show = true;
            });
        },
        loadPipe() {
            axios.get("api/pipe/" + this.val)
            .then(res => {
                console.log(res.data[0]);
                this.pipeArray = res.data[0];
            })
        }
    }
}
</script>
