<template>
    <div class="form-group">
        <label>Цена покупки, руб. за тн.</label>
        <input type="number" v-model="man" @change="Cash" class="form-control" />
    </div>
</template>

<script>
export default {
    data: () => ({
        man: '',
    }),

    methods: {
         Cash() {
             console.log(man);
             this.$emit('Cash', {price: this.man});
         }
    }
}
</script>
