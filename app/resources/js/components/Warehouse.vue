<template>
    <tr>
        <td>{{Warehouse.name}}</td>
        <td><span v-for="warehouse_type in Warehouse.warehouse_types" :key="warehouse_type.id" @happy="warehouseTypeNew"> {{warehouse_type.name}} </span></td>
        <td>
            <div class='btn-group'>
                <v-ModalEditorWarehouse :Warehouse="Warehouse"
                ></v-ModalEditorWarehouse>
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
    warehouseTypeNew(data) {
        console.log('16')
        this.warehouse_types = data.form
        this.warehouse_types.push(this.form);
    },
    removeWarehouse() {
        console.log(this.Warehouse.id);
        axios.delete('api/warehousetype/' + this.Warehouse.id);
        this.$emit('removeWarehouse', {id: this.Warehouse.id})
    },
}
}
</script>
