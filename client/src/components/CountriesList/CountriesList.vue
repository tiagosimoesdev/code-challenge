<template>
    <div class="content-layout">
      <h1 class="content__title" data-test="page-title">List of all the countries</h1>
        <div class="bg-white ">
          <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <ul  role="list"  class="mx-auto mt-20 grid max-w-2xl grid-cols-2 gap-x-8 gap-y-16 text-center sm:grid-cols-3 md:grid-cols-4 lg:mx-0 lg:max-w-none lg:grid-cols-5 xl:grid-cols-6">
              <li  data-test="list" v-for="country in countries.data" :key="country.name">
                <img class="mx-auto h-24 w-24 rounded-full" :src="country.flag" alt="" />
                <h3 data-test='country-name' class="mt-6 text-base font-semibold leading-7 tracking-tight text-gray-900">{{ country.name }}</h3>
              </li>
            </ul>
          </div>
        </div>
    </div>
</template>

<script setup>
import { getAllCountries } from "@/services/country.service";
import { ref } from "vue";
import authService from "@/services/auth.service.js";

const countries = ref("");

const fetchCountries = async () => {
  const { getUserAccessToken } = authService();
  const accessToken = await getUserAccessToken();
  const { data } = await getAllCountries(accessToken);

  if (data) {
    countries.value = data
  }
};

fetchCountries();
</script>
