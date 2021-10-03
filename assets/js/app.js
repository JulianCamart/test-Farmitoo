import '../css/app.scss';
const $ = require('jquery');
require('bootstrap')

window.addEventListener('load', main);

function main() {
    document.querySelectorAll('[data-product]').forEach((productElement) => {
        const quantityElement = productElement.querySelector('[data-product-quantity]')

        productElement.querySelector('[data-product-more]').addEventListener('click', () => {
            quantityElement.innerHTML = parseInt(quantityElement.innerHTML) + 1
        })

        productElement.querySelector('[data-product-less]').addEventListener('click', () => {
            if(parseInt(quantityElement.innerHTML) > 0) {
                quantityElement.innerHTML = parseInt(quantityElement.innerHTML) - 1
            }
        })

        productElement.querySelector('[data-add-cart-url]').addEventListener('click', (evt) => {
            $.ajax({
                method: "POST",
                url: evt.target.dataset.addCartUrl,
                data: JSON.stringify({quantity: parseInt(quantityElement.innerHTML)})
            })

        })
    })
}