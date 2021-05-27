<template>
<div>
    <label>Склад</label>
    <select v-model="warehouse_id">
        <option size="sm" class="mt-3"  v-for="warehouse in warehouseArray" v-bind:key="warehouse.message" v-bind:value="warehouse.name">{{warehouse.name}} </option>
    </select>
</div>
</template>

<script>


export default {
    data: () => ({
        warehouse_id: '',
        warehouseArray: [],
        options: [
            { warehouseArray: '', value: '' },
        ]
    }),
    mounted() {
        this.loadwarehouse();
    },
    methods: {
        loadwarehouse() {
            axios.get('/api/warehouse')
            .then(res => {
                this.warehouseArray = res.data;
            })
        }
    }
}
</script>
