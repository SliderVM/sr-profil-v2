<template>
    <div class="container-fluid">
    <h2 class="mb-3">Контрагенты</h2>
        <div class="input-group my-4">
            <input v-model="form.imya" placeholder="Добавить" class="form-control">
            <button @click="send" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#info3Modal"><b-icon icon="plus-square"></b-icon> Добавить</button>
        </div>
        <table class="table table-sm mt-3">
            <thead>
                <tr>
                    <th>Контрагенты</th>
                </tr>
            </thead>
            <tbody>
                <counterparties v-for="counterparties in counterpartiesArray"
                :key="counterparties.id"
                :name="counterparties.name" />
            </tbody>
        </table>
    </div>
</template>
<script>
import counterparties from '../components/counterparties.vue';
export default {
    components: {counterparties},
    data: () => ({
        counterpartiesArray: [],
        form: {
            imya: ""
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
        send() {
            axios.post('/api/counterparties', this.form, {
                headers: {"Content-type": "application/json"}
            })
            .then((response) => {
            this.form = response.data;
            this.counterpartiesArray.push(this.form)
            console.log(this.form);
            })
            .catch((error) => {
                console.log(error);
            });
        }
    }
}
</script>
