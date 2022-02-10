<template>
    <a href="#" class="to-top">
        <i class="fas fa-chevron-up"></i>
    </a>
</template>

<script>
export default {
    mounted() {
        const toTop = document.querySelector(".to-top");
        window.addEventListener("scroll",()=>{
            if(window.pageYOffset > 300){
                toTop.classList.add("active");
            }
            else {
                toTop.classList.remove("active");
            }
        })
    }
}
</script>

<style lang="scss">
.to-top{
    position: fixed;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    bottom: 16px;
    right: 32px;
    text-decoration: none;
    color: #fff;
    background: #f36f21;
    opacity: 0;
    pointer-events: none;
    transition: all .4s ease;
}
.to-top.active{
    bottom: 32px;
    opacity: 1;
    pointer-events:auto;
}
</style>