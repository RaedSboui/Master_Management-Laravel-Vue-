<template>
	<DataTable ref="dt" :value="diplomasList" @click="onChange" v-model:selection="selectedDiplomas" dataKey="id" :paginator="true" :rows="10" :filters="filters"
		paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[5,10,25]"
		currentPageReportTemplate="Showing {first} to {last} of {totalRecords} diplomas" responsiveLayout="scroll">
		<template #header>
			<div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
				<h5 class="m-0">Manage diplomas:</h5>
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
		<Column field="name" header="Title" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Title</span>
				{{slotProps.data.name}}
			</template>
		</Column>
		<Column field="years" header="Number Years" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Number Years</span>
				<span>{{slotProps.data.years}}</span>
			</template>
		</Column>
        <Column field="years_min" header="Minimum number of years" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Minimum number of years</span>
				{{slotProps.data.years_min}}
			</template>
		</Column>
        <Column field="credits" header="Credits" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">Credits</span>
				{{ slotProps.data.credits? 'YES' : 'NO'}}
			</template>
	    </Column>
        <Column field="sfe" header="SFE" :sortable="true">
			<template #body="slotProps">
				<span class="p-column-title">SFE</span>
                {{slotProps.data.sfe? 'YES' : 'NO'}}
			</template>
		</Column>
		<Column>
			<template #body="slotProps">
				<Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editDiploma(slotProps.data)" />
				<Button icon="pi pi-trash" class="p-button-rounded p-button-warning" @click="confirmDeleteDiploma(slotProps.data)" />
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
            diplomasList: null,
            selectedDiplomas: null,
            filters: {},
            diploma: {}
        }
    },
    created() 
    {
		this.initFilters()
	},
    mounted()
    {
        window.mitt.on("diplomas", data => this.diplomasList = data)
        window.mitt.on("createdDiploma", data => this.diplomasList = [...this.diplomasList, data])
		window.mitt.on("deletedDiploma", data => this.diplomasList = this.diplomasList.filter(val => val.id !== data))
		window.mitt.on("deletedMultipleDiplomas", data => {
			this.diplomasList = this.diplomasList.filter(val => !data.includes(val.id))
			this.selectedDiplomas = null
		})
    },
    methods: {
        initFilters()				
        {
            this.filters = { 'global': {value: null, matchMode: FilterMatchMode.CONTAINS} }
        },
        onChange()
        {
            window.mitt.emit('selectedDiplomas', this.selectedDiplomas)
        },
        editDiploma(diploma) 
		{
            window.mitt.emit("editDiplomaDialog", {editDiplomaDialog:true, diploma: diploma})
		},
        confirmDeleteDiploma(diploma) 
		{
            window.mitt.emit("deleteDiplomaDialog", {deleteDiplomaDialog:true, diploma: diploma})
		},
    }
}
</script>

