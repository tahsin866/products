<template>

    <div>
    <CertificateAgreement v-if="!showApplicationForm" @proceed="showApplicationForm = true" />
    <div v-else>
      <!-- Your existing application form template -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Search Form -->
      <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Certificate Search</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          <!-- Year Dropdown -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Academic Year
            </label>
            <select
              v-model="searchParams.year"
              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
              <option value="">Select Year</option>
              <option v-for="year in years" :key="year" :value="year">
                {{ year }}
              </option>
            </select>
          </div>

          <!-- Class Dropdown -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Class
            </label>
            <select
              v-model="searchParams.class"
              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
              <option value="">Select Class</option>
              <option v-for="className in classes" :key="className" :value="className">
                {{ className }}
              </option>
            </select>
          </div>

          <!-- Roll Number Input -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Roll Number
            </label>
            <input
              type="number"
              v-model="searchParams.roll"
              placeholder="Enter roll number"
              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            />
          </div>

          <!-- Registration ID Input -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Registration ID
            </label>
            <input
              type="number"
              v-model="searchParams.regId"
              placeholder="Enter registration ID"
              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            />
          </div>
        </div>

        <!-- Search Button -->
        <div class="mt-6 flex justify-end">
          <button
            @click="searchCertificates"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search
          </button>
        </div>
      </div>

      <!-- Results Table -->
      <div v-if="searchResults.length" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Student Name
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Roll Number
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Registration ID
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Class
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Year
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="result in searchResults" :key="result.id">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ result.studentName }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ result.rollNumber }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ result.registrationId }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ result.class }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ result.year }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span :class="{
                  'px-2 py-1 text-xs font-medium rounded-full': true,
                  'bg-green-100 text-green-800': result.status === 'Approved',
                  'bg-yellow-100 text-yellow-800': result.status === 'Pending',
                  'bg-red-100 text-red-800': result.status === 'Rejected'
                }">
                  {{ result.status }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <button class="text-indigo-600 hover:text-indigo-900">View Details</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    </div>
  </div>



  </template>

  <script setup>
  import { ref, reactive } from 'vue'
  import CertificateAgreement from './CertificateAgreement.vue'

const showApplicationForm = ref(false)


  // Sample data for dropdowns
  const years = ref([2023, 2022, 2021, 2020, 2019])
  const classes = ref(['Class 1', 'Class 2', 'Class 3', 'Class 4', 'Class 5'])

  // Search parameters
  const searchParams = reactive({
    year: '',
    class: '',
    roll: '',
    regId: ''
  })

  // Sample search results
  const searchResults = ref([])

  const searchCertificates = () => {
    // Simulate API call
    searchResults.value = [
      {
        id: 1,
        studentName: 'John Doe',
        rollNumber: '12345',
        registrationId: 'REG001',
        class: 'Class 5',
        year: '2023',
        status: 'Approved'
      },
      // Add more sample results as needed
    ]
  }
  </script>

  <style scoped>
  /* Add any additional custom styles here */
  </style>
