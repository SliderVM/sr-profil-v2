<template>
    <div class="container-fluid">
        <h5 class="mb-3">Справочники</h5>
        <div class="row">
            <div class="col-3">
                <div class="list-group small">
                     <router-link :to="link.href" v-for="link in links" :key="link.id" class="list-group-item">{{link.title}}</router-link>
                </div>
            </div>
            <div class="col-9">
                <h2 class="mb-3">Толщина металла</h2>
                <div class="input-group my-4">
                    <input type="number" v-model="form.tolsch" placeholder="Добавьте толщину в мм" class="form-control">
                    <button @click="send" size="sm" class="btn btn-sm btn-outline-primary"><b-icon icon="plus-square"></b-icon> Добавить</button>
                </div>
                <table class="table table-sm mt-3 table-metal-weight">
                    <thead>
                        <tr>
                            <th>Толщина, мм</th>
                            <th class="col-2">Операции</th>
                        </tr>
                    </thead>
                    <tbody>
                            <thicknesse v-for="thicknesse in thicknessesArray"
                            :key="thicknesse.id"
                            :thicknesse="thicknesse" @removing="rem" />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import thicknesse from '../components/thicknesse.vue';
    export default {
        components: {thicknesse},
        data: () => ({
            thicknessesArray: [],
            form:{
                tolsch: ""
            },
            links: [
                {
                    title: "Тип металла",
                    href:"/info"
                },
                {
                    title: "Размеры труб",
                    href:"/info2"
                },
                {
                    title: "Толщина металла",
                    href:"/info5"
                },
                {
                    title: "Управление складами",
                    href:"/warehouseinfo"
                },
                {
                    title: "Смены",
                    href:"/brigade"
                }
            ]
        }),
        mounted() {
            this.loadthicknesse();
        },
        methods: {
            loadthicknesse() {
                axios.get('/api/thicknesse')
                .then(res => {
                    this.thicknessesArray = res.data;
                })
            },
            send() {
                axios.post('/api/thicknesse', this.form, {
                headers: {"Content-type": "application/json"}
                })
                .then((response) => {
                    this.form = response.data;
                    this.thicknessesArray.push(this.form);
                })

                .catch((error) => {
                    console.log(error);
                });
            },
            rem(id) {
                const index = this.thicknessesArray.findIndex(thicknessesArray => thicknesse.id === id)
                this.thicknessesArray.splice(index,1)
            }
        }
    }
</script>
