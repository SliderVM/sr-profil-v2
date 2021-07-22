<template>
    <b-table-simple small bordered>
        <b-thead>
        <b-tr>
            <b-th>Ширина</b-th>
            <b-th>Тоннаж</b-th>
            <b-th>Количество</b-th>
        </b-tr>
        </b-thead>
        <b-tbody>
        <b-tr v-for="aprka in apr" :key="aprka.id">
            <b-td>{{aprka.width}} мм</b-td>
            <b-td>{{aprka.tonage}} тн</b-td>
            <b-td>{{aprka.amount}} шт</b-td>
        </b-tr>
        </b-tbody>
    </b-table-simple>
</template>

<script>
export default {
    props: {apr:Array},
}
</script>
