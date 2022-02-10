<template>
<div>
    <div v-if="loading" class="w-screen h-screen flex align-items-center justify-content-center">
        <ProgressSpinner/>
    </div>
    <div v-else class="col-12 md:col-6 w-screen h-screen flex align-items-center justify-content-center">
        <Toast/>
		<div class="card" style="padding:0 !important; margin: 0 !important; width: 60vw !important; height:60vh">
            <div class="flex flex-wrap w-full h-full" style="overflow:hidden">
				<div class="col-12 lg:col-6 lg:mb-0" style="padding:0 !important;">
                    <img aria-hidden="true" class="cover w-full h-full border-round" style="object-fit: cover;" src="images/login-office.jpeg" alt="Office" />
				</div>
                <div class="col-12 mb-2 lg:col-6 lg:mb-0 flex align-items-center justify-content-center flex-column">
                    <h2>CONNEXION</h2>
                    <form @submit.prevent="login()" class="p-fluid">
                        <div class="field mt-6">
                            <label for="username">Username:</label> <br>
                            <InputText id="username" type="text" v-model="credentials.username" />
                         <!--   <small v-if="(credentials.username && submitted) || credentials.username" class="p-error">Username is required !</small> -->
                        </div>
                        <div class="field">
                            <label for="email">Password:</label> <br>
                            <InputText id="email" type="text" v-model="credentials.password"/>
                         <!--   <small v-if="(credentials.password && submitted) || credentials.password" class="p-error">password is required !</small>  -->
                        </div>
                        <div class="field">
                            <Button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Log Me In
                            </Button>
                            <a class="text-sm w-full font-medium text-purple-600 dark:text-purple-400 hover:underline"  href="#">
                                Forgot your password?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            credentials: {},
            loading: true,
            submitted: false,
        }
    },
    mounted() {
        if(localStorage.getItem("auth")){
            axios.post('/api/checkToken', { token : this.$store.state.token })
                .then(res => {
                    this.loading = false
                    if(res.data.success){
                        this.$router.push('/admin')
                    } else {
                        this.$store.commit('setToken', res.data.token)
                    }
                })
                .catch(err => {
                    this.loading = false
                })
        }else{
            this.loading = false
            this.$store.commit('clearToken')
        }
    },
    methods: {
        /*

        handleSubmit(isFormValid) {
            this.submitted = true;

            if (!isFormValid) {
                return;
            }

            this.login();
        },

        */
        login()
        {
            axios.post('/api/login', this.credentials)
                .then( res => {
                    if(res.data.success){
                        this.loading = false
                        this.$store.commit('setToken', res.data.token)
                        this.$store.commit('setUser', res.data.user)
                        this.$router.push('/admin')
                    }
                })
                .catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: 'Verify your credentials', life: 5000}))
        },
    },
}
</script>