document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const subtotal = urlParams.get('subtotal');
    const dataElements = document.querySelector(".inf-order").querySelectorAll("span");
    dataElements[0].innerHTML = subtotal;
    dataElements[1].innerHTML = 2;
    dataElements[2].innerHTML = Number(subtotal) + 2;
});