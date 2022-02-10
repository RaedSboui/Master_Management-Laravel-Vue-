<template>
    <section class="header">
        <nav :class="{active: isActive}">
            <div class="logo">
                <router-link :to="{ name: 'Home' }">
                    <img src="/images/client/logo.png" alt="university_logo">
                </router-link>
            </div>
            <div class="nav-links" id="navLinks">
                <ul class="navBar">
                    <li :class="{active : this.$route.path == '/'}">
                        <router-link :to="{ name: 'Home' }">
                            <a href="" :class="{active : this.$route.path == '/'}">home</a>
                        </router-link>
                    </li>

                    <li class="drop-down" :class="{active : this.$route.path.includes('/studies')}">
                        <a href="" :class="{active : this.$route.path.includes('/studies')}">studies</a>
                        <ul class="u-drop-down">
                            <li><a href="">unified license</a></li>
                            <li><a href="">engineering</a></li>
                            <li ><a href="">masters</a></li>
                            <li>
                                <router-link :to="{ name: 'MasterCandidacy' }">
                                    <a href="">master's candidacy</a>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                    <li class="drop-down" :class="{active : this.$route.path.includes('/research')}">
                        <a href="" :class="{active : this.$route.path.includes('/research')}">research</a>
                        <ul class="u-drop-down research">
                            <li class="drop-down2"><a href="">research structure</a>
                                <ul class="u-drop-down2">
                                    <li><a href="">Laboratory of Advanced Electronic Systems and Sustainable Energy</a></li>
                                    <li><a href="">New Technologies and Telecommunications Systems Unit</a></li>
                                    <li><a href="">Unit in Advanced Technologies for Image and Signal Processing</a></li>
                                </ul>
                            </li>
                            <li class="drop-down2"><a href="">doctorate in ICST</a>
                                <ul class="u-drop-down2">
                                    <li><a href="">description and news</a></li>
                                    <li><a href="">doctoral enrollment</a></li>
                                    <li><a href="">doctoral studies</a></li>
                                    <li><a href="">doctoral thesis</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li :class="{active : this.$route.path == '/news'}">
                        <router-link :to="{ name: 'News' }">
                            <a href="" :class="{active : this.$route.path == '/news'}">news</a>
                        </router-link>
                    </li>

                    <li :class="{active : this.$route.path == '/about'}">
                        <router-link :to="{ name: 'About' }">
                            <a href="" :class="{active : this.$route.path == '/about'}">about us</a>
                        </router-link>
                    </li>

                    <li :class="{active : this.$route.path == '/contact'}">
                        <router-link :to="{ name: 'Contact' }">
                            <a href="" :class="{active : this.$route.path == '/contact'}">contact</a>
                        </router-link>
                   </li>

                </ul>
            </div>
            <div class="humburgger" @click="toggleNavbar" v-click-away="closeNavbar">
                <div class="bar"></div>
            </div>
        </nav>
    </section>
</template>

<script>
export default {
    data(){
        return {
            isActive: false,
            navLInks: '',
        }
    },
    mounted() {
        this.navLInks = document.getElementById('navLinks')
    },
    methods: {
        toggleNavbar(){
            this.isActive = !this.isActive
        },
        closeNavbar() {
            this.isActive = false
        }
    }
}
</script>

