<template>
    <div>
        <b-button @click='modalShow=!modalShow' size='sm' variant='outline-primary' class="mt-2 mb-2"><b-icon icon="plus-square"></b-icon> Добавить трубу</b-button>
        <b-modal v-model="modalShow" size="lg" title="Добавить трубу">
            <b-form-group id="input-group-Counterparties" label="Поставщик" label-for="Counterparties">
                <b-form-select v-model="form.counterpartyId" id="Counterparties">
                    <option
                        v-for="Counterparties in CounterpartiesArray"
                        :key="Counterparties.id"
                        :value="Counterparties.id">
                        {{ Counterparties.name }}
                    </option>
                </b-form-select>
            </b-form-group>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-Date" label="Дата" label-for="input-Date">
                        <b-form-datepicker id="input-Date" v-model="form.receiptDate" class="mb-2"></b-form-datepicker>
                    </b-form-group>
                </b-col>
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
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-thicknesse" label="Толщина, мм" label-for="thicknesse">
                        <b-form-select v-model="form.thicknesseId" id="thicknesse">
                            <option
                                v-for="thicknesse in thicknessesArray"
                                :key="thicknesse.id"
                                :value="thicknesse.id"
                            >
                            {{ thicknesse.thicknesses }}
                        </option>
                        </b-form-select>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-pipeSize" label="Размер трубы" label-for="pipeSize">
                        <b-form-select v-model="form.pipeSize" id="pipeSize">
                            <option
                                v-for="pipetype in pipetypeArray"
                                :key="pipetype.id"
                                :value="pipetype.id">
                                {{ pipetype.name }}
                            </option>
                        </b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-pipeSort" label="Качество трубы" label-for="pipeSort">
                        <b-form-select v-model="form.pipeSort" id="pipeSort">
                            <option
                                v-for="qualitie in qualitieArray"
                                :key="qualitie.id"
                                :value="qualitie.id">
                                {{ qualitie.name }}
                            </option>
                        </b-form-select>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-length" label="Длина одной трубы, м" label-for="input-length">
                        <b-form-input
                        id="input-length"
                        v-model.number="form.length"
                        required
                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-form-group id="input-group-amount" label="Кол-во, шт" label-for="input-amount">
                        <b-form-input
                        id="input-amount"
                        v-model.number="form.amount"
                        required
                        ></b-form-input>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group id="input-group-price" label="Цена за тонну, руб" label-for="input-price">
                        <b-form-input
                        id="input-price"
                        v-model.number="form.price"
                        required
                        ></b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>
            <template #modal-footer>
                <button @click="send" size="sm" class="btn btn-outline-primary">
                    Отправить на склад
                </button>
            </template>
        </b-modal>
    </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
export default {
    data: () => ({
        modalShow: false,
        CounterpartiesArray: [],
        thicknessesArray: [],
        selecttype: [],
        qualitieArray: [],
        pipetypeArray: [],
        form: {
            counterpartyId: "",
            receiptDate: "",
            typeMetalId: "",
            thicknesseId: "",
            pipeSize: "",
            pipeSort: "",
            length: "",
            amount: "",
            price: ""
        }
    }),
    mounted() {
        this.loadtypes();
        this.Counterparties();
        this.loadthicknesse();
        this.pipeSize();
        this.pipeQualitie();
    },
    methods: {
        loadthicknesse() {
            axios.get("/api/thicknesse").then(res => {
                this.thicknessesArray = res.data;
            });
        },
        loadtypes() {
            axios.get("/api/types").then(res => {
                this.selecttype = res.data;
            });
        },
        Counterparties() {
            axios.get("/api/counterparties").then(res => {
                this.CounterpartiesArray = res.data;
            });
        },
        pipeQualitie() {
            axios.get("/api/qualitie").then(res => {
                this.qualitieArray = res.data;
            });
        },
        pipeSize() {
            axios.get("/api/pipetype").then(res => {
                this.pipetypeArray = res.data;
            });
        },
        send() {
            axios.post('api/pipe', this.form)
            .then(res => {
                this.modalShow = false;
                this.form = "";
            })
        }
    }
}
</script>
