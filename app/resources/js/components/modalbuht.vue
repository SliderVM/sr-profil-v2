<template>
    <div>
        <b-button v-b-modal.modal-1 class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-plus"></i> Приход металла</b-button>

            <b-modal id="modal-1" title="Приход металла">
                <!-- <v-inputdata></v-inputdata> -->
                <div class="form-group">
                    <label>Дата поступления</label>
                    <input type="date" v-model="Form.ReceiptDate" placeholder="Введите дату" class="form-control" />
                </div>
                <!-- <v-selectcounterparties></v-selectcounterparties> -->
                <!-- <div> -->
                    <!-- <select v-model="form.counterparty_id">
                        <option v-for="counterparties in counterpartiesArray" v-bind:key="counterparties.id" v-bind:value="counterparties.id">{{counterparties.name}} </option>
                    </select>
                </div> -->
                <div>
                    <label>Контрагенты</label>
                    <multiselect v-model="Value" :options="CounterpartiesArray" @search-change="CounterpartiesSearch"></multiselect>
                </div>


                <!-- <v-selectwarehouse></v-selectwarehouse> -->
                <div>
                    <label>Склад</label>
                    <select v-model="Form.WarehouseId">
                        <option v-for="Warehouse in WarehouseArray" v-bind:key="Warehouse.id" v-bind:value="Warehouse.id">{{Warehouse.name}} </option>
                    </select>
                </div>
                <!-- <v-selecttype></v-selecttype> -->
                <div>
                    <label>Тип металла</label>
                    <select v-model="Form.TypeMetalId">
                        <option v-for="types in SelectType" v-bind:key="types.id" v-bind:value="types.id">{{types.name}} </option>
                    </select>
                </div>

                <!-- <v-inputwidth></v-inputwidth> -->
                <div class="form-group">
                    <label>Ширина, мм</label>
                    <input type="number" v-model="Form.Width" placeholder="1250" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Длина</label>
                    <input type="number" v-model="Form.Length" placeholder="1250" class="form-control" />
                </div>

                <!-- <v-selectthickness></v-selectthickness> -->
                <div>
                    <label>Толщина</label>
                    <select v-model="Form.MetalThicknessId">
                        <option size="sm" class="mt-3" v-for="thicknesse in ThicknessesArray" v-bind:key="thicknesse.id" v-bind:value="thicknesse.id">{{thicknesse.thicknesses}} </option>
                    </select>
                </div>

                <!-- <v-inputweight></v-inputweight> -->
                <div class="form-group">
                    <label>Вес, т</label>
                    <input type="number" v-model="Form.Weight" placeholder="0.00" class="form-control" />
                </div>

                <!-- <v-inputprice></v-inputprice> -->
                <div class="form-group">
                    <label>Цена покупки, руб. за тн.</label>
                    <input type="number" v-model="Form.Price" placeholder="" class="form-control" />
                </div>

                <input type="radio" id="one" value="1" v-model="Form.Available">
                <label for="one">Бухта в пути</label>
                <br>
                <input type="radio" id="two" value="2" v-model="Form.Available">
                <label for="two">Бухта на складе</label>


                <div slot="modal-footer">
                    <button v-on:click="Send" size="sm" class="btn btn-primary input-group-addon">Сохранить</button>
                </div>
            </b-modal>

    </div>

</template>

<script>
import multiselect from 'vue-multiselect'
Vue.component('multiselect', multiselect)
export default {
    components: { multiselect },
    data: () => ({

        CounterpartiesArray: [],
        Value: [],

        WarehouseArray: [],
        options: [
            { WarehouseArray: '', Value: '' },
        ],

        ThicknessesArray: [],
        options: [
            { thicknessesArray: '', Value: '' },
        ],

        SelectType: [],
        options: [
            {SelectType: '', Value: ''},
        ],

        Form:{
            "ReceiptDate": "",
            "WarehouseId": "",
            "TypeMetalId": "",
            "Width": "",
            "Weight": "",
            "MetalThicknessId": "",
            "Length": "",
            "Price": "",
            "Available": "",
            "CounterpartyId": ""
        }
    }),
    mounted() {
        this.LoadWarehouse();
        this.LoadTypes();
        this.LoadCounterparties();
        this.LoadThicknesse();
    },
    methods: {
        CounterpartiesSearch () {
            axios.get('/api/counterparties').then(response => {
            this.CounterpartiesArray = response;
            })
        },
        LoadWarehouse() {
            axios.get('/api/warehouse')
            .then(res => {
                this.warehouseArray = res.data;
            })
        },
        LoadTypes() {
            axios.get('/api/types')
            .then(res => {
                this.SelectType = res.data;
            })
        },
        LoadCounterparties() {
            axios.get('/api/counterparties')
            .then(res => {
                this.CounterpartiesArray = res.data;
                console.log(res.data)
            })
        },
        LoadThicknesse() {
            axios.get('/api/thicknesse')
            .then(res => {
                this.ThicknessesArray = res.data;
            })
        },
        Send: function () {
            axios.post('/api/buhtas',this.form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                this.form = response.data;
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
        }
    }
}
</script>


