<template>
    <div >
        <label>Толщина</label>
        <select v-model="selected">
            <option size="sm" class="mt-3" v-for="thicknesse in thicknessesArray" :key="thicknesse.id" :value="thicknesse.thicknesses">{{thicknesse.thicknesses}} </option>
        </select>
    </div>
</template>

<script>


export default {
    data: () => ({
        selected: '',
        thicknessesArray: [],
        options: [
            { thicknessesArray: '', value: '' },
        ]
    }),
    mounted() {
            this.loadthicknesse();
    },
    methods: {
        loadthicknesse() {
            axios.get('/api/thicknesse')
            .then(res => {
                this.thicknessesArray = res.data;
            })
        }
    }
}

</script>
