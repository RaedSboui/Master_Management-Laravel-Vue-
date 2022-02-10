<template>
    <Dialog v-model:visible="deleteSpecialitiesDialog" :style="{width: '450px'}" header="Confirm" :modal="true">
		<div class="flex align-items-center justify-content-center">
		    <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
			<span v-if="ids">Are you sure you want to delete the <b>{{ this.ids.length }}</b> selected specialities ?</span>
		</div>
		<template #footer>
			<Button label="NO" icon="pi pi-times" class="p-button-text" @click="deleteSpecialitiesDialog = false"/>
			<Button label="YES" icon="pi pi-check" class="p-button-text" @click="deleteSelectedSpecialities" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            deleteSpecialitiesDialog: false,
            ids: []
        }
    },
    mounted() {
        window.mitt.on("deleteSpecialitiesDialog", data => {
            this.deleteSpecialitiesDialog = data.deleteSpecialitiesDialog
            this.ids = data.ids
        })
    },
    methods: {
		deleteSelectedSpecialities()
		{   
			axios.delete('/api/specialities/deleteMultiple/'+ this.ids)
				.then(res => {
					window.mitt.emit("deletedMultipleSpecialities", this.ids)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.deleteSpecialitiesDialog = false;
		}
    }
}
</script>