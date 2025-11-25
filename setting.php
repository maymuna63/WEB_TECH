<?php
session_start();
require('inc/essentials.php');
adminLogin();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Dashboard</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h4 class="mb-4">SETTING</h4>

        <!------------general setting section--------------->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title m-0">General Settings</h5>
                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                </div>
                
                <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                <p class="card-text" id="site_title">content</p>
                <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                <p class="card-text" id="site_about">content</p>
            </div>
        </div>

<!------------general setting modal--------------->
<div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <form onsubmit="event.preventDefault(); update_general();">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">General Setting</h5>
      </div>

      <div class="modal-body">

        <div class="mb-3">
          <label class="form-label">Site Title</label>
          <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none">
        </div>

        <div class="mb-3">
          <label class="form-label">About Us</label>
          <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6"></textarea>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
        <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
      </div>

    </div>
    </form>
  </div>
</div>

</div>
</div>
</div>

<?php require('inc/script.php'); ?>

<script>
let general_data;

// ----------------------- GET GENERAL DATA -----------------------
function get_general() {
    let site_title = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');
    let site_title_inp = document.getElementById('site_title_inp');
    let site_about_inp = document.getElementById('site_about_inp');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php");
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        general_data = JSON.parse(this.responseText);

        site_title.innerText = general_data.site_title;
        site_about.innerText = general_data.site_about;

        site_title_inp.value = general_data.site_title;
        site_about_inp.value = general_data.site_about;
    }

    xhr.send('get_general=1');
}


// ----------------------- UPDATE GENERAL DATA -----------------------
function update_general() {

    let site_title_val = document.getElementById('site_title_inp').value;
    let site_about_val = document.getElementById('site_about_inp').value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php");
    xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        let myModal = bootstrap.Modal.getInstance(document.getElementById('general-s'));

        if(this.responseText.trim() == "1"){
           alert('success','Changes Saved!');
            myModal.hide();
            get_general();
        }
        else{
           alert('error','No Changes made!');
        }
    }

    xhr.send('site_title=' + site_title_val + '&site_about=' + site_about_val + '&upd_general=1');
}

window.onload = function(){
    get_general();
}
</script>

</body>
</html>
