<template>
	<Toolbar class="mb-4 flex justify-content-between">
		<template v-slot:start>
			<div class="my-2">
				<Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
				<Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" :disabled="!selectedSpecialities || !selectedSpecialities.length" />
			</div>
		</template>
		<template v-slot:end>
            <FileUpload name="import" mode="basic" :customUpload="true" @uploader="importSpecialities" accept=".xlsx" :maxFileSize="1000000" chooseLabel="Import" class="mr-2 inline-block" />
			<Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportSpecialities" />
		</template>
	</Toolbar>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			specialitiesList: null,
            selectedSpecialities: null,
            ids: [],
			URL: '',
            token: this.$store.state.token,
        }
    },
    mounted() 
    { 
        window.mitt.on("selectedSpecialities", data => this.selectedSpecialities = data);
		window.mitt.on("specialities", data => this.specialitiesList = data)
    },
    methods: {
        openNew() 
		{
			window.mitt.emit('specialityDialog', true)
		},
		confirmDeleteSelected()
		{
            this.ids = []
            this.selectedSpecialities.map(speciality => this.ids.push(speciality.id))
			window.mitt.emit('deleteSpecialitiesDialog', {deleteSpecialitiesDialog:true, ids: this.ids})
		},
        importSpecialities(e)
        {
            let fd = new FormData()
            fd.append('import', e.files[0])
            axios.post('/api/specialities/import', fd)
				.then(res => {
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
					this.$router.go('/specialities')
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
        },
        exportSpecialities() 
		{
            this.ids = []			
			if(this.selectedSpecialities) {
				this.selectedSpecialities.map(speciality => this.ids.push(speciality.id))
			}else {
				this.specialitiesList.map(speciality => this.ids.push(speciality.id))
			}
			window.location.href = '/api/specialities/export/' + this.ids + '?token=' + this.token
		},
    }
}
</script>