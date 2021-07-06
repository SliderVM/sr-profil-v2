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
                        <input v-model="form.imya" placeholder="Начните вводить тип" class="form-control">
                        <button @click="send" class="btn btn-sm btn-outline-primary"><b-icon icon="plus-square"></b-icon> Добавить</button>
                    </div>
                    <table class="table mt-3">
                        <thead>
                            <th>Тип</th>
                        </thead>
                        <tbody>
                            <types v-for="type in types" :key="type.id" :name="type.name" />
                        </tbody>
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
            form: {
                imya: ""
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
            this.loadtypes();
        },
        methods: {
            loadtypes() {
                axios.get('/api/types')
                .then(res => {
                    this.types = res.data;
                })
            },
            send() {
                axios.post('/api/types',this.form, {
                    headers: {"Content-type": "application/json"}
                })
            .then((response) => {
                this.form = response.data;
                this.types.push(this.form);
            })
            .catch((error) => {
                console.log(error);
            });
            }
        }
    }
</script>
