<!-- sidebar.php -->
<?php ob_start();?>
<div class="sideNav" id="dropdown">
	<div class="the-links" style="margin-top: ;">
		<div class="the-logo" onclick="ShowNav()">
			<img src="logo/logo.jpg">
			<span>Select Menu <i class=" fa fa-arrow-down"></i></span>
		</div>
		<div class="nav-links" id="dropLink">
			<a href="index.php">
				<div class="side-inner">
					<i class="fa fa-rss"></i> Dashboard
				</div>
			</a>

			<a href="invoice.php">
				<div class="side-inner">
					<i class="fa fa-file-pdf"></i> Invoices
				</div>
			</a>

			<div class="segment" id="myDrop">
				<a href="">
					<div>Add Invoce</div>
				</a>
				<a href="">
					<div>All Invoce</div>
				</a>
			</div>

			<a href="products.php">
				<div class="side-inner">
					<i class="fa fa-box"></i> Products
				</div>
			</a>
		    
			<a href="">
				<div class="side-inner">
					<i class="fa fa-users"></i> Customers
				</div>
			</a>
		   
			<a href="">
				<div class="side-inner">
					<i class="fa fa-user-plus"></i> User
				</div>
			</a>

			<a href="trash.php">
				<div class="side-inner">
					<i class="fa fa-trash"></i> Trashed
				</div>
			</a>

			<a href="">
				<div class="side-inner">
					<i class="fa fa-cogs"></i> Settings
				</div>
			</a>

			<a href="includes/logout.php">
				<div class="side-inner">
					<i class="fa fa-user-circle"></i> Logout
				</div>
			</a>
		</div>
	</div>
    
</div>

<script>
	// function DropClick(){
	//     const dropSidebar = document.getElementById('dropdown');
	//     dropSidebar.classList.toggle('active');   
	// }

	function DropClick() {
	  if (window.innerWidth <= 992) {
	    document.getElementById('dropdown').classList.toggle('active');
	  }
	}

	function ShowNav(){
		let dropLinks = document.getElementById('dropLink');
		dropLinks.classList.toggle('active');
	}

	function flexing(){
		const myDrops = document.getElementById('myDrop');
		myDrops.classList.toggle('active');
	}

</script>
<?php

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}else{
	header('Location:login.php');
}

?>