<template>
    <Dialog v-model:visible="editMasterDialog" :style="{width: '450px'}" header="Master details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="title">Titre</label>
			<InputText id="title" v-model="master.title"/>
		</div>
		<div class="field">
			<label for="isActive" class="p-mb-3">Statut</label>
			<Dropdown id="isActive" v-model="master.isActive" :options="isActive" optionLabel="label" placeholder="Select a status">
				<template #value="slotProps">
					<div>
						<span :class="'master-badge status-' + (slotProps.value.status ? slotProps.value.status : slotProps.value)">{{slotProps.value.label ? slotProps.value.label : (slotProps.value ? 'Enabled' : 'Disabled')}}</span>
					</div>
				</template>
			</Dropdown>
		</div>
        <div class="field">
			<label for="description">Description</label>
			<Textarea id="description" v-model="master.description" rows="3" cols="20"/>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="editMasterDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="updateMaster" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            master: {},
            editMasterDialog: false,
			isActive: [
				{label: 'Enabled', value: 1, status:'1 Y'},
				{label: 'Disabled', value: 0, status:'0 N'}
			],
        }
    },
    mounted() {
        window.mitt.on("editMasterDialog", data => {
			this.editMasterDialog = data.editMasterDialog
			this.master = data.master
		})
    },
    methods: {
    	updateMaster() 
		{
			this.master.isActive = this.master.isActive.status ? this.master.isActive.value : this.master.isActive
            axios.put(`/api/masters/${this.master.id}`, this.master)
				.then(res => this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000}))
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.editMasterDialog = false
			this.master = {}
		},
    }
}
</script>