<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <select v-model="selected" class="form-control col-3" name="sklad" @change="smena">
                    <option disabled value="">Выберите склад</option>
                    <option size="sm" class="mt-3" v-for="warehouse in warehouseArray" :key="warehouse.id" :value="warehouse.id">
                        {{ warehouse.name }}
                    </option>
                </select>
            </div>
            <div class="col-3">
                <select v-model="selectType" class="form-control col-3" @change="loadPage">
                    <option value="">Выберите тип склада</option>
                    <option size="sm" class="mt-3" v-for="warehouset in warehouseT.warehouse_types" :key="warehouset.id" :value="warehouset.id">
                        {{ warehouset.name }}
                    </option>
                </select>
            </div>
            <div v-if="visible">
                <div>
                    <br>
                        <v-modalbuht @send="loadBuhts"></v-modalbuht>
                    <br>
                </div>
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
                            <b-td colspan="4"></b-td>
                        </b-tr>
                    </b-tfoot>
                </b-table-simple>
            </div>
            <div v-if="show">
                <div>
                    <br>
                    <modal-shtrips></modal-shtrips>
                    <br>
                </div>
                <shtrips :shtrips="shtripsArray" :wId="val"></shtrips>
            </div>
        </div>
    </div>
</template>

<script>
import shtrips from '../views/Warehouses/Shtrips.vue'
import modalShtrips from '../views/Warehouses/modalShtripsReceipt.vue'
import buhta from "../components/buhta.vue"

export default {
    components: {buhta, shtrips, modalShtrips},
    data: () => ({
        warehouseArray: [],
        options: [{ warehouseArray: '', value: '' }],
        warehouseT: {},
        selected: '',
        selectType: '',
        visible: false, // бухты
        show: false, // штрипс
        buhtas: [],
        shtripsArray: [],
        val: '',
    }),
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
        loadPage(event) {
            if(event.target.value == "") {
                this.show = false;
                this.visible = false;
            }
            else if (event.target.value == 1) {
                this.loadBuhts();
                this.show = false;
            }
            else
            {
                this.loadShtrips();
                this.visible = false;
                this.show = true;
            }
        },
        smena(event) {
            axios.get("/api/warehouse/" + event.target.value)
            .then(response => {
                this.warehouseT = response.data;
                this.selectType = ''
                this.val = event.target.value;
                this.show = false;
                this.visible = false;
            });
        },
        loadShtrips() {
            axios.get("/api/shtrips/" + this.val + "/edit")
            .then(res => {
                this.shtripsArray = res.data;
                this.show = true;
            });
        },
    }
}
</script>
