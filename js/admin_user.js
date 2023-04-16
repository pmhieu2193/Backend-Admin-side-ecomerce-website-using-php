let userName = document.forms['add_user'].uname;
let userMail = document.forms['add_user'].uemail;
let userPhone = document.forms['add_user'].uphone;
let userRole = document.forms['add_user'].urole;

let userForm = document.querySelector('.user-form');
let addUserForm = document.querySelector('.add-user-form');
let addBtn = document.querySelector('.add-user');


addBtn.addEventListener('click', () => {
  addUserForm.style.display = 'flex';
});

function editUser(x) {
  userForm.style.display = 'flex';
}

$(".bxs-edit-alt").click(function () {
  let $row = $(this).closest("tr");
  let idUser = $row.find("#getID").text();
  idUser = idUser.trim();
  var element = document.getElementById("form");
  let requestUserInfo = new XMLHttpRequest();
  requestUserInfo.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var result = this.response;
      //console.log(result);
      element.innerHTML = result;
    }
  }
  requestUserInfo.open("GET", "user_info.php?id=" + idUser, true);
  requestUserInfo.send();
});


let userDltConfirm = document.querySelector('.product-delete');
let deleteBtn = document.getElementsByClassName('bxs-trash');
let confirmDeletion = document.querySelector('.confirm');
let cancelDeletion = document.querySelector('.cancel-deletion');

confirmDeletion.addEventListener('click', () => {
  userDltConfirm.style.display = 'none';
});
cancelDeletion.addEventListener('click', () => {
  userDltConfirm.style.display = 'none';
});

function deleteUser(x) {
  var myInput = document.getElementById("idDelete");
  myInput.value = x;
  userDltConfirm.style.display = 'flex';
}


addBtn.addEventListener('click', () => {
  document.forms['add_user'].action = 'add_user.php';
  document.forms['add_user'].reset();
  addUserForm.style.display = 'flex';
});

//close add product form
let cancelEditBtn = document.querySelector('#cancel_edit');
cancelEditBtn.addEventListener('click', () => {
  userForm.style.display = 'none';
})

let cancelAddBtn = document.querySelector('#cancel_add');
cancelAddBtn.addEventListener('click', () => {
  addUserForm.style.display = 'none';
})

window.onclick = function (event) {
  if (event.target == userForm) {
    userForm.style.display = 'none';
  }
  if (event.target == addUserForm) {
    addUserForm.style.display = 'none';
  }
}

//chỉnh sửa cả file admin css

