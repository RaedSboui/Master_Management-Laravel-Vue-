<template>
	<Dialog v-model:visible="editDiplomaDialog" :style="{width: '450px'}" header="Diploma details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="name">Title</label>
			<InputText id="name" v-model="diploma.name"/>
		</div>
		<div class="field">
			<label for="years">Number of years</label>
			<InputText id="years" v-model="diploma.years"/>
		</div>
		<div class="field">
			<label for="years_min">Minimum number of years</label>
			<InputText id="years_min" v-model="diploma.years_min"/>
		</div>
        <div class="p-d-flex p-flex-column p-flex-md-row">
            <div class="field-checkbox">
                <Checkbox id="credits" :value="diploma.credits" v-model="selectedCredits"/>
                <label for="credits">Credits</label>
            </div>
            <div class="field-checkbox">
                <Checkbox id="sfe" :value="diploma.sfe" v-model="selectedSFE"/>
                <label for="sfe">SFE</label>
            </div>
        </div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="editDiplomaDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="updateDiploma" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            diploma: {},
            editDiplomaDialog: false,
			selectedCredits: [1],
			selectedSFE: [1]
        }
    },
    mounted() {
        window.mitt.on("editDiplomaDialog", data => {
			this.editDiplomaDialog = data.editDiplomaDialog
			this.diploma = data.diploma
		})
    },
    methods: {
    	updateDiploma() 
		{
			this.diploma.credits = this.selectedCredits[0] ? true : false
			this.diploma.sfe = this.selectedSFE[0] ? true : false
            axios.put(`/api/diplomas/${this.diploma.id}`, this.diploma)
				.then(res => this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000}))
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.editDiplomaDialog = false
			this.diploma = {}
		},
    }
}
</script>