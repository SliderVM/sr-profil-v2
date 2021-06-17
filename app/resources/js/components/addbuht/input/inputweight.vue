<template>
    <div class="form-group">
        <label>Вес, т</label>
        <input type="number" v-model="weight" @change="Ves" placeholder="0.00" class="form-control" />
    </div>
</template>

<script>
export default {
    data: () => ({
        weight: '',
     }),
     methods: {
         Ves() {
             this.$emit('Ves', {weight: this.weight});
         }
     }
}
</script>
