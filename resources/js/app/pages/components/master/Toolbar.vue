<template>
	<Toolbar class="mb-4 flex justify-content-between">
		<template v-slot:start>
			<div class="my-2">
				<Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
				<Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" :disabled="!selectedMasters || !selectedMasters.length" />
			</div>
		</template>
		<template v-slot:end>
            <FileUpload name="import" mode="basic" :customUpload="true" @uploader="importMasters" accept=".xlsx" :maxFileSize="1000000" chooseLabel="Import" class="mr-2 inline-block" />
			<Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportMasters" />
		</template>
	</Toolbar>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			mastersList: null,
            selectedMasters: null,
            ids: [],
			URL: '',
            token: this.$store.state.token,
        }
    },
    mounted() 
    { 
        window.mitt.on("selectedMasters", data => this.selectedMasters = data);
		 window.mitt.on("masters", data => this.mastersList = data)
    },
    methods: {
        openNew() 
		{
			window.mitt.emit('masterDialog', true)
		},
		confirmDeleteSelected()
		{
            this.ids = []
            this.selectedMasters.map(master => this.ids.push(master.id))
			window.mitt.emit('deleteMastersDialog', {deleteMastersDialog:true, ids: this.ids})
		},
        importMasters(e)
        {
            let fd = new FormData()
            fd.append('import', e.files[0])
            axios.post('/api/masters/import', fd)
				.then(res => {
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
					this.$router.go('/master')
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
        },
        exportMasters() 
		{
            this.ids = []			
			if(this.selectedMasters) {
				this.selectedMasters.map(master => this.ids.push(master.id))
			}else {
				this.mastersList.map(master => this.ids.push(master.id))
			}
			window.location.href = '/api/masters/export/' + this.ids + '?token=' + this.token
		},
    }
}
</script>