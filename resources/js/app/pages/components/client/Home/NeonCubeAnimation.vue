<template>
    <section class="animation">
        <div class="cube1">
            <div class="top"><img src="images/client/logo.png"></div>
            <div>
                 <span style='--i: 0'></span>
                <span style='--i: 1'></span>
                <span style='--i: 2'></span>
                <span style='--i: 3'></span>
            </div>
        </div>
        <div class="cube2">
            <div class="top"><img src="images/client/whiteLogo.png"></div>
            <div>
                <span style='--i: 0'></span>
                <span style='--i: 1'></span>
                <span style='--i: 2'></span>
                <span style='--i: 3'></span>
            </div>
        </div>
        <div class="cube3">
            <div class="top"><img src="images/client/logo.png"></div>
            <div>
                <span style='--i: 0'></span>
                <span style='--i: 1'></span>
                <span style='--i: 2'></span>
                <span style='--i: 3'></span>
            </div>
        </div>
    </section>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.animation{
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: 250px;
    width: 100%;
    background: #000;

    .cube1 {
        position: relative;
        width: 100px;
        height: 100px;
        transform-style: preserve-3d;
        transform: rotateX(-30deg);
        animation: animate 4s linear infinite;

        @keyframes animate {
            0%{
                transform: rotateX(-30deg) rotateY(0deg);
            }
            100%{
                transform: rotateX(-30deg) rotateY(360deg);
            }
        }

        .top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            background: #222;
            transform: rotateX(90deg) translateZ(50px);
            img{
                width: 100px;
                height: 100px;
            }

            &::before{
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100px;
                height: 100px;
                background:#0e0;
                transform: translateZ(-150px);
                filter: blur(20px);
                box-shadow: 0 0 120px rgba(0,255,0, 0.2),
                            0 0 200px rgba(0,255,0, 0.4),
                            0 0 300px rgba(0,255,0, 0.6),
                            0 0 400px rgba(0,255,0, 0.8),
                            0 0 500px rgba(0,255,0, 1);
            }
        }
        div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;

            span {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(#151515, #00ec00);
                transform: rotateY(calc(90deg * var(--i))) translateZ(50px);
            }
        }
    }
    .cube2 {
        position: relative;
        width: 100px;
        height: 100px;
        transform-style: preserve-3d;
        transform: rotateX(-30deg);
        animation: animate 4s linear infinite;

        @keyframes animate {
            0%{
                transform: rotateX(-30deg) rotateY(0deg);
            }
            100%{
                transform: rotateX(-30deg) rotateY(360deg);
            }
        }

        .top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            background: #222;
            transform: rotateX(90deg) translateZ(50px);
            img{
                width: 100px;
                height: 100px;
            }

            &::before{
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100px;
                height: 100px;
                background:#f00;
                transform: translateZ(-150px);
                filter: blur(20px);
                box-shadow: 0 0 120px rgba(255,0,0, 0.2),
                0 0 200px rgba(255,0,0, 0.4),
                0 0 300px rgba(255,0,0, 0.6),
                0 0 400px rgba(255,0,0, 0.8),
                0 0 500px rgba(255,0,0, 1);
            }
        }
        div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;

            span {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(#151515, #f00);
                transform: rotateY(calc(90deg * var(--i))) translateZ(50px);
            }
        }
    }
    .cube3 {
        position: relative;
        width: 100px;
        height: 100px;
        transform-style: preserve-3d;
        transform: rotateX(-30deg);
        animation: animate 4s linear infinite;

        @keyframes animate {
            0%{
                transform: rotateX(-30deg) rotateY(0deg);
            }
            100%{
                transform: rotateX(-30deg) rotateY(360deg);
            }
        }

        .top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            background: #222;
            transform: rotateX(90deg) translateZ(50px);
            img{
                width: 100px;
                height: 100px;
            }

            &::before{
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100px;
                height: 100px;
                background:#0ff;
                transform: translateZ(-150px);
                filter: blur(20px);
                box-shadow: 0 0 120px rgba(0,216,255, 0.2),
                0 0 200px rgba(0,216,255, 0.4),
                0 0 300px rgba(0,216,255, 0.6),
                0 0 400px rgba(0,216,255, 0.8),
                0 0 500px rgba(0,216,255, 1);
            }
        }
        div {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;

            span {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(#151515, #0ff);
                transform: rotateY(calc(90deg * var(--i))) translateZ(50px);
            }
        }
    }
}
</style>