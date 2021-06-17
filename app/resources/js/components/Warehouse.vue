<template>
    <tr>
        <td>{{Warehouse.name}}</td>
        <td><span v-for="warehouse_type in Warehouse.warehouse_types" :key="warehouse_type.id"> {{warehouse_type.name}} </span></td>
        <v-ModalEditorWarehouse v-bind:Warehouse="Warehouse" v-on:remove="removeWarehouse"></v-ModalEditorWarehouse>
    </tr>
</template>

<script>
export default {

    data: () => ({
        warehouse_types: []
    }),
    methods: {
        removeWarehouse(id) {
            axios.delete('api/warehousetype/' + id);
        }
    },

    name: "Warehouse",
    props: ["Warehouse"]
}
</script>
