<?php 

session_start();
$name = "";
$update = false;
$id = 0;

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
// add a catagory
if (isset($_POST["add"])){
    $category = $_POST['category'];

    $conn->query("INSERT INTO categories (c_name) VALUES('$category')") or die($conn->error);

    $_SESSION['message'] = "Category has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: categories.php"); // send the user to this pace after pressing the button
}

// delete a catagory 
if (isset($_GET['delete'])){
    $id = $_GET['delete'];

    $conn->query("DELETE FROM categories WHERE c_id=$id") or die($conn->error);

    $_SESSION['message'] = "Category has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: categories.php"); // send the user to this pace after pressing the button
}

// edit a category
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM categories WHERE c_id=$id") or die($conn->error); // check if the row exist in the database
    if ($result->num_rows){
        $row = $result->fetch_array();
        $name = $row['c_name'];
    }
}

// update button
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['category'];

    $conn->query("UPDATE categories SET c_name='$name' WHERE c_id=$id") or die($conn->error);

    $_SESSION['message'] = "Your catagory have been updated";
    $_SESSION['msg_type'] = "warning";

    header("location: categories.php"); // send the user to this pace after pressing the button
}