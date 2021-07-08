<template>
    <tr>
        <td>{{buhta}}</td>
        <!-- <td>{{buhta.counterparties.name}}</td>
        <td>{{buhta.types_metals.name}}</td>
        <td>{{buhta.width}}</td>
        <td>{{buhta.metal_thickness_id}}</td>
        <td>{{buhta.length}}</td>
        <td>{{buhta.weight}}</td>
        <td>{{buhta.price}}</td> -->
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
            this.$emit('removeBuhta', {id: this.buhta.id})
        }
    }
}
</script>
