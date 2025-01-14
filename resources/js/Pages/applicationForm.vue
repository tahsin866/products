<template>


    <div  class="max-w-7xl mx-auto"


    style="font-family: 'Merriweather','SolaimanLipi',sans-serif;">
    <CertificateAgreement v-if="!showApplicationForm" @proceed="showApplicationForm = true" />


    <div v-else>
        <div class="mx-auto p-6">
        <!-- Language Switcher -->
        <div class="mb-6 flex justify-end">
          <div class="bg-white rounded-lg shadow-sm inline-flex">
            <button
              v-for="lang in ['bn', 'en']"
              :key="lang"
              @click="currentLanguage = lang"
              :class="[
                'px-4 py-2 text-sm font-medium',
                currentLanguage === lang
                  ? 'bg-indigo-500 text-white'
                  : 'text-gray-600 hover:bg-gray-50'
              ]"
            >
              {{ lang === 'bn' ? 'বাংলা' : 'English' }}
            </button>
          </div>
        </div>

        <!-- Search Tabs -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
          <nav class="flex divide-x divide-gray-200">
            <button
              v-for="tab in tabs"
              :key="tab.id"
              @click="activeTab = tab.id"
              :class="[
                'flex-1 px-6 py-4 text-lg font-medium transition-all duration-200',
                activeTab === tab.id
                  ? 'bg-indigo-50 text-indigo-600 border-b-2 border-indigo-500'
                  : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'
              ]"
            >
              {{ currentLanguage === 'bn' ? tab.labelBn : tab.labelEn }}
            </button>
          </nav>
        </div>

        <!-- Search Form -->
        <div class="bg-gradient-to-br rounded-md from-white to-gray-50  shadow-xl p-10 border border-gray-100">
  <h2 class="text-3xl font-bold mb-8  text-gray-800 border-b pb-4">
    {{ currentLanguage === 'bn' ? searchTitles[activeTab].bn : searchTitles[activeTab].en }}
  </h2>

  <form @submit.prevent="handleSearch" class="grid grid-cols-1 md:grid-cols-4 gap-8">
    <!-- Year Selection -->
    <div class="space-y-3">
      <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
        {{ currentLanguage === 'bn' ? 'বছর নির্বাচন করুন' : 'Select Year' }}
      </label>
      <select
        v-model="searchForm.years"
        class="w-full rounded-md px-4 border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all duration-200 bg-white shadow-sm"
      >
        <option value="">{{ currentLanguage === 'bn' ? 'বছর নির্বাচন করুন' : 'Select year' }}</option>
        <option v-for="years in years" :key="years" :value="years">{{ years }}</option>
      </select>
    </div>

    <!-- Roll Number -->
    <div class="space-y-3">
      <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
        {{ currentLanguage === 'bn' ? 'রোল নম্বর' : 'Roll Number' }}
      </label>
      <input
        v-model="searchForm.Roll"
        type="text"
        class="w-full rounded-md px-4  border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all duration-200 bg-white shadow-sm"
        :placeholder="currentLanguage === 'bn' ? 'রোল নম্বর লিখুন' : 'Enter roll number'"
      >
    </div>

    <!-- Registration ID -->
    <div class="space-y-3">
      <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">
        {{ currentLanguage === 'bn' ? 'রেজিস্ট্রেশন আইডি' : 'Registration ID' }}
      </label>
      <input
        v-model="searchForm.reg_id"
        type="text"
        class="w-full rounded-md px-4  border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all duration-200 bg-white shadow-sm"
        :placeholder="currentLanguage === 'bn' ? 'রেজিস্ট্রেশন আইডি লিখুন' : 'Enter registration ID'"
      >
    </div>

    <!-- Search Button -->
    <div class="flex items-end">
      <button
        type="submit"
        :disabled="isLoading"
        class="w-full bg-gradient-to-r rounded-md  from-indigo-600 to-indigo-700 text-white px-6 py-2.5   font-medium transform transition-all duration-200 hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
      >
        <span v-if="isLoading" class="flex items-center justify-center">
          <svg class="animate-spin -ml-1 mr-3 h-5 w-5" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
          </svg>
          {{ currentLanguage === 'bn' ? 'অনুসন্ধান করা হচ্ছে...' : 'Searching...' }}
        </span>
        <span v-else class="flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          {{ currentLanguage === 'bn' ? 'অনুসন্ধান করুন' : 'Search' }}
        </span>
      </button>
    </div>
  </form>
