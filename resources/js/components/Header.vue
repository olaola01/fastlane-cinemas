<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-dark">
        <div class="container-fluid">
            <router-link class="navbar-brand" :to="{name: 'home'}">FASTLANE CINEMAS</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{name: 'home'}">Dashboard</router-link>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link  class="nav-link" :to="{name: 'cinema-list'}">Cinema</router-link>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link class="nav-link" :to="{name: 'movie-list'}">Movies</router-link>
                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link class="nav-link" :to="{name: 'login'}">Login</router-link>
                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link class="nav-link" :to="{name: 'register'}">Register</router-link>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <a href="#" class="nav-link" @click.prevent="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    methods: {
        logout() {
            axios.post('/logout').then(response => {
                this.$toaster.success('Logout Successful!');
                localStorage.removeItem("auth");
                this.$store.commit('SET_AUTHENTICATED', false);
                this.$router.push({name: 'login'});
            });
        },

    },
    computed: {
        isLoggedIn() {
            return this.$store.getters.getAuthenticated;
        },
        user(){
            return this.$store.getters.getUser;
        }
    }
}
</script>

<style scoped>

</style>
