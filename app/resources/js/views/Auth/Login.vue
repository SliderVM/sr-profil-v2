<template>
    <div>
        <form autocomplete="off" @submit.prevent="login" method="post">

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="log.email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="log.password" required>
            </div>
            <input type="hidden" name="_token" :value="csrf">
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>
    </div>
</template>
<script>
  export default {
    data(){
      return {

        log: {
            email: null,
            password: null,
            // csrf_token: '123'
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
      }
    },
    methods: {
        login() {
            axios.post("/login", this.log, {
                header: "Content-type: application/json"
            })
            .then(response => {
                console.log(response)
                // this.$router.push({ path: '/'})
            })
            .catch(error => {
                console.log(error);
            });
            // console.log(this.csrf);
        }
    }
  }
</script>
