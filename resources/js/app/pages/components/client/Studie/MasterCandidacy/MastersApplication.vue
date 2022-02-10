<template>
    <div class="mastersApplication">
        <div id="mastersList">
            <h4>Masters lists :</h4>
            <ul>
                <router-link to="" v-for="(master) in masters" :key="master.id">{{master.title}}</router-link>
            </ul>
        </div>
        <div id="applicationCondition">
            <h4>Application conditions :</h4>
            <p>Students authorized to apply must have:</p>
            <div>  
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <span>A license or equivalent diploma or an engineering diploma for professional masters</span>
                </p>
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <span>A license or equivalent diploma or an engineering diploma for professional mastersA bachelor's degree, an engineering degree, a professional master's degree or an equivalent degree for the research master.</span>
                </p>
            </div>
        </div>
        <div id="importantDates">
            <h4>Important dates</h4>
            <div>  
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <span>Opening of the application site :  <b>July 19, 2021</b></span>
                </p>
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <span>Last application deadline :  <b>August 9, 2021</b></span>
                </p>
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <span>On-site display of the list of preselected candidates in the first phase :  <b>August 16, 2021</b></span>
                </p>
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <span>Submission of the paper file :  by mail from <b>August 16, 2021</b> to <b>August 24, 2021</b></span>
                </p>
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <span>Posting on site of the list of candidates accepted in the final phase :  <b>September 10, 2021</b></span>
                </p>
                <p>
                    <i class="fas fa-arrow-alt-circle-right"></i>
                    <span>Last registration deadline for selected candidates :  <b>September 24, 2021</b></span>
                </p>
            </div>
        </div>
        <div id="admissionFile">
            <h4>The admission file includes the following documents</h4>
            <div>
                <p>
                    <i class="pi pi-fw pi-arrow-circle-right"></i>
                    <span>The form to print, after having completed and submitted it through the site.</span>
                </p>
                <p>
                    <i class="pi pi-fw pi-arrow-circle-right"></i>
                    <span>A copy of the Baccalaureate diploma and a copy of the transcript, certified as true to the original.</span>
                </p>
                <p>
                    <i class="pi pi-fw pi-arrow-circle-right"></i>
                    <span>A certified copy of the original of the diplomas obtained.</span>
                </p>
                <p>
                    <i class="pi pi-fw pi-arrow-circle-right"></i>
                    <span>A certified copy of the original of all the transcripts obtained, including those for repetition years.</span>
                </p>
                <p>
                    <i class="pi pi-fw pi-arrow-circle-right"></i>
                    <span>A copy of the national identity card.</span>
                </p>
                <p>
                    <i class="pi pi-fw pi-arrow-circle-right"></i>
                    <span>2 recent passport photos.</span>
                </p>
            </div>
        </div>
        <div id="press">
            <p>To request additional information you can send an email : <span> candidature.master.enetcom@gmail.com</span></p>
            <p>Sending of the paper file made up to ENET'Com :</p>
            <p>The paper files of the shortlisted candidates must be put in an envelope on which you mention the application number and sent to ENET'Com by post at the following address: </p>
            <p>National School of Electronics and Telecommunications of Sfax B.P.: 1163 - Sfax: 3018.</p>
        </div>
        <div id="selectionCriteria">
            <h4>Selection criteria</h4>
            <div>
                <a href="" target="_blank" rel="noopener noreferrer">(see SCORE file)</a>
            </div>
        </div>
    </div>
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
    .mastersApplication{
        width: 100%;
        h4{
            color: #ff9515;
            margin-top: 2rem;
            &::after {
                content: '';
                width: 100%;
                height: 1px;
                background: #ff9515;
                display: block;
            }
        }
        ul{
            display: flex;
            flex-direction: column;
            margin-left: 2rem;
            .router-link-active{
                padding: 10px 20px;
                margin-bottom: 5px;
                color: #0000cd;
                border-top: thin #ccc dotted;
                border-bottom: 1px #ccc dotted;
                &:hover{
                    background: #ccc;
                }
            }
        }
        #applicationCondition, #importantDates, #admissionFile, #selectionCriteria{
            text-align: justify;
            div{
                margin-left: 2rem;
                p{
                    display: flex;
                    align-items: flex-start;
                    span{
                        margin-left: 1rem;
                    }
                }
            }
        }
        #importantDates{
            div{
                > p:nth-of-type(5), > p:nth-of-type(6){
                    b{
                        color: red !important;
                    }
                }
        
                b{
                    color: rgb(102, 101, 101);
                    font-size: 12px;
                }
            }
        }
        #admissionFile{
            i{
                color: #ff9515;
            }
        }
        #press{
            width: 100%;
            background: #6ab04c;
            border: 2px solid yellowgreen; 
            margin: 2rem auto;
            padding: 2rem;
            
            p{
                color: #fff;
            }
            > p:nth-of-type(3){
                color: #000;
            }
            > p:nth-of-type(4){
                text-align: center;
                color: #EEE685;
                font-size: 16px;
            }
            
            span{
                color: #0000cd;
            }
        }
        #selectionCriteria{
            a{
                font-size: 14px;
                font-weight: bold;
                color: #073772;
                &:hover{
                    color: #f36f21;
                }
            }
        }
    }
</style>