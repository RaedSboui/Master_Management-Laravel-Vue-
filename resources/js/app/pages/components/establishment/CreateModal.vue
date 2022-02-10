<template>
	<Dialog v-model:visible="establishmentDialog" :style="{width: '450px'}" header="Establishment details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="name">Name</label>
			<InputText id="name" v-model="establishment.name" autofocus :class="{'p-invalid': submitted && !establishment.name}" />
			<small class="p-error" v-if="submitted && !establishment.name">Please enter the establishment title.</small>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="establishmentDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveEstablishment" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
			submitted: false,
            establishment: {},
            establishmentDialog: false,
        }
    },
    mounted() 
    { 
        window.mitt.on("establishmentDialog", data => {
            this.establishmentDialog = data;
        });
    },
    methods:{
		saveEstablishment() 
		{
			this.submitted = true
            axios.post('/api/establishments', this.establishment)
				.then(res => {
					window.mitt.emit("createdEstablishment", res.data.establishment)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.establishmentDialog = false
			this.establishment = {}
		},
    }
}
</script>
