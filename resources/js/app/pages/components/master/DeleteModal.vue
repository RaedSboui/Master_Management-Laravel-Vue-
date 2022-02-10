<template>
    <Dialog v-model:visible="deleteMasterDialog" :style="{width: '450px'}" header="Confirmation" :modal="true">
		<div class="flex align-items-center justify-content-center">
			<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
			<span v-if="master">Are you sure you want to delete the master <b>{{master.title}}</b> ?</span>
		</div>
		<template #footer>
			<Button label="NO" icon="pi pi-times" class="p-button-text" @click="deleteMasterDialog = false"/>
			<Button label="YES" icon="pi pi-check" class="p-button-text" @click="deleteMaster(master.id)" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            master: {},
            deleteMasterDialog: false,
        }
    },
    mounted() {
        window.mitt.on("deleteMasterDialog", data => {
			this.deleteMasterDialog = data.deleteMasterDialog
			this.master = data.master
		})
    },
    methods: {
		deleteMaster(id) 
		{
			axios.delete('/api/masters/' + id)
				.then(res => {
					window.mitt.emit("deletedMaster", id)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.deleteMasterDialog = false
			this.master = {}
		},
    }
}
</script>