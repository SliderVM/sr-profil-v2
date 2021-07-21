<template>
    <tr>
        <td>{{thicknesse.thicknesses}}</td>
        <td><b-button @click='removing' :value="this.thicknesse.id" size='sm' variant='outline-primary'><b-icon icon='x'></b-icon></b-button></td>
    </tr>
</template>

<script>
export default {
    name: "thicknesse",
    props: ["thicknesse"],
    methods: {
        removing () {
            axios.delete('/api/thicknesse/' + this.thicknesse.id)
            this.$emit('removing', {id: this.thicknesse.id})
        }
    }
}
</script>
