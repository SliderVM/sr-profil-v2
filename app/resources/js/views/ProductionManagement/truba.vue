<template>
    <div class="container-fluid">
        <h5>Труба</h5>
        <div class="d-flex mt-3">
            <div>
                <select name="" class="form-control form-control-sm">
                    <option value="" selected="">Склад 1: с. Кушнаренково</option>
                    <option value="">Склад 2: пос. Чишмы</option>
                </select>
            </div>
        </div>
        <table class="table table-sm table-hover small mt-4" id="warehouse_tubes">
            <thead>
                <tr>
                    <th>№ п/п</th>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Сорт</th>
                    <th>Тип металла</th>
                    <th>Толщина, мм</th>
                    <th>Длина, м</th>
                    <th>Вес, т</th>
                    <th>Кол-во, шт</th>
                    <th width="30" class="d-print-none"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>Труба</td>
                    <td>I</td>
                    <td>ХК</td>
                    <td>0.7</td>
                    <td>2254.69</td>
                    <td>1.25</td>
                    <td>4</td>
                    <td class="d-print-none">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                            <div class="dropdown-menu dropdown-menu-right small">
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#dispatchModal"><i class="fa fa-truck"></i> Отгрузка</a>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#transferModal"><i class="fa fa-exchange"></i> Перемещение м/у складами</a>
                                <a href="#" class="dropdown-item"><i class="fa fa-pencil"></i> Редактировать</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>Труба</td>
                    <td>II</td>
                    <td>ГК</td>
                    <td>0.7</td>
                    <td>2254.69</td>
                    <td>1.25</td>
                    <td>6</td>
                    <td class="d-print-none">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                            <div class="dropdown-menu dropdown-menu-right small">
                                <a href="#" class="dropdown-item"  data-toggle="modal" data-target="#dispatchModal"><i class="fa fa-truck"></i> Отгрузка</a>
                                <a href="#" class="dropdown-item"  data-toggle="modal" data-target="#transferModal"><i class="fa fa-exchange"></i> Перемещение м/у складами</a>
                                <a href="#" class="dropdown-item"><i class="fa fa-pencil"></i> Редактировать</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>Труба</td>
                    <td>Брак</td>
                    <td>Цинк</td>
                    <td>0.7</td>
                    <td>2254.69</td>
                    <td>1.25</td>
                    <td>1</td>
                    <td class="d-print-none">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                            <div class="dropdown-menu dropdown-menu-right small">
                                <a href="#" class="dropdown-item"  data-toggle="modal" data-target="#dispatchModal"><i class="fa fa-truck"></i> Отгрузка</a>
                                <a href="#" class="dropdown-item"  data-toggle="modal" data-target="#transferModal"><i class="fa fa-exchange"></i> Перемещение м/у складами</a>
                                <a href="#" class="dropdown-item"><i class="fa fa-pencil"></i> Редактировать</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="font-weight-bold">
                    <td colspan="7">Итого: </td>
                    <td>3.75</td>
                    <td>11</td>
                </tr>
            </tfoot>
        </table>
        <!-- <p><a href="#"onclick="window.print(); return false;" class="d-print-none"><i class="fa fa-print"></i> Печатная форма</a></p> -->
    </div>
</template>

<script>

    export default {
        name: "truba"
    }
    </script>
