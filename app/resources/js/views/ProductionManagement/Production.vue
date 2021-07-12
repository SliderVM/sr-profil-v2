<template>
    <div class="row">
        <div class="col-3">
            <b-form-select v-model="selected" class="form-control col-3" name="sklad" @change="smena($event)">
                <template #first>
                    <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                </template>
                <b-form-select-option size="sm" class="mt-3"
                v-for="warehouse in warehouseArray"
                :key="warehouse.id"
                :value="warehouse.id">
                {{warehouse.name}}
                </b-form-select-option>
            </b-form-select>
        </div>
        <div class="col-3">
            <b-form-select class="form-control col-3" name="type">
                <b-form-select-option size="sm" class="mt-3"
                v-for="warehouse_type in  warehouse_types"
                :key="warehouse_type.id"
                :value="warehouse_types.id">
                {{warehouse_types}}
                </b-form-select-option>
            </b-form-select>
        </div>
    <h5> Управление производством </h5>
  </div>
</template>

<script>
export default {
    data: () => ({
        selected: null,
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
                this.warehouse_types = res.data;
                console.log(res.data)
                console.log(this.warehouse_types)
            })
        },
        smena(event) {
            console.log(event.target.value)
        }
    }
}
</script>
