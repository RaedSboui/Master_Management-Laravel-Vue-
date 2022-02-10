<template>
	<Dialog v-model:visible="userDialog" :style="{width: '450px'}" header="Admin details" :modal="true" class="p-fluid">
		<div class="field">
			<label for="firstName">First Name</label>
			<InputText id="firstName" v-model="user.firstName" autofocus :class="{'p-invalid': submitted && !user.firstName}" />
			<small class="p-error" v-if="submitted && !user.firstName">Please enter a first name.</small>
		</div>
		<div class="field">
			<label for="lastName">Last Name</label>
			<InputText id="lastName" v-model="user.lastName" autofocus :class="{'p-invalid': submitted && !user.lastName}" />
			<small class="p-error" v-if="submitted && !user.lastName">Please enter a last name.</small>
		</div>
		<div class="field">
            <label for="email">E-mail</label>
            <div class="p-input-icon-right">
                <i class="pi pi-envelope" />
                <InputText id="email" class="p-pt-4 " v-model="user.email" :class="{'p-invalid':  submitted && !user.email}" aria-describedby="email-error"/>
            </div>
			<small class="p-error" v-if="submitted && !user.email" >Please enter an email address.</small>
            <small class="p-error" v-else-if="submitted && (/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i).test(user.email) === false">The field entered does not correspond to an email address.</small>
        </div>
		<div class="field">
			<label for="username">Username</label>
			<InputText id="username" v-model="user.username" :class="{'p-invalid': submitted && !user.username}" />
			<small class="p-error" v-if="submitted && !user.username">Please enter the username.</small>
		</div>
		<div class="field">
            <label for="password">Password</label>
            <div class="p-float-label">
                <Password id="password" v-model="user.password" :class="{'p-invalid':submitted && !user.password}" toggleMask>
                    <template #header>
                        <h6>Pick a password</h6>
                    </template>
                    <template #footer="sp">
                        {{sp.level}}
                        <Divider />
                        <p class="p-mt-2">Suggestions</p>
                        <ul class="p-pl-2 p-ml-2 p-mt-0" style="line-height: 1.5">
                            <li>At least one lowercase</li>
                            <li>At least one uppercase</li>
                            <li>At least one numeric</li>
                            <li>Minimum 8 characters</li>
                        </ul>
                    </template>
                </Password>
            </div>
            <small  class="p-error" v-if="submitted && !user.password">Please enter a password.</small>
        </div>
        <div class="field">
			<label for="role" class="mb-3">Role</label>
			<Dropdown id="role" v-model="user.role" :options="roles" optionLabel="label" placeholder="Select a role" :class="{'p-invalid': submitted && !user.role}">
				<template #value="slotProps">
					<div v-if="slotProps.value && slotProps.value.value">
						<span :class="'user-badge status-' + slotProps.value.value">{{slotProps.value.label}}</span>
					</div>
				</template>
			</Dropdown>
			<small class="p-error" v-if="submitted && !user.role">Please select a role.</small>
		</div>
		<div class="field">
			<label for="isLocked" class="p-mb-3">Status</label>
			<Dropdown id="isLocked" v-model="user.isLocked" :options="isLocked" optionLabel="label" placeholder="Select a status" :class="{'p-invalid': submitted && !user.isLocked}">
				<template #value="slotProps">
					<div v-if="slotProps.value && slotProps.value.value">
						<span :class="'user-badge status-' + slotProps.value.value">{{slotProps.value.label}}</span>
					</div>
				</template>
			</Dropdown>
			<small class="p-error" v-if="submitted && !user.isLocked">Please select a status.</small>
		</div>
		<template #footer>
			<Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="userDialog = false"/>
			<Button label="Save" icon="pi pi-check" class="p-button-text" @click="saveUser" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
			user: {},
			userDialog: false,
			submitted: false,
			isLocked: [
				{label: 'Locked', value: false},
				{label: 'Not Locked', value: true},
			],
            roles: [
				{label: 'SUPER ADMIN', value: 'SUPER ADMIN'},
				{label: 'ADMIN', value: 'ADMIN'},
			],
        }
    },
    mounted() 
    { 
        window.mitt.on("userDialog", data => this.userDialog = data)
    },
    methods:{
		saveUser() {
			this.submitted = true
			this.user.isLocked = this.user.isLocked?.value
			this.user.role = this.user.role?.value
            axios.post('/api/users', this.user)
			    .then(res => {
					window.mitt.emit("createUser", res.data.user)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.userDialog = false
			this.user = {}
		},
    }
}
</script>
