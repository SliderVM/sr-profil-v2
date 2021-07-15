<template>
  <div>
      <b-table-simple bordered>
            <b-thead >
                <b-tr>
                    <b-th>Наименование</b-th>
                    <b-th>Контрагент</b-th>
                    <b-th>Тип металла</b-th>
                    <b-th>Ширина, мм</b-th>
                    <b-th>Толщина, мм</b-th>
                    <b-th>Длина, м</b-th>
                    <b-th>Вес, тн</b-th>
                    <b-th>Стоимость, руб</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for='apr in aprArray' :key='apr.id' >
                <td @click="load1(apr.buhta_id)">{{apr.name}}</td>
                <td>{{apr.counterparties.name}}</td>
                <td>{{apr.types_metals.name}}</td>
                <td>{{apr.width}}</td>
                <td>{{apr.metal_thickness_id}}</td>
                <td>{{apr.length}}</td>
                <td>{{apr.weight}}</td>
                <td>{{apr.price}}</td>
                </b-tr>
                <b-tr>
                    <div class="hidden" v-show="visible">
                        <b-table-simple>
                            <b-thead>
                                <b-tr>
                                    <b-th>Ширина, мм</b-th>
                                    <b-th>Тоннаж, тн</b-th>
                                    <b-th>Количество, шт</b-th>
                                </b-tr>
                            </b-thead>
                            <b-tbody>
                                <b-tr v-for='apr in aprArray' :key='apr.id' >
                                <td>{{apr.width}}</td>
                                <td>{{apr.tonage}}</td>
                                <td>{{apr.amount}}</td>
                                </b-tr>
                            </b-tbody>
                        </b-table-simple>
                    </div>
                </b-tr>
            </b-tbody>

      </b-table-simple>

  </div>
</template>

<script>
export default {
    data:() => ({
        aprArray: [],
        visible:false
    }),
    mounted() {
        this.loadApr();
    },
    methods: {
        loadApr() {
            axios.get('/api/apr')
            .then(res => {
                this.aprArray = res.data
                console.log('1', res.data)
            })
        },
        load1(id) {
            console.log(id)
            console.log()
            this.visible = true;
        }
    }
}

</script>

<style>

</style>
