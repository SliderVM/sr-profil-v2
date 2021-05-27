<template>
    <div>
        <label>Контрагенты</label>
        <select v-model="selected">
            <option v-for="counterparties in counterpartiesArray" v-bind:key="counterparties.id" v-bind:value="counterparties.name">{{counterparties.name}} </option>
        </select>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data: () => ({
        selected: '',
        counterpartiesArray: [],
        options: [
        { counterpartiesArray: '', value: '' },
        ]
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
        }
    }
}
</script>
