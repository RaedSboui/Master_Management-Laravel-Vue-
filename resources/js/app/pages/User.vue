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
import Toolbar from './components/user/Toolbar'
import DataTable from './components/user/DataTable'
import CreateModal from './components/user/CreateModal'
import UpdateModal from './components/user/UpdateModal'
import DeleteModal from './components/user/DeleteModal'
import DeleteMultipleModal from './components/user/DeleteMultipleModal'
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
        if((this.$store.state.token !== '') && (this.$store.state.user.roles[0].name === 'SUPER ADMIN')){
                axios.get('/api/users')
		            .then((res) => window.mitt.emit('users', res.data.users))
		            .catch((err) => console.log('Fetch Data Error: ',err))
        }else{
            this.loading = false
            this.$router.push('/login')
        }
	}
}
</script>

<style lang="scss">
	.user-badge {
		border-radius: 2px;
		padding: .25em .5rem;
		text-transform: uppercase;
		font-weight: 700;
		font-size: 12px;
		letter-spacing: .3px;

		&.status-0 {
			background: #C8E6C9;
			color: #256029;
		}
		&.status-1 {
			background: #FFCDD2;
			color: #C63737;
		}
		&.status-SUPER {
            background: #f9ca24;
            color: #8a5340;
		}
		&.status-ADMIN {
			background: #82ccdd;
			color: #0c2461;
		}
	}
	b {
		color: #C63737;
	}
</style>
