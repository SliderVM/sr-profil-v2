<template>
    <div>
        <b-button @click="modalShow=!modalShow" size="sm" variant="outline-primary"><b-icon icon="plus-square"></b-icon> Приход металла</b-button>
        <b-modal v-model="modalShow" title="Приход металла" hide-header-close>

            <v-InputData @Vibe="Ran"></v-InputData>
            <div class="form-group">
                <label>Наименование</label>
                <input type="text" v-model="form.name" placeholder="Введите наименование" class="form-control" />
            </div>

            <div>
                <label>Контрагенты</label>
                <multiselect
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
            </div>

            <div>
                <label>Склад</label>
                <select v-model="form.warehouseId">
                    <option
                        size="sm"
                        class="mt-3"
                        v-for="warehouse in warehouseArray"
                        :key="warehouse.id"
                        :value="warehouse.id">
                        {{ warehouse.name }}
                    </option>
                </select>
            </div>

            <div>
                <label>Тип металла</label>
                <select width="100" v-model="form.typeMetalId">
                    <option
                        v-for="types in selecttype"
                        :key="types.id"
                        :value="types.id">
                        {{ types.name }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Ширина, мм</label>
                <input
                    type="number"
                    v-model="form.width"
                    placeholder="Укажите ширину бухты"
                    class="form-control"
                />
            </div>

            <div class="form-group">
                <label>Длина</label>
                <input
                    type="number"
                    v-model="form.length"
                    placeholder="Укажите длину бухты"
                    class="form-control"
                />
            </div>

            <div>
                <label>Толщина</label>
                <select v-model="form.metalThicknessId">
                    <option
                        size="sm"
                        class="mt-3"
                        v-for="thicknesse in thicknessesArray"
                        :key="thicknesse.id"
                        :value="thicknesse.id"
                    >
                        {{ thicknesse.thicknesses }}
                    </option>
                </select>
            </div>

            <v-InputWeight @Ves="VesTonna"></v-InputWeight>

            <div class="form-group">
                <label>Цена покупки, руб. за тн.</label>
                <input
                    type="number"
                    v-model="form.price"
                    class="form-control"
                />
            </div>

            <div>
                <input type="radio" id="negativeOne" value="-1" v-model="form.available" />
                <label for="negativeOne">Бухта в пути</label>
                <br>
                <input type="radio" id="one" value="1" v-model="form.available" />
                <label for="one">Бухта на складе</label>
            </div>

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
        Ran(data) {
            this.form.receiptDate = data.receiptDate;
        },
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
