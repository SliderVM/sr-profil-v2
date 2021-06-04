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
                <h6 class="mb-3">Размеры труб</h6>
                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#info2Modal"><i class="fa fa-plus"></i> Добавить</button>

                <table class="table table-sm mt-3">
                    <thead>
                        <tr>
                            <th>Размер, мм</th>
                            <th width="40"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>40x40</td>
                            <td>
                                <a class="close" href="#" title="Удалить">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>20x20</td>
                            <td>
                                <a class="close" href="#" title="Удалить">
                                    <span aria-hidden="true">&times;</span>
                                </a>
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
                                title: "Тип бухт",
                                href:"/info"
                            },
                            {
                                title: "Размеры труб",
                                href:"/info2"
                            },
                            {
                                title: "Толщина бухт",
                                href:"/info5"
                            },
                            {
                                title: "Управление складами",
                                href:"/warehouseinfo"
                            }
                        ]
                }
            }
                        }

    </script>
