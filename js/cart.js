// cart.js
let cart = JSON.parse(localStorage.getItem("cart")) || [];

const cartItemsContainer = document.getElementById("cart-items");
const totalContainer = document.getElementById("total");

function renderCart() {
    cartItemsContainer.innerHTML = "";

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = "<p>Your cart is empty</p>";
        totalContainer.innerText = "";
        return;
    }

    let totalPrice = 0;

    cart.forEach((item, index) => {
        totalPrice += item.price * item.qty;

        let div = document.createElement("div");
        div.className = "cart-item";
        div.innerHTML = `
            <img src="${item.img}" alt="${item.name}" width="80">
            <h3>${item.name}</h3>
            <p>Price: ₹${item.price}</p>
            <p>Quantity: ${item.qty}</p>
            <button onclick="removeItem(${index})">Remove</button>
        `;
        cartItemsContainer.appendChild(div);
    });

    totalContainer.innerText = `Total: ₹${totalPrice}`;

    // ✅ SAVE TOTAL FOR CHECKOUT
    localStorage.setItem("cartTotal", totalPrice);
}

function removeItem(index) {
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
}

// ✅ BUY NOW → GO TO CHECKOUT
function buyNow() {
    if (cart.length === 0) {
        alert("Your cart is empty");
        return;
    }
  window.location.href = "checkout.php";
}

// initial render
renderCart();
