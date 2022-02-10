<template>
	<Dialog v-model:visible="editUserDialog" :style="{width: '450px'}" header="Admin details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="firstName">First Name</label>
			<InputText id="firstName" v-model="user.firstName" disabled/>
		</div>
		<div class="field">
			<label for="lastName">Last Name</label>
			<InputText id="lastName" v-model="user.lastName" autofocus disabled/>
		</div>
		<div class="field">
            <label for="email">E-mail</label>
            <div class="p-input-icon-right">
                <i class="pi pi-envelope" />
                <InputText id="email" class="p-pt-4 " v-model="user.email" disabled/>
            </div>
        </div>
		<div class="field">
			<label for="username">Username</label>
			<InputText id="username" v-model="user.username" disabled/>
		</div>
		<div class="field">
            <label for="password">Password</label>
            <div class="p-float-label">
                <Password id="password" v-model="user.password" disabled/>
            </div>
        </div>
		<div class="field">
			<label for="role" class="p-mb-3">Role</label>
			<Dropdown id="role" v-model="user.roles[0].name" :options="roles" optionLabel="label" placeholder="Select a role">
				<template #value="slotProps">
					<div>
						<span :class="'user-badge status-' +  (slotProps.value.value ? slotProps.value.value : slotProps.value)">{{slotProps.value.label ? slotProps.value.label : slotProps.value}}</span>
					</div>
				</template>
			</Dropdown>
		</div>
		<div class="field">
			<label for="isLocked" class="p-mb-3">Status</label>
			<Dropdown id="isLocked" v-model="user.isLocked" :options="isLocked" optionLabel="label" placeholder="Select a status">
				<template #value="slotProps">
					<div>
						<span :class="'user-badge status-' +  (slotProps.value.status ? slotProps.value.status : slotProps.value)">{{slotProps.value.label ? slotProps.value.label : (slotProps.value ? 'Locked' : 'Actif')}}</span>
					</div>
				</template>
			</Dropdown>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="editUserDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="updateUser" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            user: {},
            editUserDialog: false,
			isLocked: [
				{label: 'Locked', value: true, status:'1 N'},
				{label: 'Actif', value: false, status:'0 Y'},
			],
            roles: [
				{label: 'SUPER ADMIN', value: 'SUPER ADMIN'},
				{label: 'ADMIN', value: 'ADMIN'},
			],
        }
    },
    mounted() {
        window.mitt.on("editUserDialog", data => {
			this.editUserDialog = data.editUserDialog
			this.user = data.user
		})
    },
    methods: {
    	updateUser() 
		{
			this.user.role = this.user.roles[0].name.value ? this.user.roles[0].name.value : this.user.roles[0].name
			this.user.isLocked = this.user.isLocked.status ? this.user.isLocked.value : this.user.isLocked
			console.log(this.user)
            axios.put(`/api/users/${this.user.id}`, this.user)
				.then(res => this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000}))
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.editUserDialog = false
			this.user = {}
		},
    }
}
</script>