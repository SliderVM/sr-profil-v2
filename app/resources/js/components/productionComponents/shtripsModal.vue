<template>
    <div>
        <b-button @click='modalShow=!modalShow' size='sm' :value="buhta.id" variant='outline-primary'><b-icon icon='calculator'></b-icon> Произвести штрипс</b-button>
        <b-modal v-model="modalShow">
            <div slot='modal-header'>
                <label>Производство штрипса</label>
            </div>
            <div class="form-group">
                <label>Дата производства</label>
                <input type="Date" v-model="Form.dateManufacture" placeholder="Введите дату производства" class="form-control" />
            </div>
            <div>
                <label>Бригада</label>
                <b-form-select v-model="Form.brigadeId">
                    <option v-for="brigade in selectBrigade" :key="brigade.id" :value="brigade.id">{{brigade.name}} </option>
                </b-form-select>
            </div>
            <div slot="modal-footer">
                <button size="sm" @click="saveShtrips" class="btn btn-primary input-group-addon">Сохранить</button>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ['buhta', 'apr'],
    data: () => ({
        modalShow: false,
        selectBrigade: [],
        options: [
            {selectBrigade: '', value: ''},
        ],
        Form: {
            dateManufacture: '',
            brigadeId: '',
            buhtas: {},
            aprs: {}
        }
    }),
    mounted() {
        this.Form.buhtas = this.buhta; // переменная = пропс
        this.loadBrigade();
    },
    methods: {
        loadBrigade() {
            axios.get('/api/brigade')
            .then(res => {
                this.selectBrigade = res.data;
            })
        },
        saveShtrips() {
            this.Form.aprs = this.apr; // переменная = пропс
            console.log(this.aprs)
            axios.post('/api/shtrips', this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response);
            })
            .catch((error) => {
                console.log(error);
            })
        }
    }
}
</script>
