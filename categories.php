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
              <a href="index.php" class="nav-link ">Home</a>
          </li>
        <li class="nav-item">
            <a href="categories.php" class="nav-link active">Categories</a>
        </li>
        <li class="nav-item">
            <a href="products.php" class="nav-link">Products</a>
        </li>
      </ul>

      <div class="jumbotron jumbotron-fluid">
          <div class="container">
              <h1 class="display-3 text-center">Lars Mobile Shop</h1>
              <p class="lead text-center">Categories</p>
          </div>
      </div>

      <?php require_once 'c-process.php'; ?>

      <?php

      if (isset($_SESSION['message'])): ?>

      <div class="alert alert-<?=$_SESSION['msg_type']?>">
      
        <?php // showing a message after something is done
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
      </div>
        <?php endif ?>
      <?php //connecting to the database
        $mysqli = new mysqli('localhost', 'root', '', 'lars') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM categories") or die($mysqli->error);

      ?>
<!--Tabel that shows what is in the database-->
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Catergory</th>
                        <th colespan="2">Action</th>
                    </tr>
                </thead>
                <?php // get information from the databas and showing it
                    while ($row = $result->fetch_assoc()):
                ?>

                <tr>
                    <td><?php echo $row['c_name']; ?></td>
                    <td> <!-- Buttons that controlls what to do with the information in the database-->
                        <a href="categories.php?edit=<?php echo $row['c_id'];?>" class="btn btn-info">Edit</a>
                        <a href="c-process.php?delete=<?php echo $row['c_id'];?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>

                <?php endwhile;?>
            </table>
        </div>
<!--Form to chnage in the database-->
    <div class="row justify-content-center">
      <form action="c-process.php" method="post">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <div class="form-group">
            <label for="category">Select a category: </label>
            <select class="form-control" name="category" id="category" value="<?php echo $name; ?>">
              <option>Huawei</option>
              <option>Samsung</option>
              <option>Apple</option>
            </select>
          </div>
          <div class="form-group">
              <?php 
              if ($update == true):
              ?> <!--Only showing the button Update if the button edit have been pressed -->
                <button type="submit" name="update" class="btn btn-info">Update</button>
             <?php else: ?>
                <button type="submit" name="add" class="btn btn-primary">Add</button>
             <?php endif;?>
          </div>
      </form>
</div>
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