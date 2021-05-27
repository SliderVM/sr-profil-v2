<template>
    <tr>
        <td>{{name}}</td>
    </tr>
</template>

<script>
export default {
    name: "types",
    props: {
        name: {
            type: String
            // default: "NULL"
        }
    }
}
</script>
