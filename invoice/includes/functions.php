<?php
// Function to encrypt your value
function encryptData($data, $key = 'my-secret-key') {
    $cipher = "AES-128-CTR";           // Encryption method
    $options = 0;                      // Default options
    $iv = '1234567891011121';          // Must be 16 characters long

    $encrypted = openssl_encrypt($data, $cipher, $key, $options, $iv);

    return urlencode($encrypted); // make it safe for URL
}
// Function to decrypt value
function decryptData($encryptedData, $key = 'my-secret-key') {
    $cipher = "AES-128-CTR";
    $options = 0;
    $iv = '1234567891011121'; // Same as used in encryption

    $decrypted = openssl_decrypt(urldecode($encryptedData), $cipher, $key, $options, $iv);

    return $decrypted;
}

Function TimeDifference(){
  
  global $timeSent;

  $time = new DateTime($timeSent);
  $now = new DateTime();

  $diff = $now->diff($time);
  if ($diff->y > 0) {
      $timediff = $diff->y.' years ago.';
  }else if ($diff-> m > 0) {
      $timediff = $diff-> m.' months ago.';
  }
  else if ($diff-> d > 0) {
      $timediff = $diff-> d.' days ago.';
  }
  else if ($diff-> h > 0) {
      $timediff = $diff-> h.' hours ago.';
  }
  else if ($diff-> i > 0) {
      $timediff = $diff-> i.' minutes ago.';
  }else{
    $timediff = 'Just now.';
  }

  return $timediff;

}


