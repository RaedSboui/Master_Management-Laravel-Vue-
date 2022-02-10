<template>
    <Dialog v-model:visible="deleteSubjectDialog" :style="{width: '450px'}" header="Confirmation" :modal="true">
		<div class="flex align-items-center justify-content-center">
			<i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
			<span v-if="subject">Are you sure you want to delete the subject <b>{{subject.name}}</b> ?</span>
		</div>
		<template #footer>
			<Button label="NO" icon="pi pi-times" class="p-button-text" @click="deleteSubjectDialog = false"/>
			<Button label="YES" icon="pi pi-check" class="p-button-text" @click="deleteSubject(subject.id)" />
		</template>
	</Dialog>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            subject: {},
            deleteSubjectDialog: false,
        }
    },
    mounted() {
        window.mitt.on("deleteSubjectDialog", data => {
			this.deleteSubjectDialog = data.deleteSubjectDialog
			this.subject = data.subject
		})
    },
    methods: {
		deleteSubject(id) 
		{
			axios.delete('/api/subjects/' + id)
				.then(res => {
					window.mitt.emit("deletedSubject", id)
					this.$toast.add({severity:'success', summary: 'Successful', detail: res.data.message, life: 3000})
				})
				.catch(err => this.$toast.add({severity:'error', summary: 'Erreur', detail: err, life: 5000}))
			this.deleteSubjectDialog = false
			this.subject = {}
		},
    }
}
</script>