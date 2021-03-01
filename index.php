<!doctype html>
<html lang="en">
  <head>
    <title>Lars Mobile Shop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
<div class="container">
    <!-- Nav tabs -->
    <ul class="nav nav-pills nav-stacked">
        <li class="nav-item">
            <a href="index.php" class="nav-link active">Home</a>
        </li>
        <li class="nav-item">
            <a href="categories.php" class="nav-link">Categories</a>
        </li>
        <li class="nav-item">
            <a href="products.php" class="nav-link">Products</a>
        </li>
    </ul>

      <div class="jumbotron jumbotron-fluid">
          <div class="container">
              <h1 class="display-3 text-center">Lars Mobile Shop</h1>
              <p class="lead text-center">Home page</p>
          </div>
      </div>

    <!-- Cards-->
    <div>
        <h2 class="text-left">Phones</h2>
    </div>
    <div class="card-deck">
        <div class="card" style="width: 18rem;">
            <img src="img/Huawei-P40-Lite-1200x675.jpg" class="card-img-top img-thumbnail" alt="Huawei phone" >
            <div class="card-body">
                <h5 class="card-title">Huawei</h5>
            </div>
            <div class="card-footer">
                <small class="text-muted">The amout of phones sold: </small>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/samsung-galaxy-a8s-.jpg" class="card-img-top img-thumbnail" alt="Samsung phone">
            <div class="card-body">
                <h5 class="card-title">Samsung</h5>
            </div>
            <div class="card-footer">
                <small class="text-muted">The amout of phones sold: </small>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="img/iphone-11-og-201909.jpg" class="card-img-top img-thumbnail" alt="iPhone">
            <div class="card-body">
                <h5 class="card-title">Apple</h5>
            </div>
            <div class="card-footer">
                <small class="text-muted">The amout of phones sold: </small>
            </div>
        </div>
    </div>
    <?php require_once 'p-process.php'; ?>
    <?php 
        $mysqli = new mysqli('localhost', 'root', '', 'lars') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM products") or die($mysqli->error);

      ?>
    <br>
    <br>
    <!--Form that shows what's in the database-->
    <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['p_category']; ?></td>
                    <td><?php echo $row['p_name']; ?></td>
                    <td><?php echo $row['p_model']; ?></td>
                    <td><?php echo $row['p_quantity']; ?></td>
                    <td><?php if ($row['p_quantity'] == 0){
                      echo "Out of stock";
                    } else {
                        echo "In stock!";
                    }
                    ?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </div>
        <br>
        <br>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3 text-center">Total number of sold products: </h1>
            <h1 class="display-3 text-center"><?php echo $_SESSION['capnum'] ?></h1> <!--Show how many times the sell button have been pressed-->
        </div>
    </div>
</div>
<br>
<br>
<footer>
    <h3 class="text-right">By Danielle Hamrin, WUE2020</h3>
</footer>
      <script>
          $('#navId a').click(e => {
              e.preventDefault();
              $(this).tab('show');
          });
      </script>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>