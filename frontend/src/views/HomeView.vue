<script>
import axios from 'axios';
import { store } from '../store.js';
import RestaurantCard from '../components/RestaurantCard.vue';
export default {
  data() {
    return {
      restaurants: [],
      types: [],
      store,

    }
  },
  methods: {
    getrestaurants() {
      this.store.loading = true;
      axios.get(`${this.store.baseUrl}/api/restaurants`)
        .then(response => {
          console.log(response);
          this.restaurants = response.data.results;
          this.store.loading = false;
        });
    },
  },
  components: {
    RestaurantCard,
  },

  mounted() {
    this.getrestaurants();
  }
}
</script>

<template>
  <div class="container" v-if="this.store.loading == false">
    <div class="restaurant-container">
      <RestaurantCard :RestaurantObject="restaurant" v-for="(restaurant, i) in restaurants.reverse().slice(0, 4)" :key="i">
      </RestaurantCard>
    </div>
  </div>
  <div v-else>
    <span class="loader m-3"></span>
  </div>
</template>

<style scoped lang="scss">
@use '../styles/partials/mixins' as*;
@use '../styles/partials/variables' as*;

.container {
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height: calc(100vh - 4rem);

  .type-container {
    @include container-80;
    height: 4rem;
    display: flex;
    align-items: center;
  }

  .restaurant-container {
    @include container-80;
    margin: auto;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
  }
}
</style>

