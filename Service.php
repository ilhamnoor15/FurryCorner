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
  }

  *{ box-sizing: border-box; margin:0; padding:0; }

  body{
    font-family: 'times new roman', sans-serif;
    color: var(--ink);
    background:#fff;
    line-height:1.5;
  }

  /* FIXED: Changed .p to p */
  h1,h2,h3,.brand, p {
    font-family:'times new roman', sans-serif;
  }

  a{ text-decoration:none; color:inherit; }
  img{ max-width:100%; display:block; }

.container{
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 40px;
}

.navbar{
    position: sticky;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    background: var(--white);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding: 14px 40px;
    box-shadow: 0 2px 0 rgba(0,0,0,0.04);
    transition: box-shadow .25s ease, padding .25s ease;
  }

  .navbar.scrolled{
    box-shadow: 0 6px 18px rgba(0,0,0,0.10);
    padding: 10px 40px;
  }

  .nav-left{
    display:flex;
    align-items:center;
    gap: 44px;
  }

   .nav-icons{
    display:flex;
    align-items:center;
    gap: 22px;
  }

  .nav-icons svg{
    width: 22px;
    height: 25px;
    cursor:pointer;
  }

  .icon-btn{
  background:none;
  border:none;
  padding:0;
  cursor:pointer;
  position:relative;
  display:flex;
  color: var(--ink);
}

.icon-btn svg{
  width: 22px;
  height: 25px;
  transition: color .2s ease, transform .2s ease;
}

.icon-btn:hover svg{
  color: var(--blue-dark);
  transform: translateY(-2px);
}

.icon-btn .dot{
  position:absolute;
  top:-2px; right:-2px;
  width:9px; height:9px;
  border-radius:50%;
  background:#E5735F;
  border:2px solid #fff;
}

.logout-btn{
    margin-left: 0;
    padding: 10px 16px;
    border-radius: 14px;
    background: var(--blue);
    color: #fff;
    border: none;
    font-weight: 700;
    font-family: inherit;
}

.logo{
    display:flex;
    align-items:center;
    gap:8px;
    font-weight:700;
    font-size: 25px; 
    line-height:1.1;
    color: var(--blue-dark);
}

.logo img{ width:38px; height:38px; object-fit:contain; }

.sidenav {
    height: 100%;
    width: 250px;
    position: fixed;
    z-index: 1;
    top: 0; left: 0;
    background-color: var(--blue-dark);
    overflow-x: hidden;
    padding-top: 20px;
}

.sidenav a.active {
    background-color: var(--blue);
    color: var(--white);
    font-weight: 700;
}

.sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 22px;
    color: var(--ink);
    display: block;
}

.sidenav a:hover {
    color: #f1f1f1;
    background-color: var(--blue-dark);
}

.main {
    margin-left: 250px; 
    font-size: 16px; 
    padding: 0px 10px;
}

.AddProduct {
    background-color: var(--blue);
    color: var(--white);
    padding: 12px 28px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    border: none;
    box-shadow: 0 4px 10px rgba(92, 163, 232, 0.3);
    transition: all 0.2s ease;
    text-align: center;
    width: fit-content;
}

.AddProduct:hover {
    background-color: var(--blue-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(92, 163, 232, 0.4);
}

.page-header {
    display: flex;
    justify-content: space-between; /* Pushes h1 to left, button to right */
    align-items: center;            /* Vertically centers them */
}

.page-header h1 {
    margin: 0;
    font-size: 28px;
    color: var(--ink);
}
.table-wrapper {
    padding: 40px;
    display:flex;
    flex-direction:column;
    gap:20px;
    margin-top:18px;
}

.table-grid-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    flex-wrap:nowrap;
}

.table-grid-header h1 {
    margin:0;
    font-size:28px;
}

table {
    width:100%;
    border-collapse:collapse;
    background: var(--white);
    box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    border-radius: 12px;
    overflow:hidden;
}

th, td {
    text-align: left;
    padding: 16px 24px;
    border-bottom: 1px solid #eee;
    font-size: 15px;
}

th {
    background-color: var(--cream-light);
    color: var(--ink);
    font-weight: 700;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.5px;
}

