<template>
    <div class="stepsdemo-content">
        <card>
            <template v-slot:title>
                Confirmation
            </template>
            <template v-slot:content>
                <fieldset>
                    <legend class="ml-4">Choices</legend>
                    <div class="p-field p-col-12 ml-3" v-for="(choice, index) in choices" :key="index">
                        <p>Choice {{choice.choice}} : &nbsp;&nbsp;<b>{{ masters.filter(master => master.id == choice.master_id)[0].title }}</b></p>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="ml-4">Personal Information</legend>
                    <div class="p-field ml-3">
                        <div class="col-12">
                            <p>National ID card or passport : &nbsp;&nbsp;<b>{{candidacy.identity}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-3">Firstname : &nbsp;&nbsp;<b>{{candidacy.firstName}}</b></p>
                            <p class="col-3">Lastname : &nbsp;&nbsp;<b>{{candidacy.lastName}}</b></p>
                            <p class="col-3">Maiden Name : &nbsp;&nbsp;<b>{{candidacy.maidenName}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-6">Date Of Birth : &nbsp;&nbsp;<b>{{candidacy.dateOfBirth}}</b></p>
                            <p class="col-6">Place Of Birth : &nbsp;&nbsp;<b>{{candidacy.placeOfBirth}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-6">Nationality : &nbsp;&nbsp;<b>{{candidacy.nationality}}</b></p>
                            <p class="col-6">Gender : &nbsp;&nbsp;<b>{{candidacy.gender}}</b></p>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="ml-4">Student Location</legend>
                    <div class="p-field ml-3">
                        <div class="col-12">
                            <p>Address : &nbsp;&nbsp;<b>{{candidacy.address}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-3">Country : &nbsp;&nbsp;<b>{{candidacy.country}}</b></p>
                            <p class="col-3">Government : &nbsp;&nbsp;<b>{{candidacy.government}}</b></p>
                            <p class="col-3">City : &nbsp;&nbsp;<b>{{candidacy.city}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-3">Postal Code : &nbsp;&nbsp;<b>{{candidacy.postalCode}}</b></p>
                            <p class="col-3">E-mail : &nbsp;&nbsp;<b>{{candidacy.email}}</b></p>
                            <p class="col-3">Phone : &nbsp;&nbsp;<b>{{candidacy.phone}}</b></p>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="ml-4">Studies</legend>
                    <div class="p-field ml-3">
                        <div class="flex">
                            <p class="col-6">Baccalaureate Year : &nbsp;&nbsp;<b>{{studies.baccalaureateYear}}</b></p>
                            <p class="col-6">Baccalaureate Average : &nbsp;&nbsp;<b>{{studies.baccalaureateAverage}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-6">Establishment : &nbsp;&nbsp;<b>{{ establishments.filter(establishment => establishment.id == studies.establishment_id)[0]?.name }}</b></p>
                            <p class="col-6">Speciality : &nbsp;&nbsp;<b>{{ specialities.filter(speciality => speciality.id == studies.speciality_id)[0]?.name }}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-6">Diploma : &nbsp;&nbsp;<b>{{ diplomas.filter(diploma => diploma.id == studies.diploma_id)[0]?.name }}</b></p>
                            <p class="col-6">Year Of Graduation : &nbsp;&nbsp;<b>{{studies.yearOfGraduation}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-6">Professional Situation : &nbsp;&nbsp;<b>{{studies.professionalSituation}}</b></p>
                            <p class="col-6">Number Of Internships : &nbsp;&nbsp;<b>{{studies.numberOfInternships}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-6">Number Of Registration With Drawals : &nbsp;&nbsp;<b>{{studies.nbOfRegistrationWithdrawals}}</b></p>
                            <p class="col-6">Number Of Repetitions From Baccalaureate : &nbsp;&nbsp;<b>{{studies.nbOfRepetitionsFromBaccalaureate}}</b></p>
                        </div>
                        <div class="flex">
                            <p class="col-6">Preparatory ? &nbsp;&nbsp;<b>{{studies.preparatory}}</b></p>
                            <p class="col-6">Number Of Repetitions In Preparatory : &nbsp;&nbsp;<b>{{studies.nbOfRepetitionsInPreparatory}}</b></p>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="ml-4">Higher Studies</legend>
                    <DataTable :value="higherStudies" responsiveLayout="scroll">
                        <Column field="schoolYear" header="School Year">
                            <template #body="slotProps">
				                {{slotProps.data.schoolYear}}
			                </template>
                        </Column>
                        <Column field="level" header="Level">
                            <template #body="slotProps">
				                {{slotProps.data.level}}
			                </template>
                        </Column>
                        <Column field="establishment" header="Establishment">
                            <template #body="slotProps">
                                {{ establishments.filter(establishment => establishment.id == slotProps.data.establishment_id)[0]?.name }}
			                </template>
                        </Column>
                        <Column field="continuingStudies" header="Continuing Studies">
                            <template #body="slotProps">
				                {{slotProps.data.continuingStudies}}
			                </template>
                        </Column>
                        <Column field="mean" header="Mean">
                            <template #body="slotProps">
				                {{slotProps.data.mean}}
			                </template>
                        </Column>
                        <Column field="redouble" header="Redouble">
                            <template #body="slotProps">
				                {{slotProps.data.redouble}}
			                </template>
                        </Column>
                        <Column field="credit" header="Credit" v-if="diplomas.filter(diploma => diploma.id == studies.diploma_id).credit">
                            <template #body="slotProps">
				                {{slotProps.data.credit}}
			                </template>
                        </Column>
                        <Column field="mention" header="Mention">
                            <template #body="slotProps">
				                {{slotProps.data.mention}}
			                </template>
                        </Column>
                        <Column field="session" header="Session">
                            <template #body="slotProps">
				                {{slotProps.data.session}}
			                </template>
                        </Column>
                    </DataTable>
                </fieldset>
                <fieldset>
                    <legend class="ml-4">SFE note</legend>
                    <p><span class="sfeNote">Semester 1 :</span> &nbsp;&nbsp;<b>{{candidacy.sfe}}</b></p>
                </fieldset>
            </template>
            <template v-slot:footer>
                <div class="grid justify-content-between">
                <button class="p-button p-component p-button-secondary" type="button" @click="prevPage">
                    <span class="pi pi-angle-left p-button-icon p-button-icon-left"></span>
                    <span class="p-button-label">Back</span>
                    <span class="p-ink"></span>
                </button>
                <button class="p-button p-button-success p-component" type="button" @click="saveCandidacy">
                    <span class="pi pi pi-check p-button-icon p-button-icon-right"></span>
                    <span class="p-button-label">Confirm</span>
                    <span class="p-ink"></span>
                </button>
            </div>
            </template>
        </card>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    props: ["masters", "diplomas", "establishments", "specialities"],
    data() {
        return {
            step: 6,
            masterTitle: null,
            choices: this.$store.state.choices,
            candidacy: this.$store.state.candidacy,
            studies: this.$store.state.studies,
            higherStudies: this.$store.state.higherStudies,
            candidacyToSubmit: {}
        }
    },
    mounted() {
        this.specialities.map(speciality => {if(speciality.id === '') speciality.name = this.studies.otherSpeciality})
    },
    methods: {
        filterMaster(id)
        {
            let master = this.masters.filter(master => master.id = id)
            this.masterTitle = master.title
        },
        saveCandidacy(){
            this.candidacyToSubmit= {
                "candidacy": this.candidacy,
                "study": this.studies,
                "higherStudies": this.higherStudies,
                "choices": this.choices
            }
            console.log(this.candidacyToSubmit)
            axios.post('/api/candidacies', this.candidacyToSubmit)
				.then(res => {
                    this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
                    this.$store.commit('setMasterCredentials', 1)
                    this.$store.commit('clearChoices')
                    this.$store.commit('clearCandidacyData')
                    this.$store.commit('clearStudies')
                    this.$store.commit('clearHigherStudies')
                    this.$router.push('/studies/master/candidacy')
                })
				.catch(err => {console.log(err)
                    this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000})})
        },
        prevPage() {
            window.mitt.emit('step', this.step - 1)
        },
    }
}
</script>

<style lang="scss">
    .title{
        color: #436792;
    }
    .step6 .p-steps{
        ul{
            li:nth-child(6){
                span{
                    color: #f36f21 !important;
                    font-weight: bold;
                }
                 .p-steps-number{
                    background: rgba(243, 111, 33, 0.2) !important;
                    z-index: 10;
                }
                &:before{
                    border-top: 1px solid #f36f21;
                }
            }
        }
    }
    fieldset{
        border: 1px solid #f36f21;
        border-radius: 10px;
        margin-bottom: 1rem;
        padding: 1rem;
        legend{
            color: #436792;
            font-weight: bold;
            padding: 10px;
        }
    }
    .sfeNote{
        font-weight: bold;
    }
</style>
