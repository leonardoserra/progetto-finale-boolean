<script>
import axios from 'axios';
import { store } from '../store.js';
export default {
  name: 'ConfirmedOrder',
  data() {
    return {
      store,
      receipt: [],
      order: [],
      restaurant_user: [],
      success_confirmed: false,
      success_received: false,
      errors: '',
    }
  },
  methods: {

    getOrder() {
      this.receipt = JSON.parse(localStorage.getItem(0));
      this.order = JSON.parse(localStorage.getItem('order'));
      this.restaurant_user = JSON.parse(localStorage.getItem('restaurant_user'));
      console.log(this.order);

      //commenta o decommenta per cancellare il local storage 
      this.clearLocalStorage();
    },
    totalPrice() {
      let total = 0;

      this.receipt.forEach(product => {
        let price = product.price;
        let quantity = product.quantity;
        let totalsinglePrice = this.totalPriceSingleProduct(price, quantity)
        total = total + parseFloat(totalsinglePrice);
      });
      return (total).toFixed(2);
    },
    totalPriceSingleProduct(price, quantity) {
      return (price * quantity).toFixed(2);
    },
    clearLocalStorage() {
      localStorage.clear();
    },

    sendMailData(receipt, order, restaurant_user) {

      if (this.order == null || this.restaurant_user == null) {
        this.$router.push({ name: 'restaurants' });
      } else {
        let payload = {
          order_id: order.id,
          name_customer: order.name_customer,
          address_customer: order.address_customer,
          email_customer: order.email_customer,
          phone_number_customer: order.phone_number_customer,
          total_price: order.total_price,
          created_at: order.created_at,
          restaurant_user: restaurant_user,

          //array di oggetti
          menu: receipt


          //chiamata per ordine confermato
        }
        axios.post(`${this.store.baseUrl}/api/orders-confirmed-mail`, payload
        ).then(response => {
          if (response.data.success) {
            this.success_confirmed = true;
            // console.log(response);

          }
        }).catch(error => {
          console.log(error.response.data);
        });



        //chiamata per ordine ricevuto
        axios.post(`${this.store.baseUrl}/api/orders-received-mail`, payload
        ).then(response => {
          if (response.data.success) {
            this.success_received = true;
            console.log(response.data.data);
            console.log(localStorage);
          }
        }).catch(error => {
          console.log(error.response.data);
        });
      }


    },
  },
  mounted() {
    this.getOrder();
    console.log(this.receipt);
    this.sendMailData(this.receipt, this.order, this.restaurant_user);
  },




}
</script>

<template>
  <div class="confirmed-order">
    <div class="receipt-card">

      <h1 class="receipt-title">
        Ordine effettuato correttamente!
      </h1>
      <div class="receipt-details">

        <div>Riepilogo Ordine</div>
        <ul class="details-list">
          <li class="single-detail" v-show="item.quantity > 0" v-for="item in this.receipt ">
            <div class="item-quantity">

              x{{ item.quantity }}&nbsp;{{ item.value }}
            </div>
            <div class="item-price">
              {{ totalPriceSingleProduct(item.price, item.quantity) }}€
            </div>
          </li>
        </ul>
      </div>
      <div class="receipt-total">

        <div class="total-label">
          TOTALE:
        </div>

        <div class="total-value">

          {{ totalPrice() }}€
        </div>
      </div>

      <div class="receipt-message">
        <p class="text-message">Ti abbiamo inviato il riepilogo dell'ordine alla mail:


        <div class="mail-message">

          {{ order.email_customer }}
        </div>

        </p>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@use '../styles/partials/mixins' as*;
@use '../styles/partials/variables' as*;

.confirmed-order {
  min-height: calc(100vh - 9rem);
  min-width: 300px;

  .receipt-card {
    margin: auto;
    max-width: 50rem;
    padding: 3.5rem;
    margin-top: 5rem;
    border: 1px solid rgba(0, 0, 0, .11);
    border-radius: 20px;
    background-color: $color-primary;
    transition: all 0.5s ease-out;

    &:hover {
      box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.5), 10px 10px 3px 3px rgba(0, 0, 0, 0.5);
    }

    .receipt-title {
      text-align: center;

    }

    .receipt-details {
      margin-top: 2rem;

      .details-list {
        list-style: none;


        .single-detail {
          font-weight: 200;
          font-size: 1.5rem;
          margin-top: 1rem;
          display: flex;
          justify-content: space-between;

        }

      }
    }

    .receipt-total {
      display: flex;
      justify-content: space-between;
      border-top: solid black 1px;
      margin-top: 1rem;
      padding-top: .5rem;
      text-align: end;
      font-size: 1.8rem;

    }

    .receipt-message {
      text-align: center;
      margin-top: 3rem;
      padding: 2rem;
      border: 2px solid #ff8f29;
      border-radius: 25px;

      .text-message {
        font-size: 1.5rem;
        font-weight: 300;
        line-height: 3rem;

        .mail-message {
          font-weight: 500;
          font-size: 1.8rem;
        }
      }

    }
  }
}

@media all and (max-width: 840px) {

  .confirmed-order {
    .receipt-card {
      margin-left: 3rem;
      margin-right: 3rem;
      padding: 1.8rem;
    }
  }
}


@media all and (max-width: 576px) {
  .confirmed-order {
    .receipt-card {
      margin-left: 3rem;
      margin-right: 3rem;
      padding: 1.8rem;

      .receipt-title {
        font-size: 0.8rem;
      }

      .receipt-details {
        font-size: 0.8rem;

        .details-list {
          .single-detail {
            font-weight: 300;
            font-size: 0.7rem;
          }

        }
      }

      .receipt-total {

        margin-top: 0.8rem;
        padding-top: .3rem;
        text-align: end;
        font-size: 0.9rem;

      }

      .receipt-message {
        text-align: center;
        margin-top: 0.1rem;
        padding: 0.7rem;
        border: none;

        .text-message {
          font-size: 0.8rem;
          font-weight: 300;
          line-height: 1.5rem;

          .mail-message {
            margin-top: 0.3rem;
            font-weight: 500;
            font-size: 0.8rem;
          }
        }

      }
    }
  }

}
</style>

