<template>
<div>
    <b-button @click='modalShow=!modalShow' size='sm' variant='outline-primary'><b-icon icon="check2"></b-icon> Подтвердить получение</b-button>

    <b-modal v-model='modalShow' size="xl" title="Подтвердить получение штрипса" footer-text-variant="danger">
        <div>
            <b-table-simple>
                <b-thead>
                    <b-tr>
                        <b-th>Тип металла</b-th>
                        <b-th>Ширина, мм</b-th>
                        <b-th>Толщина, мм</b-th>
                        <b-th>Длина, м</b-th>
                        <b-th>Вес, тн</b-th>
                        <b-th>Цена за тонну</b-th>
                        <b-th>Сумма</b-th>
                        <b-th>Размер трубы</b-th>
                        <b-th></b-th>
                    </b-tr>
                </b-thead>
                <b-tbody>
                    <b-tr v-for="shtrips in shtripsArray" :key="shtrips.id">
                        <b-td>{{shtrips.id}}</b-td>
                        <b-td>{{shtrips.types_metals.name}}</b-td>
                        <b-td>{{shtrips.width_in_millimeters}}</b-td>
                        <b-td>{{shtrips.metal_thicknesse.thicknesses}}</b-td>
                        <b-td>{{shtrips.length_in_meters}}</b-td>
                        <b-td>{{shtrips.weight_in_tons}}</b-td>
                        <b-td>{{shtrips.cost}}</b-td>
                        <b-td>{{shtrips.cost * shtrips.width_in_millimeters || 0}}</b-td>
                        <b-td>{{shtrips.pipe_type.name}}</b-td>
                        <b-td>
                            <div class='btn-group'>
                                <b-button @click="visible=!visible" v-on:click="test(shtrips.id)" size="sm" variant="outline-primary">Подтвердить</b-button>
                                <b-button @click="cancel(shtrips.id)" size="sm" variant="outline-primary">Отказаться</b-button>
                            </div>
                            <div>
                                <b-modal v-model="visible" title="Выберите дату получения">
                                    <data-r @Vibe="dateReceipt"></data-r>
                                    <div slot="modal-footer">
                                        <b-button @click="send" size="sm" variant="primary">Сохранить</b-button>
                                    </div>
                                </b-modal>
                            </div>
                        </b-td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
        </div>
        <div slot="modal-footer">
            Неподтвержденного штрипса: {{count}}
            <b-button @click="modalShow=!modalShow" size="sm" variant="primary">Отмена</b-button>
        </div>
    </b-modal>
</div>
</template>
<script>
import dataR from '../../components/addbuht/Input/inputdata.vue'
export default {
    components: {dataR},
    data: () => ({
        visible: false,
        modalShow: false,
        shtripsArray: [],
        Form: {
            id: '',
            receiptDate: '',
            userReceipt: '',
        },
        count: '',
    }),
    mounted() {
        this.loadShtrips();
    },
    methods: {
        test(id) {
            this.Form.id = id;
        },
        cancel(id) {
            axios.post('shtripscancel/' + id)
            .then(res => {
                console.log(res);
            })
        },
        dateReceipt(data) {
            this.Form.receiptDate = data.receiptDate;
            this.userCheck();
        },
        loadShtrips() {
            axios.get('api/shtrips/create')
            .then(res => {
                this.shtripsArray = res.data[0];
                this.count = res.data[1];
            })
        },
        userCheck() {
            axios.get('/user')
            .then(response => {
                this.Form.userReceipt = response.data.id
            })
        },
        send() {
            console.log(this.Form.id);
            axios.post('shtripsreceipt', this.Form)
            .then(res => {
                this.loadShtrips();
                this.visible = false;
            })
        },
    }
}
</script>
