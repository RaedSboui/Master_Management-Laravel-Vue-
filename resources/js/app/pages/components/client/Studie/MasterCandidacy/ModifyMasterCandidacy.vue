<template>
<div class="p-card p-component form">
    <div class="p-card-body">
        <div class="p-card-title title">Choices</div>
        <div class="p-card-content">
            <div class="p-fluid">
                <div class="field" v-for="(choice) in choices" :key="choice.choice">
                    <label for="choice">Choice {{ choice.choice }}</label>
                    <Dropdown id="choice" v-model="choice.master_id" :options="masters" optionLabel="title" optionValue="id" />
                </div>    
            </div>
        </div>
        <div class="p-card-title title">Personal Information</div>
        <div class="p-card-content">
            <div class="p-fluid">
                <div class="field">
                    <label for="identity">National ID card or passport</label>
                    <input class="p-inputtext p-component" id="identity" v-model="candidacy.identity">
                </div>
                <div class="field">
                    <label for="firstName">Firstname</label>
                    <input class="p-inputtext p-component" id="firstName" v-model="candidacy.firstName">
                </div>
                <div class="field">
                    <label for="lastName">Lastname</label>
                    <input class="p-inputtext p-component" id="lastName" v-model="candidacy.lastName">
                </div>
                <div class="field">
                    <label for="maidenName">Maiden Name</label>
                    <input class="p-inputtext p-component" id="maidenName" v-model="candidacy.maidenName">
                </div>
                <div class="field">
                    <label for="gender">Gender</label>
                    <Dropdown id="gender" v-model="candidacy.gender" :options="gender" optionLabel="name" optionValue="name"/>
                </div>
                <div class="field">
                    <label for="dateOfBirth">Date Of Birth</label>
                    <Calendar v-model="candidacy.dateOfBirth" dateFormat="mm/dd/yy" :showIcon="true" />
                </div>
                <div class="field">
                    <label for="placeOfBirth">Place Of Birth</label>
                    <input class="p-inputtext p-component" id="placeOfBirth" v-model="candidacy.placeOfBirth">
                </div>
                <div class="field">
                    <label for="nationality">Nationality</label>
                    <dropdown-countries v-model="candidacy.nationality"/>
                </div>
            </div>
        </div>
        <div class="p-card-title title">Location</div>
        <div class="p-card-content">
            <div class="p-fluid">
                <div class="field">
                    <label for="address">Address</label>
                    <input class="p-inputtext p-component" id="address" v-model="candidacy.address">
                </div>
                <div class="field flex justify-content-between flex-wrap">
                    <div class="col-3">
                        <label for="country">Country</label>
                        <dropdown-countries id="country" v-model="candidacy.country"/>
                    </div>
                    <div class="col-3">
                        <label for="government">Government</label>
                        <Dropdown v-if="candidacy.country?.name == 'Tunisia'" id="government" v-model="candidacy.government" :options="government"/>
                        <input v-else class="p-inputtext p-component" id="government" v-model="candidacy.government">
                    </div>
                    <div class="col-3">
                        <label for="city">City</label>
                        <input class="p-inputtext p-component" id="city" v-model="candidacy.city" />
                    </div>
                    <div class="col-2">
                        <label for="postalCode">Postal Code</label>
                        <InputText  id="postalCode" v-model="candidacy.postalCode" />
                    </div>
                </div>
                <div class="field flex justify-content-around flex-lg-wrap">
                    <div class="col-8">
                        <label for="email">E-mail</label>
                        <InputText class="p-inputtext p-component" id="email" v-model="candidacy.email"/>
                        <small class="p-error" v-if="candidacy.phone && !candidacy.email" >Please enter an email address.</small>
                        <small class="p-error" v-else-if="(candidacy.phone && candidacy.email) && ((/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i).test(candidacy.email) === false)">The field entered does not correspond to an email address.</small>
                    </div>
                    <div class="col-4">
                        <label for="phone">Phone</label>
                        <InputText id="phone" v-model="candidacy.phone" />
                    </div>
                </div>
            </div>
        </div>
        <div class="p-card-title title">Studies</div>
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
                                <ToggleButton class="p-inputtext p-component" id="preparatory" v-model="studies.preparatory" onLabel="I confirm" offLabel="I reject" onIcon="pi pi-check" offIcon="pi pi-times"/>
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
                            <div class="mt-5">
                                <label for="numberOfInternships">Number Of Internships</label>
                                <InputNumber  id="numberOfInternships" v-model="studies.numberOfInternships" />
                            </div>
                            <div class="mt-5" v-if="studies.establishment_id == ''">
                                <label for="otherEstablishment">Establishment Name</label>
                                <InputText  id="otherEstablishment" v-model="studies.otherEstablishment" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="p-card-title title">Higher Studies</div>
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
                        <div class="col-1" v-if="diplomas.filter(diploma => diploma.id == studies.diploma_id)[0].credits">
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
            <div v-if="diplomas.filter(diploma => diploma.id == studies.diploma_id)[0].sfe">
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
            <div class="grid justify-content-between" >
                <button class="p-button  p-button-secondary p-component" type="button" @click="prevPage">
                    <span class="pi pi-angle-left p-button-icon p-button-icon-left"></span>
                    <span class="p-button-label">Back</span>
                    <span class="p-ink"></span>
                </button>
                <button class="p-button p-button-success p-component" type="button" @click="saveChange">
                    <span class="pi pi pi-check p-button-icon p-button-icon-right"></span>
                    <span class="p-button-label">Save Changes</span>
                    <span class="p-ink" style="height: 90px; width: 90px; top: -27.5px; left: -33.9844px;"></span>
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import DropdownCountries from '../../../client/Studie/MasterCandidacy/DropdownCountries.vue'

