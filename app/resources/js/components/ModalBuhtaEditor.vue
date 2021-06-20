<template>
    <div class="btn-group" role="group" aria-label="Basic example">
        <b-button @click="modalShow=!modalShow" size="sm" variant="secondary"><b-icon icon="calculator"></b-icon> АПР</b-button>
        <div v-if="buhta.available == 1">
        <button type="button" @click="send" :value="buhta.id" variant="secondary">Оприходовать</button>
        </div>

        <b-modal v-model="modalShow" size="lg" title="Бухта №">

                <label>Ширина, мм  </label>

            <div>
                <label>Тип резки</label>
                <div class="col">
                <input type="number" placeholder="100" class="form-control"  />
                </div>
                <div class="col">
                <input type="number" placeholder="Количество тонн" class="form-control"  />
                </div>
                <div class="col">
                <input type="number" placeholder="0" class="form-control"  />
                </div>
            </div>
            <button type="button" variant="secondary"><b-icon icon="plus-square"></b-icon>Добавить тип резки</button>
            <div slot="modal-footer">
                <button size="sm"  class="btn btn-primary input-group-addon">Сохранить </button>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ["buhta"],
    data: () => ({
        modalShow: false,
        Form:{
            id: "",
        }
    }),
    mounted() {
        this.loadForm();
    },
    methods: {
        loadForm() {
            this.Form = this.buhta;
        },
        send: function () {
            console.log(this.buhta.id)
            axios.put('api/buhtas/' + this.buhta.id, this.Form, {
                header: ("Content-type: application/json")
            })
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            });
        }
    }
    }
</script>
