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
import Toolbar from './components/master/Toolbar.vue'
import DataTable from './components/master/DataTable.vue'
import CreateModal from './components/master/CreateModal.vue'
import UpdateModal from './components/master/UpdateModal.vue'
import DeleteModal from './components/master/DeleteModal.vue'
import DeleteMultipleModal from './components/master/DeleteMultipleModal.vue'

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
            axios.get('/api/masters')
		        .then((res) => window.mitt.emit('masters', res.data.masters))
		        .catch((err) => console.log('Fetch Data Error: ',err))
        }else{
            this.loading = false
            this.$router.push('/login')
        }
	},
}
</script>

<style lang="scss">
	.master-badge {
		border-radius: 2px;
		padding: .25em .5rem;
		text-transform: uppercase;
		font-weight: 700;
		font-size: 12px;
		letter-spacing: .3px;

		&.status-1 {
			background: #C8E6C9;
			color: #256029;
		}

		&.status-0 {
			background: #FFCDD2;
			color: #C63737;
		}
	}
	b {
		color: #C63737;
	}
</style>
