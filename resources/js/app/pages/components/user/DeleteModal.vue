<template>
    <Dialog v-model:visible="deleteUserDialog" :style="{width: '450px'}" header="Confirmation" :modal="true">
		<div class="flex align-items-center justify-content-center">
			<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
			<span v-if="user">Are you sure you want to delete the admin <b>{{user.firstName + ' ' + user.lastName}}</b> ?</span>
		</div>
		<template #footer>
			<Button label="NO" icon="pi pi-times" class="p-button-text" @click="deleteUserDialog = false"/>
			<Button label="YES" icon="pi pi-check" class="p-button-text" @click="deleteUser(user.id)" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            user: {},
            deleteUserDialog: false,
        }
    },
    mounted() {
        window.mitt.on("deleteUserDialog", data => {
			this.deleteUserDialog = data.deleteUserDialog
			this.user = data.user
		})
    },
    methods: {
		deleteUser(id) 
		{
			axios.delete('/api/users/' + id)
				.then(res => {
					window.mitt.emit("deleteUser", id)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.deleteUserDialog = false
			this.user = {}
		},
    }
}
</script>