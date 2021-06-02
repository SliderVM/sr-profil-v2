<template>
<div class="form-group">
    <label>Ширина, мм</label>
    <input type="number" v-model="width" placeholder="1250" class="form-control" @click=login />
</div>
</template>

<script>
export default {
    data: () => ({
            width: ""
    }),
    methods:{
        login() {
            this.$emit('login', {
                width: this.width
            })
        }
    }
}
</script>
