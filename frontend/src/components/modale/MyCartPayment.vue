<template>
    <div class="modal-overlay " @click="$emit('close-cart-payment')">
        <div class="modal d-flex-justify-center" @click.stop>
            <div class="close" id="payment-close" @click="$emit('close-cart-payment')"><i class="fa-solid fa-x"></i></div>
            <div id="form-customer">
                <div class="input-container">
                    <label for="name">Nome</label>&nbsp; <br />
                    <input type="text" id="name" maxlength="50" placeholder=" Nome sul campanello" v-model="name" required>
                    <p class="input-error" v-if="!name">{{ itemsError.name }}</p>

                </div>
                <div class="input-container">
                    <label for="address">Indirizzo</label>&nbsp; <br />
                    <input type="text" id="address" max="100" v-model="address" placeholder=" Via Esempio n.22" required>
                    <p class="input-error" v-if="!address">{{ itemsError.address }}</p>
                </div>
                <div class="input-container">
                    <label for="phone_number">Cellulare</label>&nbsp; <br />
                    <input type="text" minlength="10" maxlength="15" id="phone_number" v-model="phone_number"
                        placeholder=" 012 000011110000" required>

                    <p class="input-error" v-if="!phone_number">
                        {{ itemsError.phone_number }}
                    </p>
                    <p class="input-error last" v-else-if="phone_number.length < 10 || phone_number.length > 15">
                        {{ itemsError.phone_number_length }}
                    </p>
                    <p class="input-error" v-if="phone_number.length > 0 && isNaN(phone_number)">
                        {{ itemsError.phone_number_no_letters }}
                    </p>


                </div>
                <div class="input-container">
                    <label for="email">Email</label>&nbsp; <br />
                    <input type="email" id="email" max="50" v-model="email" placeholder=" email@esempio.com" required>
                    <p class="input-error last" v-if="!email">{{ itemsError.email }}</p>
                    <p class="input-error" v-if="!email.includes('@') || !checkValidEmail(email) || email.length < 3">
                        {{ itemsError.email_validation }}</p>
                </div>
                <div id="total"><span>Totale:</span><span> {{ total_price }} €</span></div>
            </div>
            <div id="dropin-wrapper" class="input-container">
                <div id="checkout-message"></div>
                <div id="dropin-container"></div>

                <button class="button-success" id="submit-button" :disabled="!checkInputErrors()" @click="payment()">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>PAGA</span>
                </button>

                <p class="input-error" v-if="!checkInputErrors()">
                <h5>
                    {{ itemsError.button }}
                </h5>
                </p>

            </div>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';
import { store } from '../../store.js';
import dropin from 'braintree-web-drop-in';



export default {
    name: 'MyCartPayment',
    data() {
        return {
            store,
            menu: '',
            instance: '',
            name: '',
            address: '',
            phone_number: '',
            email: '',
            total_price: 0,
            itemsError: {
                name: 'Inserire il nome presente sul campanello',
                address: 'Aggiungere indirizzo di consegna',
                phone_number: 'Inserire un contatto telefonico',
                phone_number_length: 'Minimo 10 cifre, massimo 15',
                phone_number_no_letters: 'Inserire solo numeri',
                email: "Inserire l'e-mail per la conferma",
                email_validation: "Inserire un email valida",
                button: 'Compilare correttamente tutti i campi'
            }
        }
    },
    methods: {
        payment(event) {
            if (this.checkInputErrors()) {
                this.instance.requestPaymentMethod((requestPaymentMethodErr, payload) => {

                    let data = {
                        'paymentMethodNonce': payload.nonce,
                        'name_customer': this.name,
                        'address_customer': this.address,
                        'phone_number_customer': this.phone_number,
                        'email_customer': this.email,
                        'menu': this.menu,
                        'total_price': this.total_price,
                        'status': 1,
                    }
                    console.log(data);

                    axios.post(`${this.store.baseUrl}/api/checkout`, data)
                        .then((response) => {
                            console.log(response);
                            if (response.data.success) {

                                localStorage.setItem('order', JSON.stringify(response.data.newOrderData))
                                this.$router.push({ name: 'confirmed-order' });
                            } else {
                                let slug = this.$route.params.slug;
                                this.$router.push({ name: 'single-restaurant', params: { 'slug': slug } });
                            }

                        }).catch((error) => {

                            console.log(error.response.data);
                        })
                })
            } else {
                event.preventDefault();
            }
        },

        checkValidEmail(value) {
            return /^(?!.@.@)[^@].*[^@]$/.test(value);
        },

        checkInputErrors() {
            if (
                !this.name
                || !this.address
                || !this.phone_number
                || this.phone_number.length < 10
                || this.phone_number.length > 15
                || isNaN(this.phone_number)
                || !this.email
                || !this.email.includes('@')
                || !this.checkValidEmail(this.email)
                || email.length < 3
            ) {
                return false;
            } else {
                return true;
            }
        },
        updateCart() {
            this.total_price = localStorage.getItem('priceTotal');
            this.menu = JSON.parse(localStorage.getItem(0));
        },

    },
    mounted() {
        dropin.create({
            authorization: "sandbox_w3brdskj_9xyqnm47s44yp4t4",
            container: '#dropin-container'
        }, (error, instance) => {
            if (error) {
                console.log(error);
            } else {
                this.instance = instance;
                console.log(instance);
            }
        });

        // this.updateCart();

    },
    updated() {
        this.updateCart();
    }
}
</script>

