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
                </div>
                <table class="table table-sm table-hover small mt-4" id="buhta">
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
                            <th class="col-2">Операции</th>
                        </tr>
                    </thead>
                    <tbody>
                        <buhta
                            v-for="buhta in buhtas"
                            :key="buhta.id"
                            :buhta="buhta"
                            @removeBuhta="loadBuhts"
                        />
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold">
                            <td colspan="9">Итого:</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div v-if="show">
                <shtrips :shtrips="shtripsArray" :wId="val"></shtrips>
            </div>
        </div>
    </div>
</template>

<script>
import shtrips from '../views/Warehouses/Shtrips.vue'
import buhta from "../components/buhta.vue";
export default {
    components: { buhta, shtrips},
    data: () => ({
        warehouseArray: [],
        options: [{ warehouseArray: '', value: '' }],
        warehouseT: {},
        selected: '',
        selectType: '',
        visible: false,
        buhtas: [],
        form: {},
        val: '',
        show: false,
        shtripsArray: []
    }),
    mounted() {
        this.loadwarehouse();
    },
    methods: {
        loadBuhts() {
            axios.get("/api/buhtas/" + this.val + "/edit")
            .then(res => {
                // if(res.data.length == 0)
                // {
                //     alert('Нет бухт!');
                //     this.visible = false;
                // }
                // else {
                    this.buhtas = res.data;
                    this.visible = true;
                }
            );
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
