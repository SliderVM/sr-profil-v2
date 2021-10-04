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
                <h5 class="mb-3">Конфигурации</h5>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th class="col-6">Конфигурации</th>
                            <th class="col-4">Значение</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="conf in configurationArray" :key="conf.id">
                            <td>{{conf.name}}</td>
                            <td><input v-model.number="conf.value" class="form-control form-control-sm" :readonly="status"></td>
                            <td>
                                <div class="input-group input-group-sm ">
                                    <button @click="red" v-if="isHidden" class="btn btn-sm btn-outline-primary"><b-icon icon="pencil"></b-icon> Редактировать</button>
                                    <button v-if="visible" @click="Send(conf.id, conf.value)" class="btn btn-sm btn-outline-primary hidden"><b-icon icon="check2"></b-icon> Сохранить</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    data: () => ({
        configurationArray: [],
        Form: {
            id: '',
            value: ''
        },
        visible: false, // кнопка сохранить
        status: true, // ридонли инпут
        isHidden: true, // кнопка редактировать
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
            },
            {
                title: "Пользователи",
                href:"/users"
            },
            {
                title: "Конфигурации",
                href:"/configuration"
            },
            {
                title: "Сорт труб",
                href:"/pipegrade"
            },
        ]
    }),
    mounted() {
        this.loadConfiguration();
    },
    methods: {
        loadConfiguration() {
            axios.get('api/configuration')
            .then(res => {
                this.configurationArray = res.data;
            })
        },
        Send(id, value) {
            this.Form.value = value;
            this.Form.id = id;
            axios.patch('/api/configuration/' + id, this.Form, {
                header: "Content-type: application/json"
            })
            .then(response => {
                this.loadConfiguration();
                this.Form = "";
                this.visible = false;
                this.isHidden = true;
                this.status = true;

            })
            .catch(error => {
                console.log(error);
            });
        },
        red() {
            this.isHidden = false;
            this.visible=true;
            this.status = false;
        }
    }
}
</script>

<style>

</style>
