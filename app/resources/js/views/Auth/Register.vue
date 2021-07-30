<template>
    <div>
        <form autocomplete="off" @submit.prevent="register" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" v-model="reg.name" required>
                <!-- <input type="hidden" name="_token" :value="csrf"> -->
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="reg.email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="reg.password" required>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                reg: {
                name: '',
                email: '',
                password: '',
                csrf: ''
                }
            };
        },
        methods: {
            register() {
                axios.post("/register", this.reg, {
                    header: "Content-type: application/json"
                })
                .then(response => {
                    console.log(response)
                    this.$router.push({ path: '/'})
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
