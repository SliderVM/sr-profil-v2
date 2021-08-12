<template>
    <tr>
        <td>
            {{brigade.name}}
        </td>
        <td @send="editorBrigade">
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
            axios.delete('api/brigade/' + this.brigade.id)
            .then(res => {
                if (res.data == "") {
                    this.$emit('removeBrigade')
                }
                else {
                    alert(res.data);
                }
            })
        },
        editorBrigade(data) {
            console.log(data)
            console.log(data.Form.warehouse)
            this.warehouse.push(data.Form.warehouse);
        }
    }
}
</script>
