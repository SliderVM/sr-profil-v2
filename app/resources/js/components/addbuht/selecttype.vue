<template>
    <div>
        <label>Тип металла</label>
        <br>
        <select v-model="selected" @change="selectType">
            <option v-for="types in selecttype" :key="types.id" :value="types.id">{{types.name}} </option>
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
        selectType() {
            this.$emit('selectType', {selected: this.selected})
        }
    }
}
</script>
