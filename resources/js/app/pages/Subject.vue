<template>
	<div class="grid crud-demo">
		<div class="col-12">
			<div class="card">
				<Toast/>
				<toolbar/>
				<data-table/>
				<create-modal/>
				<update-modal/>
				<delete-modal/>
				<delete-multiple-modal/>
			</div>
		</div>
	</div>
</template>

<script>
import Toolbar from './components/subject/Toolbar'
import DataTable from './components/subject/DataTable'
import CreateModal from './components/subject/CreateModal'
import UpdateModal from './components/subject/UpdateModal'
import DeleteModal from './components/subject/DeleteModal'
import DeleteMultipleModal from './components/subject/DeleteMultipleModal'

import axios from 'axios'

export default {
	components: {
        Toolbar,
		DataTable,
		CreateModal,
		UpdateModal,
		DeleteModal,
		DeleteMultipleModal
    },
	mounted() {
        if(localStorage.getItem("auth")){
			//all subjects
            axios.get('/api/subjects')
		        .then((res) => window.mitt.emit('subjects', res.data.subjects))
		        .catch((err) => console.log('Fetch Data Error: ',err))
			
			//all masters
            axios.get('/api/masters')
		        .then((res) => window.mitt.emit('masters', res.data.masters))
		        .catch((err) => console.log('Fetch Data Error: ',err))

			//all diplomas
            axios.get('/api/diplomas')
		        .then((res) => window.mitt.emit('diplomas', res.data.diplomas))
		        .catch((err) => console.log('Fetch Data Error: ',err))

			//all specialities
            axios.get('/api/specialities')
		        .then((res) => window.mitt.emit('specialities', res.data.specialities))
		        .catch((err) => console.log('Fetch Data Error: ',err))
        }else{
            this.loading = false
            this.$router.push('/login')
        }
	},
}
</script>