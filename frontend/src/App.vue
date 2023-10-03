<script setup>
import { RouterLink, RouterView } from 'vue-router'
import TheHeader from './components/TheHeader.vue'
</script>

<template>
  <TheHeader></TheHeader>
  <main>
    <RouterView />
  </main>
</template>

<style scoped lang="scss">
main {
  padding-top: 4rem;
  background-image: url(./assets/background_img/sun-tornado.svg);
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  background-position: center;


  // background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
  // background-size: 400% 400%;
  // animation: gradient 15s ease infinite;
  // height: 100vh;

  // @keyframes gradient {
  //   0% {
  //     background-position: 0% 50%;
  //   }

  //   50% {
  //     background-position: 100% 50%;
  //   }

  //   100% {
  //     background-position: 0% 50%;
  //   }
  // }
}
</style>
