<template>
    <div>
        <label>Тип резки</label>
            <div class="row">
                <div class="col">
                    <b-input-group append="мм">
                        <input type="number" v-model="Form.width1" placeholder="100" />
                    </b-input-group>
                </div>
                <div class="col">
                    <b-input-group append="тн">
                        <input type="number" @input="amount" v-model="Form.tonage" placeholder="Количество тонн" />
                    </b-input-group>
                </div>

                <div class="col">
                    <b-input-group append="шт">
                        <input type="number" @input="tonage" v-model="Form.amount" placeholder="0" />
                    </b-input-group>
                </div>
            </div>
            <span class="float-left">Обрезь: {{Form.remainder}} мм</span>
    </div>
</template>

<script>
export default {
    props: ["buhta"],
    data: () => ({
        Form:{
            id: "",
            width1: "",
            amount: "",
            tonage: "",
            remainder: ""
        },
    }),
     mounted() {
        this.loadForm();
    },
    methods: {
        loadForm() {
            this.Form = this.buhta;
        },
        amount: function () {
            this.Form.amount = Math.floor(this.Form.tonage / (this.Form.width1 * this.buhta.weight / this.buhta.width)); // количество: вес бухты / ширина  * 1 мм бухты вес / ширина
            this.Form.remainder = this.buhta.width - (this.Form.width1 * this.Form.amount);
            this.send();

        },
        tonage: function() {
            this.Form.tonage = this.Form.width1 * this.Form.amount * this.buhta.weight / this.buhta.width; // Вес: ширина * количество * вес 1 мм бухты
            this.Form.remainder = this.buhta.width - (this.Form.width1 * this.Form.amount);
            console.log(this.Form.remainder);
            this.send();
        },
        send: function() {
            console.log('1');
            this.$emit('send', {tonage: this.Form.tonage, amount: this.Form.amount, remainder: this.Form.remainder, width: this.Form.width1});
            console.log(this.Form.remainder);
        },

    },

}
</script>
