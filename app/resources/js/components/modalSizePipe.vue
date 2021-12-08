<template>
    <div>
        <div class='btn-group'>
            <b-button @click="modalShow=!modalShow" size="sm" variant='outline-primary'><b-icon icon="plus-square"></b-icon> Добавить</b-button>
        </div>
        <b-modal v-model="modalShow" title="Добавление типа трубы">
        <type @selectType="type"></type>
        <div class="form-group">
            <label>Размер трубы, мм x мм</label>
            <input v-model.number="Form.sizePipe" placeholder="20x20" class="form-control" />
        </div>
        <div class="form-group">
            <label>Толщина трубы, мм</label>
            <input v-model.number="Form.thicknessMetal" placeholder="0.2"  class="form-control" />
        </div>
        <div class="form-group">
            <label>Ширина штрипса, мм</label>
            <input v-model.number="Form.widthShtrips" placeholder="20" class="form-control" />
        </div>
        <thickness @selectThickness="thicknesse"></thickness>
        <div class="form-group">
            <label>Вес одного метра трубы, м</label>
            <input v-model.number="Form.weightPipe" placeholder="0.003" class="form-control" />
        </div>
        <div class="form-group">
            <label>Количество труб в одной пачке, шт.</label>
            <input v-model.number="Form.amountPipe" placeholder="10" class="form-control" />
        </div>
        <div slot="modal-footer">
            <button @click="send" size="sm" class="btn btn-primary input-group-addon">Добавить</button>
        </div>
        </b-modal>
    </div>
</template>

<script>
import thickness from './addbuht/selectthickness.vue'
import type from './addbuht/selecttype.vue'
export default {
    components: {thickness, type},
    data: () => ({
        modalShow: false,
        Form: {
            metalThicknesseId: '',
            TypeMetalId: '',
            sizePipe: '',
            thicknessMetal: '',
            widthShtrips: '',
            weightPipe: '',
            amountPipe: ''
        }
    }),
    methods: {
        thicknesse(data) {
            this.Form.metalThicknesseId = data.selected;
        },
        type(data) {
            this.Form.TypeMetalId = data.selected;
        },
        send() {
            console.log(this.Form);
            axios.post('api/pipetype', this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data)
                this.modalShow = false;
                this.$emit('size', response.data)
                this.Form = '';
            })
            .catch((error) => {
                console.log(error);
            })
        }
    }
}
</script>

<style>

</style>
