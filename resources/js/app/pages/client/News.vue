<template>
    <div>
        <app-header/>
        <div style="height:600px">
            <h1>News</h1>
        </div>
        <app-footer/>
        <to-top/>
    </div>
</template>

<script>
import AppHeader from '../components/client/Header'
import AppFooter from '../components/client/Footer'
import ToTop from '../components/client/ToTop'

export default {
    components: {
        AppHeader,
        AppFooter,
        ToTop,
    }
}
</script>