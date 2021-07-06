<template>
    <tr>
        <td>{{thicknesse.thicknesses}}</td>
    </tr>
</template>

<script>
export default {
    name: "thicknesse",
    props: {
        thicknesse: {
            type: Object,
        }
    }
}
</script>
