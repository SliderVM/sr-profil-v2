<template>
    <div class="form-group">
        <label>Цена покупки, руб. за тн.</label>
        <input v-model.number="man" @change="Cash" class="form-control" />
    </div>
</template>

<script>
export default {
    data: () => ({
        man: '',
    }),
    methods: {
         Cash() {
             this.$emit('Cash', {price: this.man});
         }
    }
}
</script>
