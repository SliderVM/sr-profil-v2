<template>
    <tr>
        <td>{{buhta}}</td>

        <td><v-ModalBuhtaEditor :buhta="buhta" @removee="removeBuhta"></v-ModalBuhtaEditor></td>
    </tr>
</template>

<script>
export default {
    name: "buhta",
    props: ["buhta"],
    data: () => ({
        form: []
    }),
    methods: {
        removeBuhta(id) {
            console.log('removing form element', id)
            axios.delete('api/buhtas/' + id),
            this.$emit('removeBuhta', {id: this.form.id})
        }
    }
}
</script>
