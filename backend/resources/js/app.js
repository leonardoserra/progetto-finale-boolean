import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import './mychart.js';
import './mySecondChart.js';
import.meta.glob([
    '../img/**'
])



///creo modal per delete dish

const deleteButtons = document.querySelectorAll('.form_delete_dish button[type="submit"]');


deleteButtons.forEach(button => {
    button.addEventListener('click', event => {
        event.preventDefault();

        const modal = document.getElementById('confirmModal');

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        const confirmDeleteBtn = modal.querySelector('.btn.btn-danger')

        confirmDeleteBtn.addEventListener('click', () => {
            button.parentElement.submit();
        });
    })
});


const btnDelete = document.getElementById('btn-delete');

btnDelete.addEventListener('click', function () {
    const formDelete = document.getElementById('form-delete');
    formDelete.submit();
});












//PROVE VARIE//


//creo riferimento per validare types client side su registration

// const registrationForm = document.getElementById('registration-form');
// const registrationFormButton = document.getElementById('registration-form-button');
// const errorMessage = document.createElement('div');

// registrationFormButton.addEventListener('click', () => {
//     registrationFormButton.preventDefault();
//     // event.preventDefault();

//     // validateType(registrationForm);

//     const types = document.querySelectorAll('input[name="types[]"]:checked');

//     if (types.length === 0) {

//         errorMessage.classList.add('text-danger');
//         errorMessage.textContent = 'Seleziona almeno un tipo di ristorante.';

//         const typesContainer = document.querySelector('.type-validate');
//         typesContainer.appendChild(errorMessage);


//         return false;
//     } else {
//         // errorMessage.textContent = '';
//         registrationForm.submit();

//     }
// })




//funzioni



// function validateType(registrationForm) {
//     const types = document.querySelectorAll('input[name="types[]"]:checked');

//     if (types.length === 0) {

//         errorMessage.classList.add('text-danger');
//         errorMessage.textContent = 'Seleziona almeno un tipo di ristorante.';

//         const typesContainer = document.querySelector('.type-validate');
//         typesContainer.appendChild(errorMessage);


//         return false;
//     } else {
//         errorMessage.textContent = '';
//         registrationForm.submit();

//     }
//     return true;
// }
