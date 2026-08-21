<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
:root{
    --blue: #7BB8F0;
    --blue-dark: #5CA3E8;
    --cream: #FCE3C0;
    --cream-light: #FDEEDA;
    --ink: #1F2430;
    --white: #ffffff;
    --border: #e2e6ec;
    --muted: #9aa1ad;
}

*{ box-sizing: border-box; margin:0; padding:0; }

body{
    font-family: 'Nunito', sans-serif;
    color: var(--ink);
    background:#f4f7fb;
    display:flex;
    align-items:center;
    justify-content:center;
    min-height:100vh;
}

.login-card{
    width: min(480px, 100%);
    background: #fff;
    border-radius: 28px;
    padding: 40px;
    box-shadow: 0 24px 60px rgba(0,0,0,0.1);
}

.login-card h1{
    font-family: 'Baloo 2', cursive;
    font-size: 2rem;
    margin-bottom: 8px;
    color: var(--blue-dark);
}

.login-card p.sub{
    font-size: 14.5px;
    font-weight: 600;
    color: var(--muted);
    margin-bottom: 26px;
    line-height: 1.5;
}

.steps{
    display:flex;
    align-items:center;
    gap: 6px;
    margin-bottom: 28px;
}

.step-dot{
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--border);
    transition: background .2s ease, transform .2s ease;
}

.step-dot.active{
    background: var(--blue);
    transform: scale(1.2);
}

.step-dot.done{
    background: var(--blue-dark);
}

.step-line{
    flex: 1;
    height: 2px;
    background: var(--border);
}

.form-group{ display:flex; flex-direction:column; gap:10px; margin-bottom: 18px; }
.form-group label{ font-weight: 700; }

input, select{
    width: 100%;
    padding: 14px 16px;
    border: 1.5px solid var(--border);
    border-radius: 14px;
    font-size: 15px;
    font-family: inherit;
    outline: none;
}

input:focus{ border-color: var(--blue); }

button{
    width: 100%;
    padding: 14px 18px;
    border: none;
    border-radius: 14px;
    background: var(--blue);
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s ease;
    font-family: inherit;
}

button:hover{ background: var(--blue-dark); }

button:disabled{
    background: #cbd2db;
    cursor: not-allowed;
}

.back-link{
    display:flex;
    align-items:center;
    gap: 6px;
    font-size: 13.5px;
    font-weight: 800;
    color: var(--blue-dark);
    cursor:pointer;
    margin-bottom: 20px;
    background:none;
    border:none;
    width: auto;
    padding: 0;
}

.back-link:hover{ background: none; }

.back-link svg{ width: 16px; height:16px; }

.note{
    margin-top: 18px;
    color: #5d6d86;
    font-size: 14px;
    line-height: 1.6;
}

.error{
    margin-top: 4px;
    margin-bottom: 14px;
    color: #c43333;
    font-weight: 700;
    font-size: 13.5px;
    display:none;
}

.error.show{ display:block; }

.email-target{
    text-align:center;
    font-size: 14.5px;
    font-weight: 700;
    margin-bottom: 24px;
    color: var(--ink);
}

.email-target span{ color: var(--blue-dark); }

.otp-inputs{
    display:flex;
    justify-content:space-between;
    gap: 8px;
    margin-bottom: 8px;
}

.otp-inputs input{
    width: 100%;
    aspect-ratio: 1/1;
    text-align:center;
    padding: 0;
    font-size: 20px;
    font-weight: 800;
}

.resend-row{
    text-align:center;
    font-size: 13.5px;
    font-weight:600;
    color: var(--muted);
    margin: 18px 0 4px;
}

.resend-row button{
    background:none;
    border:none;
    color: var(--blue-dark);
    font-weight: 800;
    cursor:pointer;
    text-decoration: underline;
    font-size: 13.5px;
    width: auto;
    padding: 0;
}

.resend-row button:hover{ background:none; }

.resend-row button:disabled{
    color: var(--muted);
    background: none;
    cursor:not-allowed;
    text-decoration:none;
}

.lock-icon{
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--cream-light);
    color: var(--blue-dark);
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom: 18px;
}

.lock-icon svg{ width: 22px; height: 22px; }

.success-step{
    text-align:center;
    padding: 6px 0 4px;
}

.success-step svg{
    width: 56px; height:56px;
    color: #3fb27f;
    margin: 0 auto 16px;
}

.success-step h2{
    font-family:'Baloo 2', cursive;
    font-size: 22px;
    margin-bottom: 8px;
}

.success-step p{
    font-size: 14.5px;
    color: var(--muted);
    font-weight:600;
    margin-bottom: 22px;
}
</style>
</head>
<body>

<div class="login-card" id="loginCard"></div>

<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script src="furryCornerStorage.js"></script>
<script>

const ADMIN_OTP_TEMPLATE_ID = "template_jic2rze";

