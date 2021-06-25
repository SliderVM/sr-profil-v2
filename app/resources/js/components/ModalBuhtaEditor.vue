<template>
    <div class="btn-group">
        <b-button @click="modalShow=!modalShow" size="sm" variant="outline-primary"><b-icon icon="calculator"></b-icon> АПР</b-button>

        <b-button type="button" v-if="visible && buhta.available == 1" @click="prihod" :value="buhta.id" variant="outline-primary">Оприходовать</b-button>

        <b-button @click="del" :value="buhta.id" size="sm" variant="outline-primary"><b-icon icon="x"></b-icon></b-button>

        <b-modal v-model="modalShow" size="lg" >
            <div slot="modal-title">
                <label>Бухта №{{buhta.id}}, тип {{buhta.types_metals.name}}, толщина {{buhta.metal_thickness_id}} мм, {{buhta.weight}}тн. </label>
                 <br>Ширина: {{buhta.width}} мм
            </div>
            <v-aprModal :buhta="buhta" @send='receive' v-for="(complect, index) in complects" :key="index" v-on:remove="removeApr"></v-aprModal>
            <br>
             <span class='btn btn-success' @click='addNewComplect'>Добавить</span>
            <div slot="modal-footer">
                <b-button size="sm" @click="savve" variant="outline-primary">Сохранить </b-button>
            </div>
        </b-modal>
    </div>

</template>

<script>
import aprModal from './aprModal.vue'
export default {
    components: {aprModal},
    props: ["buhta"],
    data: () => ({
        modalShow: false,
        visible: true,
        Form:{
            id: "",
            width: "",
            width1: "",
            amount: "",
            tonage: "",
        },
        complects: [],
        count: 0
    }),
    mounted() {
        this.loadForm();
    },
    methods: {
        addNewComplect() {
            console.log(this.complects);
			this.complects.push({placeholder: 'Textbox ' + (++this.count)});
		},
        countofComplect() {
            this.complectCount = this.complects.length - 1;
            this.fieldsCount = this.complects.length;
        },
        loadForm() {
            this.Form = this.buhta;
        },
        receive(data) {
            this.Form.amount = data.amount;
            this.Form.tonage = data.tonage;
            this.Form.width1 = data.width;
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
        },
        removeApr(id) {
            axios.delete('api/apr/' + id);
        },
        loadApr() {
            axios.get('/api/apr')
            .then(res => {
                this.apr = res.data;
            })
        }
    }
}
</script>
