<template>
    <div>
        <div class="border">
            <div class="row">
                <label class="col-11">Тип резки {{this.complect.id}} {{this.complect}}</label>
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
    </div>
</template>

<script>
export default {
    props: ["buhta", "complect"],
    methods: {
        amount() {
            this.complect.form.amount = Math.floor(this.complect.form.tonage / (this.complect.form.width1 * this.buhta.weight / this.buhta.width)); // количество: вес бухты / ширина  * 1 мм бухты вес / ширина
        },
        tonage() {
            this.complect.form.tonage = this.complect.form.width1 * this.complect.form.amount * this.buhta.weight / this.buhta.width; // Вес: ширина * количество * вес 1 мм бухты
        },
        del() {
            this.$emit('remove', this.complect.id);
        }
    }
}
</script>
