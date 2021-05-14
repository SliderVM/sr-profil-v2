<template>
    <h3>{{title}}</h3>
</template>

<script>
export default {
    name: "buhta",
    props: {
        title: {
            type: String,
            default: "NULL"
        }
    }
}
</script>
