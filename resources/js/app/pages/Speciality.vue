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
import Toolbar from './components/Speciality/Toolbar'
import DataTable from './components/Speciality/DataTable'
import CreateModal from './components/Speciality/CreateModal'
import UpdateModal from './components/Speciality/UpdateModal'
import DeleteModal from './components/Speciality/DeleteModal'
import DeleteMultipleModal from './components/Speciality/DeleteMultipleModal'

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