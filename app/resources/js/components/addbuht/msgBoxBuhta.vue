<template>
  <div>
    <div class="mb-2">
     <b-button @click="showMsgBoxOne">Simple msgBoxConfirm</b-button>
     Return value: {{ String(boxOne) }}
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        boxOne: '',
      }
    },
    methods: {
      showMsgBoxOne() {
        this.boxOne = ''
        this.$bvModal.msgBoxConfirm('Are you sure?')
          .then(value => {
            this.boxOne = value
          })
          .catch(err => {
            // An error occurred
          })
      },
    }
  }
