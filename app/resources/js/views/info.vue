<template>
    <div class="container-fluid">

        <h5 class="mb-3">Справочники</h5>

        <div class="row">
            <div class="col-3">
                <div class="list-group small">
                    <router-link :to="link.href" v-for="link in links"class="list-group-item">{{link.title}}</a></router-link>
                </div>
            </div>
            <div class="col-9">
                <h6 class="mb-3">Тип и толщина бухт</h6>
                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#info1Modal"><i class="fa fa-plus"></i> Добавить</button>

                <table class="table table-sm mt-3 table-metal-weight">
                    <thead>
                        <tr>
                            <th width="20%">Тип</th>
                            <th>Размер, мм</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ХК</td>
                            <td>
                                <a href="#" class="badge badge-pill badge-secondary">0.7</a>
                                <a href="#" class="badge badge-pill badge-secondary">0.8</a>
                                <a href="#" class="badge badge-pill badge-secondary">0.9</a>
                                <a href="#" class="badge badge-pill badge-secondary">1.0</a>
                                <a href="#" class="badge badge-pill badge-secondary">1.1</a>
                            </td>
                        </tr>
                        <tr>
                            <td>ГК</td>
                            <td>
                                <a href="#" class="badge badge-pill badge-secondary">0.7</a>
                                <a href="#" class="badge badge-pill badge-secondary">0.8</a>
                                <a href="#" class="badge badge-pill badge-secondary">0.9</a>
                                <a href="#" class="badge badge-pill badge-secondary">1.0</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Цинк</td>
                            <td>
                                <a href="#" class="badge badge-pill badge-secondary">0.7</a>
                                <a href="#" class="badge badge-pill badge-secondary">0.8</a>
                                <a href="#" class="badge badge-pill badge-secondary">0.9</a>
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
            data(){
                return {
                    links: [
                            {
                                title: "Тип и толщина бухт",
                                href:"/info"
                            },
                            {
                                title: "Размеры труб",
                                href:"/info2"
                            }
                        ]
                }
            }
                        }
        </script>
