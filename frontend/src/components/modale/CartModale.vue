<template>
    <div class="modal-overlay" @click="$emit('close-cart-modal')">
        <div class="modal" @click.stop>
            <div class="close" @click="$emit('close-cart-modal')"><i class="fa-solid fa-x"></i></div>
            <img src="./icons/cartCancelled.png" alt="cart cancelled">
            <p>Sei sicuro di voler eliminare il carrello?</p>
            <div class="button">
                <button class="conferma" @click="$emit(doubleEmitEvent())">Conferma</button>
                <button class="elimina" @click="$emit('close-cart-modal')">Annulla</button>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    name: 'CartModale',
    methods: {
        doubleEmitEvent() {
            this.$emit('clear-cart-modal');
            this.$emit('close-cart-modal');
        }
    }
}
</script>
<style scoped lang="scss">
@use '../../styles/partials/mixins' as*;
@use '../../styles/partials/variables' as*;

@include modal;

.check {
    width: 150px;
}

h6 {
    font-weight: 500;
    font-size: 28px;
    margin: 20px 0;
}

p {
    font-size: 16px;
    margin: 20px 0;
}
</style>