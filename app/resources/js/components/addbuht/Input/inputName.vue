<template>

</template>

<script>
export default {
    data: () => ({
        name: '',
    }),
     methods: {
        BuhtaName() {
            this.$emit('BuhtaName', {name: this.name});
        }
    }
}
</script>
