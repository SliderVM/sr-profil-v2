<template>
<div>
    <b-button @click='modalShow=!modalShow' size='sm' :value="buhta.id" variant='outline-primary'><b-icon icon='printer'></b-icon> Распечатать наряд</b-button>
        <b-modal v-model="modalShow" title="Распечатать наряд" hide-header-close>
            <div class="form-group">
                <label>Выберите дату</label>
                <input type="Date" v-model="Form.dateOutfit" placeholder="Введите дату производства" class="form-control" />
            </div>
            <div slot="modal-footer">
                <button size="sm" @click="printOutfitStripping" class="btn btn-primary input-group-addon">OK</button>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ['buhta'],
    data: () => ({
        modalShow: false,
        Form: {
            dateOutfit: '',
            buhtas: {}
        }
    }),
    mounted() {
        this.Form.buhtas = this.buhta; // переменная = пропс
    },
    methods: {
        printOutfitStripping()
        {
            console.log(this.Form);
            axios.post('showOutfitStripping', this.Form)
            .then(res => {
                let mywindow = window.open('', 'PRINT');
                mywindow.document.write(res.data);
                mywindow.print();
                mywindow.close();
            })
        },
    }
}
</script>
