<template>
    <div>

        <b-button v-b-modal.modal-1 class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-plus"></i> Приход металла</b-button>

            <b-modal id="modal-1" title="Приход металла">

                <!-- <v-inputdata></v-inputdata> -->
                <div class="form-group">
                    <label>Дата поступления</label>
                    <input type="date" v-model="form.receipt_date" placeholder="Введите дату" class="form-control" />
                </div>

                <!-- <v-selectcounterparties></v-selectcounterparties> -->
                <div>
                    <label>Контрагенты</label>
                    <select v-model="form.counterparty_id">
                        <option v-for="counterparties in counterpartiesArray" v-bind:key="counterparties.id" v-bind:value="counterparties.id">{{counterparties.name}} </option>
                    </select>
                </div>

                <!-- <v-selectwarehouse></v-selectwarehouse> -->
                <div>
                    <label>Склад</label>
                    <select v-model="form.warehouse_id">
                        <option size="sm" class="mt-3"  v-for="warehouse in warehouseArray" v-bind:key="warehouse.message" v-bind:value="warehouse.id">{{warehouse.name}} </option>
                    </select>
                </div>
                <!-- <v-selecttype></v-selecttype> -->
                <div>
                    <label>Тип металла</label>
                    <select v-model="form.type_metal_id">
                        <option v-for="types in selecttype" v-bind:key="types.id" v-bind:value="types.id">{{types.name}} </option>
                    </select>
                </div>

                <!-- <v-inputwidth></v-inputwidth> -->
                <div class="form-group">
                    <label>Ширина, мм</label>
                    <input type="number" v-model="form.width" placeholder="1250" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Длина</label>
                    <input type="number" v-model="form.length" placeholder="1250" class="form-control" />
                </div>

                <!-- <v-selectthickness></v-selectthickness> -->
                <div>
                    <label>Толщина</label>
                    <select v-model="form.metal_thickness_id">
                        <option size="sm" class="mt-3" v-for="thicknesse in thicknessesArray" v-bind:key="thicknesse.id" v-bind:value="thicknesse.id">{{thicknesse.thicknesses}} </option>
                    </select>
                </div>

                <!-- <v-inputweight></v-inputweight> -->
                <div class="form-group">
                    <label>Вес, т</label>
                    <input type="number" v-model="form.weight" placeholder="0.00" class="form-control" />
                </div>

                <!-- <v-inputprice></v-inputprice> -->
                <div class="form-group">
                    <label>Цена покупки, руб. за тн.</label>
                    <input type="number" v-model="form.price" placeholder="" class="form-control" />
                </div>

                <!-- <v-checkbox></v-checkbox> -->
                <input type="radio" id="one" value="1" v-model="form.available">
                <label for="one">Бухта в пути</label>
                <br>
                <input type="radio" id="two" value="2" v-model="form.available">
                <label for="two">Бухта на складе</label>


                <div slot="modal-footer">
                    <button v-on:click="send" size="sm" class="btn btn-primary input-group-addon">Сохранить</button>
                </div>
            </b-modal>

    </div>

</template>

<script>

export default {

    data: () => ({
        warehouseArray: [],
        options: [
            { warehouseArray: '', value: '' },
        ],
        thicknessesArray: [],
        options: [
            { thicknessesArray: '', value: '' },
        ],
        selecttype: [],
        options: [
            {selecttype: '', value: ''},
        ],
        counterpartiesArray: [],
        options: [
        { counterpartiesArray: '', value: '' },
        ],
        form:{
            "receipt_date": "",
            "warehouse_id": "",
            "type_metal_id": "",
            "width": "",
            "weight": "",
            "metal_thickness_id": "",
            "length": "",
            "price": "",
            "available": "",
            "counterparty_id": ""
        }
    }),
    mounted() {
        this.loadwarehouse();
        this.loadtypes();
        this.loadcounterparties();
        this.loadthicknesse();
    },
    methods: {

        loadwarehouse() {
            axios.get('/api/warehouse')
            .then(res => {
                this.warehouseArray = res.data;
            })
        },
        loadtypes() {
            axios.get('/api/types')
            .then(res => {
                this.selecttype = res.data;
            })
        },
        loadcounterparties() {
            axios.get('/api/counterparties')
            .then(res => {
                this.counterpartiesArray = res.data;
            })
        },
        loadthicknesse() {
            axios.get('/api/thicknesse')
            .then(res => {
                this.thicknessesArray = res.data;
            })
        },
        send: function () {
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