</div>


        <!-- Results Table -->
        <div v-if="props.searchResults && props.searchResults.length > 0"
       class="mt-6 rounded-md bg-white shadow-xl overflow-hidden border border-gray-100">

    <!-- Results Header -->
    <div class="p-5 bg-gradient-to-r from-indigo-500 to-purple-600">
      <h3 class="text-2xl font-bold text-white">
        {{ currentLanguage === 'bn' ? 'অনুসন্ধানের ফলাফল' : 'Search Results' }}
      </h3>
    </div>

    <!-- Certificate Table -->
    <div v-if="activeTab === 'certificate'" class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="bg-gray-50">
            <th v-for="header in tableHeaders"
                :key="header.key"
                class="px-6 py-4 text-left">
              <span class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                {{ currentLanguage === 'bn' ? header.bn : header.en }}
              </span>
            </th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          <tr v-for="result in props.searchResults"
              :key="result.id"
              class="hover:bg-gray-50 transition-colors duration-200">
            <td class="px-6 py-5">
              <div class="flex items-center">
                <div class="h-10 w-10 flex-shrink-0 rounded-full bg-indigo-100 flex items-center justify-center">
                  <span class="text-indigo-600 font-semibold">{{ result.Name[0] }}</span>
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900">{{ result.Name }}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-5 text-sm text-gray-700">{{ result.Father }}</td>
            <td class="px-6 py-5 text-sm text-gray-700">{{ result.years }}</td>
            <td class="px-6 py-5">
              <span class="px-3 py-1 text-sm rounded-full bg-indigo-50 text-indigo-700 font-medium">
                {{ result.Roll }}
              </span>
            </td>
            <td class="px-6 py-5 text-sm text-gray-700">{{ result.reg_id }}</td>
            <td class="px-6 py-5">
              <Link :href="route('applicationStuDetailes', { Roll: result.Roll, reg_id: result.reg_id })"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                {{ currentLanguage === 'bn' ? 'বিস্তারিত দেখুন' : 'View Details' }}
              </Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
    </div>

   </div>

      </div>




      </template>


   <script setup>
import { ref, reactive, watch, computed } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import { Head, Link } from '@inertiajs/vue3';
import CertificateAgreement from './CertificateAgreement.vue';

const showApplicationForm = ref(false);
const currentLanguage = ref('bn');
const activeTab = ref('certificate');
const isLoading = ref(false);

// Define props from backend
const props = defineProps({
  availableYears: Array,
  searchResults: Array
});

const searchForm = reactive({
  years: '',
  Roll: '',
  reg_id: '',
  Name: '',
});

const tabs = [
  { id: 'certificate', labelBn: 'বাংলা-ইংরেজি আবেদন ', labelEn: 'Certificate' },
  { id: 'transcript', labelBn: ' আরবি-ইংরেজি আবেদন', labelEn: 'Transcript' },
];

const searchTitles = {
  certificate: { bn: 'সনদপত্র অনুসন্ধান', en: 'Certificate Search' },
  transcript: { bn: 'ট্রান্সক্রিপ্ট অনুসন্ধান', en: 'Transcript Search' },
};

// Use backend years
const years = computed(() => props.availableYears);

const handleSearch = () => {
  isLoading.value = true;

  router.get('/applicationForm', searchForm, {
    preserveState: true,
    preserveScroll: true,
    onFinish: () => {
      isLoading.value = false;
    }
  });
};



const tableHeaders = [
  { key: 'name', en: 'Name', bn: 'নাম' },
  { key: 'father', en: 'Father Name', bn: 'পিতার নাম' },
  { key: 'year', en: 'Year', bn: 'বছর' },
  { key: 'roll', en: 'Roll', bn: 'রোল' },
  { key: 'regId', en: 'Registration ID', bn: 'রেজিস্ট্রেশন আইডি' },
  { key: 'action', en: 'Action', bn: 'অ্যাকশন' }
];
</script>





  <style scoped>
  .form-select,
  .form-input {
    @apply w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500;
  }

  .btn-primary {
    @apply bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700
           transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed
           font-semibold shadow-md hover:shadow-lg;
  }


  .table-scroll {
  @apply overflow-x-auto;
  scrollbar-width: thin;
  scrollbar-color: theme('colors.indigo.400') theme('colors.gray.100');
}

.table-scroll::-webkit-scrollbar {
  @apply h-2 w-2;
}

.table-scroll::-webkit-scrollbar-track {
  @apply bg-gray-100 rounded-full;
}

.table-scroll::-webkit-scrollbar-thumb {
  @apply bg-indigo-400 rounded-full;
}
  </style>
