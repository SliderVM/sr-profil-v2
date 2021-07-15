<template>
  <div>
      <b-table-simple>
            <b-thead>
                <b-tr>
                    <b-th>Наименование</b-th>
                    <b-th>Контрагент</b-th>
                    <b-th>Тип металла</b-th>
                    <b-th>Ширина, мм</b-th>
                    <b-th>Толщина, мм</b-th>
                    <b-th>Длина, м</b-th>
                    <b-th>Вес, тн</b-th>
                    <b-th>Стоимость, руб</b-th>
                    <b-th class="col-2">Операции</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for='apr in aprArray' :key='apr.id' >
                <td>{{apr.name}}</td>
                <td>{{apr.counterparties.name}}</td>
                <td>{{apr.types_metals.name}}</td>
                <td>{{apr.width}}</td>
                <td>{{apr.metal_thickness_id}}</td>
                <td>{{apr.length}}</td>
                <td>{{apr.weight}}</td>
                <td>{{apr.price}}</td>
                <td><div class='btn-group'>
                <b-button :value='this.apr.id' size='sm' variant='outline-primary'>Показать АПР</b-button></div></td>
                </b-tr>
            </b-tbody>
      </b-table-simple>
  </div>
</template>

<script>
export default {
    data:() => ({
        aprArray: [],
        complects: [{form: {
            id: 1,
            width1: 0,
            amount: "",
            tonage: "",
        }}],
        count: 2,
    }),
    mounted() {
        this.loadApr();
    },
    methods: {
        addNewComplect() {
            this.complects.push({form: {
                id: this.count++,
                width1: 0,
                amount: "",
                tonage: "",
            }});
        },
        loadApr() {
            axios.get('/api/apr')
            .then(res => {
                this.aprArray = res.data
                console.log('1', res.data)
            })
        },
        load1() {
            axios.get('/api/apr')
            .then(res => {
                this.aprArray = res.data
                console.log('1', res.data)
            })
        }
    }
}
</script>

<style>

</style>
