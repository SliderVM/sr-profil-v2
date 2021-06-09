<template>
    <tr>
        <td>{{Warehouse.name}} </td>
        <td ><span v-for="warehouse_type in Warehouse.warehouse_types" :key="warehouse_type.id"> {{warehouse_type.name}} </span></td>
        <v-ModalEditorWarehouse></v-ModalEditorWarehouse>
    </tr>
</template>

<script>
export default {
    data: () => ({
    warehouse_types: []
    }),
    name: "Warehouse",
    props: ["Warehouse"]
}
</script>
