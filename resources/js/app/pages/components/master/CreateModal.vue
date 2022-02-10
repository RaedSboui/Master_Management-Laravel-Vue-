<template>
    <Dialog v-model:visible="masterDialog" :style="{width: '450px'}" header="Master details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="title">Title</label>
			<InputText id="title" v-model="master.title" autofocus :class="{'p-invalid': submitted && !master.title}" />
			<small class="p-error" v-if="submitted && !master.title">Please enter a title !</small>
		</div>
		<div class="field">
			<label for="isActive" class="p-mb-3">Status</label>
			<Dropdown id="isActive" v-model="master.isActive" :options="isActive" optionLabel="label" placeholder="Select a status" :class="{'p-invalid': submitted && !master.isActive}">
			    <template #value="slotProps">
			        <div v-if="slotProps.value">
				        <span :class="'master-badge status-' + slotProps.value.status">{{slotProps.value.label}}</span>
			        </div>
			    </template>
		    </Dropdown>
			<small class="p-error" v-if="submitted && !master.isActive">Please select a status !</small>
		</div>
        <div class="field">
			<label for="description">Description</label>
			<Textarea id="description" v-model="master.description" rows="3" cols="20" :class="{'p-invalid': submitted && !master.isActive}"/>
			<small class="p-error" v-if="submitted && !master.isActive">Please enter a description.</small>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="masterDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveMaster" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            master: {},
            submitted: false,
            masterDialog: false,
            isActive: [
				{label: 'Enabled', value: 1, status:'1 Y'},
				{label: 'Disabled', value: 0, status:'0 N'}
			],
			createdBy: this.$store.state.user.firstName + ' ' +this.$store.state.user.lastName,
        }
    },
    mounted() 
    { 
        window.mitt.on("masterDialog", data => {
            this.masterDialog = data;
        });
    },
    methods:{
		saveMaster() 
		{
			this.submitted = true
			this.master.isActive = this.master.isActive?.value
			this.master.createdBy = this.createdBy
            axios.post('/api/masters', this.master)
				.then(res => {
					window.mitt.emit("createdMaster", res.data.master)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.masterDialog = false
			this.master = {}
		},
    }
}
</script>
