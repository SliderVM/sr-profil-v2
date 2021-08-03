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
            <button type="submit" class="btn btn-default">Sign in</button>
        </form>
    </div>
</template>
<script>
export default {
    data: () => ({
        log: {
            email: null,
            password: null,
            device_name: 'browser',
        }
    }),
    methods: {
        login() {
            axios.post('/login', this.log)
            .then(response => {
                localStorage.setItem('token', response.data)
                this.$router.push({ path: '/info2'})
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>
