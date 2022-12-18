<script setup>
import {computed, ref} from 'vue';
import ApplicationMenu from '@/Components/AppMenu.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Sidebar from 'primevue/sidebar';
import { onUnmounted, onMounted } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
const openNav = ref(false);
const escape = (evt)  => {
    if (openNav.value && evt.code === 'Escape') {
        openNav.value = false;
    }
}
const menus = computed(() => {
    return  usePage().props.value.auth.menus ?? [];
});

onMounted(() => {
    console.log(usePage().props.value)
    window.addEventListener('keydown', escape );
})

onUnmounted(() => {
    window.removeEventListener('keydown', escape )
})
</script>
<template>
    <div id="body">
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <ApplicationMenu class="block h-9 w-auto"  @click="openNav = !openNav"/>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
        <Sidebar v-model:visible="openNav" position="full">
            <aside class=""  >
                <div class="max-w-10xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <ul  class="menu  grid md:grid-cols-4 md:gap-4 gap-1 justify-evenly px-0" >
                        <li v-for=" menu in menus" class=" py-6 bg-sky-500/75">
                            <ul class="px-2">
                                <li >
                                    <label>
                                        {{menu.label}}
                                    </label>
                                </li>
                                <li class="sub-menu">
                                    <ol >
                                        <li  v-for=" action in menu.actions" class="py-2">
                                            <Link v-if="action.type='redirect'" :href="route(action.route)">
                                                <label>{{action.label}}</label>
                                            </Link>

                                        </li>
                                    </ol>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </aside>

        </Sidebar>
    </div>
</template>
<style lang="sass">
#body
    width: 100vw


ul
    list-style: none
</style>
