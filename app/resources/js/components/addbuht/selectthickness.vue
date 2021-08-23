<template>
    <div>
        <label>Толщина металла, мм</label>
        <br>
        <select v-model="selected" @change="selectThickness">
            <option size="sm" class="mt-3" v-for="thicknesse in thicknessesArray" :key="thicknesse.id" :value="thicknesse.id" >{{thicknesse.thicknesses}} </option>
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
        },
        selectThickness() {
            console.log(this.selected)
            this.$emit('selectThickness', {selected: this.selected})
        }
    }
}
</script>
