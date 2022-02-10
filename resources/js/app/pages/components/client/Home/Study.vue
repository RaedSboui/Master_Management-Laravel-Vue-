<template>
    <section class="studies">
        <h1>Studies We Offer</h1>
        <p>Lorem ipsum  </p>
        <div class="row">
            <div class="study-col">
                <h3>Fundamental licence</h3>
                <p>
                    <i class="pi pi-angle-right"></i>
                    <a href="">FL-ICST: Information and Communication Sciences and Technologies</a>
                </p>
                <h3>Research Master</h3>
                <p>
                    <i class="pi pi-angle-right"></i>
                    <a href="">RM-ICST: Information and Communication Sciences and Technologies</a>
                </p>
            </div>
            <div class="study-col">
                <h3>Engineers studies</h3>
                <p>
                    <i class="pi pi-angle-right"></i>
                    <a href="">Electronic Systems and Communication Engineering (ECE)</a>
                </p>
            </div>
            <div class="study-col">
                <h3>Professional Masters</h3>
                <p v-for="(master) in masters" :key="master.id">
                    <i class="pi pi-angle-right"></i>
                    <a href="">{{master.title}}</a>
                </p>
            </div>
            <div class="study-col">
                <h3>Doctoral studies</h3>
                <p>
                    <i class="pi pi-angle-right"></i>
                    <a href="">Electronic Systems and Communication Engineering (ECE)</a>
                </p>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            masters: null
        }
    },
    mounted() {
        axios.get('/api/front/masters').then( res => {
            this.masters =  res.data.masters
        })
    },
}
</script>

<style lang="scss">
.studies{
    width: 100%;
    margin: auto;
    text-align:center;
    padding-top: 100px;

    h1{
        font-size: 36px;
        font-weight: 600;
        color: #436792;
        text-transform: uppercase;
        //margin-top: 5rem;

        &::after {
            content: '';
            width: 10%;
            height: 1px;
            background: #073772;
            display: block;
            margin: auto;
        }
    }
    p{
        font-size: 14px;
        font-weight: 300;
        line-height: 22px;
        padding: 10px;
    }
    .row{
        margin-top: 5%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;   

        .study-col{
            width: 280px;
            height: 400px;
            background: #efefef;
            border-radius: 10px;
            margin: 20px;
            margin-bottom: 5%;
            padding: 20px 8px;
            box-sizing: border-box;
            border: double 5px transparent;
            box-shadow: inset -10px -10px 80px 1px rgba(0, 0, 0, 0.3), 10px 20px 50px 10px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            animation-name: turn-animation;
            animation-duration: 6000ms; 
            animation-iteration-count: infinite;
            transition-timing-function: cubic-bezier(0.42, 0, 0.58, 1);

            @keyframes turn-animation {
                0%, 100% {
                    transform: rotate3d(0, 1, 0, 10deg);
                }
                50% {
                    transform: rotate3d(0, 1, -0.2, 45deg);
                }
            }
            &:hover{
                border: double 5px #EEE685;
                animation-duration: 0s;
            }

            h3{
                text-align: center;
                font-weight: 600;
                color: #f36f21;
                margin: 10px 0;
            }
            
            p{
                text-align: left;
                margin: 0 !important;
            }
            .pi{
                color: #f36f21;
                font-size: 20px;
            }
            a{
                text-decoration: none;
                color: #000;
                font-size: 14px;
                font-weight: 400;

                &:hover{
                    color: #1e4daa;
                }
            }
        }
    }
}


@media (max-width: 700px) {
    .studies{
        .row{
            flex-direction: column;
        }
    } 
}
</style>