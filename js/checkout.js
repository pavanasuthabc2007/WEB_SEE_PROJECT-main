function showOrderSummary() {

    // ===== FORM VALIDATION =====
    const name = document.getElementById("fullName").value.trim();
    const phone = document.getElementById("phoneNum").value.trim();
    const address = document.getElementById("deliveryAddress").value.trim();
    const pincode = document.getElementById("pincode").value.trim();

    if (name.length < 3) {
        alert("Please enter a valid name");
        return;
    }

    if (!/^[6-9]\d{9}$/.test(phone)) {
        alert("Please enter a valid 10-digit phone number");
        return;
    }

    if (address.length < 10) {
        alert("Please enter a valid address");
        return;
    }

    if (!/^\d{6}$/.test(pincode)) {
        alert("Please enter a valid 6-digit pincode");
        return;
    }

    // ===== GET CART =====
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // ===== GET PAYMENT METHOD =====
    const paymentInputs = document.querySelectorAll('input[name="paymentMethod"]');
    let paymentMethod = "Cash On Delivery";
    paymentInputs.forEach(input => {
        if(input.checked){
            paymentMethod = input.value || "Cash On Delivery";
        }
    });

    // ===== CALCULATE TOTAL =====
    let total = 0;
    cart.forEach(item => {
        total += Number(item.price) * Number(item.qty);
    });

    // ===== SEND ORDER TO DATABASE =====
    fetch("place_order.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            full_name: name,
            phone: phone,
            address: address,
            pincode: pincode,
            payment_method: paymentMethod,
            total_amount: total,
            items: cart
        })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === "success"){

            // ===== SHOW ORDER SUMMARY =====
            const orderItems = document.getElementById("order-items");
            const orderTotal = document.getElementById("summary-total-price");
            const deliveryDateEl = document.getElementById("delivery-date");

            orderItems.innerHTML = "";

            cart.forEach(item => {
                orderItems.innerHTML += `
                    <div class="order-item">
                        <img src="${item.img}" width="50">
                        <div>
                            <p><strong>${item.name}</strong></p>
                            <p>₹${item.price} × ${item.qty}</p>
                        </div>
                    </div>
                `;
            });

            orderTotal.innerText = `₹${total}`;

            // Delivery date (+3 days)
            const today = new Date();
            const delivery = new Date(today);
            delivery.setDate(today.getDate() + 3);
            const options = { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' };
            deliveryDateEl.innerHTML =
                `📦 Estimated Delivery: <strong>${delivery.toLocaleDateString('en-IN', options)}</strong>`;

            // Success message
            orderItems.innerHTML += `
                <p class="success-msg">
                    ✅ Order #${data.order_id} placed successfully!
                </p>
            `;

            // Clear cart
            localStorage.removeItem("cart");

        } else {
            alert("Order failed: " + data.message);
        }
    })
    .catch(err => {
        alert("Something went wrong! Please try again.");
        console.error(err);
    });
}