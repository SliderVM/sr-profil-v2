<template>
  <div class="container-fluid">
        <b-table-simple bordered>
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
                    <b-td>{{kol}}</b-td>
                    <b-td> <move :id="val" :available="kol"></move> </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
  </div>
</template>

<script>
import move from './shtripsMove.vue'
export default {
    components: {move},
    props: ['id', 'name', 'val'],
    data: () => ({
        kol: ''
    }),
    mounted() {
        this.loadAmount();
    },
    methods: {
        loadAmount() {
            axios.get('groupshtrips/' + this.val)
            .then(res => {
                this.kol = res.data;
            });
        }
    }
}
</script>
