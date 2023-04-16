<?php
if(isset($_REQUEST['deleteUser'])) {

	$idUser = $_REQUEST['idDelete'];
    
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb21s6";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	//chưa có các đk kiểm tra đầu vào
  //xử lý các vấn đề tương tự với edit_user
	$sql = sprintf($sql = "DELETE FROM nguoidung WHERE MaNguoiDung = %d", $idUser);
	if ($conn->query($sql) === TRUE) {
	  echo "The record editted successfully";
	  header("Location: admin_user.php");
	  exit();
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	mysqli_close($conn);
}