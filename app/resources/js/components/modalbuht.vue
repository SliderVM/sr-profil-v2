<template>
    <div>
        <b-button @click="modalShow=!modalShow" size="sm" variant="outline-primary"><b-icon icon="plus-square"></b-icon> Приход металла</b-button>
        <b-modal size="lg" v-model="modalShow" title="Приход металла">
            <b-row>
                <b-col>
                    <b-form-group id="input-group-Date" label="Дата" label-for="input-Date">
                        <b-form-datepicker id="input-Date" v-model="form.receiptDate" class="mb-2"></b-form-datepicker>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-name" label="Наименование" label-for="input-name">
                        <b-form-input
                        id="input-name"
                        v-model="form.name" placeholder="Введите наименование"
                        required
                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-Counterparties" label="Контрагенты" label-for="Counterparties">
                        <multiselect
                            id="Counterparties"
                            v-model="Value"
                            :options="CounterpartiesArray"
                            label="name"
                            :options-limit="3"
                            open-direction="bottom"
                            :hide-selected="true"
                            placeholder="Начните вводить"
                            @open="CounterpartiesOpen"
                            @select="CounterpartiesSearch">
                        </multiselect>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-warehouse" label="Склад" label-for="warehouse">
                        <b-form-select v-model="form.warehouseId" id="warehouse">
                            <option
                                size="sm"
                                class="mt-3"
                                v-for="warehouse in warehouseArray"
                                :key="warehouse.id"
                                :value="warehouse.id">
                                {{ warehouse.name }}
                            </option>
                        </b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-typeMetal" label="Тип металла" label-for="typeMetal">
                        <b-form-select v-model="form.typeMetalId" id="typeMetal">
                            <option
                                v-for="types in selecttype"
                                :key="types.id"
                                :value="types.id">
                                {{ types.name }}
                            </option>
                        </b-form-select>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-width" label="Ширина, мм" label-for="width">
                    <b-form-input
                            id="width"
                            v-model.number="form.width"
                            placeholder="Укажите ширину бухты"
                            required>
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-length" label="Длина" label-for="length">
                    <b-form-input
                            id="length"
                            v-model.number="form.length"
                            placeholder="Укажите длину бухты"
                            required>
                        </b-form-input>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-metalThickness" label="Толщина" label-for="metalThickness">
                        <b-form-select v-model="form.metalThicknessId" id="metalThickness">
                            <option
                                size="sm"
                                class="mt-3"
                                v-for="thicknesse in thicknessesArray"
                                :key="thicknesse.id"
                                :value="thicknesse.id">
                                {{ thicknesse.thicknesses }}
                            </option>
                        </b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <v-InputWeight @Ves="VesTonna"></v-InputWeight>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-price" label="Цена покупки, руб. за тн." label-for="price">
                        <b-form-input
                            id="price"
                            v-model.number="form.price"
                            required>
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-form-group v-slot="{ ariaDescribedby }">
                    <b-form-radio-group value="-1" v-model="form.available" :aria-describedby="ariaDescribedby" name="some-radios">Бухта в пути</b-form-radio-group>
                    <b-form-radio-group value="1" v-model="form.available" :aria-describedby="ariaDescribedby" name="some-radios" >Бухта на складе</b-form-radio-group>
            </b-form-group>
            <div slot="modal-footer">
                <button @click="send" size="sm" class="btn btn-outline-primary">
                    Сохранить
                </button>
            </div>
        </b-modal>
    </div>
</template>

<script>
import multiselect from "vue-multiselect";
export default {
    components: {multiselect},
    data: () => ({
        modalShow: false,
        CounterpartiesArray: [],
        Value: "",
        warehouseArray: [],
        optionsW: [{ warehouseArray: "", value: "" }],
        thicknessesArray: [],
        options: [{ thicknessesArray: "", value: "" }],
        selecttype: [],
        options: [{ selecttype: "", value: "" }],
        form: {
            name: "",
            receiptDate: "",
            warehouseId: "",
            typeMetalId: "",
            width: "",
            weight: "",
            metalThicknessId: "",
            length: "",
            price: "",
            available: "",
            counterpartyId: ""
        }
    }),
    mounted() {
        this.loadwarehouse();
        this.loadtypes();
        this.loadthicknesse();
    },
    methods: {
        VesTonna(data) {
            this.form.weight = data.weight;
        },
        CounterpartiesOpen() {
            axios.get("/api/counterparties").then(res => {
                this.CounterpartiesArray = res.data;
            });
        },
        CounterpartiesSearch() {
            axios.get("/api/counterparties").then(res => {
                this.CounterpartiesArray = res.data;
                this.form.counterpartyId = this.Value.id;
            });
        },
        loadwarehouse() {
            axios.get("/api/warehouse").then(res => {
                this.warehouseArray = res.data;
            });
        },
        loadtypes() {
            axios.get("/api/types").then(res => {
                this.selecttype = res.data;
            });
        },
        loadthicknesse() {
            axios.get("/api/thicknesse").then(res => {
                this.thicknessesArray = res.data;
            });
        },
        send() {
            axios.post("/api/buhtas", this.form, {
                headers: {"Content-type": "application/json"}
            })
            .then(res => {
                this.modalShow = false;
                this.$emit("send");
                this.form = "";
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>
