<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Certificate System" />

    <div
    style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"

    class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative flex min-h-screen flex-col items-center justify-center selection:bg-blue-500 selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:col-start-2 lg:justify-center">
                        <!-- You can replace this with your certificate system logo -->
                        <h1 class="text-3xl font-bold text-blue-600">সনদ শাখা</h1>
                    </div>
                    <nav v-if="canLogin" class="flex flex-1 justify-end space-x-4">
    <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition duration-200 ease-in-out"
    >
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Dashboard
    </Link>

    <template v-else>
        <Link
            :href="route('login')"
            class="inline-flex items-center px-4 py-2 border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition duration-200 ease-in-out"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Log in
        </Link>

        <Link
            v-if="canRegister"
            :href="route('register')"
            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg shadow hover:from-blue-700 hover:to-blue-800 transition duration-200 ease-in-out"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            Register
        </Link>
    </template>
</nav>

                </header>

                <main class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <!-- Certificate Creation Card -->
                        <a
                            href="route('applicationForm')"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-lg transition hover:shadow-xl"
                        >
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-blue-100">
                                <svg class="size-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>

                            <div class="pt-3">
                                <h2 class="text-xl font-semibold text-black">সনদের আবেদন</h2>
                                <p class="mt-4 text-sm/relaxed">
                                    Generate new certificates for your students or employees. Customize templates and add digital signatures.
                                </p>
                            </div>
                        </a>

                        <!-- Certificate Verification Card -->
                        <a
                            href="/certificates/verify"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-lg transition hover:shadow-xl"
                        >
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-green-100">
                                <svg class="size-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>

                            <div class="pt-3">
                                <h2 class="text-xl font-semibold text-black">সনদ স্টাটাস চেক</h2>
                                <p class="mt-4 text-sm/relaxed">
                                    Verify the authenticity of certificates using our secure verification system.
                                </p>
                            </div>
                        </a>

                        <!-- Certificate Management Card -->
                        <a
                            href="/certificates/manage"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-lg transition hover:shadow-xl"
                        >
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-purple-100">
                                <svg class="size-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>

                            <div class="pt-3">
                                <h2 class="text-xl font-semibold text-black">ফলাফল অনুসন্ধান</h2>
                                <p class="mt-4 text-sm/relaxed">
                                    View, edit, and manage all your issued certificates in one place.
                                </p>
                            </div>
                        </a>

                        <!-- Template Library Card -->
                        <a
                            href="/certificates/templates"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-lg transition hover:shadow-xl"
                        >
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-yellow-100">
                                <svg class="size-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                            </div>

                            <div class="pt-3">
                                <h2 class="text-xl font-semibold text-black">মারহালাওয়ারী ফলাফল অনুসন্ধান</h2>
                                <p class="mt-4 text-sm/relaxed">
                                    Browse and customize our collection of professional certificate templates.
                                </p>
                            </div>
                        </a>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Certificate System v1.0
                </footer>
            </div>
        </div>
    </div>
</template>
