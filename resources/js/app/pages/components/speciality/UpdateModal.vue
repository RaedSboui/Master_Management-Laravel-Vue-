<template>
	<Dialog v-model:visible="editSpecialityDialog" :style="{width: '450px'}" header="Speciality details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="name">Name</label>
			<InputText id="name" v-model="speciality.name"/>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="editSpecialityDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="updateSpeciality" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            speciality: {},
            editSpecialityDialog: false,
			selectedCredits: [1],
			selectedSFE: [1]
        }
    },
    mounted() {
        window.mitt.on("editSpecialityDialog", data => {
			this.editSpecialityDialog = data.editSpecialityDialog
			this.speciality = data.speciality
		})
    },
    methods: {
    	updateSpeciality() 
		{
            axios.put(`/api/specialities/${this.speciality.id}`, this.speciality)
				.then(res => this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000}))
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.editSpecialityDialog = false
			this.speciality = {}
		},
    }
}
</script>