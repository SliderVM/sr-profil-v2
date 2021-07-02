<template>
    <tr>
        <td>{{buhta}}</td>

        <td><v-ModalBuhtaEditor :buhta="buhta" v-on:remove="removeBuhta"></v-ModalBuhtaEditor></td>
    </tr>
</template>

<script>
export default {
    methods: {
        removeBuhta(id) {
            axios.delete('api/buhtas/' + id);
        }
    },
    name: "buhta",
    props: ["buhta"]
}
</script>
