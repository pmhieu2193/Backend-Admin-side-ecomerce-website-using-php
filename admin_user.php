<!DOCTYPE html>
<html lang="en">

<?php
ini_set('display_errors', 0);

$servername = "localhost";
$username = "root";
$password = "";
//đổi giùm cái tên database
$dbname = "mydb21s6";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!isset ($_GET['page']) ) {
  $page = 1; 
  } else {  
  $page = $_GET['page'];  
  }

$limit=10;
$sqlcount = "SELECT * FROM nguoidung";
$resultcount = mysqli_query($conn, $sqlcount);
$page_first_result = ($page-1) * $limit;
$number_of_result = mysqli_num_rows($resultcount);
$number_of_page = ceil ($number_of_result / $limit);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['searchBtn'])){
  if(isset($_POST['searchKey'])){
    $searchKey=$_POST['searchKey'];
    $sql = "SELECT * FROM nguoidung WHERE Hoten LIKE '%$searchKey%' or email LIKE  '%$searchKey%' ORDER BY role LIMIT $page_first_result, $limit";
    $result = mysqli_query($conn, $sql);
  }
}
else{
$roleSort="";
$joinDate="";
$editDate="";
$Sortby="";
if(isset($_REQUEST['roleSort'])){
  $roleSort= $_REQUEST['roleSort'];
}
if(isset($_REQUEST['regisdate'])){
  $joinDate= $_REQUEST['regisdate'];
}
if(isset($_REQUEST['editdate'])){
  $editDate= $_REQUEST['editdate'];
}
if(isset($_REQUEST['Sortby'])){
  $Sortby= $_REQUEST['Sortby'];
}
if($Sortby==2){
  $sql = "SELECT * FROM nguoidung WHERE role LIKE '%$roleSort%' and created_at LIKE '%$joinDate%' and updated_at LIKE '%$editDate%' ORDER BY Hoten DESC LIMIT $page_first_result, $limit";
}
else if ($Sortby==3){
  $sql = "SELECT * FROM nguoidung WHERE role LIKE '%$roleSort%' and created_at LIKE '%$joinDate%' and updated_at LIKE '%$editDate%' ORDER BY email ASC LIMIT $page_first_result, $limit";
}
else{
  $sql = "SELECT * FROM nguoidung WHERE role LIKE '%$roleSort%' and created_at LIKE '%$joinDate%' and updated_at LIKE '%$editDate%' ORDER BY role ASC LIMIT $page_first_result, $limit";
};
$result = mysqli_query($conn, $sql);
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BKMT WATCH | Admin - User</title>
  <link rel="stylesheet" href="fontawesome-free-6.2.0-web/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-alarm'></i>
      <span class="logo_name">BKMT WATCH</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="admin_index.html">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="admin_product.html">
          <i class='bx bx-box'></i>
          <span class="links_name">Product</span>
        </a>
      </li>
      <li>
        <a href="admin_order_list.html">
          <i class='bx bx-list-ul'></i>
          <span class="links_name">Order list</span>
        </a>
      </li>
      <li>
        <a href="admin_statistical.html">
          <i class='bx bx-pie-chart-alt-2'></i>
          <span class="links_name">Statistical</span>
        </a>
      </li>
      <li>
        <a href="#" class="active">
          <i class='bx bx-user'></i>
          <span class="links_name">User</span>
        </a>
      </li>
      <li class="log_out">
        <a href="index.html">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">User</span>
      </div>
      <div class="profile-details">
        <img src="images/profile.jpg" alt="">
        <span class="admin_name">Admin</span>
        <i class='bx bx-chevron-down'></i>
      </div>
    </nav>

    <div class="home-content user">
      <div class="header">
        <div class="nav">
          <form action="" method="POST">
          <div class="search-box">
            <input type="text" name="searchKey" placeholder="Search by name, email,...">
            <button type="submit" class='bx bx-search' name="searchBtn"></button>
</form>
          </div>
          <div class="action">
            <div class="add-user btn">
              <i class="bx bx-plus"></i>
            </div>
            <div class="filter-list btn">
              <i class="bx bx-filter"></i>
            </div>
          </div>
        </div>

        <form action="" method="GET" id="sortUser">
        <div class="filter">
        <div class="option">
            <p class="title">Role</p>
            <div class="option-list user-manage">
                <select name="roleSort" onchange="submitForm()">
                  <option value="" <?= $_REQUEST['roleSort'] == "" ? 'selected' : '';?>>All</option>
                  <!--sửa chỗ này-->
                  <option value="Customer" <?= $_REQUEST['roleSort'] == "Customer" ? 'selected' : '';?>>Customer</option>
                  <option value="Admin" <?= $_REQUEST['roleSort'] == "Admin" ? 'selected' : '';?>>Admin</option>
                </select>
            </div>
          </div>
          <div class="option">
            <p class="title">Registration Date</p>
            <div class="option-list">
                <input type="date" name="regisdate" onchange="submitForm()">
            </div>
          </div>
          <div class="option">
            <p class="title">Edit Date</p>
            <div class="option-list">
                <input type="date" name="editdate" onchange="submitForm()">
            </div>
          </div>
          <div class="option">
            <p class="title">Sort by</p>
            <div class="option-list">
            <select name="Sortby" onchange="submitForm()">
                  <option value=1>By Name &uarr;</option>
                  <option value=2>By Name &darr;</option>
                  <option value=3>By Email &uarr;</option>
            </select>
            </div>
          </div>
        </div>
      </div>
</form>
      <div class="box user-list">
        <table>
          <thead>
            <tr>
              <th class="text-left">ID</th>
              <th class="text-left">UserName</th>
              <th class="text-left">Phone Number</th>
              <th class="text-left">Role</th>
              <th class="text-left">Join Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
        $s = "";
        if (mysqli_num_rows($result) == 0){
          echo "<h2>Không có kết quả nào được tìm thấy</h2></br>";
        }
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {							
            // new row
							$s .= '<tr>';
                $s .= sprintf('<td id="getID">"%s"</td>', $row['MaNguoiDung']);
                $s .= '<td class="text-left">';
                $s .= sprintf('<p id="test">"%s"</p>', $row['Hoten']);
                $s .= sprintf('<p class="email">"%s"</p>', $row['email']);
                $s .= '</td>';
                $s .= sprintf('<td class="text-left">"%s"</td>', $row['SoDienThoai']);
                $s .= sprintf('<td class="text-left">"%s"</td>', $row['role']);
                $s .= sprintf('<td class="text-left">"%s"</td>', $row['created_at']);
                //cần 1 hàng lưu trữ giá trị của id mà có thể sử dụng, có nên thiết kế hàm php không nhỉ
                //thay vì làm href mình sửa trên btn
                //mình còn thiếu vấn đề bên bảo mật
                $s .='<td>';
                $s .= sprintf("<i class='bx bxs-edit-alt' onclick='editUser(%s)'><span class='tooltip'>edit</span></i>", $row['MaNguoiDung']);
                $s .= sprintf("<i class='bx bxs-trash' onclick='deleteUser(%s)'><span class='tooltip'>delete</span></i>", $row['MaNguoiDung']);
                $s .= "<i class='bx bx-mail-send'><span class='tooltip'>contact</span></i>";
                $s .='</td>';
                $s .='</tr>';
          }
        }
          echo str_replace('"', ' ', $s);
          ?>
        </tbody>
        </table>
      </div>
    </div>
    <div class="footer">
      <div class="page">
        <?php
        if($page>=2){
          printf('<button><i class="bx bx-left-arrow-alt" onclick="nextPage(%d-1)"></i></button>', $page);
        }
        $temp=$page;
        $temp=$page;
        for($page = 1; $page<= $number_of_page; $page++) {
          if($page==$temp){
            printf('<button class="current-page" onclick="nextPage(%d)">%d</button>', $page, $page);
          }
          else{
            printf('<button onclick="nextPage(%d)">%d</button>', $page, $page);         
          }
        }
        if($temp<$number_of_page){
          printf('<button><i class="bx bx-right-arrow-alt" onclick="nextPage(%d+1)"></i></button>', $temp);
        }
        ?>
      </div>
    </div>
  </section>

  <div class="modal user-form">
    <form action="edit_user.php" class="modal-content animate" name="edit_user" method="post" enctype="multipart/form-data">
    <div class="header">
        <h2>User Information</h2>
    </div>
    <div class="container" id="form">
   </div>
      <div class="footer">
      <button type="button" class="cancel" id="cancel_edit">Cancel</button>
      <button type="submit" class="done" name="edituser">Done</button>
     </div>
  </form>
  </div>

  <div class="modal add-user-form">
    <form action="add_user.php" class="modal-content animate" name="add_user" method="post" enctype="multipart/form-data">
    <div class="header">
        <h2>Create User</h2>
    </div>
    <div class="container">
    <label for="uaccount">AccountName</label>
      <input type="text" name="uaccount" id="uaccount">
       <label for="upass">Password</label>
      <input type="text" name="upass" id="upass">
       <label for="upass1">Enter The Password</label>
      <input type="text" name="upass1" id="upass1">
      <label for="uname">UserName</label>
      <input type="text" name="uname" id="uname">
       <label for="uemail">Email</label>
       <input type="text" name="uemail" id="umail">
        <label for="uphone">Phone number</label>
   <input type="text" name="uphone" id="uphone">
        <label for="uaddress">Address</label>
   <input type="text" name="uaddress" id="uaddress">
         <label for="urole">Role</label>
        <select name="urole">
          <option value="Customer">Customer</option>
          <option value="Admin">Admin</option>
        </select>
   </div>
      <div class="footer">
      <button type="button" class="cancel" id="cancel_add">Cancel</button>
      <button type="submit" class="done" name="adduser">Done</button>
     </div>
  </form>
  </div>

  <form action="delete_user.php" name="delete_user" method="post" enctype="multipart/form-data">
    <div class="modal product-delete">
      <div class="container animate">
      <input type="hidden" value="" id="idDelete" name="idDelete">
        <h2>Are you sure you want to<br>
          delete this user?</h2>
        <div class="action">
        <button type="button" class="cancel-deletion">Cancel</button>
          <button type="submit" class="confirm" name="deleteUser">Confirm</button>
        </div>
      </div>
    </div>
  </form>


  <script>
    function submitForm() {
      document.getElementById("sortUser").submit();
  }

    function nextPage(x){
      window.location.href="admin_user.php?page="+x;
      //nếu số page trên url trùng với nút thì gán class nút đc chọn vào
      //vậy thì phần tạo nút kia mình sẽ phải xử lý bằng js, không echo bằng php nữa
      //phải lấy được tổng số nút cần tạo!
    }

    var options = document.querySelectorAll('urole');
    for (var i = 0; i < options.length; i++) {
      if (options[i].selected) {
        options[i].style.display = 'none';
      }
    }
    // expand and shrink sidebar
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function () {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }

    // open and close filter list
    let filterBtn = document.querySelector(".filter-list");
    let header = document.querySelector('.header');
    filterBtn.addEventListener('click', () => {
      header.classList.toggle('active');
    })

    // increase and decrease according to time
    let sortByTimeBtn = document.querySelector('#byname');
    sortByTimeBtn.addEventListener('click', () => {
      sortByTime = sortByTimeBtn.firstChild;
      if (sortByTime.classList.contains('fa-arrow-up')) {
        sortByTime.classList.replace('fa-arrow-up', 'fa-arrow-down');
      }
      else {
        sortByTime.classList.replace('fa-arrow-down', 'fa-arrow-up');
      }
    })

  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="noreferrer"></script>
  <script src="js/admin_user.js"></script>
</body>

<?php
mysqli_close($conn);
?>

</html>

