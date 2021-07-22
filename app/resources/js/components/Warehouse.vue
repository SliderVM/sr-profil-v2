<template>
    <tr>
        <td>{{Warehouse.name}}</td>
        <td><span v-for="warehouse_type in Warehouse.warehouse_types" :key="warehouse_type.id" @happy="addNew"> {{warehouse_type.name}} </span></td>
        <td>
            <div class='btn-group'>
                <v-ModalEditorWarehouse :Warehouse="Warehouse"
                @send="editW"></v-ModalEditorWarehouse>
                <b-button @click="removeWarehouse" :value="Warehouse.id" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon></b-button>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
props: ["Warehouse"],
name: "Warehouse",
data: () => ({
    warehouse_types: []
}),
methods: {
    removeWarehouse() {
        console.log(this.Warehouse.id);
        axios.delete('api/warehousetype/' + this.Warehouse.id);
        this.$emit('removeWarehouse', {id: this.Warehouse.id})
    },
    editW(data) {
        console.log(data)
        this.warehouse_types.push(data)
    },
    addNew(data) {
        console.log(data.TypeWarehouse);
        this.warehouse_types.push(data.TypeWarehouse)
    }
}
}
</script>
