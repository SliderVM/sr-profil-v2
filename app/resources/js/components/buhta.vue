<template>
    <tr>
        <td>{{buhta.name}}</td>
        <td>{{buhta.counterparties.name}}</td>
        <td>{{buhta.types_metals.name}}</td>
        <td>{{buhta.width}}</td>
        <td>{{buhta.metal_thickness_id}}</td>
        <td>{{buhta.length}}</td>
        <td>{{buhta.weight}}</td>
        <td>{{buhta.price}}</td>
        <td><v-ModalBuhtaEditor :buhta="buhta"></v-ModalBuhtaEditor></td>
    </tr>
</template>

<script>
export default {
    name: "buhta",
    props: ["buhta"]
}
</script>
