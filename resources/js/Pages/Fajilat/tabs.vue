<template>
    <AuthenticatedLayout>
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
                <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
              </select>
            </div>

            <!-- Roll Number -->
            <div class="space-y-2">
              <label class="block text-md font-semibold text-gray-700">
                {{ currentLanguage === 'bn' ? 'রোল নম্বর' : 'Roll Number' }}
              </label>
              <input
                v-model="searchForm.roll"
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
                v-model="searchForm.regId"
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
        <div v-if="searchResults.length > 0" class="mt-6 bg-white rounded-xl shadow-lg overflow-hidden">
          <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">
              {{ currentLanguage === 'bn' ? 'অনুসন্ধানের ফলাফল' : 'Search Results' }}
            </h3>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <!-- Table headers and content here -->
            </table>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

  <script setup>
  import { ref, reactive } from 'vue'
  import { Head, Link } from '@inertiajs/vue3'
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

  const currentLanguage = ref('bn')
  const activeTab = ref('certificate')
  const isLoading = ref(false)

  const tabs = [
    { id: 'certificate', labelBn: 'সনদপত্র', labelEn: 'Certificate' },
    { id: 'transcript', labelBn: 'ট্রান্সক্রিপ্ট', labelEn: 'Transcript' },
    { id: 'provisional', labelBn: 'সাময়িক সনদ', labelEn: 'Provisional' }
  ]

  const searchTitles = {
    certificate: { bn: 'সনদপত্র অনুসন্ধান', en: 'Certificate Search' },
    transcript: { bn: 'ট্রান্সক্রিপ্ট অনুসন্ধান', en: 'Transcript Search' },
    provisional: { bn: 'সাময়িক সনদ অনুসন্ধান', en: 'Provisional Certificate Search' }
  }

  const years = Array.from({ length: 10 }, (_, i) => new Date().getFullYear() - i)

  const searchForm = reactive({
    year: '',
    roll: '',
    regId: ''
  })

  const searchResults = ref([])

  const handleSearch = async () => {
    isLoading.value = true

    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1500))

    // Dummy results
    searchResults.value = [
      {
        id: 1,
        nameEn: 'John Doe',
        nameBn: 'জন ডো',
        roll: '12345',
        regId: 'REG001',
        status: 'Approved'
      },
      // Add more dummy results
    ]

    isLoading.value = false
  }
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
