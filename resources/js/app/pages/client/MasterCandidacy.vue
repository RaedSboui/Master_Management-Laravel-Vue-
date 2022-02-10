<template>
    <div>
        <app-header/>
        <div class="contentMaster" v-if="this.$route.path === '/studies/master/candidacy'">
            <div class="left-col1">
                <presentation/>
                <partners-certifications/>
            </div>
            <div class="right-col1">
                <h1>FIRST YEAR APPLICATION FOR MASTERS</h1>
                <div v-if="this.$store.state.masterCredentials">
                    <Message severity="info">You have received an email with your credentials</Message>
                </div>
                <div class="candidacy">
                    <div class="candidacyApplication">
                        <span>You have not yet completed your first year master's application for the year 2021/2022 ?</span>
                        <router-link :to="{name: 'NewMasterCandidacy'}"><button id="btn">candidacy application</button></router-link>
                    </div>
                    <master-form-connexion/>
                </div>
                <h1>Masters application</h1>
                <p>Students who wish to continue their graduate studies in the master's cycle at the National School of Electronics and Telecommunications of Sfax (<b>ENET'</b><b>COM</b>) can apply for the following master's degrees by setting their priority:</p>
                <div class="sectionsNav">
	                <ul>
                        <li>
		                    <h5><a href="#mastersList">Masters lists</a></h5>
		                </li>
		                <li>
		                    <h5><a href="#applicationCondition">Application conditions</a></h5>
		                </li>
		                <li>
		                    <h5><a href="#importantDates">Important dates</a></h5>
		                </li>
		                <li>
		                    <h5><a href="#admissionFile">The admission file includes the following documents</a></h5>
		                </li>
		                <li>
		                    <h5><a href="#selectionCriteria">Selection criteria</a></h5>
		                </li>
	                </ul>
                </div>
                <masters-application/>
            </div>
        </div>
        <router-view v-else/>
        <app-footer/>
        <to-top/>
    </div>
</template>

<script>
import AppHeader from '../components/client/Header'
import Presentation from '../components/client/Presentation'
import PartnersCertifications from '../components/client/PartnersCertifications'
import MasterFormConnexion from '../components/client/Studie/MasterCandidacy/MasterFormConnexion'
import MastersApplication from '../components/client/Studie/MasterCandidacy/MastersApplication'
import AppFooter from '../components/client/Footer'
import ToTop from '../components/client/ToTop'


export default {
    data() {
        return {
            masterCredentials: null,
        }
    },
    components: {
        AppHeader,
        Presentation,
        PartnersCertifications,
        MasterFormConnexion,
        MastersApplication,
        AppFooter,
        ToTop,
    },
    mounted()
    {
        window.mitt.on('masterCredentials', data => console.log('this.masterCredentials =', data))
    }
}
</script>

<style lang="scss">
.contentMaster{
    display: flex;
    justify-content: center;
    margin: 5rem;
    min-height: 70vh;

    .left-col1{
        max-width: 300px;
        display: flex;
        flex-direction: column;
    }
    .right-col1{
        margin-left: 6rem;
        max-width: 900px;
        h1{
            color: #f36f21;
            margin-bottom: 5rem;
        }
        .candidacy{
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            .candidacyApplication{
                display: flex;
                flex-direction: column;
                align-items: center;
                color: #fff;

                span{
                    max-width: 300px !important;
                    padding: 20px;
                    border: 2px solid yellowgreen;
                    background: #6ab04c;
                }
                #btn{
                    font-family: "Saira";
                    position: relative;
                    padding: 20px 32px;
                    font-size: 12px;
                    font-weight: 700;
                    letter-spacing: 4px;
                    color: yellowgreen;
                    border: 2px solid yellowgreen;
                    text-transform: uppercase;
                    z-index: 1;
                    cursor: crosshair !important;
                    transition: 0.8s ease-out;
                    display: block;
                    background: none;
                    outline: none;
                    overflow: hidden;
                    margin-top: 5rem ;

                    &:before {
                        content: "";
                        position: absolute;
                        background: yellowgreen;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        top: 100%;
                        z-index: -1;
                        transition: top 0.8s ease-out;
                    }

                    &:hover {
                        color: #fff;
                        &:before {
                            top: 0%;
                        }
                    }
                }
            }
        }
        > h1:nth-of-type(2){
            margin-top: 5rem;
            margin-bottom: 1rem !important;
        }
        > p:nth-of-type(1){
            text-align: justify;
            > b:nth-of-type(1){
                color: #f36f21;
            }
            > b:nth-of-type(2){
                color: #073772;
            }
        }
        .sectionsNav{
            width: 100%;
            padding: 20px;
            background: #073772;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2rem;

            ul{
                display: flex;
                align-items: center;
                justify-content: space-around;
                flex-wrap: wrap;

                li{
                    text-decoration: underline;
                    color: #fde9ac;
                    margin: auto 20px;
                    a{
                        color: #fde9ac;
                    }
                    &:hover {
                        text-decoration: none !important;
                        color: #00a8ff !important;
                        a{
                            color: #00a8ff !important;
                        }
                    } 
                }
            }
        }
    }
}


@media(max-width: 1223px){
    .right-col1{
        margin-left: 4rem;
        max-width: 900px;
        h1{
            font-size: 2rem;
            margin-bottom: 5rem;
        }
        .candidacy .candidacyApplication{
            margin-bottom: 3rem;
            #btn{
                margin-top: 2rem !important
            }
        }
    }
}

    @media(max-width: 1110px){
        .contentMaster{
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            margin-top: 0px;
            margin-left: 0px; 

            .left-col{
                max-width: 600px !important;
            }
            .right-col1{
                max-width: 100vw !important;
                h1{
                    margin-top: 3rem;
                }
            }
        }
    }

@media(max-width: 890px){
    .contentMaster{
        .right-col{
            > div:nth-of-type(1){
                margin-top: -33rem !important;
            }
        }
    }
}

@media(max-width: 790px){
    .contentMaster{
        .right-col{
            h1{
                   font-size: 1rem !important;
            }
            > div:nth-of-type(1){
                margin-top: -38rem !important;
            }
            .sectionsNav{
                ul{
                    flex-direction: column !important;
                }
            }
        }
        .right-col1{
            h1{
                   font-size: 1.5rem !important;
            }
        }
    }
}
@media(max-width: 550px){
    .contentMaster{
        justify-content: center !important;
        margin: 1rem !important;
        margin-top: 0px !important;

        .right-col1{
            margin-left: 0px !important;
        }
    }
}
</style>