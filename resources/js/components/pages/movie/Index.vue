<template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div>
                    <h3 v-if="loading == false" class="mr-3 text-base text-80 font-bold"/>
                    <h3 v-else class="loading mr-3 text-base text-80" style="text-align:center;padding: 70px 0;">
                        Loading Information...
                    </h3>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Movie List</h5>
                        <router-link :to="{name: 'create-movie'}" class="btn btn-primary">Create Movie</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 100px"> Id </th>
                                <th> Name Of Movie</th>
                                <th> Time Of Movie</th>
                                <th> Cinema Showing </th>
                                <th style="width: 170px"> Action </th>
                            </tr>
                            </thead>
                            <tbody v-if="movies.length">
                            <tr v-for="movie in movies" :key="movie.id">
                                <td style="width: 100px"> {{ movie.id }} </td>
                                <td> {{ movie.name }} </td>
                                <td> {{ moment(String(movie.time)).format('dddd, MMMM, yyyy H:m') }} </td>
                                <td> {{ movie.cinema.name }} </td>
                                <td style="width: 170px">
                                    <router-link :to="{name: 'edit-movie', params: {id: movie.id}}" class="btn btn-primary btn-sm">Edit</router-link>
                                    <a @click.prevent="deleteMovie(movie)" href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4">
                                    <h5 class="text-center mt-4 mb-4">No Movies found.</h5>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import moment from "moment";

export default {
    data(){
        return {
            movies: [],
            moment: moment,
            loading: false,
        }
    },
    methods: {
        loadMovies(){
            axios.get('/api/movie').then(response => {
                this.movies = response.data.data;
                this.loading = false;
            });
        },
        deleteMovie(movie){
            axios.delete(`/api/movie/${movie.id}`).then(() => {
                this.$toaster.success('Movie Deleted!.')
            });
            let index = this.movies.indexOf(movie);
            this.movies.splice(index, 1);
        },
        setLoading() {
            this.loading = true;
        },
    },
    mounted() {
        this.loadMovies();
        this.setLoading();
    }
}
</script>

<style scoped>

</style>
