<template>
    <div class="btn-group" role="group" aria-label="Basic example">
        <b-button @click="modalShow=!modalShow" size="sm" variant="outline-primary"><b-icon icon="calculator"></b-icon> АПР</b-button>
        <b-button type="button" v-if="visible && buhta.available == 1" @click="prihod" :value="buhta.id" variant="outline-primary">Оприходовать</b-button>
        <b-button @click="del" :value="buhta.id" size="sm" variant="outline-primary"><b-icon icon="x"></b-icon></b-button>

        <b-modal v-model="modalShow" size="lg" >
            <div slot="modal-title">
                <label>Бухта №{{buhta.id}}, {{buhta.types_metals.name}}, {{buhta.metal_thickness_id}} мм, {{buhta.weight}}тн.</label>
            </div>

            <label>Ширина: {{buhta.width}} мм</label>

            <div>
                <label>Тип резки</label>
                <div class="row">
                    <div class="col">
                        <b-input-group append="мм">
                            <input type="number" v-model="Form.width"placeholder="100" />
                        </b-input-group>
                    </div>
                    <div class="col">
                        <b-input-group append="тн">
                            <input type="number" @change="calculation" v-model="Form.tonage"placeholder="Количество тонн" />
                        </b-input-group>
                    </div>

                    <div class="col">
                        <b-input-group append="шт">
                            <input type="number" @change="calculation" v-model="Form.amount" placeholder="0" />
                        </b-input-group>
                    </div>
                </div>
            </div>
            <br>
            <b-button block type="button" size="sm" class="col-lg-12" variant="outline-primary"><b-icon icon="plus-square"></b-icon> Добавить тип резки</b-button>

            <div slot="modal-footer">
                <span class="float-left">Обрезь: мм</span>
                <b-button size="sm" @click="savve" variant="outline-primary">Сохранить </b-button>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ["buhta"],
    data: () => ({
        modalShow: false,
        visible: true,
        Form:{
            id: "",
            width: "",
            amount: "",
            tonage: ""
        }
    }),
    mounted() {
        this.loadForm();
    },
    methods: {
        calculation(){

        },
        loadForm() {
            this.Form = this.buhta;
        },
        prihod: function () {
            axios.put('api/buhtas/' + this.buhta.id, this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data);
                this.visible = false;
            })
            .catch((error) => {
                console.log(error);
            });
        },
          savve: function () {
            axios.post('api/apr/',this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                this.form = response.data;
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
        },
        del: function() {
            this.$emit('remove', this.buhta.id);
            console.log(this.buhta.id);
        }
    }
    }
</script>
