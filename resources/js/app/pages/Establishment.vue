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
import Toolbar from './components/establishment/Toolbar'
import DataTable from './components/establishment/DataTable'
import CreateModal from './components/establishment/CreateModal'
import UpdateModal from './components/establishment/UpdateModal'
import DeleteModal from './components/establishment/DeleteModal'
import DeleteMultipleModal from './components/establishment/DeleteMultipleModal'

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
            axios.get('/api/establishments')
		        .then((res) => window.mitt.emit('establishments', res.data.establishments))
		        .catch((err) => console.log('Fetch Data Error: ',err))
        }else{
            this.loading = false
            this.$router.push('/login')
        }
	},
}
</script>