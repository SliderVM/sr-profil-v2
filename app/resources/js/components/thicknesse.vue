<template>
    <tr>
        <td>{{test}}</td>
    </tr>
</template>

<script>
export default {
    name: "thicknesses",
    props: {
        test: {
            type: Number,
            // default: "0"
        }
    }
}
</script>