<style lang="scss">
.header {
    width: 100%;
    min-height: 300px;
    background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)), url('/images/client/slide2.png'); 
    background-position: center;
    background-size: cover;
    position: relative;
    
    nav {
        display: flex;
        padding: 2% 6%;
        justify-content: space-between;
        align-items: center;
        .logo {
            width: 20vw;
            height: 15vh;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 6px solid #073772;

            img {
                width: 15vw;
                height: 10vh;
            }
        }
        
        .nav-links {
            flex: 1;
            text-align: right;
            text-transform: uppercase;

            .navBar{ 
                li{
                    list-style: none;
                    display: inline-block;
                    padding: 8px 12px;
                    position: relative;

                    a {
                        color: #fff;
                        text-decoration: none;
                        font-size: 23px;
                    }
                    &::after {
                        content: '';
                        width: 0%;
                        height: 2px;
                        background: #f36f21;
                        display: block;
                        margin: auto;
                        transition: .5s;
                    }
                    &:hover::after {
                        width: 100%;
                    }
                    .active{
                        border-bottom: 2px solid #f36f21;
                    }
                }
                .drop-down{
                    position: relative;

                    .u-drop-down {
                        position: absolute;
                        width: 200px;
                        height: 200px;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-around;
                        top: 41px;
                        border: 2px solid #073772;
                        background: #073772;
                        visibility: hidden;

                        li{
                            width: 100%;
                            height: 100%;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            color: #fff;
                            cursor: pointer;
                            
                            a{
                                font-size: 13px;
                            }
                            &:hover{
                                background: #2477ddcb;
                            }
                            &:hover a {
                                color: #f36f21;
                            }
                            &:hover::after {
                                width: 0%;
                            }
                        }
                    }
                    &:hover .u-drop-down{
                        visibility: visible;
                    }
                    .research{
                        height: 100px !important;

                        .drop-down2{
                            position: relative;

                            .u-drop-down2 {
                                position: absolute;
                                width: 200px;
                                height: 200px;
                                display: flex;
                                flex-direction: column;
                                justify-content: space-around;
                                top: -2px;
                                border: 2px solid #073772;
                                background: #073772;
                                visibility: hidden;
                                margin-left: 398px;

                                li{
                                    width: 100%;
                                    height: 100%;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    cursor: pointer;
                            
                                    a{
                                        font-size: 10px;
                                        text-align: left;
                                        color: #fff;
                                    }
                                    &:hover{
                                        background: #2477ddcb;
                                        a{
                                            color: yellowgreen;
                                        }
                                    }
                                
                                    &:hover::after {
                                        width: 0%;
                                    }
                                }
                            }
                            &:hover .u-drop-down2{
                                visibility: visible;
                            }
                        }
                    }
                }
            }
        }
        .humburgger{
            width: 4rem;
            height: 3rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            display: none;

            .bar{
                width: 2rem;
                height: 3px;
                border-radius: 2px;
                background-color: #fff;
                transition: .5s;
                position: relative;
                display: none;

                &::before, &::after{
                    content: "";
                    position: absolute;
                    width: inherit;
                    height: inherit;
                    background: #fff;
                    transition: .5s;
                }
                &::before{
                    transform: translateY(-9px);
                }
                &::after{
                    transform: translateY(9px);
                }
            }
        }
    }
}

@media (max-width: 1100px) {
    nav {
        padding: 2% 10px !important;
        .logo {
            width: 300px !important;
            height: 150px !important;
            img {
                width: 250px !important;
                height: 100px;
            }
        }
        .nav-links{
            height: 783.6px;
            width: 200px;
            right: 0;
            background: rgba(0, 0, 0, 0.589);
            margin-top: 92.8vh;
            position: absolute;
            z-index: 2;
            transition: 1s;
            border: 3px solid #073772 !important;
            display: none;

            .navBar {       
                display: flex;
                flex-direction: column;
                li{
                    width: 100%;
                    height: 100%;
                    display: flex !important;
                    justify-content: center !important;
                    align-items: center;
                    a{
                        color: #f36f21 !important;
                    }
                    &::after{
                        display: none !important;
                    }
                    .active{
                        border: none !important;
                    }
                    &:hover{
                        background: #f36f21;
                        a {
                            color: #fff !important;
                        }
                    }
                    .active{
                        border: none !important;
                    }
                }
                .active{
                    background:#f36f21;
                    a{
                        color: #fff !important;
                    }
                }
                .drop-down{
                    .u-drop-down{
                        right: 194px !important;
                        height: 25vh !important;
                        transform: translate(0%,-45%);
                        background: rgba(0, 0, 0, 0.589) !important;
                        border: 2px solid #f36f21 !important;

                        .u-drop-down2{
                            right: 196px !important;
                            border: 2px solid #2477ddcb !important;
                            transform: translate(0%,2px);

                            li:hover{
                                a{
                                    color: yellowgreen !important;
                                }
                            }
                        }
                    }
                }
            }
        }
        .humburgger{
            display: inline-flex !important;

            .bar{
                display: inline-flex !important;
            }
        }
    }
    nav.active{
        .nav-links{
            display: inline-flex;
        }
        .bar{
            transform: rotate(360deg);
            background-color: transparent !important;
            &::before{
                transform: rotate(45deg) !important;
            }
            &::after{
                transform: rotate(-45deg) !important;
            }
        }
    }
}


@media (max-width: 620px) {
    nav {
        .logo {
            width: 200px !important;
            height: 100px !important;
            img {
                width: 150px !important;
                height: 50px !important;
            }
        }
        .nav-links{
            width: 150px !important;
            .navBar {
                li{
                    a{
                        font-size: 15px !important;
                    }
                    .active{
                        border: none !important;
                    }
                }
                .active{
                    background:#f36f21;
                    a{
                        color: #fff !important;
                    }
                }
                .drop-down{
                    .u-drop-down{
                        width: 120px !important;
                        right: 144px !important;
                        li{
                            a{
                                font-size: 8px !important;
                            }
                        }
                        .u-drop-down2{
                            width: 120px !important;
                            right: 115px !important;
                            height: auto !important;
                            li:hover{
                                a{
                                    font-size: 8px !important;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>