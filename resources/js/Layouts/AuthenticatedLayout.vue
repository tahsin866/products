<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const sidebarOpen = ref(false);
const dropdownOpen = ref({ products: false, orders: false });
</script>

<template>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside :class="{'hidden sm:block': !sidebarOpen}" class="bg-gray-800 text-white w-64 flex-shrink-0">
            <div class="h-16 flex items-center justify-center bg-gray-900 text-lg font-semibold">
                Product Management
            </div>
            <nav class="mt-4 space-y-2">
                <Link :href="route ('dashboard')" class="block px-4 py-2 hover:bg-gray-700">Dashboard</Link>
                <div>
                    <button
                        @click="dropdownOpen.products = !dropdownOpen.products"
                        class="w-full flex justify-between items-center px-4 py-2 hover:bg-gray-700"
                    >
                        Products
                        <svg
                            class="w-4 h-4 transition-transform"
                            :class="{'rotate-180': dropdownOpen.products}"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>
                    <div v-if="dropdownOpen.products" class="pl-6">
                        <Link :href="route('products')" class="block px-4 py-2 hover:bg-gray-700">All product</Link>

                        <Link href="#" class="block px-4 py-2 hover:bg-gray-700">Add Product</Link>
                    </div>
                </div>
                <div>
                    <button
                        @click="dropdownOpen.orders = !dropdownOpen.orders"
                        class="w-full flex justify-between items-center px-4 py-2 hover:bg-gray-700"
                    >
                        Orders
                        <svg
                            class="w-4 h-4 transition-transform"
                            :class="{'rotate-180': dropdownOpen.orders}"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>
                    <div v-if="dropdownOpen.orders" class="pl-6">
                        <Link href="#" class="block px-4 py-2 hover:bg-gray-700">All Orders</Link>
                        <Link href="#" class="block px-4 py-2 hover:bg-gray-700">Pending Orders</Link>
                    </div>
                </div>
                <Link href="#" class="block px-4 py-2 hover:bg-gray-700">Customers</Link>
                <Link href="#" class="block px-4 py-2 hover:bg-gray-700">Reports</Link>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <nav class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between items-center">
            <!-- Mobile Menu Toggle -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="sm:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 p-2 rounded-md"
            >
                <svg
                    class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>

            <!-- Logo -->
            <div class="flex items-center">
                <Link :href="route('dashboard')">
                    <ApplicationLogo class="h-9 w-auto text-gray-800 dark:text-gray-200" />
                </Link>
            </div>

            <!-- Notification and User Dropdown -->
            <div class="hidden sm:flex items-center space-x-4">
                <!-- Notification Icon -->
                <button
                    @click="openNotifications"
                    class="relative text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 p-2 rounded-md"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V11a6 6 0 10-12 0v3c0 .417-.152.816-.405 1.123L4 17h5m6 0a3 3 0 11-6 0m6 0H9"
                        />
                    </svg>
                    <!-- Notification Badge -->
                    <span
                        class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full"
                    >
                        3
                    </span>
                </button>

                <!-- Message Icon -->
                <button
                    @click="openMessages"
                    class="relative text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 p-2 rounded-md"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 8h10M7 12h8m-8 4h6M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"
                        />
                    </svg>
                    <!-- Message Badge -->
                    <span
                        class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-600 rounded-full"
                    >
                        5
                    </span>
                </button>

                <!-- User Dropdown -->
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 bg-white dark:bg-gray-800 border border-transparent text-sm leading-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                            >
                                {{ $page.props.auth.user.name }}
                                <svg
                                    class="-me-0.5 ms-2 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </span>
                    </template>
                    <template #content>
                        <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                    </template>
                </Dropdown>
            </div>
        </div>
    </div>
</nav>

            <main class="flex-1">
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
</style>
