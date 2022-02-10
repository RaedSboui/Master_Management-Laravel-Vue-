<template>
	<Dialog v-model:visible="editSubjectDialog" :style="{width: '450px'}" header="Détails du diplôme" :modal="true" class="p-fluid">
		<div class="field">
			<label for="name">Name</label>
			<InputText id="name" v-model="subject.name"/>
		</div>
		<div class="field">
			<label for="masters">Masters</label>
            <AutoComplete :multiple="true" v-model="subject.masters" :suggestions="filteredMasters" @complete="searchMaster" field="title" dropdown/>
		</div>
		<div class="field">
			<label for="diplomas">Diplomas</label>
            <AutoComplete :multiple="true" v-model="subject.diplomas" :suggestions="filteredDiplomas" @complete="searchDiploma" field="name" dropdown/>
		</div>
		<div class="field">
			<label for="specialities">Specialities</label>
            <AutoComplete :multiple="true" v-model="subject.specialities" :suggestions="filteredSpecialities" @complete="searchSpeciality" field="name" dropdown/>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="editSubjectDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="updateDiploma" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            subject: {
				name: '',
				masters: [],
				diplomas: [],
				specialities: []
			},
			masters: null,
			diplomas: null,
			specialities: null,
            submitted: false,
            editSubjectDialog: false,
			filteredMasters: null,
			filteredDiplomas: null,
			filteredSpecialities: null
        }
    },
    mounted() {
        window.mitt.on("editSubjectDialog", data => {
			this.editSubjectDialog = data.editSubjectDialog
			this.subject = data.subject
		})
		window.mitt.on("masters", data => this.masters = data)
		window.mitt.on("diplomas", data => this.diplomas = data)
		window.mitt.on("specialities", data => this.specialities = data)
    },
    methods: {
    	updateDiploma() 
		{
			this.submitted = true
			this.subject.masters = this.subject.masters.map(master => master.id)
			this.subject.diplomas = this.subject.diplomas.map(diploma => diploma.id)
			this.subject.specialities = this.subject.specialities.map(speciality => speciality.id)
            axios.put(`/api/subjects/${this.subject.id}`, this.subject)
				.then(res => this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000}))
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.editSubjectDialog = false
			this.submitted = false
			this.subject = {}
		},
        searchMaster(event) {
            setTimeout(() => {
                if (!event.query.trim().length) {
                    this.filteredMasters = [...this.masters];
                }
                else {
                    this.filteredMasters = this.masters?.filter(master => master.title.toLowerCase().startsWith(event.query.toLowerCase()))
                }
            }, 250);
        },
        searchDiploma(event) {
            setTimeout(() => {
                if (!event.query.trim().length) {
                    this.filteredDiplomas = [...this.diplomas];
                }
                else {
                    this.filteredDiplomas = this.diplomas?.filter(diploma => diploma.title.toLowerCase().startsWith(event.query.toLowerCase()))
                }
            }, 250);
        },
        searchSpeciality(event) {
            setTimeout(() => {
                if (!event.query.trim().length) {
                    this.filteredSpecialities = [...this.specialities];
                }
                else {
                    this.filteredSpecialities = this.specialities?.filter(speciality => speciality.title.toLowerCase().startsWith(event.query.toLowerCase()))
                }
            }, 250);
        }
    }
}
</script>