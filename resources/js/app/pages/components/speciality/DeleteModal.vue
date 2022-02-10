<template>
    <Dialog v-model:visible="deleteSpecialityDialog" :style="{width: '450px'}" header="Confirmation" :modal="true">
		<div class="flex align-items-center justify-content-center">
			<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
			<span v-if="speciality">Are you sure you want to delete the speciality <b>{{speciality.name}}</b> ?</span>
		</div>
		<template #footer>
			<Button label="NO" icon="pi pi-times" class="p-button-text" @click="deleteSpecialityDialog = false"/>
			<Button label="YES" icon="pi pi-check" class="p-button-text" @click="deleteSpeciality(speciality.id)" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            speciality: {},
            deleteSpecialityDialog: false,
        }
    },
    mounted() {
        window.mitt.on("deleteSpecialityDialog", data => {
			this.deleteSpecialityDialog = data.deleteSpecialityDialog
			this.speciality = data.speciality
		})
    },
    methods: {
		deleteSpeciality(id) 
		{
			axios.delete('/api/specialities/' + id)
				.then(res => {
					window.mitt.emit("deletedSpeciality", id)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.deleteSpecialityDialog = false
			this.speciality = {}
		},
    }
}
</script>