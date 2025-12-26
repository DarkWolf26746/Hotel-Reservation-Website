<?php
include("../includes/db.php");

if($_POST){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM admins WHERE admin_email='$email' AND admin_pass='$pass'");
    if(mysqli_num_rows($q)){
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
    }
}
?>

<form method="post">
    <h2>Admin Login</h2>
    <input name="email">
    <input type="password" name="password">
    <button>Login</button>
</form>
