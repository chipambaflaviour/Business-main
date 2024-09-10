<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - ALTECH BUSINESS CENTER</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #4CB5F5;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            text-decoration: none;
            color: #4CB5F5;
            margin-right: 15px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        #admin-products {
            display: flex;
            flex-wrap: wrap;
        }
        .admin-product {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            width: 200px;
            text-align: center;
        }
        .admin-product img {
            max-width: 100%;
            height: auto;
        }
        button {
            background-color: #4CB5F5;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 5px;
        }
        button:hover {
            background-color: #1F3F49;
        }
    </style>
    <script>
        async function loadAdminProducts() {
            const response = await fetch('get_products.php');
            const products = await response.json();
            const adminProductsDiv = document.getElementById('admin-products');
            adminProductsDiv.innerHTML = ''; // Clear previous content
            products.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.className = 'admin-product';
                productDiv.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <h2>${product.name}</h2>
                    <p>${product.description}</p>
                    <p>Price: $${product.price}</p>
                    <button onclick="deleteProduct(${product.id})">Delete</button>
                    <button onclick="editProduct(${product.id}, '${product.name}', '${product.description}', ${product.price}, '${product.image}')">Edit</button>
                `;
                adminProductsDiv.appendChild(productDiv);
            });
        }

        async function deleteProduct(id) {
            await fetch('delete_product.php', {
                method: 'POST',
                body: new URLSearchParams({ id: id })
            });
            loadAdminProducts(); // Reload products after deleting
        }

        function editProduct(id, name, description, price, image) {
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            document.getElementById('price').value = price;
            document.getElementById('image').value = image;
            document.getElementById('product-form').onsubmit = async (e) => {
                e.preventDefault();
                await fetch('update_product.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        id: id,
                        name: document.getElementById('name').value,
                        description: document.getElementById('description').value,
                        price: document.getElementById('price').value,
                        image: document.getElementById('image').value
                    })
                });
                loadAdminProducts();
                document.getElementById('product-form').reset();
            };
        }

        // Load products on page load
        window.onload = loadAdminProducts;
    </script>
</head>
<body>
    <h1>Admin Panel</h1>
    <nav>
        <a href="index.html">Home</a>
       
        <a href="add_product.php">Add Product</a>
        <!-- Add more links if necessary -->
    </nav>
    <div id="admin-products"></div>
</body>
</html>
