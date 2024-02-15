<template>
  <div>
    <div class="bg-white">
      <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">You are NOT logged in</h2>
          <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">Login to see all the countries</p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a @click="login" class="cursor-pointer rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">LOGIN</a>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import authService from "@/services/auth.service.js";
export default {
  setup() {
    const { login } = authService();
    return {
      login
    };
  },
};
</script>