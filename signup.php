<?php
include "db.php";

if(isset($_POST['signup'])){

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(first_name,last_name,email,password)
            VALUES('$first_name','$last_name','$email','$password')";

    if(mysqli_query($conn,$sql)){
        echo "Account created successfully!";
    }else{
        echo mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up - FurryCorner PH</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
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
    font-family:'Nunito', sans-serif;
    color: var(--ink);
    background: var(--cream-light);
    line-height:1.5;
    min-height: 100vh;
    display:flex;
    flex-direction:column;
  }

  a{ text-decoration:none; color: inherit; }

  /* ---------- HEADER ---------- */
  .top-header{
    display:flex;
    justify-content:center;
    padding: 30px 20px;
  }
  .top-header .logo{
    display:flex;
    align-items:center;
    gap: 10px;
    font-family:'Baloo 2', cursive;
    font-weight: 800;
    font-size: 22px;
    color: var(--blue-dark);
  }
  .top-header .logo img{ 
    width: 100px; 
    height:100px; 
    object-fit:contain; }

  /* ---------- LAYOUT ---------- */
  .auth-wrap{
    flex: 1;
    display:flex;
    align-items:center;
    justify-content:center;
    padding: 20px 20px 60px;
  }

  .auth-card{
    background: var(--white);
    width: 100%;
    max-width: 420px;
    border-radius: 18px;
    padding: 36px 34px 32px;
    box-shadow: 0 16px 40px rgba(31,36,48,0.08);
  }

  .auth-card h1{
    font-family:'Baloo 2', cursive;
    font-size: 26px;
    text-align:center;
    margin-bottom: 8px;
  }
  .auth-card p.sub{
    text-align:center;
    font-size: 14.5px;
    font-weight:600;
    color: var(--muted);
    margin-bottom: 28px;
  }

  /* ---------- GOOGLE BUTTON ---------- */
  .google-btn{
    width: 100%;
    height: 50px;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: var(--white);
    display:flex;
    align-items:center;
    justify-content:center;
    gap: 12px;
    font-family:'Nunito', sans-serif;
    font-weight: 800;
    font-size: 15px;
    color: var(--ink);
    cursor:pointer;
    transition: background .2s ease, border-color .2s ease;
    margin-bottom: 22px;
  }
  .google-btn:hover{ background: #f7f8fa; border-color: #d7dbe1; }
  .google-btn svg{ width: 20px; height:20px; flex-shrink:0; }

  /* ---------- DIVIDER ---------- */
  .divider{
    display:flex;
    align-items:center;
    gap: 14px;
    margin-bottom: 22px;
  }
  .divider::before, .divider::after{
    content:'';
    flex:1;
    height:1px;
    background: var(--border);
  }
  .divider span{
    font-size: 12.5px;
    font-weight: 800;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .04em;
  }

  /* ---------- FIELDS ---------- */
  .field-label{
    font-size: 12px;
    font-weight: 800;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .03em;
    margin-bottom: 8px;
    display:block;
  }

  .field{
    width: 100%;
    padding: 14px 16px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    font-family:'Nunito', sans-serif;
    font-size: 14.5px;
    font-weight: 600;
    color: var(--ink);
    background: var(--white);
    outline:none;
    margin-bottom: 18px;
  }
  .field:focus{ border-color: var(--blue); }
  .field::placeholder{ color: #a7adb8; font-weight:600; }

  .field-row{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 18px;
  }
  .field-row .field{ margin-bottom: 0; }

  .field-error{
    color: #e0685f;
    font-size: 13px;
    font-weight: 700;
    margin: -10px 0 14px;
    display:none;
  }
  .field-error.show{ display:block; }

  .primary-btn{
    width: 100%;
    height: 50px;
    border-radius: 10px;
    border:none;
    background: var(--blue);
    color: var(--white);
    font-family:'Nunito', sans-serif;
    font-weight: 800;
    font-size: 15px;
    cursor:pointer;
    transition: background .2s ease;
  }
  .primary-btn:hover{ background: var(--blue-dark); }
  .primary-btn:disabled{ background: #cbd2db; cursor:not-allowed; }

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
  }
  .back-link svg{ width: 16px; height:16px; }

  /* ---------- OTP STEP ---------- */
  .otp-target{
    text-align:center;
    font-size: 14.5px;
    font-weight: 700;
    margin-bottom: 24px;
  }
  .otp-target span{ color: var(--blue-dark); }

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
    font-size: 20px;
    font-weight: 800;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    outline:none;
    font-family:'Nunito', sans-serif;
    color: var(--ink);
  }
  .otp-inputs input:focus{ border-color: var(--blue); }

  .otp-error{
    color: #e0685f;
    font-size: 13px;
    font-weight: 700;
    text-align:center;
    margin-bottom: 14px;
    display:none;
  }
  .otp-error.show{ display:block; }

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
  }
  .resend-row button:disabled{
    color: var(--muted);
    cursor:not-allowed;
    text-decoration:none;
  }

  .demo-note{
    margin-top: 18px;
    background: var(--cream-light);
    border: 1.5px dashed var(--blue);
    border-radius: 10px;
    padding: 12px 14px;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--blue-dark);
    text-align:center;
  }

  /* ---------- SUCCESS STEP ---------- */
  .success-step{
    text-align:center;
    padding: 6px 0 4px;
  }
  .success-step svg{
    width: 56px; height:56px;
    color: #3fb27f;
    margin: 0 auto 16px;
  }
  .success-step h2{ font-family:'Baloo 2', cursive; font-size: 22px; margin-bottom: 8px; }
  .success-step p{ font-size: 14.5px; color: var(--muted); font-weight:600; margin-bottom: 22px; }

  /* ---------- FOOTER LINK ---------- */
  .switch-auth{
    text-align:center;
    margin-top: 22px;
    font-size: 14px;
    font-weight:600;
    color: var(--muted);
  }
  .switch-auth a{
    color: var(--blue-dark);
    font-weight: 800;
    text-decoration: underline;
  }

  @media (max-width: 480px){
    .auth-card{ padding: 30px 22px 26px; }
  }
