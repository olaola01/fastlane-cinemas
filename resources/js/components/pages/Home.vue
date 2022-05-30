<template>
    <div class="container py-5">
        <h2>All Cinemas with their movie list</h2>
        <div class="row justify-content-center">
            <div>
                <h3 v-if="loading == false" class="mr-3 text-base text-80 font-bold"/>
                <h3 v-else class="loading mr-3 text-base text-80" style="text-align:center;padding: 70px 0;">
                    Loading Information...
                </h3>
            </div>
            <div class="col-md-12" v-if="cinemas.length">
                <div class="card mb-5" :key="index" v-for="(cinema, index) in cinemas">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            Cinema : {{ cinema.name }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col"> Id</th>
                                <th scope="col"> Name Of Movie</th>
                                <th scope="col"> Time Of Movie</th>
                            </tr>
                            </thead>

                            <tbody v-if="cinema.movies.length">
                            <tr :key="index" v-for="(movie, index) in cinema.movies">
                                <td scope="row"> {{ movie.id }}</td>
                                <td scope="row"> {{ movie.name }}</td>
                                <td scope="row"> {{ moment(String(movie.time)).format('dddd, MMMM, yyyy H:m') }}</td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center mt-4 mb-4">No Cinemas found.</h5>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <br/>
                </div>
            </div>


            <div class="col-md-12" v-else>
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">No Data Yet</h5>
                </div>
            </div>
        </div>
    </div>
    <!--    </div>-->
</template>

<script>
import moment from "moment";

export default {
    data() {
        return {
            cinemas: [],
            loading: false,
            moment: moment
        }
    },
    methods: {
        loadCinemas() {
            axios.get('/api/cinema').then(response => {
                this.cinemas = response.data.data;
                this.loading = false;
            });
        },
        setLoading() {
            this.loading = true;
        },
    },
    mounted() {
        this.loadCinemas();
        this.setLoading();
    }
}
</script>

<style scoped>

</style>
