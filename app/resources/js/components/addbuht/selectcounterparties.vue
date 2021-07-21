<template>
   <div>
        <label>Контрагенты</label>
        <multiselect
        v-model="Value"
        :options="CounterpartiesArray"
        track-by="id"
        label="name"
        :options-limit="3"
        open-direction="bottom"
        :hide-selected="true"
        placeholder="Начните вводить"
        @open="CounterpartiesOpen"
        @select="CounterpartiesSearch">
        </multiselect>
    </div>
</template>

<script>
export default {
    data: () => ({
        CounterpartiesArray: [],
        Value: '',
        trackBy: 'id',
    }),
    methods: {
        CounterpartiesOpen () {
            axios.get('/api/counterparties')
            .then(res => {
                this.CounterpartiesArray = res.data;
            });
        },
        CounterpartiesSearch () {
            axios.get('/api/counterparties')
            .then(res => {
                this.CounterpartiesArray = res.data;
                this.form.counterpartyId = this.Value.id;
            })
        }
    }
}
</script>
