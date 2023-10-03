<template>
    <div class="modal-overlay" @click="$emit('close-modal')">
        <div class="modal" @click.stop>
            <!-- <div class="wrapper">
                <img src="../../assets/background_img/sun-tornado.svg" alt="">
            </div> -->
            <div class="close" @click="$emit('close-modal')"><i class="fa-solid fa-x"></i></div>
            <img src="./icons/cartCancelled.png" alt="cart cancelled">
            <p>Sei sicuro di voler uscire dal ristorante?</p>
            <p>P.S.I tuoi salvataggi andranno persi <br> se cambi ristorante!</p>
            <div class="button">
                <RouterLink to="/ristoranti">
                    <button class="conferma">
                        Conferma
                    </button>
                </RouterLink>
                <button class="elimina" @click="$emit('close-modal')">Annulla</button>
            </div>

        </div>
    </div>
</template>
  
<script>
export default {
    name: 'SavedModal'
}
</script>
<style scoped lang="scss">
@use '../../styles/partials/mixins' as*;
@use '../../styles/partials/variables' as*;

@include modal;

.modal {
    width: 500px;

}


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