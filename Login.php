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
    --ink: #1F2430;
    --white: #ffffff;
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
    width: min(520px, 100%);
    background: #fff;
    border-radius: 28px;
    padding: 40px;
    box-shadow: 0 24px 60px rgba(0,0,0,0.1);
}

.login-card h1{
    font-family: 'Baloo 2', cursive;
    font-size: 2.4rem;
    margin-bottom: 18px;
    color: var(--blue-dark);
}

.form-group{ display:flex; flex-direction:column; gap:10px; margin-bottom: 18px; }
.form-group label{ font-weight: 700; }

input, select{
    width: 100%;
    padding: 14px 16px;
    border: 1.5px solid #ddd;
    border-radius: 14px;
    font-size: 15px;
    font-family: inherit;
}

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
}

button:hover{ background: var(--blue-dark); }

.note{
    margin-top: 18px;
    color: #5d6d86;
    font-size: 14px;
    line-height: 1.6;
}

.error{
    margin-top: 14px;
    color: #c43333;
    font-weight: 700;
    display:none;
}
</style>
</head>
<body>
<div class="login-card">
  <h1>Admin Login</h1>
  <!-- adminEmail: admin@furrycorner.com -->
  <!-- adminPassword: password123 -->
  <form id="loginForm">
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" placeholder="Enter admin email" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" placeholder="Enter admin password" required>
    </div>
    <button type="submit">Sign In</button>
    <div class="error" id="loginError">Invalid email or password.</div>
  </form>
</div>
<script>

const loginForm = document.getElementById('loginForm');
const loginError = document.getElementById('loginError');


loginForm.addEventListener('submit', event => {

    event.preventDefault();


    loginError.style.display = 'none';


    const email =
    document.getElementById('email').value.trim();


    const password =
    document.getElementById('password').value;



    fetch("adminLogin.php", {


        method:"POST",


        headers:{


            "Content-Type":"application/json"


        },


        body:JSON.stringify({


            email:email,


            password:password


        })


    })


    .then(response => response.json())


    .then(result => {



        if(result.status === "success"){



            localStorage.setItem(
                "adminLoggedIn",
                "true"
            );


            localStorage.setItem(
                "adminUser",
                JSON.stringify(result.user)
            );



            const redirectPage =
            localStorage.getItem("redirectAfterLogin")
            || "Admin.php";



            localStorage.removeItem(
                "redirectAfterLogin"
            );



            window.location.href =
            redirectPage;



        }else{


            loginError.textContent =
            result.message;


            loginError.style.display =
            'block';


        }



    })


    .catch(error=>{


        console.error(error);


        loginError.textContent =
        "Server error. Please try again.";


        loginError.style.display =
        "block";


    });



});


</script>
</body>
</html>