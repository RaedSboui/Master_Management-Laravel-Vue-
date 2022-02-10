<template>
    <div class="p-card-body">
        <div class="p-card-title title">Personal Information</div>
        <div class="p-card-subtitle"> Enter your personal information </div>
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
                    <Dropdown id="gender" v-model="candidacy.gender" :options="gender"/>
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
        <div class="p-card-footer">
            <div class="grid justify-content-between">
                <button class="p-button  p-button-secondary p-component" type="button" @click="prevPage">
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
import DropdownCountries from '../Studie/MasterCandidacy/DropdownCountries'

export default {
    data() {
        return {
            candidacy: this.$store.state.candidacy || {},
            gender: ["Man", "Women"],
            step: 2
        }
    },
    components: {
        DropdownCountries,
    },
    methods: {
        nextPage() {
            this.candidacy.nationality = this.candidacy.nationality?.name
            this.candidacy.dateOfBirth = this.candidacy.dateOfBirth?.toLocaleDateString()
            window.mitt.emit('step', this.step + 1)
            //window.mitt.emit('candidacy', this.candidacy)
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
    .step2 .p-steps{
        ul{
            li:nth-child(2){
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