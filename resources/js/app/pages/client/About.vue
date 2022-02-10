<template>
    <div>
        <app-header/>
        <div class="content">
            <div class="left-col">
                <presentation/>
               <partners-certifications/>
            </div>
            <div class="right-col">
                <h1>ENET'COM PRESENTATION</h1>
                <iframe name="fde15cb66d201" data-testid="fb:video Facebook Social Plugin" class="w-12"
                    title="fb:video Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" 
                    scrolling="no" allow="encrypted-media" 
                    src="https://www.facebook.com/v8.0/plugins/video.php?app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df739ff87878e9c%26domain%3Denetcom.rnu.tn%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fenetcom.rnu.tn%252Ff11ee3852794e84%26relation%3Dparent.parent&amp;container_width=868&amp;href=https%3A%2F%2Fwww.facebook.com%2FENETComofficielle%2Fvideos%2F315846849532121%2F&amp;locale=fr_FR&amp;sdk=joey&amp;show_text=false&amp;width=" 
                    >
                </iframe>
                <div>
                    <i class="pi pi-fw pi-arrow-right"></i>
                    <span style="text-align: justify;line-height:20pt">&nbsp;&nbsp;For the academic year <strong>2020/2021</strong>, ENET'Com has&nbsp;
                    <span style="color:#ff0000;">123</span>&nbsp;permanent research professors providing training and supervision for these students, including&nbsp;
                    <span style="color:#ff0000;">14</span>&nbsp;Professors,&nbsp;&nbsp;<span style="color:#ff0000;">12</span>&nbsp;Lecturers,&nbsp;
                    <span style="color:#ff0000;">78</span>&nbsp;Assistant Masters (including&nbsp;<span style="color:#ff0000;">5</span>&nbsp;authorized),&nbsp;
                    <span style="color:#ff0000;">7</span>&nbsp;Assistants and&nbsp;<span style="color:#ff0000;">9</span>&nbsp;PES. Several other employees also participate in the training :&nbsp;
                    <span style="color:#ff0000;">3</span>&nbsp;seconded from secondary education,&nbsp;<span style="color:#ff0000;">18</span>
                        &nbsp;contract workers and&nbsp;<span style="color:#ff0000;">15</span>&nbsp;Experts and around 50 temporary staff.
                    </span>
                </div>
                <div>
                    <i class="pi pi-fw pi-arrow-right"></i>
                    <span style="text-align: justify;">&nbsp;&nbsp;For the academic year <strong>2020/2021</strong>, around&nbsp;
                    <span style="color:#ff0000;">1071</span> students&nbsp;are enrolled in the different engineering
                    (<span style="color:#ff0000;">661</span>), license (<span style="color:#ff0000;">156</span>), professional masters
                    (<span style="color:#ff0000;">114</span>), research masters (<span style="color:#ff0000;">42</span>) and doctorate 
                    (<span style="color:#ff0000;">98</span>) streams.</span>
                </div>
                <p>
                    <i class="pi pi-fw pi-arrow-right"></i>
                    <span style="text-align: justify;">&nbsp;&nbsp;Administrative staff of
                    <span style="color:#ff0000;">42</span> people</span>
                </p>
            </div>
        </div>
        <app-footer/>
        <to-top/>
    </div>
</template>

<script>
import AppHeader from '../components/client/Header'
import AppFooter from '../components/client/Footer'
import ToTop from '../components/client/ToTop'
import Presentation from '../components/client/Presentation'
import PartnersCertifications from '../components/client/PartnersCertifications'

export default {
    components: {
        AppHeader,
        AppFooter,
        ToTop,
        Presentation,
        PartnersCertifications,
    }
}
</script>

<style lang="scss">
.content{
    display: flex;
    justify-content: center;
    margin: 5rem;
    min-height: 70vh;

    .left-col{
        max-width: 300px;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }
    .right-col{
        margin-left: 4rem;
        max-width: 900px;

        h1{
            color: #f36f21;
            margin-bottom: 3rem;
        }
        > div:nth-of-type(1){
            margin-top: -19rem;
        }
        div{
            margin-bottom: 1rem;
            text-align: justify;
            .pi-arrow-right{
                color: #073772;
            }
        }
        iframe{
            height: 100%;
            .svg{
                height: 100% !important;
            }
        }
    }
}

@media(max-width: 1410px){
    .right-col{
        > div:nth-of-type(1){
            margin-top: -19rem !important;
        }
    }
}

@media(max-width: 1310px){
    .right-col{
        > div:nth-of-type(1){
            margin-top: -23rem !important;
        }
    }
}

@media(max-width: 1210px){
    .right-col{
        > div:nth-of-type(1){
            margin-top: -28rem !important;
        }
    }
}

@media(max-width: 1110px){
    .content{
        flex-direction: column;
        justify-content: start;
        align-items: center;
        margin-top: 0px;

        .left-col{
            max-width: 100vw !important;
            margin-left: 20px;
        }
        .right-col{
            margin-left: 0px !important;

            h1{
                margin-top: 3rem;
            }
            > div:nth-of-type(1){
                margin-top: -27rem !important;
            }
            iframe{
                height: 900px;
                ._3fnx {
                    height: 900px !important;
                }
            }
        }
    }
}

@media(max-width: 890px){
    .content{
        .right-col{
            > div:nth-of-type(1){
                margin-top: -33rem !important;
            }
        }
    }
}

@media(max-width: 790px){
    .content{
        .right-col{
            > div:nth-of-type(1){
                margin-top: -38rem !important;
            }
        }
    }
}

@media(max-width: 690px){
    .content{
        margin: 2rem;
        .right-col{
            > div:nth-of-type(1){
                margin-top: -39rem !important;
            }
        }
    }
}

@media(max-width: 510px){
    .content{
        margin: 1rem;
        .right-col{
            h1{
                font-size: 22px;
            }
            > div:nth-of-type(1){
                margin-top: -52rem !important;
            }
            div{
                font-size: 13px;
            }
            iframe{
                height: 1000px;
                ._3fnx {
                    height: 1000px !important;
                }
            }
        }
    }
}
</style>