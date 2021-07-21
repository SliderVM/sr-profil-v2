<template>
    <table>
        <tr>
            <th>Ширина</th>
            <th>Тоннаж</th>
            <th>Количество</th>
        </tr>
        <tr v-for="aprka in apr" :key="aprka.id">
            <td>{{aprka.width}} мм</td>
            <td>{{aprka.tonage}} тн</td>
            <td>{{aprka.amount}} шт</td>
        </tr>
    </table>
</template>

<script>
export default {
    props: {apr:Array},
}
</script>