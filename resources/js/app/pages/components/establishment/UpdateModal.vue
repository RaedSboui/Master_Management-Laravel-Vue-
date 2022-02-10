<template>
	<Dialog v-model:visible="editEstablishmentDialog" :style="{width: '450px'}" header="Establishment details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="name">Name</label>
			<InputText id="name" v-model="establishment.name"/>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="editEstablishmentDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="updateEstablishment" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            establishment: {},
            editEstablishmentDialog: false,
        }
    },
    mounted() {
        window.mitt.on("editEstablishmentDialog", data => {
			this.editEstablishmentDialog = data.editEstablishmentDialog
			this.establishment = data.establishment
		})
    },
    methods: {
    	updateEstablishment() 
		{
            axios.put(`/api/establishments/${this.establishment.id}`, this.establishment)
				.then(res => this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000}))
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.editEstablishmentDialog = false
			this.establishment = {}
		},
    }
}
</script>