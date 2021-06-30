<template>
    <div>
        <div class="border">
            <div class="row">
                <label class="col-11">Тип резки {{this.complect.id}} {{this.complect.form}}</label>
                    <b-input-group class="col-1">
                        <b-button variant="outline-secondary" @click="del" size="sm"><b-icon icon="x"></b-icon></b-button>
                    </b-input-group>
            </div>
            <div class="row">
                <div class="col-4">
                    <b-input-group append="мм">
                        <input type="number" v-model="complect.form.width1" placeholder="100" />
                    </b-input-group>
                </div>
                <div class="col-4">
                    <b-input-group append="тн">
                        <input type="number" @input="amount" v-model="complect.form.tonage" placeholder="Количество тонн" />
                    </b-input-group>
                </div>
                <div class="col-4">
                    <b-input-group append="шт">
                    <input  type="number" @input="tonage" v-model="complect.form.amount" placeholder="Количество штук" />
                    </b-input-group>
                </div>

            </div>
        </div>
        <span class="float-left">Обрезь: {{complect.form.remainder}} мм</span>
    </div>
</template>

<script>
export default {
    props: ["buhta", "complect", "aprData"],
    data: () => ({

    }),
    methods: {
        amount() {
            this.complect.form.amount = Math.floor(this.complect.form.tonage / (this.complect.form.width1 * this.buhta.weight / this.buhta.width)); // количество: вес бухты / ширина  * 1 мм бухты вес / ширина
            this.complect.form.remainder = this.buhta.width - (this.complect.form.width1 * this.complect.form.amount);
            this.send();
        },
        tonage() {
            this.complect.form.tonage = this.complect.form.width1 * this.complect.form.amount * this.buhta.weight / this.buhta.width; // Вес: ширина * количество * вес 1 мм бухты
            this.complect.form.remainder = this.buhta.width - (this.complect.form.width1 * this.complect.form.amount);
            console.log(this.complect.form.remainder);
            this.send();
        },
        send() {
            console.log('2');
            this.$emit('send', {tonage: this.complect.form.tonage, amount: this.complect.form.amount, remainder: this.complect.form.remainder, width: this.complect.form.width1, remainder: this.complect.form.remainder});
            console.log(this.complect.form.remainder);

        },
        del() {
            this.$emit('remove', this.complect.id);
        }
    }
}
</script>
