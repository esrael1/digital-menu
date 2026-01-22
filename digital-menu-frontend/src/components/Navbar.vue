<template>
  <nav class="bg-gradient-to-r from-blue-600 to-green-500 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo/Brand -->
        <div class="flex items-center space-x-3">
          <div class="bg-white/20 p-2 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
            </svg>
          </div>
          <div class="flex flex-col">
            <span class="text-xl font-bold text-white">{{ businessName }}</span>
            <span class="text-xs text-blue-100 opacity-90">Restaurant Management System</span>
          </div>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-6">
          <router-link 
            to="/dashboard" 
            class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center space-x-2"
            :class="{ 'bg-white/10': $route.path === '/dashboard' }"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Dashboard</span>
          </router-link>
          
          <router-link 
            to="/menu" 
            class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center space-x-2"
            :class="{ 'bg-white/10': $route.path === '/menu' }"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <span>Menu Editor</span>
          </router-link>
          
          <!-- Add Public Menu Link (opens in new tab) -->
          <a 
            v-if="publicMenuUrl"
            :href="publicMenuUrl"
            target="_blank"
            class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center space-x-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
            <span>Public Menu</span>
          </a>
          
          <!-- <router-link 
            to="/analytics" 
            class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center space-x-2"
            :class="{ 'bg-white/10': $route.path === '/analytics' }"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span>Analytics</span>
          </router-link> -->
          
          <router-link 
            to="/settings" 
            class="text-blue-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center space-x-2"
            :class="{ 'bg-white/10': $route.path === '/settings' }"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Settings</span>
          </router-link>
        </div>

        <!-- User & Logout -->
        <div class="flex items-center space-x-4">
          <!-- User Profile -->
          <div class="hidden md:flex items-center space-x-3 bg-white/10 px-4 py-2 rounded-lg">
            <div class="bg-white/20 p-1 rounded-full">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
            <div class="text-sm">
              <p class="font-medium text-white">{{ userEmail }}</p>
              <p class="text-xs text-blue-100 opacity-90">{{ userRole }}</p>
            </div>
          </div>

          <!-- Logout Button -->
          <button 
            @click="handleLogout"
            class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 flex items-center space-x-2 shadow-md"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            <span>Logout</span>
          </button>

          <!-- Mobile menu button -->
          <button 
            @click="isMobileMenuOpen = !isMobileMenuOpen"
            class="md:hidden text-blue-100 hover:text-white focus:outline-none"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div v-if="isMobileMenuOpen" class="md:hidden bg-blue-700 px-4 py-3 border-t border-blue-800">
      <div class="space-y-2">
        <router-link 
          to="/dashboard" 
          class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors flex items-center space-x-3"
          :class="{ 'bg-white/10': $route.path === '/dashboard' }"
          @click="isMobileMenuOpen = false"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          <span>Dashboard</span>
        </router-link>
        
        <router-link 
          to="/menu" 
          class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors flex items-center space-x-3"
          :class="{ 'bg-white/10': $route.path === '/menu' }"
          @click="isMobileMenuOpen = false"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
          </svg>
          <span>Menu Editor</span>
        </router-link>
        
        <!-- Public Menu Link for Mobile -->
        <a 
          v-if="publicMenuUrl"
          :href="publicMenuUrl"
          target="_blank"
          class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors flex items-center space-x-3"
          @click="isMobileMenuOpen = false"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
          </svg>
          <span>Public Menu</span>
        </a>
        
        <!-- <router-link 
          to="/analytics" 
          class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors flex items-center space-x-3"
          :class="{ 'bg-white/10': $route.path === '/analytics' }"
          @click="isMobileMenuOpen = false"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
          </svg>
          <span>Analytics</span>
        </router-link> -->
        
        <router-link 
          to="/settings" 
          class="text-blue-100 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors flex items-center space-x-3"
          :class="{ 'bg-white/10': $route.path === '/settings' }"
          @click="isMobileMenuOpen = false"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          <span>Settings</span>
        </router-link>

        <div class="pt-4 border-t border-blue-800">
          <div class="flex items-center space-x-3 px-3 py-2">
            <div class="bg-white/20 p-1 rounded-full">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
            </div>
            <div class="text-sm">
              <p class="font-medium text-white">{{ userEmail }}</p>
              <p class="text-xs text-blue-100 opacity-90">{{ userRole }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  user: {
    type: Object,
    default: () => ({})
  }
});

const emit = defineEmits(['logout']);
const isMobileMenuOpen = ref(false);

// Compute values from user prop or use defaults
const userEmail = computed(() => {
  return props.user?.email || 'admin@example.com';
});

const businessName = computed(() => {
  return props.user?.business_name || 'Digital Menu Pro';
});

const userRole = computed(() => {
  return props.user?.role || 'Administrator';
});

const publicMenuUrl = computed(() => {
  if (props.user?.slug) {
    return `${window.location.origin}/menu/${props.user.slug}`;
  }
  return null;
});

const handleLogout = () => {
  // You could add confirmation dialog here if needed
  emit('logout');
};
</script>