<template>
	<Toolbar class="mb-4 flex justify-content-between">
		<template v-slot:start>
			<div class="my-2">
				<Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
				<Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" :disabled="!selectedSubjects || !selectedSubjects.length" />
			</div>
		</template>
		<template v-slot:end>
            <FileUpload name="import" mode="basic" :customUpload="true" @uploader="importSubjects" accept=".xlsx" :maxFileSize="1000000" chooseLabel="Import" class="mr-2 inline-block" />
			<Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportSubjects" />
		</template>
	</Toolbar>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			subjectsList: null,
            selectedSubjects: null,
            ids: [],
			URL: '',
            token: this.$store.state.token,
        }
    },
    mounted() 
    { 
        window.mitt.on("selectedSubjects", data => this.selectedSubjects = data);
		window.mitt.on("subjects", data => this.subjectsList = data)
    },
    methods: {
        openNew() 
		{
			window.mitt.emit('subjectDialog', true)
		},
		confirmDeleteSelected()
		{
            this.ids = []
            this.selectedSubjects.map(subject => this.ids.push(subject.id))
			window.mitt.emit('deleteSubjectsDialog', {deleteSubjectsDialog:true, ids: this.ids})
		},
        importSubjects(e)
        {
            let fd = new FormData()
            fd.append('import', e.files[0])
            axios.post('/api/subjects/import', fd)
				.then(res => {
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
					this.$router.go('/subjects')
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
        },
        exportSubjects() 
		{
            this.ids = []			
			if(this.selectedSubjects) {
				this.selectedSubjects.map(subject => this.ids.push(subject.id))
			}else {
				this.subjectsList.map(subject => this.ids.push(subject.id))
			}
			window.location.href = '/api/subjects/export/' + this.ids + '?token=' + this.token
		},
    }
}
</script>