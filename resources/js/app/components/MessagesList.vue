<template>
    <div>
        <div  v-for="(message, index) in allMessages" :key="index" class="messageDisplay" :class="(this.$store.state.user.id===message.user_id)?'right':'left'">
            <span class="small font-italic">{{message.user?.firstName + ' ' + message.user?.lastName}}</span>
            <p v-if="message.message" class="message" :class="(this.$store.state.user.id===message.user_id)?'green':'red'">
                {{message.message}}
            </p>
            <img v-if="message.file"  :src="'/chat/'+message.file" alt="">
            <span class="small font-italic">{{message.created_at}}</span>
        </div>
    </div>
</template>

<script>
  export default {
    props:['allMessages'],
  }
</script>

<style lang="scss">
.messageDisplay{
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    .message{
        color: #fff;
        padding: 5px;
        border-radius: 10px;
    }
   .red{
        background: red !important;
    }
    .green{
        background: green !important;
    }
    img{
        width: 150px;
        height: 100px
    }
}
.right {
    align-items: flex-end;
}
.left {
    align-items: flex-start;
}

</style>