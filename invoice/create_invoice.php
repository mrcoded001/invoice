<?php session_start();?>
<?php include'includes/header.php'; ?>
<?php include'includes/sidebar.php';?>
<?php include'includes/functions.php';?>
<?php include'includes/navbar.php'; ?>
<style>.sideNav{height:90vh;}

.invoice-bg{
  width: 100%;
  height: 300px;
  /*padding: 20px;
  background: #fff;*/
  /*box-shadow: 0 2px 4px rgba(0,0,0,0.5);*/
}

.invoice-head{
  width: 100%;
  height: 60px;
  background: #1F282F;
  display: flex;
  align-items: center;
  padding-left: 30px;
  gap: 20px;
}
.invoice-head input{
  border: 2px solid #ddd;
  height: 40px;
  border-radius: 5px;
  width: 200px;
  background: #fff;
  outline: none;
  text-align: center;
}
.invoice-head button{
  outline: none;
  padding: 8px;
  border: 2px solid #ddd;
  border-radius: 5px;
  background: #1F282F;
  color: #fff;
  transition: ease-in 0.5s;
}
.invoice-head button:hover{
  background: #fff;
  color:#1F282F;
  border: 2px solid #1F282F;
}

</style>
<div class="insider">

  <div class="invoice-bg">
    <div class="invoice-head">
      <input type="number" name="" placeholder="Enter Quantity">
      <button class="">Add Now</button>
      <a href="" class="btn btn-primary">Continue</a>
    </div>
    <div class="prod-bg">
      <div class="prod-area">
        <input type="text" name="">
      </div>
    </div>
    <div class="ess-bg">
    </div>
  </div>





</div>

  

  

 <?php include'includes/footer.php';?>


 