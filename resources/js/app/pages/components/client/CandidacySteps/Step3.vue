<template>
    <div class="p-card-body">
        <div class="p-card-title title">Location</div>
        <div class="p-card-subtitle"></div>
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
import DropdownCountries from '../Studie/MasterCandidacy/DropdownCountries'

export default {
    data() {
        return {
            government: [
                'Ariana', 'Beja', 'Ben Arous', 'Bizerte', 'Gabes', 'Gafsa', 'Jendouba', 'Kairouan', 'Kasserine', 'Kebili', 'Kef', 'Manouba',
                'Mahdia', 'Medenine', 'Monastir', 'Nabel', 'Sfax', 'Sidi Bouzid', 'Silana', 'Sousse', 'Tataouine', 'Tozer', 'Tunis', 'Zaghouan'
            ],
            step: 3,
            candidacy: this.$store.state.candidacy,
        }
    },
    components: {
        DropdownCountries,
    },
    methods: {
        nextPage() {
            this.candidacy.country = this.candidacy.country?.name
            window.mitt.emit('step', this.step + 1)
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
    .step3 .p-steps{
        ul{
            li:nth-child(3){
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