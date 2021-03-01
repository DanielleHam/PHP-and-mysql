<?php 

session_start();
$name = "";
$model ="";
$category = "";
$quantity = "";
$update = false;
$id = 0;

$_SESSION['capnum'] = ((isset($_SESSION['capnum'])) ? $_SESSION['capnum'] : 0); // set the count of how many times the sell button have been presed to 0.

$servername = "localhost";
$username = "root";
$password = "";
$myDB = "lars";

// Create connection
$conn = new mysqli($servername, $username, $password, $myDB);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// add a product
if (isset($_POST["add"])){
    $category = $_POST['category'];
    $name = $_POST['name'];
    $model = $_POST['model'];
    $quantity = $_POST['quantity'];

    $conn->query("INSERT INTO products (p_category, p_name, p_model, p_quantity) VALUES('$category', '$name', '$model', '$quantity')") or die($conn->error);

    $_SESSION['message'] = "Product has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: products.php"); // send the user to this pace after pressing the button
}

// delete a product 
if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $conn->query("DELETE FROM products WHERE p_id=$id") or die($conn->error);

    $_SESSION['message'] = "Product has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: products.php"); // send the user to this pace after pressing the button
}

// edit a product
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM products WHERE p_id=$id") or die($conn->error); // check if the row exist in the database
    if ($result->num_rows){
        $row = $result->fetch_array();
        $quantity = $row['p_quantity'];
    }
}

// update button
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];


    $conn->query("UPDATE products SET p_quantity='$quantity' WHERE p_id=$id") or die($conn->error);

    $_SESSION['message'] = "Your product have been updated";
    $_SESSION['msg_type'] = "warning";

    header("location: products.php"); // send the user to this pace after pressing the button
}

// Sell button
if(isset($_GET['sell'])){
    $sell_product= $_GET['sell'];

    // only sell a product it there is one in the database
    if ($sell_product >= 1) { 
        $conn->query("UPDATE products SET p_quantity=(p_quantity-1) WHERE p_quantity='$sell_product'") or die($conn->error);
        $_SESSION['capnum']++; // count how many time the button sell is pressed.

        $_SESSION['message'] = "Your product have been sold";
        $_SESSION['msg_type'] = "success";

    } else {
        $_SESSION['message'] = "Your product are out of stock";
        $_SESSION['msg_type'] = "danger";
    }

    header("location: products.php"); // send the user to this pace after pressing the button

}

