<template>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Edit Movie - {{ movieForm.name }} </h5>
                        <router-link :to="{name: 'movie-list'}" class="btn btn-primary">Movies</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="saveMovie">
                                    <div class="mb-2 ">
                                        <label for="">Movie Name</label>
                                        <input type="text" v-model="movieForm.name" class="form-control" name="name" placeholder="movie name" :class="{ 'is-invalid': movieForm.errors.has('movie') }">
                                        <has-error :form="movieForm" field="name"></has-error>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Select Cinema</label>
                                        <select name="cinema_id" class="form-control" v-model="movieForm.cinema_id" :class="{ 'is-invalid': movieForm.errors.has('cinema_id') }">
                                            <option style="display:none;" value="" selected>Select Cinema</option>
                                            <option :value="cinema.id" v-for="cinema in cinemas" :key="cinema.id"> {{
                                                    cinema.name }}</option>
                                        </select>
                                        <has-error :form="movieForm" field="cinema_id"></has-error>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Movie Time</label>
                                        <input type="text" v-model="movieForm.time" class="form-control" name="time" placeholder="movie time" :class="{ 'is-invalid': movieForm.errors.has('time') }">
                                        <has-error :form="movieForm" field="time"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update Movie</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from 'vform'

export default {
    data(){
        return {
            movieForm: new Form({
                name: '',
                time: '',
                cinema_id: ''
            }),
            cinemas : [],
        }
    },
    methods: {
        loadMovieData(){
            let id = this.$route.params.id;

            axios.get(`/api/movie/${id}/edit`).then(response => {
                let movie = response.data.data;

                this.movieForm.name = movie.name;
                this.movieForm.time = movie.time;
                this.movieForm.cinema_id = movie.cinema_id;
            });
        },
        saveMovie(){
            let id = this.$route.params.id;
            this.movieForm.put('/api/movie/'+id).then(({ data }) => {
                this.$toaster.success('Movie Updated Successfully.')
            })
        },

        loadCinemas(){
            axios.get('/api/cinema').then(response => {
                this.cinemas = response.data.data;
            });
        }
    },
    mounted(){
        this.loadMovieData();
        this.loadCinemas();
    }
}
</script>
