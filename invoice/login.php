<?php session_start();?>
<?php ob_start();?>
<?php include'includes/header.php';?>

<?php include'includes/navbar.php';?>

<?php include'includes/functions.php';?>

<?php?>
<!-- Modal Styling -->
<style>
    
    .modal2 {
        /*display: none;*/
        position: fixed;
        z-index: 99999;
        left: 0; top: 0;
        width: 100%; 
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
        backdrop-filter:blur(3px);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }

    .modal-content {
        background-color: #F9F9F9;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
        width: 500px;
        height: 400px;
        
       /* max-width: 600px;*/
        animation: fadeIn 0.3s;
        margin-top: 120px;
    }

    .modal-header, .modal-footer {
        font-weight: bold;
    }

    .modal-footer{
        /*border-top: 1px solid #ddd;*/
        display: flex;
        justify-content: space-between;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }


    .head-role{
        margin-top: 10px;
        display: flex;
        gap:5px;

    }
    .head-role input{
        width: 20px;
        height: 20px;
    }
    .single-role{
        height: 30px;
        padding: 5px;
        margin-top: 8px;
        
        /*display: flex;
        flex-direction: row;
        align-content: center;
        justify-content: center;*/

    }
    .single-role i{
        font-size: 17px;
        color: #d5d5d5;

    }
    .single-role label{

        font-size: 17px;
    }
    .msg-title{
        margin-top: 20px;
        text-align: center;
    }
    .msg-title h3{
        text-align: center;
        font-size: 16px;
        font-family: sans-serif;
    }

@media(max-width: 992px){
    .body-role{
        display: flex;
        gap:5px;
        flex-wrap: wrap;
    }
    .col-lg-4{
        border-bottom: 1px solid #d5d5d5;
    }
    
}
.login-head{
    width: 100%;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 10px;
}
.login-head img{
    width: 80px;
    height: 80px;
    border:2px solid #d5d5d5;
    border-radius: 8px;
}
.login-head h2{
    font-size: 17px;
    font-family: sans-serif;
    font-weight: bold;
}
form label{
    font-size: 15px;
    font-weight: bold;
    margin-left: 10px;
}


</style>

<!-- Adding user role -->
<div id="notification-containers" class="notification-containers" style="z-index: 9999990"></div>
<div class="modal2">
    <div class="modal-content">
        <div class="modal-header" style="border-bottom: 2px solid #ddd; padding-bottom: 10px;">
            <div class="login-head">
            	<img src="logo/logo.jpg">
                <h2>LOGIN HERE</h2>
            </div>
        </div>
        <form action="" method="POST" class="mt-4">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username">
            </div>
            <div class="form-group mt-4">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password">
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary" style="width: 100%;" name="login-btn">Login</button>
            </div>
        </form>
    </div>
</div>



<?php
if (isset($_POST['login-btn'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && ($password)) {

        if ($username == "divine" && $password == "admin") {

            $_SESSION['message'] = "You are welcome";
            $_SESSION['type'] = "success";
            $_SESSION['username'] = $username;
            header("Location:index.php");
        }else{
            $_SESSION['message'] = "Data Error";
            $_SESSION['type'] = "error";
        }
        
    }else{
        $_SESSION['message'] = "Invalid details";
        $_SESSION['type'] = "error";

    }

	
    // $_SESSION['message'] = "Deleted Successfully";
    // $_SESSION['type'] = "success";
}

?>

<!-- Notifications alert -->
<script>
  function showNotification(message, type = 'success') {
    const container = document.getElementById('notification-containers');

    const iconMap = {
      success: '✔️',
      error: '❌',
      warning: '⚠️',
      info: 'ℹ️'
    };

    const toaster = document.createElement('div');
    toaster.className = `toaster ${type}`;
    toaster.innerHTML = `
      <span class="icon">${iconMap[type] || ''}</span>
      ${message}
      <span class="close-btn" onclick="this.parentElement.remove()">×</span>
    `;

    container.appendChild(toaster);

    setTimeout(() => {
      toaster.remove();
    }, 4000); // auto-dismiss
  }

  // Load it after DOM is ready
  document.addEventListener("DOMContentLoaded", function () {
    <?php if (isset($_SESSION['message'])): ?>
      showNotification("<?= $_SESSION['message'] ?>", "<?= $_SESSION['type'] ?>");
    <?php unset($_SESSION['message'], $_SESSION['type']); endif; ?>
  });

</script> 

<?php include'includes/footer.php';?>


