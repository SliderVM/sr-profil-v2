<template>
    <tr>
    <td>{{name}}</td>
    </tr>
</template>

<script>
export default {
    counterparties: "counterparties",
    props: {
        name: {
            type: String
        }
    }
}
</script>
