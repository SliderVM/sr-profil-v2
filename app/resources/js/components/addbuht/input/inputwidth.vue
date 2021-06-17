<template>

</template>

<script>
export default {
    data: () => ({
            shirina: '',
    }),
    methods:{
        Width() {
            console.log(shirina);
            this.$emit('Width', {width: this.shirina})
        }
    }
}
</script>
