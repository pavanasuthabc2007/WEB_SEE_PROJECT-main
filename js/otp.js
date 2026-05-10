let generatedOTP = "";

function sendOTP() {
    let username = document.getElementById("username").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let msg = document.getElementById("msg");

    if (username.length < 3) {
        msg.style.color = "red";
        msg.innerText = "Username must be at least 3 characters";
        return;
    }

    if (!/^[6-9]\d{9}$/.test(phone)) {
        msg.style.color = "red";
        msg.innerText = "Enter valid 10-digit phone number";
        return;
    }

    // Generate OTP
    generatedOTP = Math.floor(100000 + Math.random() * 900000);

    // SIMULATION (for project)
    alert("Your OTP is: " + generatedOTP);
    console.log("OTP:", generatedOTP);

    msg.style.color = "green";
    msg.innerText = "OTP sent to your mobile number";

    document.getElementById("otpSection").style.display = "block";
}

function verifyOTP() {
    let enteredOTP = document.getElementById("otpInput").value.trim();
    let username = document.getElementById("username").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let msg = document.getElementById("msg");

    if (enteredOTP == generatedOTP) {
        // Save user account
        localStorage.setItem("loggedInUser", username);
        localStorage.setItem("userPhone", phone);

        msg.style.color = "green";
        msg.innerText = "Login successful!";

        setTimeout(() => {
            window.location.href = "index.html";
        }, 1000);
    } else {
        msg.style.color = "red";
        msg.innerText = "Invalid OTP";
    }
}
