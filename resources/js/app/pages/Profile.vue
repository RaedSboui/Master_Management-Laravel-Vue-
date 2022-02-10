<template>
    <div>
        <h1>My Profile</h1>
        <div class="profileData">
            <div class="profileImage">
                <img :src="'/avatars/' + this.$store.state.user.image" alt="user_image">
                <!-- <input type="file" name="image" id="image" @change="onImageSelected" />  -->
                <FileUpload v-if="!disabled" name="image" mode="basic" :auto="true" :customUpload="true" @uploader="onImageSelected" accept="image/*" :maxFileSize="1000000" chooseLabel="Upload Image"/>
            </div>
            <div class="detailsProfile">
                <div class="props">
                    <label for="firstName">First Name</label>
                    <InputText id="firstname" type="text" v-model="user.firstName" :disabled="disabled"/>
                </div>
                <div class="props">
                    <label for="lastName">Last Name</label>
                    <InputText id="lastname" type="text" v-model="user.lastName" :disabled="disabled"/>
                </div>
                <div class="props">
                    <label for="email">E-mail</label>
                    <InputText id="email" type="text" v-model="user.email" :disabled="disabled"/>
                </div>
                <div class="props">
                    <label for="username">Username</label>
                    <InputText id="username" type="text" v-model="user.username" :disabled="disabled"/>
                </div>
                <div class="props">
                    <label for="password">password</label>
                    <Password id="password" :feedback="false" toggleMask v-model="user.password" :disabled="disabled"/>
                </div>
            </div>
        </div>
        <div class="buttons">
            <Button v-if="!disabled" label="Back" class="p-button-rounded p-button-info" @click="disabled = true" style="margin-right: 10px"/>
            <Button v-if="disabled" label="Update Profile" class="p-button-rounded p-button-success" @click="disabled = false"/>
            <Button v-if="!disabled" label="Save Change" class="p-button-rounded p-button-success" @click="updateProfile"/>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            user: this.$store.state.user,
            disabled: true,
            file: []
        }
    },
    methods: {
        onImageSelected(event){
            this.file = event.files[0]
            console.log(this.file)
        },
        updateProfile()
        {
            if(this.file) this.user.image = this.file
            this.user.role = this.user.roles[0].name.value
            console.log('user to update', this.user)
            axios.put(`/api/users/${this.user.id}`, this.user)
            .then(res=> console.log('update profile res :',res.data))
            .catch(err => console.log(err));
        }
    },
}
</script>

<style scoped>
.profileData{
    margin-top: 5rem;
    display: flex;
    align-items: center;
}
.profileImage{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.profileImage img{
    width: 300px;
    height: 300px;
    margin-bottom: 2rem;
}
.detailsProfile{
    margin-left: 7rem;
    display: flex;
    flex-wrap: wrap;
}
.detailsProfile .props{
    display: flex;
    flex-direction: column;
    margin-bottom: 3rem;
    margin-left: 1rem;
}
.detailsProfile .props label {
    color: #0000cd;
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 10px;
}
input{
    color: #000;
    font-size: 15px;
    font-weight: bold;
}
.buttons{
    margin-top: 7rem;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>