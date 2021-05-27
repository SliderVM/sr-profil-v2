<template>
    <div>
        <label>Тип металла</label>
        <select v-model="selected">
            <option v-for="types in selecttype" v-bind:key="types.id" v-bind:value="types.name">{{types.name}} </option>
        </select>
    </div>
</template>

<script>

export default {
    data: () => ({
        selected: '',
        selecttype: [],
        options: [
            {selecttype: '', value: ''},
        ]
    }),
    mounted() {
        this.loadtypes();
        },
    methods: {
        loadtypes() {
            axios.get('/api/types')
            .then(res => {
                this.selecttype = res.data;
            })
        },
    }

}
</script>
