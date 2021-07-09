<template>
    <tr>
        <td>
            {{brigade.name}}
        </td>
        <td>
            <span v-for="warehouse in brigade.warehouse" :key="warehouse.id" @send="warehouseNew"> {{warehouse.name}} </span>
        </td>
        <td>
            <div class='btn-group'>
            <v-modalEditor :brigade="brigade"></v-modalEditor>
             <b-button @click="removeBrigade" :value="this.brigade.id" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon></b-button>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    props:  ["brigade"],
    name: "brigadeTable",
    data: () => ({
        warehouses: []
    }),
    methods: {
        warehouseNew(data) {
            this.warehouses = data.form
            this.warehouses.push(this.form);
        },
        removeBrigade() {
            axios.delete('api/brigade/' + this.brigade.id);
            this.$emit('removeBrigade', {id: this.brigade.id})
        }
    },
}
</script>