const loginCard = document.getElementById("loginCard");

let adminUser = null;
let personalEmail = "";
let resendSeconds = 30;
let resendTimer = null;

/* =========================
   STEP 1 — Admin credentials
========================= */

function renderCredentialsStep(){

    clearInterval(resendTimer);

    loginCard.innerHTML = `
        <div class="steps">
            <div class="step-dot active"></div>
            <div class="step-line"></div>
            <div class="step-dot"></div>
            <div class="step-line"></div>
            <div class="step-dot"></div>
        </div>

        <h1>Admin Login</h1>
        <p class="sub">Sign in with your admin credentials to continue.</p>

        <form id="loginForm">
            <div class="form-group">
                <label for="email">Admin Email</label>
                <input id="email" type="email" placeholder="Enter admin email" required autocomplete="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" placeholder="Enter admin password" required autocomplete="current-password">
            </div>
            <div class="error" id="loginError">Invalid email or password.</div>
            <button type="submit">Continue</button>
        </form>
    `;

    const loginForm = document.getElementById("loginForm");
    const loginError = document.getElementById("loginError");

    loginForm.addEventListener("submit", event => {

        event.preventDefault();

        loginError.classList.remove("show");

        const submitBtn = loginForm.querySelector("button");
        submitBtn.disabled = true;
        submitBtn.textContent = "Checking...";

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;

        fetch("adminLogin.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                email: email,
                password: password
            })

        })

        .then(response => response.json())

        .then(result => {

            if(result.status === "success"){

                adminUser = result.user;
                renderEmailStep();

            }else{

                loginError.textContent = result.message;
                loginError.classList.add("show");
                submitBtn.disabled = false;
                submitBtn.textContent = "Continue";

            }

        })

        .catch(error => {

            console.error(error);
            loginError.textContent = "Server error. Please try again.";
            loginError.classList.add("show");
            submitBtn.disabled = false;
            submitBtn.textContent = "Continue";

        });

    });

}

/* =========================
   STEP 2 — Personal email
========================= */

function renderEmailStep(){

    loginCard.innerHTML = `
        <button class="back-link" id="backToCredentials">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Back
        </button>

        <div class="steps">
            <div class="step-dot done"></div>
            <div class="step-line"></div>
            <div class="step-dot active"></div>
            <div class="step-line"></div>
            <div class="step-dot"></div>
        </div>

        <div class="lock-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
        </div>

        <h1>Verify it's you</h1>
        <p class="sub">For extra security, enter the personal email registered for admin access. We'll send a one-time code there.</p>

        <form id="emailForm">
            <div class="form-group">
                <label for="personalEmail">Personal Email</label>
                <input id="personalEmail" type="email" placeholder="you@example.com" required autocomplete="email">
            </div>
            <div class="error" id="emailError">This email is not authorized for admin access.</div>
            <button type="submit">Send Code</button>
        </form>
    `;

    document.getElementById("backToCredentials").addEventListener("click", renderCredentialsStep);

    const emailForm = document.getElementById("emailForm");
    const emailError = document.getElementById("emailError");

    emailForm.addEventListener("submit", event => {

        event.preventDefault();

        emailError.classList.remove("show");

        const submitBtn = emailForm.querySelector("button");
        submitBtn.disabled = true;
        submitBtn.textContent = "Sending...";

        const enteredEmail = document.getElementById("personalEmail").value.trim();

        fetch("requestAdminOtp.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                email: enteredEmail
            })

        })

        .then(response => response.json())

        .then(result => {

            if(!result.success){

                emailError.textContent = result.message || "This email is not authorized for admin access.";
                emailError.classList.add("show");
                submitBtn.disabled = false;
                submitBtn.textContent = "Send Code";
                return;

            }

            personalEmail = enteredEmail;

            FurryCornerStorage.sendVerificationCode(
                personalEmail,
                result.otp,
                ADMIN_OTP_TEMPLATE_ID
            )
            .then(() => {

                renderOtpStep();

            })
            .catch(error => {

                console.error(error);
                emailError.textContent = "We couldn't send the code. Please try again.";
                emailError.classList.add("show");
                submitBtn.disabled = false;
                submitBtn.textContent = "Send Code";

            });

        })

        .catch(error => {

            console.error(error);
            emailError.textContent = "Server error. Please try again.";
            emailError.classList.add("show");
            submitBtn.disabled = false;
            submitBtn.textContent = "Send Code";

        });

    });

}

/* =========================
   STEP 3 — OTP entry
========================= */

