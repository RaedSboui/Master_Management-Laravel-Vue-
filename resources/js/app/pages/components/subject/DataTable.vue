<template>
	<DataTable ref="dt" :value="subjectsList" @click="onChange" v-model:selection="selectedSubjects" dataKey="id" :paginator="true" :rows="10" :filters="filters"
		paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[5,10,25]"
		currentPageReportTemplate="Showing {first} to {last} of {totalRecords} subjects" responsiveLayout="scroll">
		<template #header>
			<div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
				<h5 class="m-0">Manage subjects:</h5>
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
		<Column field="masters" header="Masters">
			<template #body="slotProps">
				<span class="p-column-title">Masters</span>
				<Listbox :options="slotProps.data.masters" optionLabel="title"  style="width:15rem" listStyle="height:60px" />
			</template>
		</Column>
		<Column field="diplomas" header="Diplomas">
			<template #body="slotProps">
				<span class="p-column-title">Diplomas</span>
				<Listbox :options="slotProps.data.diplomas" optionLabel="name"  style="width:15rem" listStyle="height:60px" />
			</template>
		</Column>
		<Column field="specialities" header="Specialities">
			<template #body="slotProps">
				<span class="p-column-title">Specialities</span>
				<Listbox :options="slotProps.data.specialities" optionLabel="name"  style="width:15rem" listStyle="height:60px" />
			</template>
		</Column>
		<Column>
			<template #body="slotProps">
				<Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editSubject(slotProps.data)" />
				<Button icon="pi pi-trash" class="p-button-rounded p-button-warning" @click="confirmDeleteSubject(slotProps.data)" />
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
            subjectsList: null,
            selectedSubjects: null,
            filters: {},
            subject: {}
        }
    },
    created() 
    {
		this.initFilters()
	},
    mounted()
    {
        window.mitt.on("subjects", data => this.subjectsList = data)
        window.mitt.on("createdSubject", data => this.subjectsList = [...this.subjectsList, data])
		window.mitt.on("deletedSubject", data => this.subjectsList = this.subjectsList.filter(val => val.id !== data))
		window.mitt.on("deletedMultipleSubjects", data => {
			this.subjectsList = this.subjectsList.filter(val => !data.includes(val.id))
			this.selectedSubjects = null
		})
    },
    methods: {
        initFilters()				
        {
            this.filters = { 'global': {value: null, matchMode: FilterMatchMode.CONTAINS} }
        },
        onChange()
        {
            window.mitt.emit('selectedSubjects', this.selectedSubjects)
        },
        editSubject(subject) 
		{
            window.mitt.emit("editSubjectDialog", {editSubjectDialog:true, subject: subject})
		},
        confirmDeleteSubject(subject) 
		{
            window.mitt.emit("deleteSubjectDialog", {deleteSubjectDialog:true, subject: subject})
		},
    }
}
</script>