<style scoped lang="scss">
// utility
@use '../../styles/partials/mixins' as*;
@include modal;

.modal {
    width: 80%;
    height: 80%;
    padding: 50px;
    max-width: 1200px;
}

.close#payment-close {
    position: absolute;
    top: -95px;
    right: 20px;
}

#form-customer {
    background-color: rgba($color: #fff, $alpha: .7);
    padding: 2rem;
    border-radius: 5px;
    min-width: 500px;
    text-align: start;

    label {
        display: inline-block;
        margin-bottom: 5px;
        font-weight: 300;
        font-size: 1.2rem;
    }

    input {
        padding: 8px 0px 8px 2px;
        width: 100%;
        margin-bottom: 45px;
        font-size: 1rem;
        border: none;
        border-bottom: 1px solid rgba($color: #000, $alpha: .4);
        background: transparent;

        &:focus {
            outline: none;
        }
    }

    #total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: rgba(0, 0, 0, 0.777);

        span:first-child {
            font-size: 1.5rem;
        }

        span:last-child {
            font-size: 2rem;
        }
    }

    .input-container {
        position: relative;
    }

    .input-error {
        font-size: 0.9rem;
        font-weight: 400;
        color: red;
        position: absolute;
        top: 45px;
        left: 0;

        &.last {
            top: 60px;
        }

    }
}

.d-flex-justify-center {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 50px;

}

.ms-3 {
    margin-left: 3rem;
}

.check {
    width: 150px;
}

.white-font {
    color: rgb(255, 255, 255);
}

h5 {
    font-weight: 400;
    text-decoration: underline;
    color: rgba($color: #fff, $alpha: 0.9);
}

p {
    font-size: 16px;
    margin: 20px 0;
}

button {
    @include button-success;
    margin: auto;
    padding: 1rem 2rem;
    font-size: 1.4rem;
    background-color: rgba(76, 253, 53, 0.6);
    color: rgb(69, 172, 55);

    &:hover,
    &:active {
        color: white;
    }
}
@media (max-width: 1200px) {
    .modal .close{
        margin-top: 110px;
    }
}

@media (max-width: 992px) {
    .modal-overlay {
        .modal.d-flex-justify-center {
            gap: 0px;

        }

        .modal {
            margin-top: 25px;
            padding-top: 70px;
            min-width: 90%;
            height: 850px;
            display: flex;
            flex-direction: column;


            .close#payment-close {
                position: absolute;
                top: -90px;
                right: 17px;
            }

            #form-customer {
                padding: 1rem;
                border-radius: 15px;
                min-width: 350px;

                input {
                    margin-bottom: 32px;
                }

                label {
                    font-size: 1rem;
                    margin-bottom: 1px;
                }

                #total {
                    margin-top: 10px;

                    span:first-child {
                        font-size: 1rem;
                    }

                    span:last-child {
                        font-size: 1.3rem;
                    }
                }

                .input-error {
                    font-size: 0.7rem;

                }
            }

        }
    }

}

@media (max-width: 500px) {
    .modal-overlay {

        .modal {
            padding-top: 250px;
            padding-bottom: 250px;
            min-width: 95%;

            overflow-y: scroll;

            .close#payment-close {
                position: absolute;
                top: -90px;
                right: 17px;
                font-size: 1.5rem;
            }

            #form-customer {
                margin-top: 25px;
                padding: 1rem;
                border-radius: 15px;
                min-width: 300px;


                label {
                    font-size: 0.9rem;
                }

                input {
                    font-size: 0.7rem;
                }

                .input-error {
                    font-size: 0.6rem;

                }
            }

        }
    }

}
</style>
  