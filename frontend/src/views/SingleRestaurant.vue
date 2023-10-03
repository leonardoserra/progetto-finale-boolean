<script>
import axios from 'axios';
import { store } from '../store.js';
import SavedModal from '../components/modale/SavedModal.vue';
import CartModale from '../components/modale/CartModale.vue';
import MyCartPayment from '../components/modale/MyCartPayment.vue';

export default {
    name: 'SingleRestaurant',
    components: { SavedModal, CartModale, MyCartPayment },
    data() {
        return {
            store,
            restaurant: [],
            menu: [],
            actualLocalStorage: [],
            actualRestaurant: '',
            showModal: false,
            showCartModal: false,
            showCartPayment: false
        }
    },
    methods: {
        getRestaurant() {
            const slug = this.$route.params.slug;

            axios.get(`${this.store.baseUrl}/api/restaurants/${slug}`)
                .then(response => {
                    if (response.data.success == true) {
                        this.restaurant = response.data.restaurant;
                        localStorage.setItem('restaurant_user', JSON.stringify(response.data.restaurant_user));
                    } else {
                        this.$router.push({ name: 'not-found' });
                    }
                    this.checkRestaurant();


                    this.actualLocalStorage = this.getLocalStorageValues();
                    console.log(this.actualLocalStorage);

                    this.getMenu(this.actualLocalStorage);
                    console.log(this.menu);
                });
        },
        addOneToCart(value) {

            // funzione per trovare l'elemento dentro cartItem
            let singleItem = this.menu.find(item => item.value === value);
            if (singleItem) {
                singleItem.quantity++
                localStorage.setItem(0, JSON.stringify(this.menu));
            } else {
                this.getMenu(this.actualLocalStorage);
                singleItem.quantity++
                localStorage.setItem(0, JSON.stringify(this.menu));
            }

        },
        removeOneToCart(value) {

            // funzione per trovare l'elemento dentro cartItem
            let singleItem = this.menu.find(item => item.value === value);
            if (singleItem) {
                singleItem.quantity--
                localStorage.setItem(0, JSON.stringify(this.menu));
            } else {
                this.getMenu(this.actualLocalStorage);
                singleItem.quantity--
                localStorage.setItem(0, JSON.stringify(this.menu));
            }

        },
        getMenu(actualLocalStorage) {
            if (this.restaurant.dishes) {
                if (this.actualLocalStorage == null) {

                    this.menu = [];
                    this.restaurant.dishes.forEach(dish => {
                        this.menu.push({
                            'id': dish.id,
                            'value': dish.name,
                            'ingredients_description': dish.ingredients_description,
                            'price': dish.price,
                            'visibility': dish.visibility,
                            'quantity': 0,

                        })
                    });

                } else {
                    this.menu = actualLocalStorage;
                }
            }
        },
        getLocalStorageValues() {
            this.menu = JSON.parse(localStorage.getItem(0));
            let menuStorage = JSON.parse(localStorage.getItem(0));
            return menuStorage;
        },
        checkRestaurant() {
            this.actualRestaurant = this.restaurant.id;
            console.log(this.actualRestaurant);
            console.log(localStorage.getItem('restaurant_id'));
            if (this.actualRestaurant != localStorage.getItem('restaurant_id')) {
                localStorage.removeItem(0);
                this.getMenu(this.actualLocalStorage);
            }

            localStorage.setItem('restaurant_id', this.restaurant.id);
        },
        clearCart() {
            localStorage.removeItem(0);
            this.actualLocalStorage = null;
            this.getMenu(this.actualLocalStorage);
        },
        removeProduct(value, quantity) {
            if (quantity > 0) {
                let singleItem = this.menu.find(item => item.value === value);
                singleItem.quantity = 0;
                localStorage.setItem(0, JSON.stringify(this.menu));
            }
        },
        totalPriceSingleProduct(price, quantity) {
            return (price * quantity).toFixed(2);
        },
        totalPrice() {
            let total = 0;

            this.menu.forEach(product => {
                let price = product.price;
                let quantity = product.quantity;
                let totalsinglePrice = this.totalPriceSingleProduct(price, quantity)
                total = total + parseFloat(totalsinglePrice);
                localStorage.setItem('priceTotal', (total).toFixed(2));
            });
            return (total).toFixed(2);
        },
        resetSelectedTypes() {
            this.store.selectedTypes = [];
        },
        buttonPay() {
            this.showCartPayment = true;
            this.store.selectedTypes = [];
        }
    },
    created() {
        this.$watch(
            () => this.$route.params,
            () => {
                this.clearCart();
                this.getRestaurant();
            }
        )
    },
    mounted() {
        this.getRestaurant();
        console.log(this.showModal);
    },
    updated() {
        console.log('localStorage:', localStorage);
        console.log('menu:', this.menu);
        console.log('actualLocalStorage:', this.actualLocalStorage)
    }
}
</script>

