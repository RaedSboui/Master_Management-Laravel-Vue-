<template>
	<Toolbar class="mb-4 flex justify-content-between">
		<template v-slot:start>
			<div class="my-2">
				<Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="openNew" />
				<Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" :disabled="!selectedUsers || !selectedUsers.length" />
			</div>
		</template>
		<template v-slot:end>
            <FileUpload name="import" mode="basic" :customUpload="true" @uploader="importUsers" accept=".xlsx" :maxFileSize="1000000" chooseLabel="Import" class="mr-2 inline-block" />
			<Button label="Export" icon="pi pi-upload" class="p-button-help" @click="exportUsers" />
		</template>
	</Toolbar>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			usersList: null,
            selectedUsers: null,
            ids: [],
			URL: '',
            token: this.$store.state.token,
        }
    },
    mounted() 
    { 
        window.mitt.on("selectedUsers", data => this.selectedUsers = data);
		window.mitt.on("users", data => this.usersList = data)
    },
    methods: {
        openNew() 
		{
			window.mitt.emit('userDialog', true)
		},
		confirmDeleteSelected()
		{
            this.ids = []
            this.selectedUsers.map(user => this.ids.push(user.id))
			window.mitt.emit('deleteUsersDialog', {deleteUsersDialog:true, ids: this.ids})
		},
        importUsers(e)
        {
            let fd = new FormData()
            fd.append('import', e.files[0])
            axios.post('/api/users/import', fd)
				.then(res => {
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
					this.$router.go('/admins')
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
        },
        exportUsers() 
		{
            this.ids = []			
			if(this.selectedUsers) {
				this.selectedUsers.map(user => this.ids.push(user.id))
			}else {
				this.usersList.map(user => this.ids.push(user.id))
			}
			window.location.href = '/api/users/export/' + this.ids + '?token=' + this.token
		},
    }
}
</script>