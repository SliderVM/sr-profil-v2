<template>

    <div class="container-fluid">

        <h5>Бухта</h5>

        <div class="d-flex mt-3">
            <div class="mr-auto">
                <v-modalbuht></v-modalbuht>
            </div>
        </div>

        <table class="table table-sm table-hover small mt-4" id="warehouse">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Тип металла</th>
                    <th>Ширина, мм</th>
                    <th>Толщина, мм</th>
                    <th>Длина, м</th>
                    <th>Вес, т</th>
                    <th>Стоимость, руб</th>
                    <th width="110"></th>
                </tr>
            </thead>

            <tbody>
                <buhta v-for="buhta in buhtas" :key="buhta.id"
                :buhta="buhta" />
                <v-buhta></v-buhta>
            </tbody>

            <tfoot>
                <tr class="font-weight-bold">
                    <td colspan="7">Итого: </td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    import buhta from '../components/buhta.vue';
    import modalbuht from '../components/modalbuht'

    export default {
        components: {buhta, modalbuht},
        data: () => ({
            buhtas: [],
        }),
        mounted() {
            this.loadBuhts();
        },
        methods: {
            loadBuhts() {
                axios.get('/api/buhtas')
                .then(res => {
                    this.buhtas = res.data;
                })
            }
        }
        }
</script>
