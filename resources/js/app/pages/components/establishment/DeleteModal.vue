<template>
    <Dialog v-model:visible="deleteEstablishmentDialog" :style="{width: '450px'}" header="Confirmation" :modal="true">
		<div class="flex align-items-center justify-content-center">
			<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
			<span v-if="establishment">Are you sure you want to delete the establishment <b>{{establishment.name}}</b> ?</span>
		</div>
		<template #footer>
			<Button label="NO" icon="pi pi-times" class="p-button-text" @click="deleteEstablishmentDialog = false"/>
			<Button label="YES" icon="pi pi-check" class="p-button-text" @click="deleteEstablishment(establishment.id)" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            establishment: {},
            deleteEstablishmentDialog: false,
        }
    },
    mounted() {
        window.mitt.on("deleteEstablishmentDialog", data => {
			this.deleteEstablishmentDialog = data.deleteEstablishmentDialog
			this.establishment = data.establishment
		})
    },
    methods: {
		deleteEstablishment(id) 
		{
			axios.delete('/api/establishments/' + id)
				.then(res => {
					window.mitt.emit("deletedEstablishment", id)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.deleteEstablishmentDialog = false
			this.establishment = {}
		},
    }
}
</script>