<template>
    <div id="flex">
        <!-- PARTE DI SINISTRA -->
        <div id="left-side">
            <!-- RISTORANTE -->
            <h1>
                <i class="fa-solid fa-utensils"></i>
                Ristorante :
            </h1>
            <div class="restaurant-card">
                <div class="card-sx">
                    <div class="wrapper">
                        <img v-if="restaurant.img" :src="`${this.store.baseUrl}/storage/${restaurant.img}`">
                        <img v-else src="/src/assets/default_img.jpg" />
                    </div>
                </div>
                <div class="card-dx">
                    <h2 class="restaurant-title">{{ restaurant.name }}</h2>
                    <div class="restaurant-type">
                        <p v-for="restaurantType in restaurant.types" :key="restaurantType.id">
                            {{ restaurantType.name }}
                        </p>
                    </div>
                    <button v-if="totalPrice() > 0" @click="showModal = true">
                        Torna indietro<span>&larr;</span>
                        <RouterLink to="/ristoranti">
                        </RouterLink>
                    </button>
                    <button v-else>
                        <RouterLink to="/ristoranti" @click="resetSelectedTypes()">
                            Torna indietro<span>&larr;</span>
                        </RouterLink>
                    </button>
                    <!-- Componente ShowModale -->
                    <SavedModal v-show="showModal" @close-modal="showModal = false">
                    </SavedModal>
                    <!-- Componente ShowModale -->
                </div>
            </div>
            <!-- PIATTI -->
            <h1>
                <i class="fa-solid fa-plate-wheat"></i>
                Menù :
            </h1>
            <div class="restaurant-card" v-if="menu.length > 0">
                <ul class="piatti">
                    <li v-for="dish in restaurant.dishes" class="piatto" v-show="dish.visibility == 1">
                        <span>
                            <h3>{{ dish.name }}</h3>
                            <p>{{ dish.ingredients_description }}</p>
                            <p><strong>Prezzo : </strong>&euro; {{ dish.price }}</p>
                            <div class="buttons-dishes">
                                <button @click="addOneToCart(dish.name)">Aggiungi al carrello</button>
                            </div>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="restaurant-card" v-else>
                <span>Questo ristorante non ha piatti..</span>
            </div>
        </div>

        <!-- PARTE DI DESTRA -->
        <div id="right-side" class="cart">

            <!-- CARRELLO -->
            <h1>
                <i class="fa-solid fa-cart-shopping"></i>
                Carrello :
            </h1>
            <div class="restaurant-card">
                <h3 v-if="totalPrice() > 0">
                    Il tuo ordine : <span> &euro; {{ totalPrice() }}</span>
                    <h6>sei pronto per ordinare</h6>
                    <hr>
                </h3>

                <h3 v-else> Carrello Vuoto </h3>

                <ul>
                    <li v-for=" dish in menu" class="product-cart-card" v-show="dish.quantity > 0">
                        <h2>{{ dish.value }}</h2>
                        <p><strong>Ingredienti : </strong>{{ dish.ingredients_description }}</p>
                        <p><strong>Prezzo : </strong>&euro; {{ dish.price }}</p>
                        <p><strong>Quantità : </strong>
                            <span class="quantita">{{ dish.quantity }}</span>
                        </p>
                        <p><strong>Totale : </strong><span>&euro; {{ totalPriceSingleProduct(dish.price, dish.quantity)
                        }}</span></p>
                        <div class="button">
                            <button class="button-cart" @click="removeProduct(dish.value, dish.quantity)"><i
                                    class="fa-solid fa-trash"></i></button>
                            <button class="button-cart" @click="addOneToCart(dish.value)">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <button class="button-cart" @click="removeOneToCart(dish.value)" v-show="dish.quantity > 1">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                        </div>
                    </li>
                </ul>
                <div class="button">

                    <div class="button-success">
                        <button v-if="totalPrice() > 0" @click="buttonPay()">
                            <i class="fa-solid fa-credit-card"></i>
                            <span>Vai al pagamento</span>
                        </button>
                    </div>
                    <button v-show="totalPrice() > 0" @click="showCartModal = true" class="button-delete">
                        <i class="fa-solid fa-trash-can"></i>
                        <span>Svuota carrello</span>
                    </button>
                </div>

                <!-- MODALE -->
                <!-- Componente ShowCartModale -->
                <CartModale v-show="showCartModal" @clear-cart-modal="clearCart()"
                    @close-cart-modal="showCartModal = false">
                </CartModale>
                <!-- Componente ShowCartModale -->
                <!-- Componente ShowModale -->
                <MyCartPayment v-show="showCartPayment" @close-cart-payment="showCartPayment = false"></MyCartPayment>
                <!-- Componente ShowModale -->
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
@use '../styles/partials/mixins' as*;
@use '../styles/partials/variables' as*;

