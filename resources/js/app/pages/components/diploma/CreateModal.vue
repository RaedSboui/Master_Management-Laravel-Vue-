<template>
	<Dialog v-model:visible="diplomaDialog" :style="{width: '450px'}" header="Diploma details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="name">Title</label>
			<InputText id="name" v-model="diploma.name" autofocus :class="{'p-invalid': submitted && !diploma.name}" />
			<small class="p-error" v-if="submitted && !diploma.name">Please enter the diploma title.</small>
		</div>
		<div class="field">
			<label for="years">Number of years</label>
			<InputText id="years" v-model="diploma.years" :class="{'p-invalid': submitted && !diploma.years}" />
			<small class="p-error" v-if="submitted && !diploma.years">Please enter the number of years of the degree.</small>
		</div>
		<div class="field">
			<label for="years_min">Minimum number of years</label>
			<InputText id="years_min" v-model="diploma.years_min" :class="{'p-invalid': submitted && !diploma.years_min}" />
			<small class="p-error" v-if="submitted && !diploma.years_min">Please enter the minimum number of years of the degree.</small>
		</div>
        <div class="p-d-flex p-flex-column p-flex-md-row">
            <div class="field-checkbox">
                <Checkbox id="credits" name="credits" v-model="diploma.credits" :binary="true"/>
                <label for="credits">Credits</label>
            </div>
            <div class="field-checkbox">
                <Checkbox id="sfe" name="sfe" v-model="diploma.sfe" :binary="true"/>
                <label for="sfe">SFE</label>
            </div>
        </div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="diplomaDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveDiploma" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            diploma: {},
            submitted: false,
            diplomaDialog: false,
        }
    },
    mounted() 
    { 
        window.mitt.on("diplomaDialog", data => {
            this.diplomaDialog = data;
        });
    },
    methods:{
		saveDiploma() 
		{
			this.submitted = true
			this.diploma.credits = this.diploma.credits?.shift()
			this.diploma.sfe = this.diploma.sfe?.shift()
            axios.post('/api/diplomas', this.diploma)
				.then(res => {
					window.mitt.emit("createdDiploma", res.data.diploma)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.diplomaDialog = false
			this.diploma = {}
		},
    }
}
</script>
