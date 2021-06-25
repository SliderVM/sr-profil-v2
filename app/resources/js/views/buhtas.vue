<template>
    <div class="container-fluid">
        <h5>Бухта</h5>
        <div class="d-flex mt-3">
            <div class="mr-auto">
                <v-modalbuht></v-modalbuht>
            </div>
        </div>
        <table class="table table-sm table-hover small mt-4" id="buhta">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Контрагент</th>
                    <th>Тип металла</th>
                    <th>Ширина, мм</th>
                    <th>Толщина, мм</th>
                    <th>Длина, м</th>
                    <th>Вес, тн</th>
                    <th>Стоимость, руб</th>
                    <th class="col-2">Операции</th>
                </tr>
            </thead>
            <tbody>
                <buhta v-for="buhta in buhtas" :key="buhta.id" :buhta="buhta"/>
                <v-buhta></v-buhta>
            </tbody>
            <tfoot>
                <tr class="font-weight-bold">
                    <td colspan="9">Итого: </td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    import buhta from '../components/buhta.vue';
    import ModalBuht from '../components/ModalBuht';

    export default {
        components: {buhta, ModalBuht},
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
