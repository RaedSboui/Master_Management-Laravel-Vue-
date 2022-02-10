<template>
    <div class="p-card-body" v-if="step == 5">
                <div class="p-card-title title">Higher Studies</div>
                <div class="p-card-subtitle"></div>
                <div class="p-card-content">
                    <div class="p-fluid">
                        <div class="field flex justify-content-between" v-for="(higherStudy, index) in higherStudies" :key="index">
                            <b></b>
                            <div class="col-1">
                                <label for="schoolYear">School Year</label>
                                <Dropdown id="schoolYear" v-model="higherStudies[index].schoolYear" :options="schoolYear"/>
                            </div>
                            <div class="col-1">
                                <label for="level">Level</label>
                                <InputNumber id="level" v-model="higherStudies[index].level" :value="index + 1" disabled/>
                            </div>
                            <div class="col-2">
                                <label for="establishment_id">Establishment</label>
                                <Dropdown id="establishment_id" v-model="higherStudies[index].establishment_id" :options="establishments" optionLabel="name" optionValue="id"/>
                            </div>
                            <div class="col-2">
                                <label for="continuingStudies">Continuing Studies</label>
                                <input class="p-inputtext p-component" id="continuingStudies" v-model="higherStudies[index].continuingStudies" />
                            </div>
                            <div class="col-1">
                                <label for="mean">Mean</label>
                                <InputNumber  id="mean" v-model="higherStudies[index].mean" />
                            </div>
                            <div class="col-1">
                                <label for="redouble">Redouble</label>
                                <Dropdown id="redouble" v-model="higherStudies[index].redouble" :options="redouble"/>
                            </div>
                            <div class="col-1" v-if="diplomas.filter(diploma => diploma.id == studies.diploma_id)[0]?.credits">
                                <label for="credit">Credit</label>
                                <input class="p-inputtext p-component" id="credit" v-model="higherStudies[index].credit">
                            </div>
                            <div class="col-1">
                                <label for="mention">Mention</label>
                                <Dropdown id="mention" v-model="higherStudies[index].mention" :options="mention"/>

                            </div>
                            <div class="col-1">
                                <label for="session">Session</label>
                                <Dropdown id="establishment_id" v-model="higherStudies[index].session" :options="session"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="diplomas.filter(diploma => diploma.id == studies.diploma_id)[0]?.sfe">
                    <div class="p-card-title title">SFE</div>
                    <div class="p-card-content">
                        <div class="p-fluid">
                            <div class="field col-6">
                                <InputNumber id="sfe" v-model="candidacy.sfe"/>
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
    props: ["establishments", "diplomas"],
    data() {
        return {
            higherStudies: this.$store.state.higherStudies || [
                {establishment_id: this.studies?.establishment_id, redouble: 0}, 
                {establishment_id: this.studies?.establishment_id, redouble: 0}, 
                {establishment_id: this.studies?.establishment_id, redouble: 0}, 
                {establishment_id: this.studies?.establishment_id, redouble: 0}
            ],
            session: ["First", "Second"],
            redouble: [0, 1, 2, 3, 4],
            mention: ['Passable', 'Enough grade', 'Good', 'Very good'],
            schoolYear: [],
            step: 5,
            studies: this.$store.state.studies,
            candidacy: this.$store.state.candidacy,
            
        }
    },
    mounted() {
        this.establishments.map(establishment => {if(establishment.id === '') establishment.name = this.studies.otherEstablishment})
        this.createSchoolYear()
    },
    methods: {
        createSchoolYear() {
            let schoolYear = []
            for (var i = 1981; i <= new Date().getFullYear() -1; i++) {
                schoolYear.push(i + '-' + (i+ 1))
            }
            this.schoolYear = schoolYear.reverse()
        },
        nextPage() {
            window.mitt.emit('step', this.step + 1)
            this.higherStudies.map((higherStudy, index) => higherStudy.level = index +1)
            this.higherStudies = this.higherStudies.filter((higherStudy) => higherStudy.mean)
            //window.mitt.emit('higherStudies', this.higherStudies)
            this.$store.commit('setHigherStudies', this.higherStudies)
            this.$store.commit('setCandidacyData', this.candidacy)
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
    .step5 .p-steps{
        ul{
            li:nth-child(5){
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