#flex {
    min-height: calc(100vh - 4rem);
    display: flex;
    justify-content: space-between;
    @include container-80;
    padding-bottom: 2rem;

    h1 {
        padding-top: 2rem;
        color: $color-secondary;
    }

    #left-side {
        width: 50%;

        .restaurant-card {
            @include card-1;
            width: 100%;
            margin-top: 0px;

            .piatti {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                list-style: none;
                width: 100%;


                .piatto {
                    width: 80%;
                    text-align: left;
                    border: double 8px orange;
                    border-radius: 20px;
                    padding: 1rem 2rem;
                    margin: 0.5rem;
                    transition: all 0.5s ease-out;

                    &:hover {
                        box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.5), 5px 5px 3px 3px rgba(0, 0, 0, 0.5);
                    }

                    h3::first-letter,
                    p::first-letter {
                        text-transform: uppercase;

                    }

                    .buttons-dishes {
                        display: flex;
                        margin-top: 1rem;

                        button {
                            @include button-cart;
                            margin: 0 0.5rem;
                            border-radius: 10px;
                        }
                    }
                }
            }

            .card-sx {
                width: 50%;

                .wrapper {
                    height: 20rem;

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
                justify-content: space-around;
            }

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

            button {
                @include button-primary;
                margin-top: 1rem;
            }
        }
    }

    #right-side {
        width: 45%;

        .restaurant-card {
            @include card-1;
            width: 100%;
            max-height: 80vh;
            flex-direction: column;
            text-align: left;
            margin-top: 0px;

            ul {
                overflow-y: auto;

                &::-webkit-scrollbar {
                    height: 10px;
                    width: 10px;
                }

                &::-webkit-scrollbar-thumb {
                    background-color: $color-tertiary;
                    border-radius: 10px;

                    &:hover {
                        background-color: grey;
                    }
                }

                li {
                    @include card-2;
                    list-style: none;
                    border: none;
                    box-shadow: 3px 3px 3px 3px rgba(0, 0, 0, 0.5);
                }
            }

            .button {
                display: flex;
                width: 100%;
                margin-top: 1rem;

                .button-delete {
                    @include button-delete;
                    max-width: 15rem;
                    margin: 0 0.5rem;
                }

                .button-success {
                    max-width: 15rem;

                    button {
                        @include button-success;
                        margin: 0 0.5rem;
                    }
                }

                .button-cart {
                    @include button-cart;
                    margin: 0 0.5rem;
                }

            }

            .product-cart-card {
                margin: 20px 10%;

                .quantita {
                    border: 1px solid black;
                    padding: 0rem 1rem;
                    border-radius: 0.1rem;
                }
            }

            a {
                color: black;
                text-decoration: none;
            }

            h2 {
                margin-bottom: 1rem;
            }


            h3 {
                h6 {
                    padding: .5rem 0;
                    color: green;
                    font-style: italic;
                    font-weight: lighter;
                }

                span {
                    color: red;
                }
            }

            ul {
                p {
                    padding: .3rem 0;
                }

                li {
                    span {
                        color: red
                    }
                }
            }
        }

    }
}

@media screen and (max-width: 768px) {
    #flex {
        display: flex;
        flex-direction: column;
        width: 100%;

        #left-side {
            width: 100%;
            padding: 0 0.5rem;

            .restaurant-card {
                display: flex;
                flex-direction: column;
                align-items: center;

                .card-sx {
                    width: 90%;

                    .wrapper {
                        padding: 1rem 0;

                        img {
                            border-radius: 1rem;
                        }
                    }
                }

                .card-dx {
                    width: 100%;
                    margin-top: 1rem;
                }
            }
        }

        #right-side {
            width: 100%;
            padding: 0 0.5rem;

            .restaurant-card {
                .button {

                    .button-success,
                    .button-delete {
                        span {
                            display: none;
                        }
                    }
                }
            }
        }
    }
}

@media screen and (max-width: 768px) {
    #right-side {

        .restaurant-card {
            .button {

                .button-success,
                .button-delete {
                    span {
                        display: none;
                    }
                }
            }
        }
    }
}
</style>
