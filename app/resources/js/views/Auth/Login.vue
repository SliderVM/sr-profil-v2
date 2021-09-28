<template>
<div>
    <div class="top">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">
                <label class="top-brand">СР-Профиль</label>
                <button class="btn btn-light btn-sm"><b-icon icon='box-arrow-in-right' @click="vhod"></b-icon> Вход</button>
            </div>
        </div>
    </div>
    <div>
        <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="log.email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" class="form-control" v-model="log.password" required>
            </div>
            <button type="submit" class="btn btn-outline-primary"><b-icon icon='box-arrow-in-right'></b-icon> Вход</button>
        </form>
    </div>
</div>

</template>
<script>
export default {
    data: () => ({
        log: {
            email: '',
            password: ''
        }
    }),
    methods: {
        vhod() {
            window.location.href = '/'
        },
        login() {
            axios.post('/login', this.log)
            .then(response => {
                console.log(response.data);
                localStorage.setItem('user', response.data)
                window.location.href = '/'
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>
<style scoped>
form {
    padding: 50px;
    margin-left: 150px;
}
input {
    width: 350px;
    margin-top: 5px;
}
form button {
    margin-top: 15px;
}
</style>
