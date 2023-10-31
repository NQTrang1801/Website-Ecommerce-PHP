export const cart = JSON.parse(localStorage.getItem("cart")) || [];

export function save() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

export function remove(productID) {
    cart.forEach((item, index) => {
        if (item.productID === productID){
            cart.splice(index, 1);
            save();
        }
    });
}
