<script>
import axios from 'axios';
import { store } from '../store.js';
import TypeCard from '../components/TypeCard.vue';
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
    gettypes() {
      axios.get(`${this.store.baseUrl}/api/types`)
        .then(response => {
          console.log(response);
          this.types = response.data.results;
        });
    },
    resetSelectedTypes() {
      this.store.selectedTypes = [];
    },


  },
  components: {
    TypeCard,
    RestaurantCard,
  },

  mounted() {
    this.getrestaurants();
    this.gettypes();
    this.resetSelectedTypes();
  }
}
</script>

<template>
  <div class="container" v-if="this.store.loading == false">
    <div class="type-container">
      <TypeCard :TypeObject="type" v-for="(type, i) in types" :key="i">
      </TypeCard>
    </div>
    <div class="restaurant-container">
      <RestaurantCard :RestaurantObject="restaurant" v-for="(restaurant, i) in restaurants" :key="i"></RestaurantCard>
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
    margin-top: 3rem;
    margin-bottom: 2rem;
    height: 4rem;
    display: flex;
    align-items: center;

  }

  .restaurant-container {
    @include container-80;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
  }
}




//resp large
@media screen and (max-width: 1400px) {
  .container {

    //da sistemare
    .type-container {
      margin-top: 1.5rem;
      margin-bottom: 0;
      height: 30%;
      overflow-x: auto;

      &::-webkit-scrollbar {
        background: transparent;
      }
    }
  }
}
</style>


