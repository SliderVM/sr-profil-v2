<!-- <template>
    <buhta
        v-for="buhta in buhtas"
        :title="buhta.title"
    />
</template>

<script>
    import axios from 'axios';
    import buhta from "./buhta.vue";
    export default {
        components: {buhta},
        data: () => ({
            buhts: []
        }),
        mounted() {
            this.loadBuhts();
        },
        methods: {
            loadBuhts() {
                axios.get('/api/buhtas')
                .then(res => {
                    this.buhts = res.data;
                })
            }
        }
    }
</script> -->
