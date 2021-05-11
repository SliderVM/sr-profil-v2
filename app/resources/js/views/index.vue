<template>
    <div class="container-fluid">

        <!-- <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Удалось
        </div> -->

        <h5>Бухта</h5>
        <div class="d-flex mt-3">
            <div class="mr-auto">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#supplyModal"><i class="fa fa-plus"></i> Приход металла</button>
            </div>
            <!-- <div>
                <select name="" class="form-control form-control-sm">
                    <option value="">Металл</option>
                    <option value="">Штрипс</option>
                    <option value="">Обрезь</option>
                </select>
            </div> -->
        </div>

        <table class="table table-sm table-hover small mt-4" id="warehouse">
            <thead>
                <tr>
                    <th>№ п/п</th>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Тип металла</th>
                    <th>Ширина, мм</th>
                    <th>Толщина, мм</th>
                    <th>Длина, м</th>
                    <th>Вес, т</th>
                    <th width="110"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>Металл</td>
                    <td>ХК</td>
                    <td>1250</td>
                    <td>0.7</td>
                    <td>2254.69</td>
                    <td>1.25</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-secondary"  data-toggle="modal" data-target="#aprModal"><i class="fa fa-calculator"></i> АПР</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>3</td>
                    <td>Металл</td>
                    <td>ГК</td>
                    <td>1250</td>
                    <td>0.8</td>
                    <td>2244.69</td>
                    <td>1.27</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-secondary"  data-toggle="modal" data-target="#aprModal"><i class="fa fa-calculator"></i> АПР</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>4</td>
                    <td>Металл</td>
                    <td>Цинк</td>
                    <td>1250</td>
                    <td>0.9</td>
                    <td>2264.69</td>
                    <td>1.23</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-secondary"  data-toggle="modal" data-target="#aprModal"><i class="fa fa-calculator"></i> АПР</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="font-weight-bold">
                    <td colspan="7">Итого: </td>
                    <td>3.75</td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>

    export default {
        name: "index"
    }
    </script>
