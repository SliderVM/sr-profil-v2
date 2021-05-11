<template>
    <div class="container-fluid">

        <h5 class="mb-3">Производители</h5>

        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#info3Modal"><i class="fa fa-plus"></i> Добавить</button>

        <table class="table table-sm mt-3">
            <thead>
                <tr>
                    <th>Прозводитель</th>
                    <th width="40"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ОАО "Винтик и шпунтик"</td>
                    <td>
                        <a class="close" href="#" title="Удалить">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>ОАО "Стамеска"</td>
                    <td>
                        <a class="close" href="#" title="Удалить">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        name: "info3"
    }
</script>
