<template>
	<Dialog v-model:visible="specialityDialog" :style="{width: '450px'}" header="Speciality details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="name">Name</label>
			<InputText id="name" v-model="speciality.name" autofocus :class="{'p-invalid': submitted && !speciality.name}" />
			<small class="p-error" v-if="submitted && !speciality.name">Please enter the speciality title.</small>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="specialityDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveSpeciality" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
			submitted: false,
            speciality: {},
            specialityDialog: false,
        }
    },
    mounted() 
    { 
        window.mitt.on("specialityDialog", data => {
            this.specialityDialog = data;
        });
    },
    methods:{
		saveSpeciality() 
		{
			this.submitted = true
            axios.post('/api/specialities', this.speciality)
				.then(res => {
					window.mitt.emit("createdSpeciality", res.data.speciality)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.specialityDialog = false
			this.speciality = {}
		},
    }
}
</script>