function renderOtpStep(){

    loginCard.innerHTML = `
        <button class="back-link" id="backToEmail">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Back
        </button>

        <div class="steps">
            <div class="step-dot done"></div>
            <div class="step-line"></div>
            <div class="step-dot done"></div>
            <div class="step-line"></div>
            <div class="step-dot active"></div>
        </div>

        <h1>Enter your code</h1>
        <p class="email-target">We sent a 6-digit code to <span>${personalEmail}</span></p>

        <div class="otp-inputs" id="otpInputs">
            ${Array.from({ length: 6 }).map((_, i) => `<input type="text" inputmode="numeric" maxlength="1" data-index="${i}">`).join('')}
        </div>
        <div class="error" id="otpError">That code didn't match. Please try again.</div>

        <button id="verifyBtn" disabled>Verify Code</button>

        <div class="resend-row">
            Didn't get a code? <button id="resendBtn" disabled>Resend (<span id="resendCount">30</span>s)</button>
        </div>
    `;

    document.getElementById("backToEmail").addEventListener("click", renderEmailStep);

    const inputs = Array.from(document.querySelectorAll("#otpInputs input"));
    const verifyBtn = document.getElementById("verifyBtn");
    const otpError = document.getElementById("otpError");

    function checkComplete(){
        const complete = inputs.every(i => i.value.trim().length === 1);
        verifyBtn.disabled = !complete;
    }

    inputs.forEach((input, idx) => {

        input.addEventListener("input", () => {
            input.value = input.value.replace(/[^0-9]/g, "");
            if(input.value && idx < inputs.length - 1){
                inputs[idx + 1].focus();
            }
            otpError.classList.remove("show");
            checkComplete();
        });

        input.addEventListener("keydown", (e) => {
            if(e.key === "Backspace" && !input.value && idx > 0){
                inputs[idx - 1].focus();
            }
        });

        input.addEventListener("paste", (e) => {
            e.preventDefault();
            const digits = (e.clipboardData.getData("text") || "").replace(/[^0-9]/g, "").split("");
            inputs.forEach((inp, i) => { inp.value = digits[i] || ""; });
            checkComplete();
            const next = inputs[Math.min(digits.length, inputs.length - 1)];
            if(next) next.focus();
        });

    });

    verifyBtn.addEventListener("click", () => {

        const entered = inputs.map(i => i.value).join("");

        verifyBtn.disabled = true;
        verifyBtn.textContent = "Verifying...";

        fetch("verifyAdminOtp.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                email: personalEmail,
                otp: entered
            })

        })

        .then(response => response.json())

        .then(result => {

            if(result.success){

                completeLogin();

            }else{

                otpError.textContent = result.message || "That code didn't match. Please try again.";
                otpError.classList.add("show");
                inputs.forEach(i => i.value = "");
                inputs[0].focus();
                verifyBtn.disabled = true;
                verifyBtn.textContent = "Verify Code";

            }

        })

        .catch(error => {

            console.error(error);
            otpError.textContent = "Server error. Please try again.";
            otpError.classList.add("show");
            verifyBtn.disabled = false;
            verifyBtn.textContent = "Verify Code";

        });

    });

    resendSeconds = 30;
    const resendBtn = document.getElementById("resendBtn");
    const resendCount = document.getElementById("resendCount");

    clearInterval(resendTimer);
    resendTimer = setInterval(() => {
        resendSeconds--;
        resendCount.textContent = resendSeconds;
        if(resendSeconds <= 0){
            clearInterval(resendTimer);
            resendBtn.disabled = false;
            resendBtn.textContent = "Resend code";
        }
    }, 1000);

    resendBtn.addEventListener("click", () => {

        if(resendBtn.disabled) return;

        resendBtn.disabled = true;

        fetch("requestAdminOtp.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                email: personalEmail
            })

        })

        .then(response => response.json())

        .then(result => {

            if(!result.success){
                otpError.textContent = result.message || "Couldn't resend the code.";
                otpError.classList.add("show");
                return;
            }

            return FurryCornerStorage.sendVerificationCode(
                personalEmail,
                result.otp,
                ADMIN_OTP_TEMPLATE_ID
            );

        })

        .then(() => {

            renderOtpStep();

        })

        .catch(error => {

            console.error(error);
            otpError.textContent = "Couldn't resend the code. Please try again.";
            otpError.classList.add("show");

        });

    });

    inputs[0].focus();

}

/* =========================
   COMPLETE LOGIN
========================= */

function completeLogin(){

    clearInterval(resendTimer);

    loginCard.innerHTML = `
        <div class="success-step">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="8 12 11 15 16 9"/></svg>
            <h2>You're verified!</h2>
            <p>Redirecting you to the dashboard...</p>
        </div>
    `;

    localStorage.setItem("adminLoggedIn", "true");
    localStorage.setItem("adminUser", JSON.stringify(adminUser));

    const redirectPage = localStorage.getItem("redirectAfterLogin") || "Admin.php";

    localStorage.removeItem("redirectAfterLogin");

    setTimeout(() => {
        window.location.href = redirectPage;
    }, 700);

}

renderCredentialsStep();

</script>
</body>
</html>