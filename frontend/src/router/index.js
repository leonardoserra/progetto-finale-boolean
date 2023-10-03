import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SingleRestaurant from '../views/SingleRestaurant.vue'
import RestaurantList from '../views/RestaurantList.vue'
import NotFound from '../views/NotFound.vue'
import ConfirmedOrder from '../views/ConfirmedOrder.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/ristorante/:slug',
      name: 'single-restaurant',
      component: SingleRestaurant,
    },
    {
      path: '/ordine-confermato',
      name: 'confirmed-order',
      component: ConfirmedOrder,
    },
    {
      path: '/ristoranti',
      name: 'restaurants',
      component: RestaurantList
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: NotFound,
    },
  ]
})

export default router
