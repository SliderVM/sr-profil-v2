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
                    <b-td>{{id}}</b-td>
                    <b-td> <move :id="id"></move> </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
  </div>
</template>

<script>
import move from './shtripsMove.vue'
export default {
    components: {move},
    props: ['id', 'name'],
}
</script>
