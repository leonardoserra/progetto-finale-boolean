<script>
import { RouterLink, RouterView } from 'vue-router'
import { store } from '../store.js';

export default {
  name: 'TheHeader',
  data() {
    return {
      store,
    }
  },
  methods: {
    resetSelectedTypes() {
      this.store.selectedTypes = [];
    }
  }
}
</script>

<template>
  <header>
    <div class="container">
      <div class="left">
        <img src="../assets/logo.png" alt="logo">
        <img id="deliveboo-logo-text" src="../assets/deliveboo.png" alt="logo">
      </div>
      <nav class="right">
        <RouterLink to="/" @click="resetSelectedTypes()">
          <div class="header-link">
            <i class="fa-solid fa-house"></i>
            <span>
              Home
            </span>
          </div>
        </RouterLink>
        <RouterLink to="/ristoranti" @click="resetSelectedTypes()">
          <div class="header-link">
            <i class="fa-solid fa-utensils"></i>
            <span>
              Ristoranti
            </span>
          </div>
        </RouterLink>
        <a href="http://127.0.0.1:8000/login">
          <div class="header-link">
            <i class="fa-solid fa-user"></i>
            <span>
              Accedi
            </span>
          </div>
        </a>
        <a href="http://127.0.0.1:8000/register">
          <div class="header-link">
            <i class="fa-solid fa-user-plus"></i>
            <span>
              Registrati
            </span>
          </div>
        </a>
      </nav>
    </div>
  </header>
</template>

<style scoped lang="scss">
@use '../styles/partials/mixins' as*;
@use '../styles/partials/variables' as*;

header {
  width: 100%;
  background-color: $color-primary;
  box-shadow: 0 0 1px rgba(0, 0, 0, .1), 0 2px 4px rgba(0, 0, 0, .02);
  height: 4rem;
  position: fixed;
  top: 0px;
  left: 0px;

  .container {
    @include container-80;
    height: 100%;
    display: flex;
    justify-content: space-between;

    .left {
      @include flex-center;


      img {
        height: 100%
      }

      #deliveboo-logo-text {
        width: 250px;
        height: 50%;
        margin-left: 1rem;
      }
    }

    .right {
      display: flex;
      justify-content: end;
      align-items: center;


      a {
        text-decoration: none;


        .header-link {
          margin: 1rem;
          padding: 0.2rem 0rem;
          position: relative;
          color: $color-secondary;
          text-align: center;

          &::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 4px;
            border-radius: 4px;
            background-color: $color-secondary;
            bottom: 0;
            left: 0;
            transform-origin: right;
            transform: scaleX(0);
            transition: transform .3s ease-in-out;
          }

          &:hover::before {
            transform-origin: left;
            transform: scaleX(1);
          }
        }

      }
    }
  }
}

@media screen and (max-width: 768px) {
  .right {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;

    a {
      span {
        display: none;
        transition: all 1s ease;
      }
    }
  }
}

@media screen and (max-width: 676px) {
  #deliveboo-logo-text {
    display: none;
  }
}
</style>