Function UserLogin(){
	global $pdo;
	if (isset($_POST['login-btn'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (empty($email && $password)) {
			echo "<div class='alert alert-danger'>All Fields are required</div>";
		}else{
			// Get details from the database
			$retrieve = "SELECT password, firstName FROM user_tb 
						WHERE email = ? ";
			$stmt = $pdo->prepare($retrieve);
			$stmt->execute([$email]);

			$dataDetails = $stmt->fetch(PDO::FETCH_ASSOC);
			$fetchPassword = $dataDetails['password'];
			$fetchName 		= $dataDetails['firstName'];

			if (password_verify($password, $fetchPassword)) {
				$_SESSION['mail'] = $email;
				$_SESSION['firstName'] = $fetchName;

				// Get the brandName
				$brand = "SELECT displayName FROM user_acct
							WHERE userEmail = ?";
				$brandPdo = $pdo->prepare($brand);
				$brandPdo->execute([$email]);
				$theData = $brandPdo->fetch(PDO::FETCH_ASSOC);
				$brandName = $theData['displayName'];

				$_SESSION['brandName'] = $brandName;
				$_SESSION['brandProfile'] = $brandName;

				header('Location:index.php');
			}else{
				echo "<div class='alert alert-danger'>Invalid Details.</div>";
			}

			
		}
	}
}



Function EditProduct(){
  global $prodId;
  global $prodImg;
  global $prodName;
  global $price;
  global $quantity;
  ?>

     <div id="modal-<?= $prodId ?>" class="modal">
        <div class="modal-content" style="margin-top:100px;">
          <div class="modal-header">Edit Product</div>
          <div class="modal-body">
            <!-- Input form starts here -->
            <form action="" method="POST" enctype="multipart/form-data">
              <!-- <div class="uploads" style="margin-top: -5px">
                <img src="prod-img/<?php echo $prodImg;?>" alt="Preview" class="editImagePreview ">
                <div class="rightRound">
                  <label for="editImageInput-<?= $prodId ?>" class="camera-icon">
                    <i class="fa fa-camera"></i>
                  </label>
                  <input type="file" class="editImageInput" name="prod-Image" id = "fileImg">
                  <input type="hidden" name="returnImg" value="<?php echo $prodImg;?>">
                </div>
                <input type="hidden" name="edit-id" value="<?= $prodId ?>">
              </div> -->
              <input type="hidden" name="edit-id" value="<?= $prodId ?>">
              <label style="padding-left: 30px;">Product Name:</label>
              <input type="text" class="form-control" name="prod-name" value="<?= htmlspecialchars($prodName) ?>" required>

              <!-- Price and Quantity -->
              <div class="input-group mt-4">
                <div class="label-wraps">
                  <label>Unit Price</label>
                  <label>Product Quantity</label>
                </div>
                <div class="input-wraps">
                  <div class="price-box">
                    <span>₦</span>
                    <input type="number" name="price" step="0.01" min="0" autocomplete="off" placeholder="Unit Price" value="<?php echo $price;?>" required>
                  </div>
                  <div class="quant-box">
                    <input type="number" name="quantity" step="0.01" min="0" autocomplete="off" placeholder="Quantity" value="<?php echo $quantity;?>" required>
                  </div>
                </div>
              </div>
              <!-- End product and quality  -->
              <button type="submit" name="upd-product" class="btn btn-success mt-3">Update Product</button>

            </form>
            <!-- End Form action -->
          </div>
          <!-- End Modal body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="closeModal('modal-<?= $prodId ?>')">Cancel</button>
          </div>

        </div>
        <!-- Modal Content -->
      </div>
      <!-- Modal overall -->
<?php }




Function AddProduct(){?>
  <div id="modal-add" class="modal">
      <div class="modal-content" style="margin-top:100px;">
          <div class="modal-header">Add New Product <i class="fa fa-plus-circle"></i></div>
          <div class="modal-body">
              <form action="" method="POST" enctype="multipart/form-data" >
              	<!-- Product name -->
                <label style="padding-left: 30px;">Product Name:</label>
              	<input type="text" name="prod-name" class="form-control" placeholder="Product Name" required autocomplete="off">

                  <!-- Add a product image -->
                  <!-- <input type="hidden" name="slide_image">
                  <div class="upload-wraps">
                    <div class="uploads mt-3">
                      <img alt="" src="images/logo.png" id = "image" >
                      <div class="rightRound" id = "upload">
                        <input type="file" name="slide_image" id = "fileImg" accept=".jpg, .jpeg, .png">
                        <i class = "fa fa-camera"></i>
                      </div>
                      <div class="leftRound" id = "cancel" style = "display: none;">
                        <i class = "fa fa-times"></i>
                      </div>
                    </div>
                  </div>  -->
                  <!-- Price and Quantity -->
                  <div class="input-group mt-3">
                    <div class="label-wraps">
                      <label>Unit Price</label>
                      <label>Product Quantity</label>
                    </div>
                    <div class="input-wraps">
                      <div class="price-box">
                        <span>₦</span>
                        <input type="number" name="price" step="0.01" min="1"  autocomplete="off" placeholder="Unit Price" required>
                      </div>
                      <div class="quant-box">
                        <input type="number" name="quantity" step="0.01" min="1"  autocomplete="off" placeholder="Quantity" required>
                      </div>
                    </div>
                  </div>
                  <!-- Add product button -->
                  <button type="submit" name="add-product" class="btn btn-success">Add Product <i class="fa fa-plus-square"></i></button>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="closeModal('modal-add')">Cancel <i class="fa fa-cancel"></i> &times;</button>
          </div>
      </div>
  </div>
<?php } 


Function TotalProduct(){
  global $pdo;

  // select 
  $select = "SELECT COUNT(prodId) AS prodId FROM products";
  $stmt = $pdo->prepare($select);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $counter = $data['prodId'];
}

Function TrashProduct(){
  global $pdo;

  // select 
  $select = "SELECT COUNT(prodId) AS prodId FROM products_trash";
  $stmt = $pdo->prepare($select);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  return $counter = $data['prodId'];
}


function TotalInvoice(){
  global $pdo;

  $count = "SELECT COUNT(invoiceId) AS invoiceNum FROM invoice_tabl";
  $stmt = $pdo->prepare($count);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $TotalInvoice = $row['invoiceNum'];
}

function TotalSales(){
  global $pdo;

  $sales = "SELECT SUM(amount) AS totalAmount FROM invoice_tabl";
  $stmt = $pdo->prepare($sales);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $TotalAmount = $row['totalAmount'];
}

function ThisMonth(){
  global $pdo;

  $getMonth = date('Y-m');

  // get Month data
  $month = "SELECT SUM(amount) AS totalMonth FROM invoice_tabl WHERE created LIKE ?";
  $stmt = $pdo->prepare($month);
  $stmt->execute(["%$getMonth%"]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $TotalMonth = $row['totalMonth'];
}

function TotalCustomer(){
  global $pdo;

  $customer = "SELECT DISTINCT (customer) AS totalCustomer FROM invoice_tabl";
  $stmt = $pdo->prepare($customer);
  
  $stmt->execute();
  return $counter = $stmt->rowCount();
}

function ExpiryProduct(){
  global $pdo;
  $quantity = 0;

  $expiry = "SELECT COUNT(quantity) AS expiry FROM products WHERE quantity = ?";
  $stmt = $pdo->prepare($expiry);
  $stmt->execute([$quantity]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $counter = $row['expiry'];
}












?>