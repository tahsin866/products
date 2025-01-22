<template>
    <AuthenticatedLayout>
    <!-- Stats Cards Grid -->
    <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
         class="p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Students Card -->
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl p-6 border border-purple-100 hover:shadow-lg transition-all duration-300">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-baseline space-x-2">
                        <h4 class="text-4xl font-bold text-purple-900">{{ props.studentCount }}</h4>
                        <span class="text-purple-600 text-sm font-semibold">মোট</span>
                    </div>
                    <p class="text-purple-900 font-medium">মোট ছাত্র-ছাত্রী</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 border border-blue-100 hover:shadow-lg transition-all duration-300">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-baseline space-x-2">
                        <h4 class="text-4xl font-bold text-blue-900">{{ props.maleCount }}</h4>
                        <span class="text-blue-600 text-sm font-semibold">জন</span>
                    </div>
                    <p class="text-blue-900 font-medium">ছাত্র সংখ্যা</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-blue-100">

            </div>
        </div>
            <!-- Female Students Card -->
            <div class="bg-gradient-to-br from-pink-50 to-white rounded-2xl p-6 border border-pink-100 hover:shadow-lg transition-all duration-300">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-baseline space-x-2">
                        <h4 class="text-4xl font-bold text-pink-900">{{ props.femaleCount }}</h4>
                        <span class="text-pink-600 text-sm font-semibold">জন</span>
                    </div>
                    <p class="text-pink-900 font-medium">ছাত্রী সংখ্যা</p>
                </div>
                <div class="bg-pink-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-pink-100">

            </div>
        </div>


        <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-6 border border-emerald-100 hover:shadow-lg transition-all duration-300">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-baseline space-x-2">
                        <h4 class="text-4xl font-bold text-emerald-900">{{ yearCount }}</h4>
                        <span class="text-emerald-600 text-sm font-semibold">জন</span>
                    </div>
                    <p class="text-emerald-900 font-medium">{{ selectedYear }} সালের মোট</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-emerald-100">

            </div>
        </div>
        <!-- Similar cards for Male, Female, and Year Total -->
        <!-- ... other cards remain the same ... -->
    </div>

    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="bg-white shadow-xl rounded-xl p-6">
            <!-- Filter Section -->
            <div class="bg-white shadow-xl rounded-xl mb-6">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">ফিল্টার অপশন</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <!-- Year Select -->
                        <select v-if="years.length > 0"
                            v-model="selectedYear"
                            @change="filterByYear"
                            class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 outline-none shadow-sm hover:border-blue-400">
                            <option value="">বছর নির্বাচন করুন</option>
                            <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                        </select>

                        <!-- Other select elements -->
                        <!-- ... keep existing select elements ... -->
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div class="bg-white shadow-xl rounded-xl mb-6">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">অনুসন্ধান</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Search inputs -->
                        <input type="text" v-model="Roll" placeholder="রোল নম্বর লিখুন"
                            class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg" />
                        <!-- ... other inputs ... -->
                        <button @click="searchStudent()"
                            class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span>অনুসন্ধান</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white shadow-xl rounded-xl mb-6">
                <div class="p-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">অ্যাকশন</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Action buttons -->
                        <PrimaryButton class="bg-green-600 hover:bg-green-700">এক্সপোর্ট</PrimaryButton>
                        <!-- ... other buttons ... -->
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <div class="overflow-hidden rounded-xl border border-gray-200">
                    <table style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="w-full">
                        <!-- ... table content remains the same ... -->
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-4 rounded-lg shadow-sm">
                    <!-- ... pagination content remains the same ... -->
                </div>
            </div>
        </div>
    </div>
</AuthenticatedLayout>

</template>
