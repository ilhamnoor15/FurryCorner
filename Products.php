<?php
include "db.php";

/* =========================
   ADD PRODUCT
========================= */

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addProduct"])) {

    $name = mysqli_real_escape_string($conn, $_POST["product-name"]);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $price = (float)$_POST["price"];
    $stock = (int)$_POST["stock"];

    $subcategory = "";

    $sql = "INSERT INTO products
            (product_name, category, subcategory, price, stock)
            VALUES
            ('$name', '$category', '$subcategory', $price, $stock)";

    mysqli_query($conn, $sql);

    header("Location: Products.php");
    exit();
}

/* =========================
   LOAD PRODUCTS
========================= */

$sql = "SELECT * FROM products ORDER BY product_id";
$result = mysqli_query($conn, $sql);

$products = [];

while($row = mysqli_fetch_assoc($result)){
    $products[] = [
        "id" => (int)$row["product_id"],
        "name" => $row["product_name"],
        "category" => $row["category"],
        "subcategory" => $row["subcategory"],
        "price" => (float)$row["price"],
        "stock" => (int)$row["stock"],
        "status" => $row["stock"] <= 0 ? "Out of Stock"
                    : ($row["stock"] <= 5 ? "Low Stock" : "In Stock"),
        "dateUpdated" => $row["date_updated"]
    ];
}
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

/* --- Add Product Button --- */
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
/* --- MODAL STYLES --- */
.add-product-modal {
    display: none; 
    position: fixed; 
    z-index: 1001; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0,0,0,0.4); 
    
    /* Center the modal box on the screen */
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fefefe;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    width: 90%;
    max-width: 500px;
    position: relative;
    font-family: 'Nunito', sans-serif;
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.close {
    color: #aaa;
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 32px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.2s;
    line-height: 1;
}

.close:hover,
.close:focus {
    color: var(--ink);
}

.modal-content h2 {
    margin-bottom: 24px;
    color: var(--blue-dark);
    font-family: 'Baloo 2', cursive;
}

/* Form Styling */
#product-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

#product-form label {
    font-weight: 700;
    font-size: 14px;
    color: var(--ink);
    margin-bottom: -10px;
}

#product-form input {
    padding: 12px 14px;
    border: 1.5px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    font-family: inherit;
    transition: border-color 0.2s;
}

#product-form input:focus {
    outline: none;
    border-color: var(--blue);
}

#product-form button[type="submit"] {
    background-color: var(--blue);
    color: white;
    padding: 14px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.2s, transform 0.2s;
}

#product-form button[type="submit"]:hover {
    background-color: var(--blue-dark);
    transform: translateY(-1px);
}

#product-form select {
    padding: 12px 14px;
    border: 1.5px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    font-family: inherit;
    transition: border-color 0.2s;
}

#product-form select:focus {
    outline: none;
    border-color: var(--blue);
}

.status-pill {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
}