</style>
</head>
<body>

<div class="top-header">
  <a href="FurryCorner.php" class="logo">
    <img src="images/logo.png" alt="FurryCorner logo">
  </a>
</div>

<div class="auth-wrap">
  <div class="auth-card" id="authCard"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
<script src="furryCornerStorage.js"></script>
<script>
  const authCard = document.getElementById('authCard');
  let pendingEmail = '';
  let pendingName = '';
  let pendingLastName = "";
  let pendingPassword = '';
  let generatedCode = '';
  let resendSeconds = 30;
  let resendTimer = null;

  function generateCode(){
    return String(Math.floor(100000 + Math.random() * 900000));
  }

  async function requestVerificationCode(){
    await FurryCornerStorage.sendVerificationCode(pendingEmail, generatedCode);
  }

  // ---------- STEP 1: CHOOSE METHOD ----------
  function renderChooseStep(){
    clearInterval(resendTimer);
    authCard.innerHTML = `
      <h1>Create your account</h1>
      <p class="sub">Join FurryCorner to shop and book pet services</p>

      <button class="google-btn" id="googleBtn">
        <svg viewBox="0 0 48 48"><path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.7 32.9 29.3 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.5 6.1 29.5 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.7-.4-3.5z"/><path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.6 15.9 18.9 13 24 13c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.5 6.1 29.5 4 24 4c-7.7 0-14.4 4.3-17.7 10.7z"/><path fill="#4CAF50" d="M24 44c5.4 0 10.3-2.1 14-5.5l-6.5-5.4C29.5 34.9 26.9 36 24 36c-5.3 0-9.7-3.1-11.3-7.5l-6.6 5.1C9.5 39.6 16.2 44 24 44z"/><path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.3 4.3-4.2 5.6l6.5 5.4C39.9 36.9 44 31 44 24c0-1.3-.1-2.7-.4-3.5z"/></svg>
        Continue with Google
      </button>

      <div class="divider"><span>or</span></div>

      <div class="field-row">
        <input class="field" type="text" id="firstNameField" placeholder="First name">
        <input class="field" type="text" id="lastNameField" placeholder="Last name">
      </div>
      <div class="field-error" id="nameError">Please enter your first and last name.</div>

      <label class="field-label">Email address</label>
      <input class="field" type="email" id="emailField" placeholder="you@example.com">
      <div class="field-error" id="emailError">Please enter a valid email address.</div>

      <label class="field-label">Password</label>
        <input
            class="field"
            type="password"
            id="passwordField"
            placeholder="Enter password">

        <div class="field-error" id="passwordError">
            Password must be at least 8 characters.
        </div>

        <label class="field-label">Confirm Password</label>
        <input
            class="field"
            type="password"
            id="confirmPasswordField"
            placeholder="Confirm password">

        <div class="field-error" id="confirmPasswordError">
            Passwords do not match.
        </div>


      <button class="primary-btn" id="continueEmailBtn">Continue with Email</button>

      <div class="switch-auth">Already have an account? <a href="signin.php">Sign in</a></div>
    `;

    document.getElementById('googleBtn').addEventListener('click', () => {
      alert('Google sign-up is not connected yet — hook this up to a real OAuth provider (e.g. Google Identity Services).');
    });

    const firstNameField = document.getElementById('firstNameField');
    const lastNameField = document.getElementById('lastNameField');
    const nameError = document.getElementById('nameError');
    const emailField = document.getElementById('emailField');
    const emailError = document.getElementById('emailError');
    const passwordField =
    document.getElementById('passwordField');

    const confirmPasswordField =
    document.getElementById('confirmPasswordField');

    const passwordError =
    document.getElementById('passwordError');

    const confirmPasswordError =
    document.getElementById('confirmPasswordError');

    document.getElementById('continueEmailBtn').addEventListener('click', async () => {
      const firstName = firstNameField.value.trim();
      const lastName = lastNameField.value.trim();
      const email = emailField.value.trim();
      const password = passwordField.value;
      const confirmPassword = confirmPasswordField.value;
      const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

      let hasError = false;
      if (!firstName || !lastName){
        nameError.classList.add('show');
        hasError = true;
      } else {
        nameError.classList.remove('show');
      }
      if (!isValidEmail){
        emailError.textContent = 'Please enter a valid email address.';
        emailError.classList.add('show');
        hasError = true;
      } else {
        emailError.classList.remove('show');
      }
      if(password.length < 8){
          passwordError.classList.add('show');
          hasError = true;
      } else {
          passwordError.classList.remove('show');
      }
      if(password !== confirmPassword){
          confirmPasswordError.classList.add('show');
          hasError = true;
      } else {
          confirmPasswordError.classList.remove('show');
      }

      if (hasError) return;

      if (FurryCornerStorage.findUserByEmail(email)) {
        emailError.textContent = 'That email is already registered. Please sign in instead.';
        emailError.classList.add('show');
        return;
      }

      pendingEmail = email;
      pendingName = firstName;
      pendingName = lastName;
      pendingPassword = password;
      generatedCode = generateCode();

      try {
        await requestVerificationCode();
        renderOtpStep();
      } catch (error) {
        console.error('Verification code send failed:', error);
        const message = error?.message || 'Unable to send verification code. Please try again.';
        emailError.textContent = message;
        emailError.classList.add('show');
      }
    });

    emailField.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') document.getElementById('continueEmailBtn').click();
    });
  }

  // ---------- STEP 2: ENTER CODE ----------
  function renderOtpStep(){
    authCard.innerHTML = `
      <button class="back-link" id="backBtn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Back
      </button>

      <h1>Check your email</h1>
      <p class="otp-target">We sent a 6-digit code to <span>${pendingEmail}</span></p>

      <div class="otp-inputs" id="otpInputs">
        ${Array.from({ length: 6 }).map((_, i) => `<input type="text" inputmode="numeric" maxlength="1" data-index="${i}">`).join('')}
      </div>
      <div class="otp-error" id="otpError">That code didn't match. Please try again.</div>

      <button class="primary-btn" id="verifyBtn" disabled>Verify Code</button>

      <div class="resend-row">
        Didn't get a code? <button id="resendBtn" disabled>Resend (<span id="resendCount">30</span>s)</button>
      </div>
    `;

    document.getElementById('backBtn').addEventListener('click', renderChooseStep);

    const inputs = Array.from(document.querySelectorAll('#otpInputs input'));
    const verifyBtn = document.getElementById('verifyBtn');
    const otpError = document.getElementById('otpError');

    function checkComplete(){
      const complete = inputs.every(i => i.value.trim().length === 1);
      verifyBtn.disabled = !complete;
    }

    inputs.forEach((input, idx) => {
      input.addEventListener('input', () => {
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value && idx < inputs.length - 1){
          inputs[idx + 1].focus();
        }
        otpError.classList.remove('show');
        checkComplete();
      });
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !input.value && idx > 0){
          inputs[idx - 1].focus();
        }
      });
      input.addEventListener('paste', (e) => {
        e.preventDefault();
        const digits = (e.clipboardData.getData('text') || '').replace(/[^0-9]/g, '').split('');
        inputs.forEach((inp, i) => { inp.value = digits[i] || ''; });
        checkComplete();
        const next = inputs[Math.min(digits.length, inputs.length - 1)];
        if (next) next.focus();
      });
    });

    verifyBtn.addEventListener('click', () => {
      const entered = inputs.map(i => i.value).join('');
      if (entered === generatedCode){

    const user = {

      firstName: pendingName,
      lastName: pendingLastName,
      email: pendingEmail,
      password: pendingPassword

    };


    fetch("registerCustomer.php",{

        method:"POST",

        headers:{
            "Content-Type":"application/json"
        },

        body:JSON.stringify(user)

    })


    .then(response=>response.text())


    .then(result=>{


        if(result.trim()=="success"){


            localStorage.setItem(
                'loggedInUser',
                pendingEmail
            );


            renderSuccessStep();


        }else{


            alert(result);


        }


    });


} else {


        otpError.classList.add('show');

        inputs.forEach(i => i.value = '');

        inputs[0].focus();

        verifyBtn.disabled = true;


    }

});

    // ---------- RESEND TIMER ----------
    resendSeconds = 30;
    const resendBtn = document.getElementById('resendBtn');
    const resendCount = document.getElementById('resendCount');

    clearInterval(resendTimer);
    resendTimer = setInterval(() => {
      resendSeconds--;
      resendCount.textContent = resendSeconds;
      if (resendSeconds <= 0){
        clearInterval(resendTimer);
        resendBtn.disabled = false;
        resendBtn.textContent = 'Resend code';
      }
    }, 1000);

    resendBtn.addEventListener('click', async () => {
      if (resendBtn.disabled) return;
      generatedCode = generateCode();
      try {
        await requestVerificationCode();
      } catch (error) {
        otpError.textContent = 'Unable to resend code. Please try again.';
        otpError.classList.add('show');
      }
      resendBtn.disabled = true;
      resendCount.textContent = 30;
      resendSeconds = 30;
      clearInterval(resendTimer);
      resendTimer = setInterval(() => {
        resendSeconds--;
        resendCount.textContent = resendSeconds;
        if (resendSeconds <= 0){
          clearInterval(resendTimer);
          resendBtn.disabled = false;
          resendBtn.textContent = 'Resend code';
        }
      }, 1000);
    });

    inputs[0].focus();
  }

  // ---------- STEP 3: SUCCESS ----------
  function renderSuccessStep(){
    clearInterval(resendTimer);
    authCard.innerHTML = `
      <div class="success-step">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="8 12 11 15 16 9"/></svg>
        <h2>Welcome, ${pendingName || 'friend'}!</h2>
        <p>Your account has been created.</p>
        <a href="FurryCorner.php" class="primary-btn" style="display:block; text-align:center; line-height:50px; text-decoration:none;">Continue to FurryCorner</a>
      </div>
    `;
  }

  renderChooseStep();
</script>

</body>
</html>
