<template>
    <tr>
        <td>{{buhta.name}}</td>
        <td>{{buhta.counterparties.name}}</td>
        <td>{{buhta.types_metals.name}}</td>
        <td>{{buhta.width}}</td>
        <td>{{buhta.metal_thicknesse.thicknesses}}</td>
        <td>{{buhta.length}}</td>
        <td>{{buhta.weight}}</td>
        <td>{{buhta.price}}</td>
        <td>
            <div class='btn-group'>
            <v-ModalBuhtaEditor :buhta="buhta"></v-ModalBuhtaEditor>
            <b-button @click='removeBuhta' :value='this.buhta.id' size='sm' variant='outline-primary'><b-icon icon='x'></b-icon></b-button></div>
        </td>
    </tr>
</template>

<script>
export default {
name: "buhta",
props: ["buhta"],
methods: {
    removeBuhta() {
        axios.delete('api/buhtas/' + this.buhta.id)
        .then(res => {
            this.$emit('removeBuhta')
        })

    }
}
}
</script>
