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
                    <v-modalbuht @send="buhtaNew"></v-modalbuht>
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
        </div>
    </div>
</template>

<script>
import buhta from "../components/buhta.vue";
export default {
    components: { buhta },
    data: () => ({
        warehouseArray: [],
        options: [{ warehouseArray: '', value: '' }],
        warehouseT: {},
        selected: '',
        selectType: '',
        visible: false,
        buhtas: [],
        form: {}
    }),
    mounted() {
        this.loadBuhts();
        this.loadwarehouse();
    },
    methods: {
        loadBuhts() {
            axios.get("/api/buhtas")
            .then(res => {
                this.buhtas = res.data;
            });
        },
        loadwarehouse() {
            axios.get("/api/warehouse/create")
            .then(res => {
                this.warehouseArray = res.data;
            });
        },
        loadPage(event) {
            if (event.target.value == 1) {
                this.visible = true;
            } else {
                alert("Нет бухт с АПР");
                this.visible = false;
            }
        },
        smena(event) {
            axios.get("/api/warehouse/" + event.target.value)
            .then(response => {
                this.warehouseT = response.data;
                this.selectType = ''
            });
        },
        buhtaNew(data) {
            this.form = data.form;
            this.buhtas.push(this.form);
        }
    }
}
</script>
