<template>
    <div>

        <b-button v-b-modal.modal-1 size="sm"><b-icon icon="plus-square"></b-icon> Приход металла</b-button>

            <b-modal id="modal-1" title="Приход металла">

                <v-InputData @Vibe='Ran'></v-InputData>

                <!-- <v-selectcounterparties></v-selectcounterparties> -->
                <div>
                    <label>Контрагенты</label>
                    <multiselect
                    v-model="Value"
                    :options="CounterpartiesArray"
                    track-by="id"
                    label="name"
                    :options-limit="3"
                    open-direction="bottom"
                    :hide-selected="true"
                    placeholder="Начните вводить"
                    @open="CounterpartiesOpen"
                    @select="CounterpartiesSearch">
                    </multiselect>
                </div>

                <!-- <v-selectwarehouse></v-selectwarehouse> -->
                <div>
                    <label>Склад</label>
                    <select v-model="form.warehouseId">
                        <option size="sm" class="mt-3"  v-for="warehouse in warehouseArray" v-bind:key="warehouse.message" v-bind:value="warehouse.id">{{warehouse.name}} </option>
                    </select>
                </div>
                <!-- <v-selecttype></v-selecttype> -->
                <div>
                    <label>Тип металла</label>
                    <select v-model="form.typeMetalId">
                        <option v-for="types in selecttype" v-bind:key="types.id" v-bind:value="types.id">{{types.name}} </option>
                    </select>
                </div>


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
                    <select v-model="form.metalThicknessId">
                        <option size="sm" class="mt-3" v-for="thicknesse in thicknessesArray" v-bind:key="thicknesse.id" v-bind:value="thicknesse.id">{{thicknesse.thicknesses}} </option>
                    </select>
                </div>

                <v-InputWeight @Ves='VesTonna'></v-InputWeight>

                 <div class="form-group">
                    <label>Цена покупки, руб. за тн.</label>
                    <input type="number" v-model="form.price" class="form-control" />
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
import InputData from './addbuht/Input/InputData.vue';
import InputWeight from './addbuht/Input/InputWeight.vue';
import multiselect from 'vue-multiselect'
Vue.component('multiselect', multiselect)
export default {
components: {
    multiselect,
    InputData,
    InputWeight,
},
data: () => ({
    CounterpartiesArray: [],
    Value: '',
    trackBy: 'id',

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
    form:{
        "receiptDate": "",
        "warehouseId": "",
        "typeMetalId": "",
        "width": "",
        "weight": "",
        "metalThicknessId": "",
        "length": "",
        "price": "",
        "available": "",
        "counterpartyId": ""
    }
}),

    mounted() {
        this.loadwarehouse();
        this.loadtypes();
        this.loadthicknesse();
    },
    methods: {
        Ran(data) {
            this.form.receiptDate = data.receiptDate;
        },
        VesTonna(data) {
            this.form.weight = data.weight;
        },
        CounterpartiesOpen () {
            axios.get('/api/counterparties')
            .then(res => {
                this.CounterpartiesArray = res.data;
            });
        },
        CounterpartiesSearch () {
            axios.get('/api/counterparties')
            .then(res => {
                this.CounterpartiesArray = res.data;
                console.log(this.Value);
                this.form.counterpartyId = this.Value.id;
            });
        },
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

