<template>
    <b-tr>
        <div>
            <b-table-simple>
                <b-thead>
                    <b-tr>
                        <b-th>Ширина, мм</b-th>
                        <b-th>Тоннаж, тн</b-th>
                        <b-th>Количество, шт</b-th>
                    </b-tr>
                </b-thead>
                <b-tbody>
                    <b-tr>
                    <td>{{apr.width}}</td>
                    <td>{{apr.tonage}}</td>
                    <td>{{apr.amount}}</td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
        </div>
    </b-tr>
</template>

<script>
export default {
    props: {apr: Array},
    data:() => ({
        aprs: []
    }),
    // mounted() {
    //     this.load1();
    // },
     methods: {
        // load1() {
        //     console.log(this.apr.id);
        //     axios.get('/api/apr/' + this.apr.id)
        //     .then(res => {
        //         this.aprs = res.data
        //     })
        // }
    }
}
</script>

<style>

</style>