export default {
    props: ['candidacy', 'choices', 'studies', 'higherStudies', 'masters', 'diplomas', 'establishments', 'specialities',],
    data () {
        return {
            gender: [{name:"Man"}, {name:"Women"}],
            government: [
                'Ariana', 'Beja', 'Ben Arous', 'Bizerte', 'Gabes', 'Gafsa', 'Jendouba', 'Kairouan', 'Kasserine', 'Kebili', 'Kef', 'Manouba',
                'Mahdia', 'Medenine', 'Monastir', 'Nabel', 'Sfax', 'Sidi Bouzid', 'Silana', 'Sousse', 'Tataouine', 'Tozer', 'Tunis', 'Zaghouan'
            ],
            year: [],
            session: ["First", "Second"],
            redouble: [0, 1, 2, 3, 4],
            mention: ['Passable', 'Enough grade', 'Good', 'Very good'],
            schoolYear: [],
        }
    },
    components: {
        DropdownCountries,
    },
    mounted() {
        this.createYear()
        this.createSchoolYear()
    },
    methods: {
        createYear() {
            let year = []
            for (var i = 1979; i <= new Date().getFullYear(); i++) {
                year.push(i)
            }
            this.year = year.reverse()
        },
        createSchoolYear() {
            let schoolYear = []
            for (var i = 1981; i <= new Date().getFullYear() -1; i++) {
                schoolYear.push(i + '-' + (i+ 1))
            }
            this.schoolYear = schoolYear.reverse()
        },
        prevPage() {
            this.$router.back()
        },
        saveChange(){

            if(this.candidacy.nationality.name) this.candidacy.nationality = this.candidacy.nationality.name 
            if(typeof(! this.candidacy.dateOfBirth) === 'string')  this.candidacy.dateOfBirth?.toLocaleDateString()
            if(this.candidacy.country.name) this.candidacy.country = this.candidacy.country.name

            this.candidacyUpdate= {
                "candidacy": this.candidacy,
                "study": this.studies,
                "higherStudies": this.higherStudies,
                "choices": this.choices
            }
            axios.put(`/api/candidacies/${this.candidacy.id}`, this.candidacyUpdate)
				.then(res => {
                    this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
                    this.$router.push('/studies/master/candidacy/' + this.candidacy.id)
                })
				.catch(err => {
                    this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000})
                    console.log(err.message)
                    console.log('Candidacy ',this.candidacyUpdate)
                })
        }
    }
}
</script>