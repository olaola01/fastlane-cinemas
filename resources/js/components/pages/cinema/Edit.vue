<template>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Edit Cinema - {{  cinemaForm.name }}</h5>
                        <router-link :to="{name: 'cinema-list'}" class="btn btn-primary">Cinemas</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="updateCinema">
                                    <div class="form-group mb-2">
                                        <label for="">Cinema name</label>
                                        <input type="text" v-model="cinemaForm.name" class="form-control" name="name" placeholder="cinema name" :class="{ 'is-invalid': cinemaForm.errors.has('name') }">
                                        <has-error :form="cinemaForm" field="name"></has-error>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Cinema location</label>
                                        <input type="text" v-model="cinemaForm.location" class="form-control" name="location" placeholder="cinema location" :class="{ 'is-invalid': cinemaForm.errors.has('location') }">
                                        <has-error :form="cinemaForm" field="location"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update Cinema</button>
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
            cinemaForm: new Form({
                name: '',
                location: ''
            }),
        }
    },
    methods: {
        updateCinema(){
            let id = this.$route.params.id;
            this.cinemaForm.put(`/api/cinema/${id}`).then(() => {
                this.$toaster.success('Cinema Updated Successfully.')
            })
        },
        loadCinema(){
            let id = this.$route.params.id;

            axios.get(`/api/cinema/${id}/edit`).then(response => {
                this.cinemaForm.name = response.data.data.name;
                this.cinemaForm.location = response.data.data.location;
            });
        }
    },
    mounted(){
        this.loadCinema();
    }
}
</script>

<style>
</style>
