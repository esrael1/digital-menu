<script setup>
import { ref } from "vue";
import axios from "../axios";
import { useRouter } from "vue-router";
//import { Lock, User, Mail, Phone, Building, FileText, Eye, EyeOff } from 'lucide-vue-next';

const router = useRouter();
const form = ref({ 
  name: "", 
  email: "", 
  phone: "", 
  business_name: "", 
  tin: "", 
  password: "",
  password_confirmation: "" 
});

const error = ref("");
const showPassword = ref(false);
const showConfirmPassword = ref(false);
const isLoading = ref(false);

const register = async () => {
  try {
    isLoading.value = true;
    error.value = "";
    
    await axios.post("/register", form.value);
    router.push("/");
  } catch (err) {
    error.value = err.response?.data?.message || "Registration failed. Please try again.";
  } finally {
    isLoading.value = false;
  }
};

const togglePasswordVisibility = (field) => {
  if (field === 'password') {
    showPassword.value = !showPassword.value;
  } else {
    showConfirmPassword.value = !showConfirmPassword.value;
  }
};
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
      <!-- Header -->
      <div class="bg-gradient-to-r from-blue-600 to-green-500 p-8 text-center">
        <div class="flex justify-center mb-4">
          <div class="bg-white/20 p-3 rounded-full">
            <User class="w-8 h-8 text-white" />
          </div>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">Create Account</h1>
        <p class="text-blue-100">Join our platform and grow your business</p>
      </div>

      <!-- Form -->
      <div class="p-8">
        <div v-if="error" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start">
          <div class="text-red-600 flex-shrink-0 mt-0.5 mr-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
          </div>
          <p class="text-red-700 text-sm">{{ error }}</p>
        </div>

        <div class="space-y-6">
          <!-- Personal Information Group -->
          <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Personal Information</h3>
            <div class="space-y-4">
              <div class="relative">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                  <User class="w-5 h-5" />
                </div>
                <input
                  v-model="form.name"
                  placeholder="Full Name"
                  class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                />
              </div>

              <div class="relative">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                  <Mail class="w-5 h-5" />
                </div>
                <input
                  v-model="form.email"
                  type="email"
                  placeholder="Email Address"
                  class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                />
              </div>

              <div class="relative">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                  <Phone class="w-5 h-5" />
                </div>
                <input
                  v-model="form.phone"
                  placeholder="Phone Number"
                  class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                />
              </div>
            </div>
          </div>

          <!-- Business Information Group -->
          <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Business Information</h3>
            <div class="space-y-4">
              <div class="relative">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                  <Building class="w-5 h-5" />
                </div>
                <input
                  v-model="form.business_name"
                  placeholder="Business Name"
                  class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                />
              </div>

              <div class="relative">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                  <FileText class="w-5 h-5" />
                </div>
                <input
                  v-model="form.tin"
                  placeholder="Tax Identification Number (TIN)"
                  class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                />
              </div>
            </div>
          </div>

          <!-- Security Group -->
          <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Security</h3>
            <div class="space-y-4">
              <div class="relative">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                  <Lock class="w-5 h-5" />
                </div>
                <input
                  :type="showPassword ? 'text' : 'password'"
                  v-model="form.password"
                  placeholder="Create Password"
                  class="w-full pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                />
                <button
                  @click="togglePasswordVisibility('password')"
                  type="button"
                  class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                >
                  <EyeOff v-if="showPassword" class="w-5 h-5" />
                  <Eye v-else class="w-5 h-5" />
                </button>
              </div>

              <div class="relative">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                  <Lock class="w-5 h-5" />
                </div>
                <input
                  :type="showConfirmPassword ? 'text' : 'password'"
                  v-model="form.password_confirmation"
                  placeholder="Confirm Password"
                  class="w-full pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                />
                <button
                  @click="togglePasswordVisibility('confirm')"
                  type="button"
                  class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                >
                  <EyeOff v-if="showConfirmPassword" class="w-5 h-5" />
                  <Eye v-else class="w-5 h-5" />
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <button
          @click="register"
          :disabled="isLoading"
          class="w-full mt-8 bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
        >
          <span v-if="!isLoading">Create Account</span>
          <span v-else class="flex items-center justify-center">
            <svg class="animate-spin h-5 w-5 mr-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Creating Account...
          </span>
        </button>

        <!-- Login Link -->
        <p class="text-center mt-6 text-gray-600">
          Already have an account?
          <a href="/" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors">Sign in here</a>
        </p>
      </div>
    </div>
  </div>
</template>