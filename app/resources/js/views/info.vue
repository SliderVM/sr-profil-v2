<template>
    <div class="container-fluid">

        <h5 class="mb-3">Справочники</h5>

            <div class="row">
                <div class="col-3">
                    <div class="list-group small">
                        <router-link :to="link.href" v-for="link in links" :key="link.id" class="list-group-item">{{link.title}} </router-link>
                    </div>
                </div>
                <div class="col-9">
                    <h2 class="mb-3">Тип металла</h2>
                    <div class="input-group my-4">
                        <input v-model="form.name" placeholder="тип" class="form-control">
                        <button v-on:click="send" class="btn btn-primary input-group-addon">Добавить</button>
                    </div>

                    <table class="table mt-3">
                        <thead>
                            <th>Тип</th>
                        </thead>
                        <tr>
                            <tbody>
                                <types v-for="type in types" :key="type.id" :name="type.name" />
                                    <v-types></v-types>
                            </tbody>
                        </tr>
                    </table>
                </div>
            </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import types from '../components/types.vue';

    export default {
        components: {types},
        data: () => ({
            types: [],
            form:{
                name: ""
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
                }
            ]
        }),
        mounted() {
        this.loadtypes();
        },
        methods: {
            loadtypes() {
                axios.get('/api/types')
                .then(res => {
                    this.types = res.data;
                })
            },
            send: function () {
                axios.post('/api/types',this.form, {
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
