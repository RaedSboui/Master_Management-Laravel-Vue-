<template>
	<Dialog v-model:visible="deleteMastersDialog" :style="{width: '450px'}" header="Confirm" :modal="true">
		<div class="flex align-items-center justify-content-center">
			<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
			<span v-if="ids">Are you sure you want to delete the <b>{{ this.ids.length }}</b> selected masters?</span>
		</div>
	    <template #footer>
			<Button label="NO" icon="pi pi-times" class="p-button-text" @click="deleteMastersDialog = false"/>
			<Button label="YES" icon="pi pi-check" class="p-button-text" @click="deleteSelectedMasters" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            deleteMastersDialog: false,
            ids: []
        }
    },
    mounted() {
        window.mitt.on("deleteMastersDialog", data => {
            this.deleteMastersDialog = data.deleteMastersDialog
            this.ids = data.ids
        })
    },
    methods: {
		deleteSelectedMasters()
		{   
			axios.delete('/api/masters/deleteMultiple/'+ this.ids)
				.then(res => {
					window.mitt.emit("deletedMultipleMasters", this.ids)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.deleteMastersDialog = false;
		},
    }
}
</script>