.status-pill.in-stock { background: #e8f9f1; color: #1e8f67; }
.status-pill.low-stock { background: #fff4e9; color: #d16928; }
.status-pill.out-of-stock { background: #ffe7e7; color: #cc3b3b; }
.status-pill.active { background: #f3f7ff; color: #4a6bf2; }

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

/* --- TABLE STYLES --- */
.table-wrapper {
    padding: 40px;
    display: flex;
    flex-direction: column; 
    gap: 20px; 
} 

table {
    width: 100%;
    border-collapse: collapse;
    background: var(--white);
    box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    border-radius: 12px;
    overflow: hidden; 
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

tr:last-child td {
    border-bottom: none;
}

tr:hover {
    background-color: #fcfcfc;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}

@media (max-width: 900px){
    .nav-left{ gap: 20px; }
    .nav-links{ display:none; }
    .menu-toggle{ display:block; }
}

@media (max-width: 480px){
    .container, .navbar, .section, .why, footer{ padding-left:20px; padding-right:20px; }
}
</style>
</head>
<body>

<div class="sidenav">
  <a href="Admin.php">Dashboard</a>
  <a href="Products.php" class="active">Products</a> 
  <a href="Service.php">Services</a>
  <a href="Orders.php">Orders</a>
</div>

<div class="main">
  
  <div class="navbar">
    <div class="nav-left">
      <div class="logo">
        <img src="images/logo.png" alt="FurryCorner logo">
        <p>Admin</p>
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
        <h1>Product Management</h1>
        <div class="AddProduct" id="add-product">
            + Add New Product
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Date Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productTableBody">

            <?php
            $sql = "SELECT * FROM products ORDER BY product_id";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)) {

                $status = $row['stock'] <= 0 
                    ? "Out of Stock" 
                    : ($row['stock'] <= 5 ? "Low Stock" : "In Stock");

            ?>

            <tr data-product-id="<?= $row['product_id'] ?>">

                <td><?= $row['product_id'] ?></td>

                <td><?= $row['product_name'] ?></td>

                <td><?= $row['category'] ?></td>

                <td>
                    ₱<?= number_format($row['price'],2) ?>
                </td>

                <td>
                    <?= $row['stock'] ?>
                </td>

                <td>
                    <?= $status ?>
                </td>

                <td>
                    <?= $row['date_updated'] ?>
                </td>

                <td>
                    <button class="table-action edit" data-id="${product.id}">
                        Edit
                    </button>

                    <button class="table-action delete" data-id="${product.id}">
                        Delete
                    </button>
                </td>

            </tr>

            <?php } ?>

            </tbody>
    </table>
  </div>

</div> <!-- End of .main -->

<div class="add-product-modal" id="add-product-modal">
    <div class="modal-content">
        <span class="close" id="close-modal">&times;</span>
        <h2 id="modalTitle">Add New Product</h2>
        <form id="product-form" method = "POST">
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="product-name" required>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="In Stock">In Stock</option>
                <option value="Low Stock">Low Stock</option>
                <option value="Out of Stock">Out of Stock</option>
                <option value="Active">Active</option>
            </select>

            <button type="submit" id="modalSubmit" name="addProduct">Add Product</button>
        </form>
    </div>  
</div>

<script src="shared-order.js"></script>

<script src="furryCornerStorage.js"></script>

<script>

const adminLoggedIn = localStorage.getItem("adminLoggedIn");


if(adminLoggedIn !== "true"){

    localStorage.setItem(
        "redirectAfterLogin",
        window.location.pathname.split("/").pop()
    );


    window.location.href = "Login.php";

}

</script>

<script>

    console.log("PRODUCTS SCRIPT LOADED");

    const modal = document.getElementById('add-product-modal');
    const btn = document.getElementById('add-product');
    const span = document.getElementById('close-modal');
    const form = document.getElementById('product-form');


    function formatAdminPrice(price){

    return '₱' + Number(price).toLocaleString('en-PH', {
        minimumFractionDigits: 2
    });

}

    let productRows = [];

    function getProductTableRows() {
        return Array.from(document.querySelectorAll('table tbody tr'));
    }

    btn.onclick = function() {
        setModalMode('add');
        modal.style.display = 'flex'; 
    } 

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    function getStatusClass(value) {
        const key = value.toLowerCase().replace(/\s+/g, '-');
        return `status-pill ${key}`;
    }

    function normalizeStatus(value) {
        const status = value.trim();
        if (status.toLowerCase() === 'out of stock') return 'Out of Stock';
        if (status.toLowerCase() === 'low stock') return 'Low Stock';
        if (status.toLowerCase() === 'in stock') return 'In Stock';
        if (status.toLowerCase() === 'active') return 'Active';
        return status;
    }

    form.addEventListener('submit', function(e) {

    e.preventDefault();


    const mode =
        document.getElementById('modalSubmit').dataset.mode || 'add';


    const name =
        document.getElementById('product-name').value;


    const category =
        document.getElementById('category').value;


    const price =
        document.getElementById('price').value;


    const stock =
        document.getElementById('stock').value;

    if (mode === 'edit') {

        e.preventDefault();

        const productId =
            document.getElementById('modalSubmit').dataset.productId;


        fetch("updateProduct.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },

            body:
                "id=" + productId +
                "&name=" + encodeURIComponent(name) +
                "&category=" + encodeURIComponent(category) +
                "&price=" + price +
                "&stock=" + stock

        })


        .then(response => response.text())


        .then(result => {

            console.log(result);


            if(result.trim() === "success"){

                alert("Product updated successfully!");

                location.reload();

            }else{

                alert(result);

            }

        });

        return;

    }

    if(mode === "add") {


        fetch("addProduct.php", {

            method: "POST",

            headers:{
                "Content-Type":
                "application/x-www-form-urlencoded"
            },

            body:
                "name=" + encodeURIComponent(name) +
                "&category=" + encodeURIComponent(category) +
                "&price=" + price +
                "&stock=" + stock

        })


        .then(response => response.text())


        .then(result => {


            console.log(result);


            if(result.trim() === "success"){


                alert("Product added successfully!");


                location.reload();


            }else{


                alert(result);


            }


        });



    }

            modal.style.display = 'none';
            form.reset();
            setModalMode('add');
        });

    function setModalMode(mode, row = null) {
        const title = document.getElementById('modalTitle');
        const submitButton = document.getElementById('modalSubmit');
        if (mode === 'edit') {
            title.textContent = 'Edit Product';
            submitButton.textContent = 'Save Changes';
            submitButton.dataset.mode = 'edit';
            submitButton.dataset.productId = row.dataset.productId;
        } else {
            title.textContent = 'Add New Product';
            submitButton.textContent = 'Add Product';
            submitButton.dataset.mode = 'add';
            submitButton.removeAttribute('data-row-index');
            document.getElementById('status').value = 'In Stock';
        }
    }

    // EDIT PRODUCT BUTTON

        document.addEventListener("click", function(event){

            if(event.target.classList.contains("edit")){


                const row = event.target.closest("tr");

                const cells = row.children;


                document.getElementById('product-name').value =
                    cells[1].textContent;


                document.getElementById('category').value =
                    cells[2].textContent;


                document.getElementById('price').value =
                    parseFloat(
                        cells[3].textContent.replace(/[^0-9.-]+/g,'')
                    );


                document.getElementById('stock').value =
                    cells[4].textContent;


                document.getElementById('status').value =
                    cells[5].textContent.trim();


                setModalMode('edit', row);


                modal.style.display = 'flex';


            }

        });

    document.querySelectorAll('.table-action.edit').forEach(button => {

    button.addEventListener('click', function(){

        const row = this.closest('tr');

        const productId = this.dataset.id;


        document.getElementById('product-name').value =
            row.children[1].textContent;


        document.getElementById('category').value =
            row.children[2].textContent;


        document.getElementById('price').value =
            row.children[3].textContent.replace(/[^0-9.]/g,'');


        document.getElementById('stock').value =
            row.children[4].textContent;


        setModalMode('edit');


        document.getElementById('modalSubmit').dataset.productId = productId;


        modal.style.display = 'flex';


    });

});

    document.querySelectorAll('.table-action.delete').forEach(button => {

        button.addEventListener('click', event => {

            const row = event.target.closest('tr');

            const productId = Number(row.dataset.productId);

            const name = row.children[1].textContent;


            if(confirm(`Delete ${name}?`)){


                fetch("deleteProduct.php", {

                    method:"POST",

                    headers:{
                        "Content-Type":
                        "application/x-www-form-urlencoded"
                    },

                    body:
                    "id=" + productId

                })


                .then(response => response.text())

                .then(result => {


                    if(result.trim() === "success"){

                        alert("Product deleted successfully!");

                        location.reload();


                    }else{

                        alert(result);

                    }


                });


            }


        });

    });

    document.addEventListener("click", function(event){

    if(event.target.classList.contains("edit")){

        console.log("EDIT BUTTON WORKING");

    }

});
</script>

</body>
</html>