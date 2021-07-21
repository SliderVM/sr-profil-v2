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
     methods: {
        BuhtaName() {
             this.$emit('BuhtaName', {name: this.name});
         }
     }
}
</script>