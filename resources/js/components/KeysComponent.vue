<template>
    <div>
        <div class="form-group">
            <input type="text" class="form-control" id="searchQuery" aria-describedby="emailHelp"
                   placeholder="Enter search query" v-model="searchQuery">
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between" v-for="key in keys.data" :key="key.id">
                {{ key.name }}
                <div class="d-flex">
                    <a :href="'/key/' + key.id"
                       class="btn btn-primary mr-3">Show</a>
                    <a :href="'/key/' + key.id + '/edit/'"
                       class="btn btn-primary mr-3">Edit</a>
                    <form :action="'/key/' + key.id" method="POST">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#deleteModal' + key.id">Delete</button>

                        <!-- Modal -->
                        <div class="modal fade" :id="'deleteModal' + key.id" tabindex="-1" role="dialog"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete key #{{ key.id}} '{{ key.name }}'?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li v-if="!keys.data.length" class="list-group-item d-flex justify-content-center">
                Keys have not been found
            </li>
        </ul>
        <div class="row mt-3" v-if="pagesCount > 1">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" :href="createPaginationLink(1)"
                                                 @click.prevent="changePage(1)">Previous</a></li>
                        <li class="page-item" :class="{ active : link === currentPage }"
                            v-for="link in paginationLinks">
                            <a class="page-link" :href="createPaginationLink(link)" @click.prevent="changePage(link)">{{
                                link }}</a>
                        </li>
                        <li class="page-item"><a class="page-link" :href="createPaginationLink(pagesCount)"
                                                 @click.prevent="changePage(pagesCount)">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            csrf: {
                type: String,
                required: true,
            },
            default_keys: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                keys: this.default_keys,
                currentPage: 1,
                maxPaginationLinks: 5,
                pagesCount: 1,
                searchQuery: '',
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.setPaginatorValues();
        },
        computed: {
            paginationLinks() {
                let maxPaginationLinks = this.maxPaginationLinks;
                if (this.maxPaginationLinks > this.pagesCount) {
                    maxPaginationLinks = this.pagesCount;
                }

                let paginationLinks = [],
                    firstPage = (this.currentPage - parseInt(maxPaginationLinks / 2)) > 0 ? this.currentPage - parseInt(maxPaginationLinks / 2) : 1,
                    lastPage = (this.currentPage + parseInt(maxPaginationLinks / 2)) <= this.pagesCount ? this.currentPage + parseInt(maxPaginationLinks / 2) : this.pagesCount;

                for (let i = firstPage; i <= lastPage; i++) {
                    paginationLinks.push(i);
                }

                if (paginationLinks.length < maxPaginationLinks && firstPage === 1 && lastPage < this.pagesCount) {
                    while (paginationLinks.length < maxPaginationLinks && lastPage <= this.pagesCount) {
                        lastPage++;
                        paginationLinks.push(lastPage);
                    }
                }

                if (paginationLinks.length < maxPaginationLinks && firstPage > 1 && lastPage === this.pagesCount) {
                    while (paginationLinks.length < maxPaginationLinks && firstPage >= 1) {
                        firstPage--;
                        paginationLinks.unshift(firstPage)
                    }
                }

                return paginationLinks;
            },
        },
        watch: {
            searchQuery() {
                this.changePage(1);
            }
        },
        methods: {
            setPaginatorValues() {
                if (this.keys.current_page) {
                    this.currentPage = this.keys.current_page;
                }

                if (this.keys.last_page) {
                    this.pagesCount = this.keys.last_page;
                }
            },
            createPaginationLink(page) {
                if (page <= 1) {
                    return `/key?searchQuery=${this.searchQuery}`;
                } else {
                    return `/key?page=${page}&searchQuery=${this.searchQuery}`;
                }
            },
            async changePage(page) {
                let response = await axios.get(this.createPaginationLink(page));
                this.keys = response.data;
                this.setPaginatorValues(this.keys);
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
