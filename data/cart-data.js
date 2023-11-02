export const cart = JSON.parse(localStorage.getItem("cart")) || [];

export function save() {
    localStorage.setItem("cart", JSON.stringify(cart));
}
