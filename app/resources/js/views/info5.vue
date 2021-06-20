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
                <h6 class="mb-3">Толщина металла</h6>
                <div class="input-group my-4">
                        <input type="number" v-model="form.thicknesses" placeholder="толщина" class="form-control">
                        <button v-on:click="send" variant="light" data-toggle="modal" data-target="#info3Modal"><b-icon icon="plus-square"></b-icon> Добавить</button>
                    </div>
                <table class="table table-sm mt-3 table-metal-weight">
                    <thead>
                        <tr>
                            <th>Размер, мм</th>
                        </tr>
                    </thead>
                    <tbody>
                            <thicknesse v-for="thicknesse in thicknessesArray" :key="thicknesse.id" :test="thicknesse.thicknesses" />
                            <v-thicknesse></v-thicknesse>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import thicknesse from '../components/thicknesse.vue';
    export default {
        components: {thicknesse},
        data: () => ({
            thicknessesArray: [],
            form:{
                thicknesses: ""
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
            send: function () {
                axios.post('/api/thicknesse',this.form, {
                headers: {"Content-type": "application/json"}
                })
            .then((response) => {
                this.form = response.data;
            })

            .catch((error) => {
                console.log(error);
            });
            }
        }
    }
</script>
