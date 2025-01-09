<template>


    <div>
        <CertificateAgreement v-if="!showApplicationForm" @proceed="showApplicationForm = true" />
        <div v-else>
          <!-- Your existing application form template -->
          <div class="max-w-4xl mx-auto mb-6 mt-5">
      <!-- Status Banner -->
      <div v-if="applicationStatus"
           :class="{
             'bg-yellow-50 border-yellow-400 text-yellow-800': applicationStatus === 'pending',
             'bg-red-50 border-red-400 text-red-800': applicationStatus === 'rejected',
             'bg-green-50 border-green-400 text-green-800': applicationStatus === 'approved',
             'bg-gray-50 border-gray-400 text-gray-800': applicationStatus === 'cancelled'
           }"
           class="rounded-md border-l-4 p-4 mb-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <!-- Status Icon -->
              <svg v-if="applicationStatus === 'pending'" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
              </svg>
              <svg v-if="applicationStatus === 'approved'" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <!-- Add other status icons as needed -->
            </div>
            <div v-if="applicationStatus"
             :class="{
               'bg-yellow-50 border-yellow-400 text-yellow-800': applicationStatus === 'pending',
               'bg-red-50 border-red-400 text-red-800': applicationStatus === 'rejected',
               'bg-green-50 border-green-400 text-green-800': applicationStatus === 'approved',
               'bg-gray-50 border-gray-400 text-gray-800': applicationStatus === 'cancelled'
             }"
             class="rounded-md border-l-4 p-4 mb-4">
          <!-- Rest of your status banner code -->
        </div>
          </div>
          <!-- Status Timeline -->
          <div class="ml-4">
            <div class="flex items-center space-x-2 text-sm">
              <span class="font-medium">Last Updated:</span>
              <span>{{ lastUpdated }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>


        <div class="min-h-screen bg-gradient-to-b from-blue-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
          <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-10">
            <div class="border-b pb-6 mb-8">
              <h2 class="text-4xl font-extrabold text-gray-900">Certificate Application Form</h2>
              <p class="mt-3 text-lg text-gray-600">
                Please fill in all required fields marked with an asterisk (<span class="text-red-500">*</span>).
              </p>
            </div>

            <form @submit.prevent="submit" class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-10">
              <!-- Certificate Type Section -->
              <section>
        <!-- Certificate Type Dropdown -->
        <div>
          <label for="certificateType" class="block text-sm font-medium text-gray-700">
            Certificate Type <span class="text-red-500">*</span>
          </label>
          <select
            id="certificateType"
            v-model="formData.Certificate_Type"
            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            required
          >
            <option value="" disabled>Select a certificate type</option>
            <option v-for="type in certificateTypes" :key="type" :value="type">{{ type }}</option>
          </select>
          <span v-if="errors.Certificate_Type" class="text-red-500 text-sm">{{ errors.Certificate_Type[0] }}</span>
        </div>

        <!-- Class Name Dropdown -->
        <div class="mt-5">
          <label for="className" class="block text-sm font-medium text-gray-700">
            Class Name <span class="text-red-500">*</span>
          </label>
          <select
            id="className"
            v-model="formData.Class_name"
            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            required
          >
            <option value="" disabled>Select a class</option>
            <option v-for="classItem in classNames" :key="classItem" :value="classItem">{{ classItem }}</option>
          </select>
          <span v-if="errors.Class_name" class="text-red-500 text-sm">{{ errors.Class_name[0] }}</span>
        </div>
      </section>

              <!-- Student Information Section -->
              <section>
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Student Information</h3>

                <!-- Names in different languages -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                  <div>
                    <label for="studentBanglaName" class="block text-sm font-medium text-gray-700">
                      Name in Bangla <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="studentBanglaName"
                      v-model="formData.student_bangla_name"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>

                  <div>
                    <label for="studentArabicName" class="block text-sm font-medium text-gray-700">
                      Name in Arabic <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="studentArabicName"
                      v-model="formData.student_arabic_name"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>

                  <div>
                    <label for="studentEnglishName" class="block text-sm font-medium text-gray-700">
                      Name in English <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="studentEnglishName"
                      v-model="formData.student_english_name"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>
                </div>

                <!-- Father's Names -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                  <div>
                    <label for="fatherNameBn" class="block text-sm font-medium text-gray-700">
                      Father's Name (Bangla) <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="fatherNameBn"
                      v-model="formData.student_Father_name_bn"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>

                  <div>
                    <label for="fatherNameAr" class="block text-sm font-medium text-gray-700">
                      Father's Name (Arabic) <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="fatherNameAr"
                      v-model="formData.student_Father_name_ar"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>

                  <div>
                    <label for="fatherNameEn" class="block text-sm font-medium text-gray-700">
                      Father's Name (English) <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="fatherNameEn"
                      v-model="formData.student_Father_name_en"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>
                </div>

                <!-- Academic Information -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                  <div>
                    <label for="roll" class="block text-sm font-medium text-gray-700">
                      Roll Number <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="number"
                      id="roll"
                      v-model="formData.Roll"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>

                  <div>
                    <label for="regId" class="block text-sm font-medium text-gray-700">
                      Registration ID <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="number"
                      id="regId"
                      v-model="formData.reg_id"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>

                  <div>
                    <label for="mid" class="block text-sm font-medium text-gray-700">
                      MID <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="number"
                      id="mid"
                      v-model="formData.MID"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>
                </div>

                <!-- Madrasha Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                  <div>
                    <label for="madrashaNameEn" class="block text-sm font-medium text-gray-700">
                      Madrasha Name (English) <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="madrashaNameEn"
                      v-model="formData.madrasha_name_en"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>

                  <div>
                    <label for="madrashaName" class="block text-sm font-medium text-gray-700">
                      Madrasha Name (Bangla) <span class="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      id="madrashaName"
                      v-model="formData.madrasha_name"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                      required
                    />
                  </div>
                </div>
              </section>

              <!-- Photo Upload Section -->
              <section>
                <label class="block text-sm font-medium text-gray-700">Photo Upload <span class="text-red-500">*</span></label>
                <div class="form-group">
            <label for="photo">Photo</label>
            <input id="photo" type="file" @change="handlePhotoSelect" class="form-control" />
            <img v-if="photoPreview" :src="photoPreview" alt="Preview" style="max-width: 100px;" />
            <span v-if="errors.photo" class="text-danger">{{ errors.photo[0] }}</span>
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
                    <div class="mt-6">
                 <!-- Replace the existing submit button with this -->
                 <button type="submit" :disabled="processing" class="btn btn-primary">
            Submit
          </button>

                </div>
                  </div>
                </div>
              </section>
            </form>
          </div>
        </div>

        </div>
      </div>




      </template>

    <script setup>
    import { ref, reactive, watch } from "vue";
    import { usePage, router } from "@inertiajs/vue3";
    import CertificateAgreement from './CertificateAgreement.vue'

    const showApplicationForm = ref(false)


    // Reactive form data
    const formData = reactive({
      Certificate_Type: "",
      Class_name: "",
      student_bangla_name: "",
      student_arabic_name: "",
      student_english_name: "",
      student_Father_name_bn: "",
      student_Father_name_ar: "",
      student_Father_name_en: "",
      Roll: "",
      reg_id: "",
      MID: "",
      madrasha_name_en: "",
      madrasha_name: "",
      photo: null,


    });

    // Reactive state for errors, flash messages, etc.
    const errors = ref({});
    const flashMessage = ref("");
    const photoPreview = ref(null);
    const processing = ref(false);

    // Accessing Inertia.js page properties
    const page = usePage();

    // Watch for flash messages
    watch(
      () => page.props.flash,
      (newFlash) => {
        if (newFlash?.success) {
          flashMessage.value = newFlash.success;
          setTimeout(() => {
            flashMessage.value = "";
          }, 5000);
        }
      },
      { deep: true }
    );

    // Handle photo selection
    const handlePhotoSelect = (event) => {
      const file = event.target.files[0];
      if (file && file.size <= 2 * 1024 * 1024) {
        formData.photo = file;
        const reader = new FileReader();
        reader.onload = (e) => {
          photoPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        flashMessage.value = "Photo size should not exceed 2MB";
      }
    };

    // Submit form data
    const submit = () => {
      processing.value = true;

      const data = new FormData();
      for (const key in formData) {
        data.append(key, formData[key]);
      }

      router.post(route("applications.store"), data, {
        preserveScroll: true,
        onSuccess: () => {
          Object.keys(formData).forEach((key) => (formData[key] = ""));
          photoPreview.value = null;
          processing.value = false;
          flashMessage.value = "Application submitted successfully!";
        },
        onError: (receivedErrors) => {
          errors.value = receivedErrors;
          processing.value = false;
        },
      });
    };

    const certificateTypes = [
      "Professional Certificate",
      "Academic Certificate",
      "Certificate of Completion",
    ];

    const classNames = [
      "Class 1",
      "Class 2",
      "Class 3",
      "Class 4",
      "Class 5",
    ];

    // Reactive form data



    </script>

    <style scoped>
    .alert {
      margin-bottom: 1rem;
    }
    .text-danger {
      font-size: 0.875rem;
    }
    </style>
