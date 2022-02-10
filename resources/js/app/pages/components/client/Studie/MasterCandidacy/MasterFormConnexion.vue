<template>
    <div class="card card-connexion">
        <h5>First year master's form connection</h5>
        <div class="p-fluid">
            <span class="p-float-label">
                <InputText id="identity" type="text" v-model="credentials.identity"/>
                <label for="identity">Identity</label>
            </span>
            <span class="p-float-label">
                <Password :feedback="false" id="password" toggleMask v-model="credentials.password"/>
                <label for="password">Password</label>
            </span>
        </div>
        <button id="btn" @click="login">connexion</button>
        <a href="">Forgot your password?</a>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data(){
        return {
            credentials: {},
        }
    },
    methods: {
        login(){
            axios.post('/api/candidacy/login', this.credentials)
                .then( res => {
                    if(res.data.success){
                        this.$store.commit('setCandidate', res.data.token)
                        this.$store.commit('setCandidacy', res.data.candidacy_id)
                        this.$router.push('/studies/master/candidacy/' + res.data.candidacy_id)
                    }
                })
                .catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
        }
    }
}
</script>

<style lang="scss">
    .card-connexion{
        border: 2px solid #000;
        padding: 2rem;
        text-align: center;
        h5{
            color: #ff9515;
            margin-top: 1rem;
            margin-bottom: 3rem;
        }
        .p-fluid{
            > span:nth-of-type(1){
                margin-bottom: 2rem;
            }
        }
        #btn{
            font-family: "Saira";
            position: relative;
            padding: 10px 17px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 4px;
            color: #74b9ff;
            border: 2px solid #74b9ff;
            text-transform: uppercase;
            z-index: 1;
            cursor: crosshair !important;
            transition: 0.8s ease-out;
            display: block;
            background: none;
            outline: none;
            overflow: hidden;
            margin: 1rem auto;

            &:before {
                content: "";
                position: absolute;
                background: #74b9ff;
                bottom: 0;
                left: 0;
                right: 0;
                top: 100%;
                z-index: -1;
                transition: top 0.8s ease-out;
            }

            &:hover {
                color: #fff;
                &:before {
                    top: 0%;
                }
            }
        }
        a{
            color: #74b9ff;
            &:hover{
                color: #073772;
            }
        }
    }
    @media(max-width: 1200px){
        .card-connexion{
            margin-top: 3rem;
        }
    }
</style>