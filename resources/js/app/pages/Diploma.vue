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
import Toolbar from './components/diploma/Toolbar'
import DataTable from './components/diploma/DataTable'
import CreateModal from './components/diploma/CreateModal'
import UpdateModal from './components/diploma/UpdateModal'
import DeleteModal from './components/diploma/DeleteModal'
import DeleteMultipleModal from './components/diploma/DeleteMultipleModal'
import axios from 'axios';

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
        if(this.$store.state.token !== ''){
            this.allDiplomas()
        }else{
            this.loading = false
            this.$router.push('/login')
        }
	},
	methods:{
		allDiplomas(){
			axios.get('/api/diplomas')
		        .then((res) => window.mitt.emit('diplomas', res.data.diplomas))
		        .catch((err) => console.log('Fetch Data Error: ',err))
		},
	}
}
</script>