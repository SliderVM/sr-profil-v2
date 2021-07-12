<template>
    <div class="form-group">
        <label>Наименование</label>
        <input type="text" v-model="name" @change="BuhtaName" placeholder="Введите наименование" class="form-control" />
    </div>
</template>

<script>
export default {
    data: () => ({
        name: '',
     }),
    // created: function() {
    //     axios.post('/api/buhtas',this.name, {
    //             header: ("Content-type: application/json")
    //         })
    //         .then(res => {
    //             this.name = res.data;
    //         })
    // },
     methods: {
        BuhtaName() {
             this.$emit('BuhtaName', {name: this.name});
             console.log(this.name)
         }
     }
}
</script>

<style>

</style>
