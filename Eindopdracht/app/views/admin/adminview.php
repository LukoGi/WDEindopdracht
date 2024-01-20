<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalSupps Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

        /* Product cards */

        .product-card {
            box-shadow: 1px 1px 4px 0 rgb(30 30 30 / 16%);
        }

        .product-card img {
            margin: auto;
            display: block;
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 10px;
        }

        /* Demonstrating a media query. This can be solved without one by the way */

        @media screen and (max-width: 768px) {

            .product-card img {
                display: block;
                width: 85px;
                margin-right: 10px;
                margin-bottom: 0px;
                height: auto;
                float: left;
            }
        }
        
        /* Making text inside the cards a bit better looking */

        .product-card p {
            margin: 0;
            font-size: .9rem;
        }

        .product-card small {
            color: #b3b3b3;
            font-size: .8rem;
        }

        /* Social icons */

        .fa-brands:hover {
            color: #929292;
        }

        /* More space inbetween category and description */
        small {
            display: block;
            margin: 0;
        }

        .category {
            margin-bottom: 20px; 
        }

        /* Making product title bigger and bolder */
        .product-title {
            font-size: 1.2rem;
            font-weight: bold; 
        }

        /* Space above submit button in form */
        .submit-button {
            margin-top: 10px; 
        }
    </style>
</head>

<body>

    <!-- Example of copy pasting and modifying a navbar from the bootstrap examples -->
    <!-- Copy pasted from https://getbootstrap.com/docs/5.0/examples/navbars/ -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container">
            <a class="navbar-brand" href="#">RoyalSupps</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown04">
                            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
                                <?php if ($_SESSION['username'] == 'admin'): ?>
                                    <li><a class="dropdown-item" href="/admin">Admin Page</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="/orderhistory">Order history</a></li>
                                <?php endif; ?>
                                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="/register">Register</a></li>
                                <li><a class="dropdown-item" href="/login">Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
                <a href="/cart" class="btn btn-outline-success">
                    <i class="fas fa-shopping-cart"></i> Cart
                </a>
            </div>
        </div>
    </nav>

    <!-- Example of responsive product cards -->

    <section>
        <div class="container">
        <div class="d-flex align-items-center mt-3 mt-lg-5">
            <button class="btn btn-success me-3">+</button>
            <h2>Our Products</h2>
        </div>

            <div id="add-product-form" style="display: none;">
            </div>

            <div class="row">
                <?php
                foreach ($products as $product) {
                ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2 p-2">
                        <div class="card product-card h-100 ">
                            <div class="card-body">
                                <img src="<?= $product->image ?>" alt="<?= $product->title ?>" title="?=$product->title?">
                                <p class="product-title"><?= $product->title ?></p>
                                <small class="category"><?= $product->category ?></small>
                                <p><?= $product->description ?></p>
                            </div>
                            <div class="card-footer">
                                <span class="float-start"><h3 class="m-1">€<?= number_format($product->price, 2, '.') ?></h3></span>                                
                                <button class="btn btn-danger rounded-circle float-end mx-2 delete-product" data-id="<?= $product->id ?>">-</button> 
                                <button class="btn btn-info rounded-circle float-end" data-id="<?= $product->id ?>">E</button>  
                              </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
    </section>

    <!-- A footer -->

    <!-- some social icons to show off font awesome -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>

    document.querySelectorAll('.delete-product').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.dataset.id;

        fetch(`/admin/deleteProduct?id=${productId}`, {
            method: 'POST',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the product card from the DOM
                this.closest('.product-card').remove();
            } else {
                // Handle error
                console.error('Error:', data.error);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
});

document.querySelector('.btn.btn-success').addEventListener('click', function() {
    document.getElementById('add-product-form').style.display = 'block';
});

document.querySelector('.btn.btn-success').addEventListener('click', function() {
    const formHtml = `
        <form action="/admin/addProduct" method="POST">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title"><br>
            <label for="description">Description:</label><br>
            <input type="text" id="description" name="description"><br>
            <label for="price">Price:</label><br>
            <input type="number" id="price" name="price" step="0.01"><br>
            <label for="category">Category:</label><br>
            <input type="text" id="category" name="category"><br>
            <label for="image">Image URL:</label><br>
            <input type="text" id="image" name="image"><br>
            <input type="submit" value="Submit" class="submit-button">
        </form>
    `;

    document.getElementById('add-product-form').innerHTML = formHtml;
    document.getElementById('add-product-form').style.display = 'block';
});

document.querySelectorAll('.btn.btn-info').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.dataset.id;

        fetch(`/admin/getProduct?id=${productId}`)
        .then(response => response.json())
        .then(product => {
            const formHtml = `
                <form action="/admin/editProduct" method="POST">
                    <input type="hidden" id="id" name="id" value="${product.id}">
                    <label for="title">Title:</label><br>
                    <input type="text" id="title" name="title" value="${product.title}"><br>
                    <label for="description">Description:</label><br>
                    <input type="text" id="description" name="description" value="${product.description}"><br>
                    <label for="price">Price:</label><br>
                    <input type="number" id="price" name="price" step="0.01" value="${product.price}"><br>
                    <label for="category">Category:</label><br>
                    <input type="text" id="category" name="category" value="${product.category}"><br>
                    <label for="image">Image URL:</label><br>
                    <input type="text" id="image" name="image" value="${product.image}"><br>
                    <input type="submit" value="Submit" class="submit-button">
                </form>
            `;

            document.getElementById('add-product-form').innerHTML = formHtml;
            document.getElementById('add-product-form').style.display = 'block';

            window.scrollTo(0, 0);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
});
</script>
</body>

</html>