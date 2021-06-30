<template>
    <div class='btn-group'>
        <b-button @click='modalShow=!modalShow' size='sm' variant='outline-primary'><b-icon icon='calculator'></b-icon> АПР</b-button>

        <b-button type='button' v-if='visible && buhta.available == 1' @click='prihod' :value='buhta.id' variant='outline-primary'>Оприходовать</b-button>

        <b-button @click='del' :value='buhta.id' size='sm' variant='outline-primary'><b-icon icon='x'></b-icon></b-button>

        <b-modal v-model='modalShow' size='lg'>

            <div slot='modal-title'>
                <label>Бухта №{{buhta.id}}, тип {{buhta.types_metals.name}}, толщина {{buhta.metal_thickness_id}} мм, {{buhta.weight}}тн. </label>
                 <br>Ширина: {{buhta.width}} мм
            </div>

            <v-aprModal 
            :buhta='buhta'
            @send='receive' 
            :complect="complect"
            v-for='complect in complects'
            :key='complect.id'
            v-on:remove='removeApr'
            >
            </v-aprModal>

            <br>
            <span class="float-left">Обрезь: {{remainder}} мм</span>
            <span class='btn btn-outline-primary' @click='addNewComplect'>Добавить тип резки</span>
            <div slot='modal-footer'>
                <b-button size='sm' @click='savve' variant='outline-primary'>Сохранить </b-button>
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
        Form: {
            id: "",
            width1: "",
            amount: "",
            tonage: "",
            remainder: ""
        },
        complects: [{form:{
            id: 1,
            width1: 0,
            amount: "",
            tonage: "",
        }}],
        count: 2,
    }),
    mounted() {
        this.loadForm();
    },
    computed:{
        remainder: function(){
            let sumwidth = this.complects
                .reduce(function(sum, current) {
                    return sum -  current.form.width1;
                }, this.buhta.width);
            return sumwidth;
        }
    },
    methods: {
        loadForm() {
            this.Form = this.buhta;
            this.remainder = this.buhta.width;
        },
        addNewComplect() {
            console.log('1');
			this.complects.push({form: {
                id: this.count++,
                width1: 0,
                amount: "",
                tonage: ""
            }});
             console.log(this.Form);
		},
        receive(data) {
            console.log('3');
            this.Form.amount = data.amount;
            this.Form.tonage = data.tonage;
            this.Form.width1 = data.width;
        },
        prihod() {
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
        savve() {
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
        del() {
            this.$emit('remove', this.buhta.id);
        },
        removeApr(id) {
            console.log('removing form element', id)
            const index = this.complects.findIndex(f => f.id === id)
            this.complects.splice(index,1)
        }
    },
    // watch: {
    //     remainder: (Newremainder, oldRemainder) => {
    //         console.log(oldRemainder+ "to" + Newremainder)
    //     }
    // }

}
</script>
