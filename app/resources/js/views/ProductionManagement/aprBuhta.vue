<template>
  <div>
      <table>
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Контрагент</th>
                    <th>Тип металла</th>
                    <th>Ширина, мм</th>
                    <th>Толщина, мм</th>
                    <th>Длина, м</th>
                    <th>Вес, тн</th>
                    <th>Стоимость, руб</th>
                    <th class="col-2">Операции</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='complect in complects' :key='complect.id' />
                <td>{{apr}}</td>
            </tbody>
      </table>
  </div>
</template>

<script>
export default {
    props: ["apr"],
    data:() => ({
        complects: [{form: {
            id: 1,
            width1: 0,
            amount: "",
            tonage: "",
        }}],
        count: 2,
        }),
        methods: {
            addNewComplect() {
			this.complects.push({form: {
                id: this.count++,
                width1: 0,
                amount: "",
                tonage: "",
            }});
		},
        }
}
</script>

<style>

</style>
