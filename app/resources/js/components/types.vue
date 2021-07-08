<template>
    <tr>
        <td>{{types.name}}</td>
        <td><b-button @click='removing' :value="this.types.id" size='sm' variant='outline-primary'><b-icon icon='x'></b-icon></b-button></td>
    </tr>
</template>

<script>
export default {
    data: ()=> ({
        errorMessage: {}
    }),
    name: "types",
    props: ["types"],
    methods: {
        removing () {
            console.log(this.types.id);
            axios.delete('api/types/' + this.types.id)
            this.$emit('removing', {id: this.types.id})
            // .then((response) => {
            //     if(response.data.error){
            //         this.errorMessage = response.data.message;
            //     }
            //     else
            //     {
            //
            //     }
            // })

        }

    }
}
</script>
