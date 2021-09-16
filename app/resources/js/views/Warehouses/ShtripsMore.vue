<template>
  <div class="container-fluid">
        <b-table-simple>
            <b-thead>
                <b-tr>
                    <b-th>Складской номер</b-th>
                    <b-th>Количество</b-th>
                    <b-th></b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr>
                    <b-td>{{name}}</b-td>
                    <b-td>{{sumShtrips}}</b-td>
                    <b-td> <move :wId="wId" :available="sumShtrips" :id="val" :array="array"></move> </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
  </div>
</template>

<script>
import move from './shtripsMove.vue'
export default {
    components: {move},
    props: ['wId', 'name', 'val'],
    data: () => ({
        sumShtrips: '', // общее количество штрипса
        array: {} // массив айди
    }),
    mounted() {
        this.loadAmount();
    },
    methods: {
        loadAmount() {
            axios.post('groupshtrips', [this.wId, this.val])
            .then(res => {
                this.sumShtrips = res.data[0];
                this.array = res.data[1];
            });
        }
    }
}
</script>
