<template>
	<DataTable ref="dt" :value="usersList" @click="onChange" v-model:selection="selectedUsers" dataKey="id" :paginator="true" :rows="10" :filters="filters"
		paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[5,10,25]"
		currentPageReportTemplate="Showing {first} to {last} of {totalRecords} users" responsiveLayout="scroll">
		<template #header>
			<div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
				<h5 class="m-0">Manage admins:</h5>
				<span class="block mt-2 md:mt-0 p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText v-model="filters['global'].value" placeholder="Search..." />
                </span>
			</div>
		</template>
		<Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
		<Column field="id" header="ID" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">ID</span>
				{{slotProps.data.id}}
			</template>
		</Column>
		<Column field="image" header="Photo" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Photo</span>
				<img :src="'/avatars/' + slotProps.data.image" :alt="slotProps.data.firstName + ' ' + slotProps.data.lastName + 'image'"
				    style="width: 50px !important; height:50px !important; border-radius: 50% !important;"
				>
			</template>
		</Column>
		<Column field="firstName" header="First Name" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">First Name</span>
				{{slotProps.data.firstName}}
			</template>
		</Column>
		<Column field="lastName" header="Last Name" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Last Name</span>
				<span>{{slotProps.data.lastName}}</span>
			</template>
		</Column>
        <Column field="email" header="E-mail" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">E-mail</span>
				{{slotProps.data.email}}
			</template>
		</Column>
        <Column field="username" header="Username" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Username</span>
				{{slotProps.data.username}}
			</template>
		</Column>
        <Column field="role" header="Role" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Role</span>
                <span v-for="role in slotProps.data.roles" :key="role.name" :class="'user-badge status-' + (role.name.value ? role.name.value : role.name)">{{role.name.value ? role.name.value : role.name}}</span>
			</template>
		</Column>
        <Column field="isActif" header="Actif" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Actif</span>
                <span :class="'user-badge status-' + (slotProps.data.isLocked.status ? slotProps.data.isLocked.status : slotProps.data.isLocked)">{{slotProps.data.isLocked ? 'Locked' : 'Actif'}}</span>
			</template>
		</Column>
		<Column field="isConnected" header="Connected" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Connected</span>
                <span :class="'user-badge status-' + (slotProps.data.isConnected ? '0' : '1')">{{slotProps.data.isConnected ? 'Online' : 'Offline'}}</span>
			</template>
		</Column>
		<Column>
			<template #body="slotProps">
				<Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editUser(slotProps.data)" />
				<Button icon="pi pi-trash" class="p-button-rounded p-button-warning" @click="confirmDeleteUser(slotProps.data)" />
			</template>
		</Column>
	</DataTable>
</template>

<script>
import {FilterMatchMode} from 'primevue/api'

export default {
    data() 
    {      
		return {
            usersList: null,
            selectedUsers: null,
            filters: {},
            user: {}
        }
    },
    created() 
    {
		this.initFilters()
	},
    mounted()
    {
        window.mitt.on("users", data => this.usersList = data)
        window.mitt.on("createUser", data => this.usersList = [...this.usersList, data])
		window.mitt.on("deleteUser", data => this.usersList = this.usersList.filter(val => val.id !== data))
		window.mitt.on("deleteMultipleUsers", data => {
			this.usersList = this.usersList.filter(val => !data.includes(val.id))
			this.selectedUsers = null
		})
    },
    methods: {
        initFilters()				
        {
            this.filters = { 'global': {value: null, matchMode: FilterMatchMode.CONTAINS} }
        },
        onChange()
        {
            window.mitt.emit('selectedUsers', this.selectedUsers)
        },
        editUser(user) 
		{
            window.mitt.emit("editUserDialog", {editUserDialog:true, user: user})
		},
        confirmDeleteUser(user) 
		{
            window.mitt.emit("deleteUserDialog", {deleteUserDialog:true, user: user})
		},
    }
}
</script>

