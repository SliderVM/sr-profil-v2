<template>
    <div class="row">
        <div class="col-3">
            <select v-model="selected" class="form-control col-3" name="sklad" @change="smena">
                <option disabled value="">Выберите склад</option>
                <option size="sm" class="mt-3"
                v-for="warehouse in warehouseArray"
                :key="warehouse.id"
                :value="warehouse.id">
                {{warehouse.name}}
                </option>
            </select>
        </div>
        <div class="col-3">
            <select class="form-control col-3" name="type">
                <option size="sm" class="mt-3"
                >
                {{warehouseT.warehouse_types}}
                </option>
            </select>
        </div>
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
        warehouseT: { warehouse_types: {name: ''}},
        selected: '',
    }),
    mounted() {
        this.loadwarehouse();
    },
    methods: {
        smena(event) {
            axios.get('/api/warehouse/' + event.target.value)
            .then((response) => {
                console.log(response);
                this.warehouseT = response.data
                console.log(this.warehouseT)
                this.warehouse_types = this.warehouseT
                console.log(this.warehouse_types)
            });

        },
        loadwarehouse() {
            axios.get('/api/warehouse/create')
            .then(res => {
                this.warehouseArray = res.data;
            })
        },

    }
}
</script>
