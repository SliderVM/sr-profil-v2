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
        form: {},
        Form: {}
    }),
    methods: {
        removeWarehouse() {
            axios.delete('api/warehousetype/' + this.Warehouse.id);
            this.$emit('removeWarehouse', {id: this.Warehouse.id})
        },
        editWarehouse(data) {
            console.log(data.form)
            this.form = data.Form
            const index = this.warehouse_types.findIndex(this.warehouse_types);
            this.warehouse_types.splice(index, 1, this.form)
            this.$emit('editWarehouse', {Form: this.form})
        }
    },

}
</script>