tr:last-child td { border-bottom: none; }
tr:hover{ background-color: #fcfcfc; }

.btn-add{ background: var(--blue); color:#fff; padding:14px 26px; border-radius:12px; border:none; font-weight:700; cursor:pointer; }
.btn-add:hover{ background: var(--blue-dark); }

.table-action {
    border: 1px solid #cfd6e0;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    background: transparent;
    color: var(--ink);
    transition: border-color .2s ease, color .2s ease, transform .2s ease;
    margin-right: 8px;
}

.table-action:hover {
    border-color: var(--blue);
    color: var(--blue-dark);
    transform: translateY(-1px);
}

.table-action.delete {
    border-color: #f3c1c1;
    color: #c43333;
}

.table-action.delete:hover {
    background: rgba(244, 67, 54, 0.05);
}

.modal{ display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); justify-content:center; align-items:center; padding:20px; z-index:1000; }
.modal.open{ display:flex; }
.modal-panel{ background:#fff; border-radius:22px; width:100%; max-width:560px; padding:32px; box-shadow:0 18px 40px rgba(0,0,0,.15); }
.modal-panel h3{ margin-top:0; }
.form-group{ display:grid; gap:10px; margin-bottom:18px; }
.form-group label{ font-weight:700; }
.form-group input, .form-group textarea, .form-group select{ width:100%; padding:12px 14px; border:1.5px solid #ddd; border-radius:12px; font-family:inherit; }

.modal-actions{ display:flex; justify-content:flex-end; gap:12px; margin-top:16px; }

.modal-close{ color:#aaa; font-size:28px; cursor:pointer; position:absolute; top:20px; right:24px; }

.status-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
}

.status-pill.active { background: #e8f9f1; color: #1e8f67; }
.status-pill.inactive { background: #ffe7e7; color: #cc3b3b; }

@media screen and (max-width: 980px){ .main{ margin-left:0; padding:20px; } .sidenav{position:relative; width:100%; height:auto;} }
@media screen and (max-width: 640px){ .section-card, .page-head{ flex-direction:column; } }
</style>
</head>
<body>

<div class="sidenav">
  <a href="Admin.php">Dashboard</a>
  <a href="Products.php">Products</a>
  <a href="Service.php" class="active">Services</a>
  <a href="Orders.php">Orders</a>
</div>

<div class="main">
  <div class="navbar">
    <div class="nav-left">
      <div class="logo">
        <img src="images/logo.png" alt="FurryCorner logo">
        <span>Admin</span>
      </div>
    </div>
    <div class="nav-icons">
      <button class="icon-btn" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 8a6 6 0 10-12 0c0 7-3 8-3 8h18s-3-1-3-8"/>
          <path d="M13.7 21a2 2 0 01-3.4 0"/>
        </svg>
        <span class="dot"></span>
      </button>
      <button class="icon-btn" aria-label="Profile">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="8" r="4"/>
          <path d="M4 21c0-4 4-6 8-6s8 2 8 6"/>
        </svg>
      </button>
      <button class="icon-btn logout-btn" id="logoutBtn">Logout</button>
    </div>
  </div>

  <div class="table-wrapper">
    
    <div class="page-header">
        <h1>Service Management</h1>
        <div class="AddProduct" id="openServiceModal">
            + Add New Service
        </div>
    </div>
    <table>
        <thead>
          <tr>
            <th>Service ID</th>
            <th>Service Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="serviceTableBody">

        </tbody>
      </table>
    </div>
  </div>

<div class="modal" id="serviceModal">
  <div class="modal-panel">
    <span class="modal-close" id="closeServiceModal">&times;</span>
    <h3 id="serviceModalTitle">Add New Service</h3>
    <form id="serviceForm">
      <div class="form-group">
        <label for="service-name">Service Name</label>
        <input type="text" id="service-name" required>
      </div>
      <div class="form-group">
        <label for="service-category">Category</label>
        <select id="service-category" required>
          <option value="Grooming">Grooming</option>
          <option value="Boarding">Boarding</option>
          <option value="Care">Care</option>
        </select>
      </div>
      <div class="form-group">
        <label for="service-price">Price</label>
        <input type="text" id="service-price" min="0" required>
      </div>
      <div class="form-group">
        <label for="service-duration">Duration</label>
        <input type="text" id="service-duration" placeholder="e.g. 1 hr, Daily" required>
      </div>
      <div class="form-group">
        <label for="service-status">Status</label>
        <select id="service-status" required>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>
      <div class="modal-actions">
        <button type="button" class="btn-add" id="cancelService">Cancel</button>
        <button type="submit" class="btn-add">Save Service</button>
      </div>
    </form>
  </div>
</div>

<script src="shared-order.js"></script>

<script>

const adminLoggedIn = localStorage.getItem("adminLoggedIn");

if (adminLoggedIn !== "true") {

    localStorage.setItem("redirectAfterLogin", "Services.php");

    window.location.href = "Login.php";

}

  const modal = document.getElementById('serviceModal');
  const openBtn = document.getElementById('openServiceModal');
  const closeBtn = document.getElementById('closeServiceModal');
  const cancelBtn = document.getElementById('cancelService');
  const form = document.getElementById('serviceForm');

  function loadAdminServices(){

      const tbody = document.getElementById('serviceTableBody');

      tbody.innerHTML = "";


      fetch("getServices.php")

      .then(response => response.json())

      .then(services => {


          services.forEach(service => {


              const row = document.createElement('tr');


              row.dataset.id = service.id;


              row.innerHTML = `

                  <td>${service.id}</td>

                  <td>${service.name}</td>

                  <td>${service.category}</td>

                  <td>${formatAdminPrice(service.price)}</td>

                  <td>${service.duration}</td>

                  <td>

                      <span class="status-pill ${service.status.toLowerCase()}">

                          ${service.status}

                      </span>

                  </td>


                  <td>

                      <button class="table-action edit">
                          Edit
                      </button>

                      <button class="table-action delete">
                          Delete
                      </button>

                  </td>

              `;


              tbody.appendChild(row);


          });


          bindServiceRowActions();


      })

      .catch(error => {

          console.error("Error loading services:", error);

      });

  }

function formatAdminPrice(price){

    if(price === "Free"){
        return price;
    }

    if(price.includes('-')){

        return '\u20B1' + price;

    }

    return '\u20B1' + Number(price).toLocaleString('en-PH', {
        minimumFractionDigits: 2
    });

}

  openBtn.addEventListener('click', () => {
    form.dataset.mode = 'add';
    form.removeAttribute('data-row-index');
    document.getElementById('serviceModalTitle').textContent = 'Add New Service';
    form.reset();
    modal.classList.add('open');
  });
  closeBtn.addEventListener('click', () => modal.classList.remove('open'));
  cancelBtn.addEventListener('click', () => modal.classList.remove('open'));
  window.addEventListener('click', event => {
    if (event.target === modal) modal.classList.remove('open');
  });

  function getServiceStatusClass(value) {
    return `status-pill ${value.toLowerCase()}`;
  }

  function updateServiceRowIds() {
    document.querySelectorAll('table tbody tr').forEach((row, index) => {
      row.children[0].textContent = index + 1;
    });
  }

  function bindServiceRowActions() {
    document.querySelectorAll('.table-action.edit').forEach(button => {
      button.addEventListener('click', event => {
        const row = event.target.closest('tr');
        document.getElementById('service-name').value = row.children[1].textContent;
        document.getElementById('service-category').value = row.children[2].textContent;
        document.getElementById('service-price').value =
          row.children[3].textContent.replace('₱','').trim();
        document.getElementById('service-duration').value = row.children[4].textContent;
        document.getElementById('service-status').value = row.children[5].textContent.trim();
        document.getElementById('serviceModalTitle').textContent = 'Edit Service';
        form.dataset.mode = 'edit';
        form.dataset.id = row.dataset.id;
        modal.classList.add('open');
      });
    });
    document.querySelectorAll('.table-action.delete').forEach(button => {


        button.addEventListener('click', event => {


            const row = event.target.closest('tr');


            const serviceId = row.dataset.id;


            const name = row.children[1].textContent;



            if(confirm(`Delete ${name}?`)){



                fetch("deleteService.php", {


                    method:"POST",


                    headers:{


                        "Content-Type":
                        "application/x-www-form-urlencoded"


                    },


                    body:

                    "id=" + serviceId



                })


                .then(response => response.text())


                .then(result => {



                    if(result.trim() === "success"){


                        alert("Service deleted successfully!");


                        loadAdminServices();


                    }else{


                        alert(result);


                    }


                });



            }


        });


    });
  }


  form.addEventListener('submit', event => {
    event.preventDefault();
    const tbody = document.querySelector('table tbody');
    const mode = form.dataset.mode || 'add';
    const name = document.getElementById('service-name').value;
    const category = document.getElementById('service-category').value;
    const price = document.getElementById('service-price').value.trim();
    const duration = document.getElementById('service-duration').value;
    const status = document.getElementById('service-status').value;

    if(mode === 'edit'){


      const id = form.dataset.id;


      fetch("updateService.php", {


          method:"POST",


          headers:{


              "Content-Type":
              "application/x-www-form-urlencoded"


          },


          body:

          "id=" + id +

          "&name=" + encodeURIComponent(name) +

          "&category=" + encodeURIComponent(category) +

          "&price=" + encodeURIComponent(price) +

          "&duration=" + encodeURIComponent(duration) +

          "&status=" + encodeURIComponent(status)



      })


      .then(response => response.text())


      .then(result => {


          if(result.trim() === "success"){


              alert("Service updated successfully!");


              modal.classList.remove('open');

              form.reset();


              loadAdminServices();


          }else{


              alert(result);


          }


      });


  }

    modal.classList.remove('open');
    form.reset();
    bindServiceRowActions();
  });

  loadAdminServices();
  
</script>

</body>
</html>