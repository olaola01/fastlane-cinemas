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
                        <h5 class="mb-0">Cinema List</h5>
                        <router-link :to="{name: 'create-cinema'}" class="btn btn-primary">Create Cinema</router-link>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 100px"> Id </th>
                                <th> Name </th>
                                <th> Location </th>
                                <th style="width: 170px"> Action </th>
                            </tr>
                            </thead>
                            <tbody v-if="cinemas.length">
                            <tr v-for="cinema in cinemas" :key="cinema.id">
                                <td style="width: 100px"> {{ cinema.id }} </td>
                                <td> {{ cinema.name }} </td>
                                <td> {{ cinema.location }} </td>
                                <td style="width: 170px">
                                    <router-link :to="{name: 'edit-cinema', params: {id: cinema.id}}" class="btn btn-primary btn-sm">Edit</router-link>
                                    <a @click.prevent="deleteCinema(cinema)" href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
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
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data(){
        return {
            cinemas: [],
            loading: false,
        }
    },
    methods: {
        loadCinemas(){
            axios.get('/api/cinema').then(response => {
                this.cinemas = response.data.data;
                this.loading = false;
            });
        },
        deleteCinema(cinema){
            axios.delete(`/api/cinema/${cinema.id}`).then(() => {
                this.$toaster.success('Cinema Deleted!.')
            });
            let index = this.cinemas.indexOf(cinema);
            this.cinemas.splice(index, 1);
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
