<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalSupps Cart Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>

</style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: lightblue;">RoyalSupps</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
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

    <div class="container mt-5">
    <h1>Your Cart</h1>
    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $key => $product): 
                $totalPrice += $product->price;
            ?>
                <tr>
                    <td><?= $product->title ?></td>
                    <td>€<?= $product->price ?></td>
                    <td>
                        <form action="/cart/removeFromCart" method="post">
                        <input type="hidden" name="product_key" value="<?= $key ?>">
                        <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <h4>Total Price: €<?= $totalPrice ?></h4>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<?php if (!empty($_SESSION['cart'])): ?>
    <div class="text-center">
        <form action="/cart/createOrder" method="post">
            <button type="submit" class="btn btn-primary" style="width: 200px;">Place Order</button>
        </form>
    </div>
<?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>