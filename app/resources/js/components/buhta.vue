<template>
    <tr>
        <td>{{buhta.name}}</td>
        <td>{{buhta.typeMetalId}}</td>
        <td>{{buhta.width}}</td>
        <td>{{buhta.metalThicknessId}}</td>
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
