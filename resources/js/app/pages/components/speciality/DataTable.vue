<template>
	<DataTable ref="dt" :value="specialitiesList" @click="onChange" v-model:selection="selectedSpecialities" dataKey="id" :paginator="true" :rows="10" :filters="filters"
		paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[5,10,25]"
		currentPageReportTemplate="Showing {first} to {last} of {totalRecords} specialities" responsiveLayout="scroll">
		<template #header>
			<div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
				<h5 class="m-0">Manage specialities:</h5>
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
		<Column field="name" header="Name" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Name</span>
				{{slotProps.data.name}}
			</template>
		</Column>
		<Column>
			<template #body="slotProps">
				<Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editSpeciality(slotProps.data)" />
				<Button icon="pi pi-trash" class="p-button-rounded p-button-warning" @click="confirmDeleteSpeciality(slotProps.data)" />
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
            specialitiesList: null,
            selectedSpecialities: null,
            speciality: {},
			filters: {}
        }
    },
    created() 
    {
		this.initFilters()
	},
    mounted()
    {
        window.mitt.on("specialities", data => this.specialitiesList = data)
        window.mitt.on("createdSpeciality", data => this.specialitiesList = [...this.specialitiesList, data])
		window.mitt.on("deletedSpeciality", data => this.specialitiesList = this.specialitiesList.filter(val => val.id !== data))
		window.mitt.on("deletedMultipleSpecialities", data => {
			this.specialitiesList = this.specialitiesList.filter(val => !data.includes(val.id))
			this.selectedSpecialities = null
		})
    },
    methods: {
        initFilters()				
        {
            this.filters = { 'global': {value: null, matchMode: FilterMatchMode.CONTAINS} }
        },
        onChange()
        {
            window.mitt.emit('selectedSpecialities', this.selectedSpecialities)
        },
        editSpeciality(speciality) 
		{
            window.mitt.emit("editSpecialityDialog", {editSpecialityDialog:true, speciality: speciality})
		},
        confirmDeleteSpeciality(speciality) 
		{
            window.mitt.emit("deleteSpecialityDialog", {deleteSpecialityDialog:true, speciality: speciality})
		},
    }
}
</script>

