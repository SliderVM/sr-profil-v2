<template>
    <tr>
        <td>
            {{brigade.name}}
        </td>
        <td>
            <span v-for="warehouse in brigade.warehouse" :key="warehouse.id"> {{warehouse.name}} </span>
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
        warehouse: []
    }),
    methods: {
        removeBrigade() {
            axios.delete('api/brigade/' + this.brigade.id);
            this.$emit('removeBrigade', {id: this.brigade.id})
        },
        editorBrigade() {
            this.warehouse = data.form
            this.warehouse.push(this.form);
        }
    },
}
</script>
