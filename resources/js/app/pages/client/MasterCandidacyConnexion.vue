<template>
<div class="p-card p-component welcome" id="test" v-if="this.$route.name === 'MasterCandidacyConnexion'">
    <div class="p-card-body">
        <div class="p-card-title title">FIRST YEAR CANDIDATE MASTER</div>
        <div class="p-card-subtitle subtitle">Welcome <b>{{candidacy?.firstName + ' ' + candidacy?.lastName}}</b></div>
        <div class="p-card-content">
            <div class="p-fluid mt-8 flex justify-content-center align-content-center">
                <div class="field p-5">
                    <router-link :to="{name: 'ModifyMasterCandidacy'}"><Button label="Modify" class="p-button-rounded p-button-success" /></router-link>
                </div>
                <div class="field p-5">
                    <Button label="Print" class="p-button-rounded p-button-info" @click="printCandidacy"/> <!--<router-link :to="{name: 'PrintMasterCandidacy'}"></router-link>-->
                </div>
                <div class="field p-5">
                    <Button label="Logout" class="p-button-rounded p-button-danger" @click="logout"/>
                </div>
            </div>
        </div>
    </div>
</div>
<router-view v-else :masters="masters" :diplomas="diplomas" 
                :establishments="establishments" :specialities="specialities" 
                :candidacy="candidacy" :choices="choices" :studies="study" 
                :higherStudies="higherStudies"/>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            candidacy: null,
            choices: null,
            study: null,
            higherStudies: null,
            masters: null,
            diplomas: null,
            establishments: null,
            specialities: null,
            token: this.$store.state.candidate,
        }
    },
    mounted() {
        if(localStorage.getItem("candidate")){
            axios.get('/api/candidacies/' + this.$route.params.id).then( res => {
                this.candidacy =  res.data[0].candidacy
                this.study =  res.data[0].study
                this.higherStudies =  res.data[0].higherStudies
                this.choices =  res.data[0].choices
            })
            axios.get('/api/front').then( res => {
                this.masters =  res.data.masters
                this.diplomas = res.data.diplomas
                this.establishments = res.data.establishments
                this.specialities = res.data.specialities
            
                this.establishments.push({id: '', name:'Other'})
                this.specialities.push({id: '', name:'Other'})
            })
            axios.post('/api/front/checkToken', { candidate : this.$store.state.candidate })
                .then(res => {
                    if(!res.data.success) this.$store.commit('setCandidate', res.data.token)
                })
                .catch(err => {
                    this.$router.push('/studies/master/candidacy')
                })
        }else{
            this.$store.commit('clearCandidate')
            this.$router.push('/studies/master/candidacy')
        }
    },
    methods: {
        printCandidacy() {
            axios.get('/api/front/print/' + this.candidacy.id, {responseType: 'blob'}).then(res => {

                const url = window.URL.createObjectURL(new Blob([res.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'master_candidacy.pdf'); //or any other extension
                //link.target = '_blank'
                document.body.appendChild(link);
                link.click();
            })
            .catch(error => {
                console.log(error);
            })
        },
        logout() {
            axios.post('/api/candidacy/logout').then( res => this.$router.push('/studies/master/candidacy'))
        }
    }
}
</script>

<style lang="scss">
    .welcome{
        border: 2px solid #f36f21;
        margin: 2rem;
        .title{
            font-size: 1.5rem;
        }
        .subtitle{
            margin-left: 2rem;
            color: #000;
        }
    }
</style>