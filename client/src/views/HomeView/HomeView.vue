<template>

  <template v-if="!isAuthenticated">
    <LoginHero />
  </template>
  <template v-if="isAuthenticated">
    <CountriesList />
  </template>

</template>


<script setup>
import LoginHero from "@/components/LoginHero/LoginHero.vue";
import CountriesList from '@/components/CountriesList/CountriesList.vue'
import { useAuth0 } from "@auth0/auth0-vue";

const { isAuthenticated } = useAuth0();
</script>

