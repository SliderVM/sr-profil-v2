<template>
  <div>
    <label>
        <input type="checkbox" v-model="available" value="1">Бухта в пути
    </label>
    <label>
        <input type="checkbox" v-model="available" value="2">Бухта на складе
    </label>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        available: []
      }
    }
  }
</script>
