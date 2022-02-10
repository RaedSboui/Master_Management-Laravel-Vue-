<template>
	<DataTable ref="dt" :value="establishmentsList" @click="onChange" v-model:selection="selectedEstablishments" dataKey="id" :paginator="true" :rows="10" :filters="filters"
		paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[5,10,25]"
		currentPageReportTemplate="Showing {first} to {last} of {totalRecords} establishments" responsiveLayout="scroll">
		<template #header>
			<div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
				<h5 class="m-0">Manage establishments:</h5>
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
				<Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editEstablishment(slotProps.data)" />
				<Button icon="pi pi-trash" class="p-button-rounded p-button-warning" @click="confirmDeleteEstablishment(slotProps.data)" />
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
			filters: {},
            establishmentsList: null,
            selectedEstablishments: null,
            establishment: {}
        }
    },
    created() 
    {
		this.initFilters()
	},
    mounted()
    {
        window.mitt.on("establishments", data => this.establishmentsList = data)
        window.mitt.on("createdEstablishment", data => this.establishmentsList = [...this.establishmentsList, data])
		window.mitt.on("deletedEstablishment", data => this.establishmentsList = this.establishmentsList.filter(val => val.id !== data))
		window.mitt.on("deletedMultipleEstablishments", data => {
			this.establishmentsList = this.establishmentsList.filter(val => !data.includes(val.id))
			this.selectedEstablishments = null
		})
    },
    methods: {
        initFilters()				
        {
            this.filters = { 'global': {value: null, matchMode: FilterMatchMode.CONTAINS} }
        },
        onChange()
        {
            window.mitt.emit('selectedEstablishments', this.selectedEstablishments)
        },
        editEstablishment(establishment) 
		{
            window.mitt.emit("editEstablishmentDialog", {editEstablishmentDialog:true, establishment: establishment})
		},
        confirmDeleteEstablishment(establishment) 
		{
            window.mitt.emit("deleteEstablishmentDialog", {deleteEstablishmentDialog:true, establishment: establishment})
		},
    }
}
</script>

