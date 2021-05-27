<template>
    <div class="container-fluid">

        <h5 class="mb-3">Контрагенты</h5>
            <div class="input-group my-4">
                <input v-model="form.name" placeholder="добавить" class="form-control">
                <button v-on:click="send" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#info3Modal"><i class="fa fa-plus"></i> Добавить</button>
            </div>
        <table class="table table-sm mt-3">
            <thead>
                <tr>
                    <th>Контрагенты</th>
                    <th width="40"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <counterparties v-for="counterparties in counterpartiesArray" :key="counterparties.id" :name="counterparties.name" />
                        <v-counterparties></v-counterparties>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import axios from 'axios';
    import counterparties from '../components/counterparties.vue';

        export default {
            components: {counterparties},
            data: () => ({
                counterpartiesArray: [],
                form:{
                    name: ""
                },
            }),
            mounted() {
            this.loadcounterparties();
            },
            methods: {
                loadcounterparties() {
                    axios.get('/api/counterparties')
                    .then(res => {
                        this.counterpartiesArray = res.data;
                    })
                },
                send: function () {
                    axios.post('/api/counterparties',this.form, {
                    headers: {"Content-type": "application/json"}
                })
                .then((response) => {

                this.form = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
                }
    }
            }
</script>
