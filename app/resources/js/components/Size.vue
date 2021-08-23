<template>
    <tr>
        <td>{{sizeProp.types_metals.name}} {{sizeProp.name}}x{{sizeProp.metal_thicknesse.thicknesses}}</td>
        <td>{{sizeProp.width_strip_in_millimeters}}</td>
        <td>{{sizeProp.thickness_in_millimeters}}</td>
        <td>{{sizeProp.pipe_in_pack}}</td>
        <td>{{sizeProp.coefficient}}</td>
    </tr>
</template>

<script>
export default {
    name: "size",
    props: ["sizeProp"]
}
</script>
