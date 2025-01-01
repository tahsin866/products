<template>
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-10">
        <div class="border-b pb-6 mb-8">
          <h2 class="text-4xl font-extrabold text-gray-900">Certificate Application Form</h2>
          <p class="mt-3 text-lg text-gray-600">
            Please fill in all required fields marked with an asterisk (<span class="text-red-500">*</span>).
          </p>
        </div>

        <form @submit.prevent="submitForm" class="space-y-10">
          <!-- Personal Information Section -->
          <section>
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Personal Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label for="fullName" class="block text-sm font-medium text-gray-700">
                  Full Name <span class="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  id="fullName"
                  v-model="formData.fullName"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                  :class="{ 'border-red-300': errors.fullName }"
                  required
                />
                <p v-if="errors.fullName" class="mt-2 text-sm text-red-500">{{ errors.fullName }}</p>
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                  Email Address <span class="text-red-500">*</span>
                </label>
                <input
                  type="email"
                  id="email"
                  v-model="formData.email"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                  :class="{ 'border-red-300': errors.email }"
                  required
                />
                <p v-if="errors.email" class="mt-2 text-sm text-red-500">{{ errors.email }}</p>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">
                  Phone Number <span class="text-red-500">*</span>
                </label>
                <input
                  type="tel"
                  id="phone"
                  v-model="formData.phone"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                  :class="{ 'border-red-300': errors.phone }"
                  required
                />
                <p v-if="errors.phone" class="mt-2 text-sm text-red-500">{{ errors.phone }}</p>
              </div>
              <div>
                <label for="certificateType" class="block text-sm font-medium text-gray-700">
                  Certificate Type <span class="text-red-500">*</span>
                </label>
                <select
                  id="certificateType"
                  v-model="formData.certificateType"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                  required
                >
                  <option value="" disabled>Select a certificate type</option>
                  <option value="professional">Professional Certificate</option>
                  <option value="academic">Academic Certificate</option>
                  <option value="completion">Certificate of Completion</option>
                  <option value="achievement">Certificate of Achievement</option>
                  <option value="participation">Certificate of Participation</option>
                </select>
              </div>
            </div>
          </section>

          <!-- Purpose Section -->
          <section>
            <label for="purpose" class="block text-sm font-medium text-gray-700">
              Purpose of Application <span class="text-red-500">*</span>
            </label>
            <textarea
              id="purpose"
              v-model="formData.purpose"
              rows="4"
              class="mt-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
              required
            ></textarea>
            <p class="mt-2 text-sm text-gray-500">Briefly describe why you are applying for this certificate.</p>
          </section>

          <!-- File Upload Section -->
          <section>
            <label class="block text-sm font-medium text-gray-700">Supporting Documents <span class="text-red-500">*</span></label>
            <div
              class="mt-4 flex justify-center p-6 border-2 border-dashed rounded-lg hover:border-blue-400 transition duration-150"
              @dragover.prevent
              @drop.prevent="handleFileDrop"
            >
              <div class="text-center space-y-3">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                  <path
                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
                <p class="text-gray-600">
                  <label for="file-upload" class="relative cursor-pointer text-blue-600 hover:text-blue-500">
                    <span>Upload a file</span>
                    <input id="file-upload" type="file" class="sr-only" @change="handleFileUpload" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" />
                  </label>
                  <span> or drag and drop</span>
                </p>
                <p class="text-xs text-gray-500">Supported formats: PDF, DOC, JPG (Max. 10MB)</p>
                <p v-if="formData.attachment" class="text-green-600">{{ formData.attachment.name }}</p>
              </div>
            </div>
          </section>

          <!-- Submit Section -->
          <section>
            <div class="flex justify-between items-center border-t pt-6">
              <p class="text-sm text-gray-500">All fields marked with <span class="text-red-500">*</span> are required.</p>
              <div class="space-x-3">
                <button
                  type="button"
                  @click="resetForm"
                  class="px-4 py-2 rounded-md border shadow-sm text-sm font-medium bg-white hover:bg-gray-50"
                >
                  Reset
                </button>
                <button
                  type="submit"
                  :disabled="isSubmitting"
                  class="px-4 py-2 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700"
                >
                  <span v-if="isSubmitting">Processing...</span>
                  <span v-else>Submit Application</span>
                </button>
              </div>
            </div>
          </section>
        </form>
      </div>
    </div>
  </template>


  <script setup>
  import { ref, reactive } from 'vue'

  const formData = ref({
    fullName: '',
    email: '',
    phone: '',
    certificateType: '',
    purpose: '',
    attachment: null
  })

  const errors = reactive({})
  const isSubmitting = ref(false)

  const validateForm = () => {
    errors.fullName = !formData.value.fullName ? 'Full name is required' : ''
    errors.email = !formData.value.email ? 'Email is required' : ''
    errors.phone = !formData.value.phone ? 'Phone number is required' : ''

    return Object.values(errors).every(error => !error)
  }

  const handleFileUpload = (event) => {
    const file = event.target.files[0]
    if (file && file.size <= 10 * 1024 * 1024) { // 10MB limit
      formData.value.attachment = file
    } else {
      alert('File size should not exceed 10MB')
    }
  }

  const handleFileDrop = (event) => {
    const file = event.dataTransfer.files[0]
    if (file && file.size <= 10 * 1024 * 1024) {
      formData.value.attachment = file
    } else {
      alert('File size should not exceed 10MB')
    }
  }

  const resetForm = () => {
    formData.value = {
      fullName: '',
      email: '',
      phone: '',
      certificateType: '',
      purpose: '',
      attachment: null
    }
    Object.keys(errors).forEach(key => errors[key] = '')
  }

  const submitForm = async () => {
    if (!validateForm()) return

    isSubmitting.value = true
    try {
      // Simulate API call
      await new Promise(resolve => setTimeout(resolve, 1500))
      console.log('Form Data:', formData.value)
      // Add your API submission logic here
      alert('Application submitted successfully!')
      resetForm()
    } catch (error) {
      console.error('Error submitting form:', error)
      alert('An error occurred while submitting the form')
    } finally {
      isSubmitting.value = false
    }
  }
  </script>
