<template>
<div class="chat"> 
    <div class="messageContainer" v-for="(discussion, index) in openDiscussion" :key="index">
        <div class="messageHeader">
            <span>{{discussion.user[0].firstName + " " + discussion.user[0].lastName}}</span>
            <div class="closeMessage">
                <span></span>
                <span @click="closeDiscussion(index)" class="closeDiscussion">X</span>
            </div>
        </div>
        <hr>
        <div class="messageContent" id="privateMessageBox">
            <messages-list :allMessages="discussion.messages"/>
        </div>
        <hr>
        <div class="messageFooter">
        <!--    <i class="fas fa-smile first"></i> -->
            <file-upload class="fileUpload" v-model="file"  
                ref='upload' 
                @input-file="$refs.upload.active = true"
                :post-action="'/api/messages/' + discussion.user[0].id"
                :headers="{ authorization: 'Bearer ' + this.$store.state.token }"
            >
                <i class="fas fa-paperclip second"></i>
            </file-upload>
        <!--    <input type="text" name="message" v-model="message.message" @keyup.enter="sendMessage"/>   -->
            <discord-picker
                input
                :value="message"
                gif-format="md"
                @update:value="message = $event"
                v-model="message" @keyup.enter="sendMessage(discussion.user[0].id)"
            />
            <i class="fas fa-paper-plane third"></i>
        </div>
    </div>
    <div class="users">
        <div class="usersheader">
            <p>Admins</p>
            <span v-if="isOpen"  @click="toggleAdminsList"><i  class="fas fa-angle-down"></i></span>
            <span v-else @click="toggleAdminsList"><i  class="fas fa-angle-up" ></i></span>
        </div>
        <div :class="isOpen ? '' : 'usersContent'">
            <!--
            <h6>Online</h6>
            <div v-for="user in onlineFriends" :key="user.id">
                <div class="user" @click="fetchMessages(user.id)">
                    <img :src="user.image" alt="">
                    <span>{{user.firstName + " " + user.lastName}}</span>
                </div>
            </div>
            <h6>Offline</h6>
            <div v-for="user in OfflineFriends" :key="user.id"> 
                <div class="user" @click="fetchMessages(user.id)">
                    <img src="/images/client/certif1.png" alt="" />
                    <span>{{user.firstName + " " + user.lastName}}</span>
                </div>
           </div>
           -->
           <div v-for="user in users" :key="user.id"> 
                <div class="user" @click="fetchMessages(user.id)">
                    <img :src="'/images/client/' + user.image" alt="" />
                    <span>{{user.firstName + " " + user.lastName}}</span>
                </div>
           </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import DiscordPicker from 'vue3-discordpicker'
import MessagesList from './MessagesList'

