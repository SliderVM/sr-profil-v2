<template>
    <tr>
        <td>{{types.name}}</td>
        <td><b-button @click='removing' :value="this.types.id" size='sm' variant='outline-primary'><b-icon icon='x'></b-icon></b-button></td>
    </tr>
</template>

<script>
export default {
    name: "types",
    props: ["types"],
    methods: {
        removing () {
            axios.delete('api/types/' + this.types.id)
            .then(res => {
                if (res.data == "") {
                this.$emit('removing')
                }
                else {
                    alert(res.data);
                }
            })
        }
    }
}
</script>
