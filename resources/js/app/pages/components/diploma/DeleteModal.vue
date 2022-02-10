<template>
    <Dialog v-model:visible="deleteDiplomaDialog" :style="{width: '450px'}" header="Confirmation" :modal="true">
		<div class="flex align-items-center justify-content-center">
			<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
			<span v-if="diploma">Are you sure you want to delete the diploma <b>{{diploma.name}}</b> ?</span>
		</div>
		<template #footer>
			<Button label="NO" icon="pi pi-times" class="p-button-text" @click="deleteDiplomaDialog = false"/>
			<Button label="YES" icon="pi pi-check" class="p-button-text" @click="deleteDiploma(diploma.id)" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            diploma: {},
            deleteDiplomaDialog: false,
        }
    },
    mounted() {
        window.mitt.on("deleteDiplomaDialog", data => {
			this.deleteDiplomaDialog = data.deleteDiplomaDialog
			this.diploma = data.diploma
		})
    },
    methods: {
		deleteDiploma(id) 
		{
			axios.delete('/api/diplomas/' + id)
				.then(res => {
					window.mitt.emit("deletedDiploma", id)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.deleteDiplomaDialog = false
			this.diploma = {}
		},
    }
}
</script>