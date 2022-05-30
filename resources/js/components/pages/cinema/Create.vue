<template>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Create Cinema</h5>
                        <router-link :to="{name: 'cinema-list'}" class="btn btn-primary">Cinemas</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form @submit.prevent="createCinema">
                                    <div class="form-group mb-2">
                                        <label for="">Cinema name</label>
                                        <input type="text" v-model="cinemaForm.name" class="form-control" name="name"
                                               placeholder="cinema name"
                                               :class="{ 'is-invalid': cinemaForm.errors.has('name') }">
                                        <has-error :form="cinemaForm" field="name"></has-error>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="">Cinema Location</label>
                                        <input type="text" v-model="cinemaForm.location" class="form-control" name="location"
                                               placeholder="cinema location"
                                               :class="{ 'is-invalid': cinemaForm.errors.has('location') }">
                                        <has-error :form="cinemaForm" field="location"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Create Cinema</button>
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
        return{
            cinemaForm: new Form({
                name: '',
                location: '',
            }),
        }
    },

    methods: {
        createCinema(){
            this.cinemaForm.post('/api/cinema').then(({ data }) => {

                this.cinemaForm.name = '';
                this.cinemaForm.location = '';

                this.$toaster.success('A new cinema has been created!.')
            })
        }
    }
}
</script>

<style scoped>

</style>
