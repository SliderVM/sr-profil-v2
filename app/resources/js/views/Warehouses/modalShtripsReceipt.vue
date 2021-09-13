<template>
<div>
    <b-button @click='modalShow=!modalShow' size='sm' variant='outline-primary'><b-icon icon="check2"></b-icon> Подтвердить получение</b-button>

    <b-modal v-model='modalShow' size='lg' hide-header-close title="Подтвердить получение штрипса">
        <div>
            <b-button @click="send" size="sm" variant="outline-primary">Подтвердить</b-button>
        </div>
        <div slot="modal-footer">
            <b-button @click="modalShow=!modalShow" size="sm" variant="primary">Отмена</b-button>
        </div>
    </b-modal>
</div>
</template>
<script>
export default {
    data: () => ({
        modalShow: false
    }),
    mounted() {
        this.loadShtrips();
    },
    methods: {
        loadShtrips() {
            axios.get('getshtrips')
            .then(res => {
                console.log(res)
            })
        },
        send() {
            axios.post('shtripsreceipt')
            console.log('ok')
        }
    }
}
</script>
