<template>
	<Toolbar class="mb-4 flex justify-content-between">
		<template v-slot:start>
			<div class="my-2">
				<Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
				<Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" :disabled="!selectedEstablishments || !selectedEstablishments.length" />
			</div>
		</template>
		<template v-slot:end>
            <FileUpload name="import" mode="basic" :customUpload="true" @uploader="importEstablishments" accept=".xlsx" :maxFileSize="1000000" chooseLabel="Import" class="mr-2 inline-block" />
			<Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportEstablishments" />
		</template>
	</Toolbar>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			establishmentsList: null,
            selectedEstablishments: null,
            ids: [],
			URL: '',
            token: this.$store.state.token,
        }
    },
    mounted() 
    { 
        window.mitt.on("selectedEstablishments", data => this.selectedEstablishments = data);
		window.mitt.on("establishments", data => this.establishmentsList = data)
    },
    methods: {
        openNew() 
		{
			window.mitt.emit('establishmentDialog', true)
		},
		confirmDeleteSelected()
		{
            this.ids = []
            this.selectedEstablishments.map(establishment => this.ids.push(establishment.id))
			window.mitt.emit('deleteEstablishmentsDialog', {deleteEstablishmentsDialog:true, ids: this.ids})
		},
        importEstablishments(e)
        {
            let fd = new FormData()
            fd.append('import', e.files[0])
            axios.post('/api/establishments/import', fd)
				.then(res => {
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
					this.$router.go('/establishments')
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
        },
        exportEstablishments() 
		{
            this.ids = []			
			if(this.selectedEstablishments) {
				this.selectedEstablishments.map(establishment => this.ids.push(establishment.id))
			}else {
				this.establishmentsList.map(establishment => this.ids.push(establishment.id))
			}
			window.location.href = '/api/establishments/export/' + this.ids + '?token=' + this.token
		},
    }
}
</script>