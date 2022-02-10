<template>
    <div>
        <home-header/>
        <study/>
        <news/>
        <neon-cube-animation/>
        <partners-certifications/>
        <app-footer/>
        <to-top/>
    </div>
</template>

<script>
import HomeHeader from '../components/client/Home/Header'
import Study from '../components/client/Home/Study'
import News from '../components/client/Home/News'
import NeonCubeAnimation from '../components/client/Home/NeonCubeAnimation'
import PartnersCertifications from '../components/client/Home/PartnersCertifications'
import AppFooter from '../components/client/Footer'
import ToTop from '../components/client/ToTop'

export default {
    components: {
        HomeHeader,
        Study,
        News,
        NeonCubeAnimation,
        PartnersCertifications,
        AppFooter,
        ToTop
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,700;1,200;1,300&display=swap');

* {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}

body{
    background: #fff;
}
</style>