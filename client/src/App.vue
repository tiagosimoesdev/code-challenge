<template>
 <PageLayout>
  <PageLoader v-if="auth.isLoading.value"/>

  <router-view v-else />
  </PageLayout>
</template>

<script setup>
import PageLoader from "@/components/PageLoader.vue";
import PageLayout from "@/components/Layout/PageLayout.vue";
import authService from "@/services/auth.service.js";

const auth = authService();
</script>
