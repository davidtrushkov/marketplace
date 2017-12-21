<template>

    <div>
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item">Cras justo odio</li>
            </ul>
        </div>
        <div class="col-sm-8">
            <file v-for="file in files" :file="file" :key="file.id"></file>
            <pagination v-if="meta.current_page" :meta="meta" v-on:pagination:switched="switchPage"></pagination>
        </div>
    </div>

</template>

<script>
    import File from './partials/File.vue'
    import Pagination from '../pagination/Pagination.vue'

    export default {
        components: {
            File,
            Pagination
        },
        data() {
            return {
                files: [],
                meta: {}
            }
        },
        watch: {
            '$route.query' (query) {
                this.getFiles(query.page)
            }
        },
        mounted() {
            this.getFiles();
        },
        methods: {
            getFiles(page = this.$route.query.page) {
                axios.get('/api/files', {
                    params: {
                        page
                    }
                }).then((response) => {
                    this.files = response.data.data;
                    this.meta = response.data.meta;
                });
            },
            switchPage (page) {
                this.$router.replace({
                    name: 'files.index',
                    query: {
                        page
                    }
                })
            }
        }
    }
</script>