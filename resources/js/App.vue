<template>
	<div v-if="this.$route.path.includes('/admin')" :class="containerClass" @click="onWrapperClick">
        <AppTopBar @menu-toggle="onMenuToggle" />
        <div class="layout-sidebar" @click="onSidebarClick">
            <AppMenu :model="menu" @menuitem-click="onMenuItemClick" />
        </div>

        <div class="layout-main-container">
            <div class="layout-main"> 
                <router-view />
            </div>
         <!--    <app-message/>-->
           <AppFooter />    
        </div>

		<AppConfig :layoutMode="layoutMode" @layout-change="onLayoutChange" />
        <transition name="layout-mask">
            <div class="layout-mask p-component-overlay" v-if="mobileMenuActive"></div>
        </transition>
	</div>
    <div v-else>
        <router-view />
    </div>
</template>

<script>
import AppMenu from './app/components/AppMenu.vue';
import AppTopBar from './app/components/AppTopBar.vue';
import AppConfig from './app/components/AppConfig.vue';
//import AppMessage from './app/components/AppMessage.vue';
import AppFooter from './app/components/AppFooter.vue';

export default {
    data() {
        return {
            layoutMode: 'static',
            staticMenuInactive: false,
            overlayMenuActive: false,
            mobileMenuActive: false,
            menu : []
        }
    },
    mounted() {
        this.menu = [
            {
                label: 'Dashboard',
                items: [
                    {
                        label: 'Home', icon: 'pi pi-fw pi-home', to: '/admin'
                    },
                    {
                        label: 'Masters', icon: 'fas fa-graduation-cap', to: '/admin/masters'
                    },
                    {
                        label: 'Diplomas', icon: 'far fa-address-card', to: '/admin/diplomas'
                    },
                    {
                        label: 'Establishments', icon: 'fas fa-university', to: '/admin/establishments'
                    },
                    {
                        label: 'Specialities', icon: 'fas fa-sitemap', to: '/admin/specialities'
                    },
                    {
                        label: 'Subjects', icon: 'far fa-clone', to: '/admin/subjects'
                    },
                    {
                        label: 'Admins', icon: 'pi pi-users', to: '/admin/admins'
                    },
                ]
            },
            {
                
                label: 'Settings',
                items: [
                    {
                        label: 'Improt Models', icon: 'pi pi-download',
                        items: [
                            {label: 'Masters', icon: 'pi pi-fw pi-bookmark', command: () => {window.location.href = "/imports/masters.xlsx"}},
                            {label: 'Diplomas', icon: 'pi pi-fw pi-bookmark', command: () => {window.location.href = "/imports/diplomas.xlsx"}},
                            {label: 'Establishments', icon: 'pi pi-fw pi-bookmark', command: () => {window.location.href = "/imports/establishments.xlsx"}},
                            {label: 'Specialities', icon: 'pi pi-fw pi-bookmark', command: () => {window.location.href = "/imports/specialities.xlsx"}},
                            {label: 'Subjects', icon: 'pi pi-fw pi-bookmark', command: () => {window.location.href = "/imports/subjects.xlsx"}},
                            {label: 'Admins', icon: 'pi pi-fw pi-bookmark', command: () => {window.location.href = "/imports/users.xlsx"}},
                            {label: 'Candidacies', icon: 'pi pi-fw pi-bookmark', command: () => {window.location.href = "/imports/candidacies.xlsx"}},
                        ]
                    },
                ]
            }
        ]
    },
    watch: {
        $route() {
            this.menuActive = false;
            this.$toast.removeAllGroups();
        }
    },
    methods: {
        onWrapperClick() {
            if (!this.menuClick) {
                this.overlayMenuActive = false;
                this.mobileMenuActive = false;
            }
            this.menuClick = false;
        },
        onMenuToggle() {
            this.menuClick = true;

            if (this.isDesktop()) {
                if (this.layoutMode === 'overlay') {
					if(this.mobileMenuActive === true) {
						this.overlayMenuActive = true;
					}

                    this.overlayMenuActive = !this.overlayMenuActive;
					this.mobileMenuActive = false;
                }
                else if (this.layoutMode === 'static') {
                    this.staticMenuInactive = !this.staticMenuInactive;
                }
            }
            else {
                this.mobileMenuActive = !this.mobileMenuActive;
            }

            event.preventDefault();
        },
        onSidebarClick() {
            this.menuClick = true;
        },
        onMenuItemClick(event) {
            if (event.item && !event.item.items) {
                this.overlayMenuActive = false;
                this.mobileMenuActive = false;
            }
        },
		onLayoutChange(layoutMode) {
			this.layoutMode = layoutMode;
		},
        addClass(element, className) {
            if (element.classList)
                element.classList.add(className);
            else
                element.className += ' ' + className;
        },
        removeClass(element, className) {
            if (element.classList)
                element.classList.remove(className);
            else
                element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        },
        isDesktop() {
            return window.innerWidth >= 992;
        },
        isSidebarVisible() {
            if (this.isDesktop()) {
                if (this.layoutMode === 'static')
                    return !this.staticMenuInactive;
                else if (this.layoutMode === 'overlay')
                    return this.overlayMenuActive;
            }

            return true;
        }
    },
    computed: {
        containerClass() {
            return ['layout-wrapper', {
                'layout-overlay': this.layoutMode === 'overlay',
                'layout-static': this.layoutMode === 'static',
                'layout-static-sidebar-inactive': this.staticMenuInactive && this.layoutMode === 'static',
                'layout-overlay-sidebar-active': this.overlayMenuActive && this.layoutMode === 'overlay',
                'layout-mobile-sidebar-active': this.mobileMenuActive,
				'p-input-filled': this.$primevue.config.inputStyle === 'filled',
				'p-ripple-disabled': this.$primevue.config.ripple === false,
                'layout-theme-light': this.$appState.theme.startsWith('saga')
            }];
        },
        logo() {
            return (this.$appState.darkTheme) ? "images/logo-white.svg" : "images/logo.svg";
        }
    },
    beforeUpdate() {
        if (this.mobileMenuActive)
            this.addClass(document.body, 'body-overflow-hidden');
        else
            this.removeClass(document.body, 'body-overflow-hidden');
    },
    components: {
        'AppTopBar': AppTopBar,
        'AppMenu': AppMenu,
        'AppConfig': AppConfig,
        //'AppMessage': AppMessage,
        'AppFooter': AppFooter,
    }
}
</script>
<style lang="scss">
@import './App.scss';
</style>

