<script>
import { store } from '../store.js';
export default {
    name: 'TypeCard',

    data() {
        return {
            store,
            isGreen: false
        }
    },
    methods: {
        activeTypes(id) {
            const index = this.store.selectedTypes.indexOf(id);
            if (index === -1) {
                // l'id non è presente nell'array, aggiungilo
                this.store.selectedTypes.push(id);
            } else {
                // l'id è presente nell'array, rimuovilo
                this.store.selectedTypes.splice(index, 1);
            }
            console.log(this.store.selectedTypes);
        },
        toggleColor() {
            this.isGreen = !this.isGreen;
        },
        toggleColorAndFunction(id) {
            this.toggleColor();
            this.activeTypes(id);
        }

    },
    props: {
        TypeObject: Object,
    },
}
</script>
<template>
    <div class="type-card">
        <button @click="toggleColorAndFunction(TypeObject.id)" :class="isGreen ? 'green' : 'black'">
            <span>
                {{ TypeObject.name }}
            </span>
            <img :src="'/src/assets/types_img/' + TypeObject.name + '.png'" alt="">
            <!-- <img :src="'/src/assets/' + TypeObject.name + '.png'" alt=""> -->
        </button>
    </div>
</template>
<style scoped lang="scss">
@use '../styles/partials/mixins' as*;
@use '../styles/partials/variables' as*;

.type-card {

    min-width: calc(100% / 8);
    height: 9.5rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    padding: 1rem;


    button {
        padding: 0.5rem;
        height: 100%;
        border-radius: 0.2rem;
        background-color: $color-primary;
        box-shadow: 0 0 1px rgba(0, 0, 0, .1), 0 2px 4px rgba(0, 0, 0, .02);
        cursor: pointer;
        display: flex;
        flex-direction: column-reverse;
        align-items: center;
        justify-content: center;
        border: none;
        text-transform: uppercase;


        &:hover {
            box-shadow: 0 15px 30px 0 rgba(0, 0, 0, .11), 0 5px 15px 0 rgba(0, 0, 0, .08);
        }

        img {
            height: 80%;
            max-width: 80%;
        }

        span {
            padding: 10px;
        }

    }

    .green {
        color: green;
        border: 1px solid green;
        box-shadow: 0 15px 30px 0 rgba(76, 255, 5, 0.11), 0 5px 15px 0 rgba(76, 255, 5, .08);
        font-weight: bolder;
    }

    .black {
        color: black;
    }


}

//responsive md
@media screen and (max-width: 1400px) {
    .type-card {

        min-width: calc(1000px / 8);
        height: 4rem;

        button {

            img {
                display: none;
            }

            span {
                font-size: 0.65rem;
                font-weight: 500;
            }

        }

    }



}
</style>