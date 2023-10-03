<script>
import { store } from '../store.js';
import { RouterLink, RouterView } from 'vue-router';
export default {
    name: 'RestaurantCard',

    data() {
        return {
            store,
        }
    },
    methods: {
    },
    props: {
        RestaurantObject: Object,
    },
    computed: {
        filterRestaurants() {
            if (this.store.selectedTypes.length > 0) {
                const restaurantTypeIds = this.RestaurantObject.types.map(type => type.id);
                return this.store.selectedTypes.every(type => restaurantTypeIds.includes(type));
            } else {
                return true;
            }
        }
    },
}
</script>
<template>
    <RouterLink class="restaurant-card" v-if="filterRestaurants"
        :to="{ name: 'single-restaurant', params: { slug: RestaurantObject.slug } }">
        <div class="card-sx">
            <div class="wrapper">
                <img v-if="RestaurantObject.img" :src="`${this.store.baseUrl}/storage/${RestaurantObject.img}`">
                <img v-else src="/src/assets/default_img.jpg" />
            </div>
        </div>
        <div class="card-dx">
            <h2 class="restaurant-title">{{ RestaurantObject.name }}</h2>
            <div class="restaurant-type">
                <p v-for="restaurantType in RestaurantObject.types" :key="restaurantType.id">
                    {{ restaurantType.name }}
                </p>
            </div>
        </div>
    </RouterLink>
</template>
<style scoped lang="scss">
@use '../styles/partials/mixins' as*;
@use '../styles/partials/variables' as*;

.restaurant-card {
    @include card-1;
    width: calc(50% - 2rem);
    padding: 1rem;
    height: 22rem;
    margin: 1rem;
    border: double 5px rgba(0, 0, 0, .1);
    text-decoration: none;

    .card-sx {
        width: 50%;

        .wrapper {
            height: 100%;

            img {
                width: 100%;
                object-fit: cover;
                height: 100%;
                padding: 0.1rem;
                display: block;
                border-radius: 1rem;
            }
        }
    }

    .card-dx {
        width: 50%;
        padding: 0rem 0.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;

        a {
            text-decoration: none;
        }

        .restaurant-title {
            width: 100%;
            background-image: linear-gradient(to left, #7c7b7e, #000000);
            color: transparent;
            background-clip: text;
            -webkit-background-clip: text;
            margin-bottom: 0.5rem;
            border: double 5px rgba(241, 106, 38, 0.205);
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
        }

        .restaurant-type {
            height: 100%;
            width: 100%;
            border: double 5px rgba(241, 106, 38, 0.205);
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
            color: $color-secondary;

            p {
                background-color: rgba(241, 106, 38, 0.205);
                padding: 0rem 0.4rem;
                margin: 0.2rem;
            }
        }


    }
}

//responsive MD da fare

@media screen and (max-width: 992px) {


    .restaurant-card {
        width: calc(90% - 2rem);
        margin: 2rem auto 2rem auto;

    }
}


//responsive x-small//////////////////////////////////////////
@media screen and (max-width: 576px) {

    .restaurant-card {
        width: 100%;
        min-width: 300px;
        margin: 0.5rem auto;
        height: 100%;
        padding: 0.7rem;
        border: double 2px rgba(0, 0, 0, .1);
        flex-direction: column;



        .card-dx {
            width: 100%;

            .restaurant-title {
                font-weight: 600;
                font-size: 1rem;
                margin-top: 1rem;

            }

            .restaurant-type {
                font-size: 0.8rem;

                p {
                    padding: 0rem 0.4rem;
                    margin: 0.2rem;
                }
            }


        }

        .card-sx {
            width: 100%;

        }
    }

}


///xxs
@media screen and (max-width: 400px) {

    .restaurant-card {
        width: 100%;
        min-width: 300px;

        height: 100%;
        padding: 0.7rem;
        border: double 2px rgba(0, 0, 0, .1);


        .card-dx {


            .restaurant-title {
                font-weight: 600;
                font-size: 1rem;

            }

            .restaurant-type {
                font-size: 0.8rem;

                p {
                    padding: 0rem 0.4rem;
                    margin: 0.2rem;
                }
            }


        }
    }

}
</style>
