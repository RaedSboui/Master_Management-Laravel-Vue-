<template>
    <div class="p-card-body" v-if="step == 4">
                <div class="p-card-title title">Studies</div>
                <div class="p-card-subtitle"></div>
                <div class="p-card-content">
                    <div class="p-fluid">
                        <div class="field flex justify-content-around">
                            <div class="col-5">
                                <div>
                                    <label for="baccalaureateYear">Baccalaureate Year</label>
                                    <Dropdown id="baccalaureateYear" v-model="studies.baccalaureateYear" :options="year"/>
                                </div>
                                <div class="mt-5">
                                    <label for="baccalaureateAverage">Average</label>
                                    <InputNumber id="baccalaureateAverage" v-model="studies.baccalaureateAverage" mode="decimal" :minFractionDigits="0" :maxFractionDigits="2" />
                                </div>
                                <div class="mt-5">
                                    <label for="nbOfRepetitionsFromBaccalaureate">Number Of Repetitions From Baccalaureate</label>
                                    <InputNumber  id="nbOfRepetitionsFromBaccalaureate" v-model="studies.nbOfRepetitionsFromBaccalaureate" />
                                </div>
                                 <div class="mt-5">
                                    <label for="preparatory">Preparatory <b>?</b></label>
                                   <ToggleButton class="p-inputtext p-component" id="preparatory" v-model="studies.preparatory" onIcon="pi pi-check" offIcon="pi pi-times" />
                                </div>
                                <div class="mt-5" v-if="studies.preparatory">
                                    <label for="nbOfRepetitionsInPreparatory">Number Of Repetitions In Preparatory</label>
                                    <InputNumber  id="nbOfRepetitionsInPreparatory" v-model="studies.nbOfRepetitionsInPreparatory" />
                                </div>
                                <div class="mt-5">
                                    <label for="nbOfRegistrationWithdrawals">Number Of Registration With Drawals</label>
                                    <InputNumber  id="nbOfRegistrationWithdrawals" v-model="studies.nbOfRegistrationWithdrawals" />
                                </div>
                            </div>
                            <div class="col-5">
                                <div>
                                    <label for="professionalSituation">Professional Situation</label>
                                    <InputText class="p-inputtext p-component"  id="professionalSituation" v-model="studies.professionalSituation" />
                                </div>
                                <div class="mt-5">
                                    <label for="yearOfGraduation">Year Of Graduation</label>
                                    <Dropdown id="yearOfGraduation" v-model="studies.yearOfGraduation" :options="year"/>
                                </div>
                                <div class="mt-5">
                                    <label for="speciality_id">Speciality</label>
                                    <Dropdown id="speciality_id" v-model="studies.speciality_id" :options="specialities" optionLabel="name" optionValue="id" />
                                </div>
                                <div class="mt-5" v-if="studies.speciality_id == ''">
                                    <label for="otherSpeciality">Speciality Name</label>
                                    <InputText  id="otherSpeciality" v-model="studies.otherSpeciality" />
                                </div>
                                <div class="mt-5">
                                    <label for="diploma_id">Diploma</label>
                                    <Dropdown id="diploma_id" v-model="studies.diploma_id" :options="diplomas" optionLabel="name" optionValue="id" />
                                </div>
                                <div class="mt-5">
                                    <label for="establishment_id">Establishment</label>
                                    <Dropdown id="establishment_id" v-model="studies.establishment_id" :options="establishments" optionLabel="name" optionValue="id" />
                                </div>
                                <div class="mt-5" v-if="studies.establishment_id == ''">
                                    <label for="otherEstablishment">Establishment Name</label>
                                    <InputText  id="otherEstablishment" v-model="studies.otherEstablishment" />
                                </div>
                                <div class="mt-5">
                                    <label for="numberOfInternships">Number Of Internships</label>
                                    <InputNumber  id="numberOfInternships" v-model="studies.numberOfInternships" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-card-footer">
                    <div class="grid justify-content-between">
                        <button class="p-button p-button-secondary p-component" type="button" @click="prevPage">
                            <span class="pi pi-angle-left p-button-icon p-button-icon-left"></span>
                            <span class="p-button-label">Back</span>
                            <span class="p-ink"></span>
                        </button>
                        <button class="p-button p-button-info p-component" type="button" @click="nextPage">
                            <span class="pi pi-angle-right p-button-icon p-button-icon-right"></span>
                            <span class="p-button-label">Next</span>
                            <span class="p-ink"></span>
                        </button>
                    </div>
                </div>
            </div>
</template>

<script>
export default {
    props: ["diplomas", "establishments", "specialities"],
    data() {
        return {
            studies: this.$store.state.studies || {},
            year: [],
            step: 4
        }
    },
    mounted() {
        this.createYear()
    },
    methods: {
        createYear() {
            let year = []
            for (var i = 1979; i <= new Date().getFullYear(); i++) {
                year.push(i)
            }
            this.year = year.reverse()
        },
        nextPage() {
            window.mitt.emit('step', this.step + 1)
            //window.mitt.emit('studies', this.studies)
            this.$store.commit('setStudies', this.studies)
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
    .step4 .p-steps{
        ul{
            li:nth-child(4){
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
</style>