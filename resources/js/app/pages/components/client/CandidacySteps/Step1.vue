<template>
    <div class="p-card-body">
        <div class="p-card-title title">Choices</div>
        <div class="p-card-subtitle">Select your choices</div>
        <div class="p-card-content">
            <div class="p-fluid">
                <div class="field" v-for="(choice, index) in choices" :key="index">
                    <label for="choice">Choice {{ index + 1 }}</label>
                    <Dropdown id="choice" v-model="choice.master_id" :options="masters" optionLabel="title" optionValue="id" />
                </div>    
            </div> 
            <div class="p-card-footer">
                <div class="grid justify-content-between" >
                    <button class="p-button  p-button-secondary p-component" type="button" @click="prevPage">
                        <span class="pi pi-angle-left p-button-icon p-button-icon-left"></span>
                        <span class="p-button-label">Back</span>
                        <span class="p-ink"></span>
                    </button>
                    <button class="p-button p-button-info p-component" type="button" @click="nextPage">
                        <span class="pi pi-angle-right p-button-icon p-button-icon-right"></span>
                        <span class="p-button-label">Next</span>
                        <span class="p-ink" style="height: 90px; width: 90px; top: -27.5px; left: -33.9844px;"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["masters"],
    data() {
        return {
            choices: this.$store.state.choices || [{},{},{}],
            step: 1,
            mastersList: this.masters
        }
    },
    methods: {
        filterMaster(id){
            this.mastersList = this.mastersList.filter(master => master.id != id)
        },
        nextPage() {
            this.choices.map((ch, index) => ch.choice = index +1)
            this.choices = this.choices.filter((choice) => choice.master_id)
            window.mitt.emit('step', this.step + 1)
            this.$store.commit('setChoices', this.choices)
        },
        prevPage() {
            this.$router.push('/studies/master/candidacy')
        }  
    }
}
</script>

<style lang="scss">
    .title{
        color: #436792;
    }
    .step1 .p-steps{
        ul{
            li:nth-child(1){
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