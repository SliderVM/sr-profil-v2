<template>
    <tr>
        <td>{{Warehouse.name}}</td>

        <td><span v-for="warehouse_type in Warehouse.warehouse_types" :key="warehouse_type.id"> {{warehouse_type.name}} </span></td>

        <td>
            <div class='btn-group'>
                <v-ModalEditorWarehouse :Warehouse="Warehouse"
                @send="editWarehouse"></v-ModalEditorWarehouse>
                <b-button @click="removeWarehouse" :value="Warehouse.id" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon></b-button>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    name: "Warehouse",
    props: ["Warehouse"],
    data: () => ({
        warehouse_types: [],
        form: {}
    }),
    methods: {
        removeWarehouse() {
            axios.delete('api/warehousetype/' + this.Warehouse.id);
            this.$emit('removeWarehouse', {id: this.Warehouse.id})
        },
        editWarehouse(data) {
            console.log(data)
            this.warehouse_types = data.form
            this.$emit('editWarehouse', {form: this.form})
        }
    }
}
</script>
