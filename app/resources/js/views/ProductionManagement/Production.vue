<template>
  <div>
    <select class="form-control">
        <option size="sm" class="mt-3"
        v-for="warehouse in warehouseArray"
        :key="warehouse.id"
        :value="warehouse.id">
        {{warehouse.name}}
        </option>
    </select>
    <select class="form-control">
        <option size="sm" class="mt-3"
        v-for="warehouse_type in  warehouseArray.warehouse_types"
        :key="warehouse_type.id"
        :value="warehouse_type.id">
        {{warehouse_type.name}}
        </option>
    </select>
    <h5> Управление производством </h5>
  </div>
</template>

<script>
export default {
    data: () => ({
        warehouseArray: [],
        options: [
            { warehouseArray: '', value: '' },
        ],
        warehouse_types: [],
        options: [
            { warehouse_types: '', value: '' },
        ],
    }),
     mounted() {
        this.loadwarehouse();
     },
    methods: {
        loadwarehouse() {
            axios.get('/api/warehouse/create')
            .then(res => {
                this.warehouseArray = res.data;
                console.log(res.data)
            })
        },
    }
}
</script>
