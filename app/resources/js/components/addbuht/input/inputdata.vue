<template>
    <div class="form-group">
        <label>Дата поступления</label>
        <input type="Date" v-model="receiptDate" @change="Vibe" placeholder="Введите дату" class="form-control" />
    </div>
</template>
<script>
export default {
     data: () => ({
        receiptDate: '',
     }),
     methods: {
         Vibe() {
             this.$emit('Vibe', {receiptDate: this.receiptDate});
         }
     }
}
</script>

