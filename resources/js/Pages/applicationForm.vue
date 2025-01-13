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
        <div class="bg-white rounded-xl shadow-lg p-8">
          <h2 class="text-2xl font-bold mb-8">
            {{ currentLanguage === 'bn' ? searchTitles[activeTab].bn : searchTitles[activeTab].en }}
          </h2>

          <form @submit.prevent="handleSearch" class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Year Selection -->
            <div class="space-y-2">
              <label class="block text-md font-semibold text-gray-700">
                {{ currentLanguage === 'bn' ? 'বছর নির্বাচন করুন' : 'Select Year' }}
              </label>
              <select v-model="searchForm.year" class="form-select">
                <option value="">{{ currentLanguage === 'bn' ? 'বছর নির্বাচন করুন' : 'Select year' }}</option>
                <option v-for="years in years" :key="years" :value="years">{{ years }}</option>
              </select>
            </div>

            <!-- Roll Number -->
            <div class="space-y-2">
              <label class="block text-md font-semibold text-gray-700">
                {{ currentLanguage === 'bn' ? 'রোল নম্বর' : 'Roll Number' }}
              </label>
              <input
                v-model="searchForm.Roll"
                type="text"
                class="form-input"
                :placeholder="currentLanguage === 'bn' ? 'রোল নম্বর লিখুন' : 'Enter roll number'"
              >
            </div>

            <!-- Registration ID -->
            <div class="space-y-2">
              <label class="block text-md font-semibold text-gray-700">
                {{ currentLanguage === 'bn' ? 'রেজিস্ট্রেশন আইডি' : 'Registration ID' }}
              </label>
              <input
                v-model="searchForm.reg_id"
                type="text"
                class="form-input"
                :placeholder="currentLanguage === 'bn' ? 'রেজিস্ট্রেশন আইডি লিখুন' : 'Enter registration ID'"
              >
            </div>

            <!-- Search Button -->
            <div class="flex items-end">
              <button
                type="submit"
                :disabled="isLoading"
                class="w-full btn-primary"
              >
                <span v-if="isLoading" class="flex items-center justify-center">
                  <svg class="animate-spin -ml-1 mr-3 h-5 w-5" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                  </svg>
                  {{ currentLanguage === 'bn' ? 'অনুসন্ধান করা হচ্ছে...' : 'Searching...' }}
                </span>
                <span v-else>
                  {{ currentLanguage === 'bn' ? 'অনুসন্ধান করুন' : 'Search' }}
                </span>
              </button>
            </div>
          </form>
        </div>

        <!-- Results Table -->
        <div v-if="props.searchResults && props.searchResults.length > 0"
     class="mt-6 bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-xl font-bold text-gray-800">
            {{ currentLanguage === 'bn' ? 'অনুসন্ধানের ফলাফল' : 'Search Results' }}
        </h3>
    </div>

    <!-- Certificate Table -->
    <div v-if="activeTab === 'certificate'" class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        {{ currentLanguage === 'bn' ? 'নাম' : 'Name' }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        {{ currentLanguage === 'bn' ? 'পিতার নাম' : 'Father Name' }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        {{ currentLanguage === 'bn' ? 'নাম' : 'Name' }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        {{ currentLanguage === 'bn' ? 'বছর' : 'Years' }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        {{ currentLanguage === 'bn' ? 'রোল' : 'Roll' }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        {{ currentLanguage === 'bn' ? 'রেজিস্ট্রেশন আইডি' : 'Registration ID' }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        {{ currentLanguage === 'bn' ? 'অবস্থা' : 'Status' }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="result in props.searchResults" :key="result.id">
                    <td class="px-6 py-4">{{ result.Name }}</td>
                    <td class="px-6 py-4">{{ result.Father }}</td>
                    <td class="px-6 py-4">{{ result.Name }}</td>
                    <td class="px-6 py-4">{{ result.years }}</td>
                    <td class="px-6 py-4">{{ result.Roll }}</td>
                    <td class="px-6 py-4">{{ result.reg_id }}</td>
                    <td class="px-6 py-4">
                        <!-- <span :class="[
                            'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                            result.status === 'Approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'
                        ]">
                            {{ result.status }}
                        </span> -->

                        <Link :href="route('Fajilat.fazilatDetailes', { Roll: result.Roll, reg_id: result.reg_id })" class="text-blue-600 hover:text-blue-800 transition-colors duration-150 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transform group-hover:scale-110 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
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
  </style>
