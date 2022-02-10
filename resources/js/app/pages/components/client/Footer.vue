<template>
    <footer>
        <div class="footer">
            <div class="customer-service">
                <h4>Customer service</h4>
                <a href="">Contact us</a><br>
                <a href="">FAQ</a><br>
                <a href="">ENET'COM</a><br>
                <a href="">About us</a><br>
                <a href="">Deaf and hard of hearing access</a><br>
                <a href="">Order a certificate</a>
            </div>
            <div class="direct-links">
               <h4>Direct links</h4>
                <a href="">Configure</a><br>
                <a href="">Request a trial</a><br>
                <a href="">Request a brochure</a><br>
                <a href="">Discover all our studies</a><br>
                <a href="">Master programs</a>
            </div>
            <div class="stay-connected">
                <h4>Let's stay connected</h4>
                <div class="links">
                    <a  href="" target="_blank">
                        <i class="fab fa-facebook" style="color:#4267b2"></i>
                    </a>
                    <a  href="" target="_blank">
                        <i class="fab fa-twitter-square" style="color:#1da1f2"></i>
                    </a>
                    <a  href="" target="_blank">
                        <i class="fab fa-youtube" style="color: red"></i>
                    </a>
                    <a  href="" target="_blank">
                        <i class="fab fa-instagram" style="color: #d93175"></i>
                    </a>
                    <a  href="" target="_blank">
                        <i class="fas fa-envelope" style="color: red"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="FooterLegal">
            <div class="FooterLegal-element">
                <a href="">Legal information site</a>
                <div class="FooterVerticalLigne"></div>
                <a href="">Personal data</a>
                <div class="FooterVerticalLigne"></div>
                <a href="">Cookies</a>
                <div class="FooterVerticalLigne"></div>
                <a href="">enetcom.rnu.tn</a>
            </div>
            <span class="FooterLegal__copyright">© <!-- -->ENET'COM<!-- --> 2021 - 2022</span>
        </div>
        <hr>
    </footer>
</template>

<script>
export default {

}
</script>

<style lang="scss">
footer{
    background: #333;

    .footer{
        width: 100%;
        display: flex;
        justify-content:space-around;
        align-items: center;
        flex-shrink: 0;
        margin: auto auto;
        margin-top: 100px;
        font-family: "Libre Baskerville","Merriweather",sans-serif;
        font-size: 15px;

        h4{
            color: #f36f21;
        }
        a{
            text-decoration: none;
            font-family: "Avro",sans-serif;
            font-size: 14px;
            color: #fff;
            line-height: 1.5;
        }
        .stay-connected, .direct-links, .customer-service{
            height: 30vh;
            margin-top: 2rem;
        }
        .direct-links a, .customer-service a{
            position: relative;
            transition: all .2s ease-in-out;

            &::after{
                content: "";
                position: absolute;
                width: 100%;
                height: 1px;
                background: #f36f21;
                left: 0;
                bottom: 0;
                transform: scale(0,1);
                transform-origin: 0% 100%;
                transition: transform .4s ease;
            }
            &:hover:after{
                transform: scale(1,1);
            }
        }
        .stay-connected{
            .links{
                margin: 20px auto;
                height: 60px;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;

                i{
                    padding-right: 1rem;
                    padding-bottom: 1rem;
                }
            }
        }
        .fab, .fas{
            font-size: 25px;
            transition: all .1s ease-in-out;

            &:hover{
                font-size: 30px;
            }
        }
    }
    hr{
        margin: auto;
        width: 90vw;
    }
    .FooterLegal{
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        align-items: center;
        margin: 1rem auto;

        .FooterLegal-element{
            display: flex;

            a{
                text-decoration: none;
                color: #7c7979;
                font-size: 13px;
                font-family: "Avro",sans-serif;
                transition: all .4s ease-in-out;

                &:hover{
                    color:#f36f21;
                }
            }
            .FooterVerticalLigne{
                width: 1px;
                height: 12px;
                background: black;
                margin: auto 10px;
            }
        }
        span{
            font-family: 'Poppins';
            font-size: 14px;
            color: #7c7979;
        }
    }
}
</style>