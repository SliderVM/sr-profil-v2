<template>
    <tr>
        <td>{{buhta.name}}</td>
        <td>{{buhta.type_metal_id}}</td>
        <td>{{buhta.width}}</td>
        <td>{{buhta.metal_thickness_id}}</td>
        <td>{{buhta.length}}</td>
        <td>{{buhta.weight}}</td>
        <td>{{buhta.price}}</td>
    </tr>
</template>

<script>
export default {
    name: "buhta",
    props: ["buhta"]
}
</script>
