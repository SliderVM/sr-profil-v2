<template>
<div>
    <div class="top">
        <b-navbar toggleable="lg" type="light" variant="light">
            <b-navbar-brand href="/">СР-Профиль</b-navbar-brand>
             <b-navbar-nav class="ml-auto">
                <b-button size="sm" variant="outline-dark"><b-icon icon='box-arrow-in-right' @click="vhod"></b-icon> Вход</b-button>
             </b-navbar-nav>
        </b-navbar>
    </div>
    <div class="container">
        <b-alert v-model="showDismissibleAlert" variant="danger" dismissible>
            Неверный логин или пароль.
        </b-alert>
        <h5 class="text-center m-0">Авторизация</h5>
        <b-form @submit.prevent="login" method="post">
            <b-form-group id="input-group-1" label="E-mail" label-for="input-1">
                <b-form-input
                id="input-1"
                v-model="log.email"
                type="email"
                placeholder="user@example.com"
                required
                ></b-form-input>
            </b-form-group>
            <b-form-group id="input-group-2" label="Пароль" label-for="input-2">
                <b-form-input
                id="input-2"
                v-model="log.password"
                type="password"
                required
                ></b-form-input>
            </b-form-group>
            <div class="b-row text-center">
                <b-button type="submit" variant="outline-primary col-3"><b-icon icon='box-arrow-in-right'></b-icon> Вход</b-button>
            </div>

        </b-form>
    </div>
</div>

</template>
<script>
export default {
    data: () => ({
        log: {
            email: '',
            password: ''
        },
        showDismissibleAlert: false
    }),
    methods: {
        vhod() {
            window.location.href = '/'
        },
        login() {
            axios.post('/login', this.log)
            .then(response => {
                localStorage.setItem('user_role', response.data.role_id)
                localStorage.setItem('user_name', response.data.name)
                window.location.href = '/'
            })
            .catch(error => {
                this.showDismissibleAlert = true;
            });
        }
    }
}
</script>