export default {
    data () {
        return {
            file: [],
            message: "",
            allMessages: [],
            users: [],
            friendID: null,
            activeFriend: [],
            onlineFriends: [],
            OfflineFriends: [],
            openDiscussion: [],      
            value: '',
            selectedGif: null,
            isOpen: false
        }
    },
    components: {
        MessagesList,
        DiscordPicker
        
    },
    created(){
        
        //let user = this.$store.state.user.id

        Echo.private(`chat2`)
            .listen('MessageSent',(e)=>{
                  console.log('pmessage sent', e)
                  this.friendID=e.message.user_id
                  this.allMessages.push(e.message)
                  setTimeout(this.scrollToEnd,100)
              })
    }, 
    mounted() {
        this.fetchUsers();
    },
    methods: {
        sendMessage(friendID)
        {
            if(this.message){
                axios.post('/api/messages/'+ friendID,  {message: this.message})
		            .then((res) => {
                        this.allMessages.push(res.data.message)
                        this.message = ""
                        setTimeout(this.scrollToEnd,100);
                    })
		            .catch((err) => console.log('Post Message Error: ',err))
            }
        },
        fetchMessages(friendId)
        {
            this.friendID = friendId
            this.activeFriend = this.users.filter(user => user.id === this.friendID)
            let checkDiscusssion = 0
            axios.get('/api/messages/' + friendId)
		        .then((res) => {
                    setTimeout(this.scrollToEnd,100);
                    this.allMessages = res.data
                    this.openDiscussion.map(discussion => {if(discussion.user[0].id === friendId) checkDiscusssion++})
                    console.log('check ', checkDiscusssion)
                    if(checkDiscusssion === 0) this.openDiscussion.push({user: this.users.filter(user => user.id === this.friendID), messages: res.data})
                    
                })
		        .catch((err) => console.log('Fetch Messages Error: ',err))
        },
        fetchUsers()
        {
            axios.get('/api/users')
		        .then((res) => {
                    this.users = res.data.users
                    //this.onlineFriends = this.users.filter(user => (user.isConnected && this.$store.state.user.id !== user.id))
                    //this.OfflineFriends.this.user.filter(user => !user.isConnected)
                })
		        .catch((err) => console.log('Fetch Users Error From MessageApp: ',err))
        },
        setEmoji (emoji) {
            console.log(emoji)
        },
        setGif (gif) {
            this.selectedGif = gif
        },
        setUpload () {
            console.log('open')
        },
        scrollToEnd(){
            window.scrollTo(0,99999);
            document.getElementById('privateMessageBox').scrollTo(0,99999);
        },
        closeDiscussion(index){
            this.openDiscussion = this.openDiscussion.filter((discussion, i) => i !== index)
        },
        toggleAdminsList(){
            this.isOpen = !this.isOpen 
        }
    },
}
</script>

<style lang="scss">
.chat{
    display: flex;
    justify-content: flex-end;
    align-items: flex-end;
    bottom: 0px;
    .messageContainer{
        width: 300px;
        margin-right: 10px;
        
        //height: 45px;
        border: 1px solid rgba(68, 67, 67, 0.274);
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;

        hr {
            margin: 0rem !important;
        }
        .messageHeader{
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background: #68BCFF;
            color: #fff;

            .closeMessage{
                width: 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 16px;

                .closeDiscussion{
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    padding: 2px;
                    width: 20px;
                    height: 20px;
                    border-radius: 50%;
                    &:hover{
                        background: #95afc0;
                    }
                }
            }
        }
        .messageContent{
            overflow-y:scroll;
            max-height: 300px !important;
        }
        .messageFooter{
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;

            input{
                border: 1px solid rgba(68, 67, 67, 0.274) !important;
                border-radius: 6px;
                height: 20px !important;
                &:focus{
                    outline: none !important;
                    box-shadow: 0 0 10px #719ece;
                }
            }
            .fileUpload{
                cursor: pointer !important;
            }
            .second{
                color: #000;
            }
            .third{
                color: #49aafa;
                cursor: pointer;
            }

            .vue3-emojipicker{
                margin-top: -13px !important;
                width: 240px !important;
                .w-4 {
                    width: 1rem !important;
                }
                .w-6 {
                    width: 1.5rem !important;
                }
                .w-8 {
                    width: 2rem !important;
                }
                .pr-4 {
                    padding-right: 1rem !important;
                }
                .mt-4 {
                    margin-top: 1rem !important;
                }
                .px-4 {
                    padding-left: 1rem !important;
                    padding-right: 1rem !important;
                }
                .pb-4 {
                    padding-bottom: 1rem !important;
                }
                .vue3-discord-emojipicker{
                    width: 300px !important;
                }
                .emojibutton__active .vue3-discord-emojipicker__emojibutton {
                    width: 22px;
                }
                .vue3-discordpicker__container{

                    .vue3-discordpicker__observe{
                        display: flex !important;
                    }
                }
            }
        }
    }
    .users{
        width: 150px;
        height: 100%;
        background: #95afc0;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        right: 0px !important;

        .usersheader{
            width: 150px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffbe76;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;

            i{
                cursor: pointer;
            }
        }
        .usersContent{
            display: none !important;
        }
        .user{
            padding: 5px;
            width: 100%;
            &:hover{
                background: #fab1a0;
            }
        }
    }
}
</style>