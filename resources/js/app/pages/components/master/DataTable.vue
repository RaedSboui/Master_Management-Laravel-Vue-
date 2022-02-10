<template>
    <DataTable :value="mastersList" @click="onChange" v-model:selection="selectedMasters" dataKey="id" :paginator="true" :rows="10" :filters="filters"
		paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[5,10,25]"
		currentPageReportTemplate="Showing {first} to {last} of {totalRecords} masters" responsiveLayout="scroll">
		<template #header>
			<div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
				<h5 class="pr-4">Manage masters: </h5>
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
		<Column field="title" header="Title" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Title</span>
				{{slotProps.data.title}}
			</template>
		</Column>
        <Column field="description" header="Description" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Description</span>
				{{slotProps.data.description}}
			</template>
		</Column>
        <Column field="isActif" header="Actif" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Actif</span>
                <span :class="'master-badge status-' + slotProps.data.isActive">{{slotProps.data.isActive ? 'Enabled' : 'Disabled'}}</span>
			</template>
		</Column>
		<Column field="created_by" header="Created by" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Created by</span>  
				{{slotProps.data.createdBy}}
			</template>
		</Column>
		<Column field="candidatures" header="candidatures" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Number of candidacies</span>
				{{slotProps.data.candidacies}}
			</template>
		</Column>
		<Column>
			<template #body="slotProps">
				<acronym title="Export all candidacies of this master in excel file">
				    <Button icon="pi pi-upload" class="p-button-rounded p-button-info mr-2" @click="exportCandidacies(slotProps.data.id)" />
				</acronym>
				<Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editMaster(slotProps.data)" />
				<Button icon="pi pi-trash" class="p-button-rounded p-button-warning" @click="confirmDeleteMaster(slotProps.data)" />
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
            mastersList: null,
            selectedMasters: null,
            filters: {},
            master: {}
        }
    },
    created() 
    {
		this.initFilters()
	},
    mounted()
    {
        window.mitt.on("masters", data => this.mastersList = data)
        window.mitt.on("createdMaster", data => this.mastersList = [...this.mastersList, data])
		window.mitt.on("deletedMaster", data => this.mastersList = this.mastersList.filter(val => val.id !== data))
		window.mitt.on("deletedMultipleMasters", data => {
			this.mastersList = this.mastersList.filter(val => !data.includes(val.id))
			this.selectedMasters = null
		})
    },
    methods: {
        initFilters()				
        {
            this.filters = { 'global': {value: null, matchMode: FilterMatchMode.CONTAINS} }
        },
        onChange()
        {
            window.mitt.emit('selectedMasters', this.selectedMasters)
        },
        editMaster(master) 
		{
            window.mitt.emit("editMasterDialog", {editMasterDialog:true, master: master})
		},
        confirmDeleteMaster(master) 
		{
            window.mitt.emit("deleteMasterDialog", {deleteMasterDialog:true, master: master})
		},
		exportCandidacies(id) 
		{
			window.location.href = '/api/candidacies/export/' + id + '?token=' + this.$store.state.token
		},
    }
}
</script>

