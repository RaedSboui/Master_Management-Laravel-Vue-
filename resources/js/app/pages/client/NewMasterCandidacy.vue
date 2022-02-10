<template>
    <div>
        <Toast />
        <div class="card form" :class="'step' + step">
            <Steps :model="items" :readonly="true" />
        </div>
        
        <div class="p-card p-component form">
            <step-1 v-if="step == 1" :masters="masters"/>
            <step-2 v-if="step == 2"/>
            <step-3 v-if="step == 3"/>
            <step-4 v-if="step == 4"  :diplomas="diplomas" :establishments="establishments" :specialities="specialities"/>
            <step-5 v-if="step == 5" :establishments="establishments" :diplomas="diplomas"/>
            <step-6 v-if="step == 6" :masters="masters" :diplomas="diplomas" :establishments="establishments" :specialities="specialities"/>
        </div>
       
    </div>
</template>

<script>
import axios from 'axios'
import Step1 from '../components/client/CandidacySteps/Step1'
import Step2 from '../components/client/CandidacySteps/Step2'
import Step3 from '../components/client/CandidacySteps/Step3'
import Step4 from '../components/client/CandidacySteps/Step4'
import Step5 from '../components/client/CandidacySteps/Step5'
import Step6 from '../components/client/CandidacySteps/Step6'

export default {
    data() {
        return {
            step: 1,
            items: 
            [
                {
                    label: 'Choices',
                },
                {
                    label: 'Personal',
                },
                {
                    label: 'Location',
                },
                {
                    label: 'Studies',
                },
                {
                    label: 'Higher Studies',
                },
                {
                    label: 'Confirmation',
                },
            ], 
            masters: null,
            diplomas: null,
            establishments: null,
            specialities: null,
            studies: null,
            higherStudies: null
        }
    },
    components: {
        Step1,
        Step2,
        Step3,
        Step4,
        Step5,
        Step6
    },
    mounted() {
        window.mitt.on('step', data => this.step = data)
        //window.mitt.on('candidacy', data => this.candidacy = data)
        //window.mitt.on('choices', data => this.choices = data)
        //window.mitt.on('studies', data => this.studies = data)
        //window.mitt.on('higherStudies', data => this.higherStudies = data)
        
        axios.get('/api/front').then( res => {
            this.masters =  res.data.masters
            this.diplomas = res.data.diplomas
            this.establishments = res.data.establishments
            this.specialities = res.data.specialities
            
            this.establishments.push({id: '', name:'Other'})
            this.specialities.push({id: '', name:'Other'})
        })
    },
}
</script>

<style lang="scss">
.form {
    margin: 1.5rem !important;
    border: .5px solid yellowgreen;
}
</style>