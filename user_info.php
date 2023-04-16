<?php
$idUser = $_GET['id'];
// Connect databse
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb21s6";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
$sql = sprintf("SELECT * FROM nguoidung WHERE MaNguoiDung = '".$idUser."'");
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result); 

$s="";
$s .=sprintf('<input type="hidden" name="uid" id="uname" value="%s">', $row['MaNguoiDung']);
$s .='     <label for="uname">Name</label>';
$s .=sprintf('    <input type="text" name="uname" id="uname" value="%s">', $row['Hoten']);
$s .='     <label for="uemail">Email</label>';
$s .=sprintf('      <input type="text" name="uemail" id="umail" value="%s">', $row['email']);
$s .='      <label for="uphone">Phone number</label>';
$s .=sprintf('       <input type="text" name="uphone" id="uphone" value="%s">', $row['SoDienThoai']);
$s .='       <label for="urole">Role</label>';
$s .='     <select name="urole">';
$s .=sprintf('<option value="%s" selected>%s</option>', $row['role'],  $row['role']);
$s .='        <option value="Customer">Customer</option>';
$s .='        <option value="Admin">Admin</option>';
$s .='      </select>';
$s .='      </br>';
$s .=sprintf('<a>Lasted Update at: %s</a>', $row['updated_at']);
echo $s;
$conn -> close();
?>