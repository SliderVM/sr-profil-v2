<template>
    <tr>
        <td>{{agent.name}}</td>
        <td>
            <div class='btn-group'>
                <b-button @click="removeCounterparties" :value="this.agent.id" size="sm" variant='outline-primary'><b-icon icon="x"></b-icon></b-button>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    counterparties: "counterparties",
    props: ['agent'],
    methods: {
        removeCounterparties() {
            axios.delete('/api/counterparties/' + this.agent.id)
            .then(res => {
                console.log(res)
                this.$emit('removeCounterparties')
                    alert(res.data); // доделать, работает некорректно

            })
        }
    }
}
</script>
