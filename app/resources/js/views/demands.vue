<template>
    <div class="container-fluid">
        <h5>Заявки</h5>
        <div class="d-flex mt-3">
            <div class="mr-auto">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#demandModal"><i class="fa fa-plus"></i> Подать заявку</button>
            </div>

        </div>
        <table class="table table-sm table-hover small mt-4">
            <thead>
                <tr>
                    <th>№</th>
                    <th width="65%">Название</th>
                    <th>Статус</th>
                    <th>Дата поступления</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><a href="#" data-toggle="modal" data-target="#dispatch1Modal">Заявка 1</a></td>
                    <td><i class="fa fa-circle-o"></i> Не отгружено</td>
                    <td>02.10.17</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a href="#" data-toggle="modal" data-target="#dispatch2Modal">Заявка 2</a></td>
                    <td class="text-success"><i class="fa fa-check-circle"></i> Отгружено</td>
                    <td>01.10.17</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
            name: "demands"
                }
</script>
