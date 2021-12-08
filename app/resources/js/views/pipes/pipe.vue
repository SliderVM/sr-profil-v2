<template>
    <div>
        <modalPipe></modalPipe>
        <b-table-simple>
            <thead>
                <b-tr>
                    <b-th>Труба</b-th>
                    <b-th>Количество</b-th>
                    <b-th>Количество, тонн</b-th>
                    <b-th>Цена за тонну</b-th>
                    <b-th>Сумма</b-th>
                </b-tr>
            </thead>
            <b-tbody>
                <b-tr v-for="pipe in pipeArray">
                    <b-td>{{pipeArray}}</b-td>
                    <b-td>1</b-td>
                    <b-td>2</b-td>
                    <b-td>3</b-td>
                    <b-td>4</b-td>
                </b-tr>
            </b-tbody>
            <b-tfoot>
                <b-tr class="font-weight-bold">
                    <b-td colspan="7">Итого: </b-td>
                    <b-td colspan="4"></b-td>
                </b-tr>
            </b-tfoot>
        </b-table-simple>
    </div>
</template>

<script>
import modalPipe from './modalAddPipe.vue'
export default {
    components: {modalPipe},
    props: ['pipeArray'],

}
</script>
