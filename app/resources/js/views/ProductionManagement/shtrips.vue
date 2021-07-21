<template>
    <div class="container-fluid">
        <h5>Штрипс</h5>
        <div class="d-flex mt-3 d-print-none">
            <div class="mr-auto">
                <button type="button" size="sm" class="btn btn-sm btn-outline-primary"><b-icon icon="plus-square"></b-icon> Добавить штрипс</button>
            </div>
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
                    <th width="110" class="d-print-none"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>Штрипс</td>
                    <td>ХК</td>
                    <td>625</td>
                    <td>0.7</td>
                    <td>2254.69</td>
                    <td>1.25</td>
                    <td class="d-print-none">
                        <a href="#" class="btn btn-sm btn-outline-secondary"  data-toggle="modal" data-target="#trubaModal"><i class="fa fa-calculator"></i> Труба</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>3</td>
                    <td>Штрипс</td>
                    <td>ГК</td>
                    <td>625</td>
                    <td>0.8</td>
                    <td>2244.69</td>
                    <td>1.27</td>
                    <td class="d-print-none">
                        <a href="#" class="btn btn-sm btn-outline-secondary"  data-toggle="modal" data-target="#trubaModal"><i class="fa fa-calculator"></i> Труба</a>
                        <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>4</td>
                    <td>Штрипс</td>
                    <td>Цинк</td>
                    <td>625</td>
                    <td>0.9</td>
                    <td>2264.69</td>
                    <td>1.23</td>
                    <td class="d-print-none">
                        <a href="#" class="btn btn-sm btn-outline-secondary"  data-toggle="modal" data-target="#trubaModal"><i class="fa fa-calculator"></i> Труба</a>
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
        <!-- <p><a href="#"onclick="window.print(); return false;" class="d-print-none"><i class="fa fa-print"></i> Печатная форма</a></p> -->
    </div>
</template>
<script>
export default {
    name: "shtrips"
}
</script>
