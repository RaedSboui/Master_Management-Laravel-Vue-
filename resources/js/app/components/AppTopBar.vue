<template>
	<div class="layout-topbar">
		<router-link to="/" class="layout-topbar-logo">
			<img alt="Logo" :src="topbarImage()" />
			<span>SAKAI</span>
		</router-link>
		<button class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle">
			<i class="pi pi-bars"></i>
		</button>

		<button class="p-link layout-topbar-menu-button layout-topbar-button"
			v-styleclass="{ selector: '@next', enterClass: 'hidden', enterActiveClass: 'scalein', 
			leaveToClass: 'hidden', leaveActiveClass: 'fadeout', hideOnOutsideClick: true}">
			<i class="pi pi-ellipsis-v"></i>
		</button>
		<!-- Profile menu -->
		<ul class="layout-topbar-menu hidden lg:flex origin-top">
			<li class="relative">
				<button class="p-link layout-topbar-button" @click="toggleProfileMenu" v-click-away="closeProfileMenu"  @keydown.escape="closeProfileMenu">
					<img class="w-10 h-10 rounded" :src="'/avatars/' + this.$store.state.user.image" alt="user_image">
				</button>
				<div v-if="isProfileMenuOpen" >
                    <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" 
                        class="absolute right-0 w-10rem p-2 mt-2 space-y-2 text-gray-600 bg-white border-0 border-bg-gray-700 shadow-2 dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                        aria-label="submenu"
                    >
                        <li class="flex">
                            <router-link :to="{name: 'Profile'}" class="inline-flex justify-content-between items-center w-full px-1 py-1 text-700 font-bold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-blue-300 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                <svg class="w-2 h-2 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Profile</span>
                            </router-link>
                        </li>
                        <li class="flex">
                            <a class="inline-flex justify-content-between items-center w-full px-1 py-1 text-700 font-bold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-blue-300 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="#">
                                <svg class="w-2 h-2 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a @click="logout" class="inline-flex justify-content-between items-center w-full px-1 py-1 text-700 font-bold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-blue-300 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="#">
                                <svg class="w-2 h-2 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" >
                                    <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
			</li>
		</ul>
	</div>
</template>

<script>
import axios from 'axios'

export default {
	data() {
		return {
			isProfileMenuOpen: false,
		}
	},
    methods: {
        onMenuToggle(event) {
            this.$emit('menu-toggle', event);
        },
		onTopbarMenuToggle(event) {
            this.$emit('topbar-menu-toggle', event);
        },
		topbarImage() {
			return this.$appState.darkTheme ? 'images/logo-white.svg' : 'images/logo-dark.svg';
		},
		toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen
        },
		closeProfileMenu() {
            this.isProfileMenuOpen = false
        },
        logout() {
            axios.post('/api/logout?token='+this.$store.state.token).then( res => this.$router.push('/login'))
            localStorage.removeItem('auth')
            localStorage.removeItem('user')
        }
    },
	computed: {
		darkTheme() {
			return this.$appState.darkTheme;
		}
	}
}
</script>