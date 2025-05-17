<?php session_start();?>
<?php include'includes/header.php'; ?>
<?php include'includes/sidebar.php';?>
<?php include'includes/functions.php';?>
<?php include'includes/navbar.php'; ?>

<!-- Handle Add Slider -->
<style>
    td span{
        padding: 10px; border-radius: 6px;
        font-size: 13px;
    }
    .success_stutus{
        background: #E8FCEF; color: #4ECA74;
    }
    .error_status{
        background: #F8D7DA; color: #90151C;
    }
</style>
<?php
function compressImage($source, $destination, $quality) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    } else {
        return false; // unsupported type
    }

    // Compress and save to destination
    return imagejpeg($image, $destination, $quality);
}


if (isset($_POST['add-product'])) {
    $prodName   = $_POST['prod-name'];
    $price      = $_POST['price'];
    $quantity   = $_POST['quantity'];
    // $img        = $_FILES['slide_image']['name'];
    // $img_tmp    = $_FILES['slide_image']['tmp_name'];

    // $imgName = uniqid() . "_" . $img; // unique name
    // move_uploaded_file($img_tmp, "prod-img/$imgName");

    $imgName = "removed";

   
        $insert = "INSERT INTO products(prodImg, prodName, unit_price, quantity) VALUES (?, ?, ?, ?)";
        $insertmt = $pdo->prepare($insert);
        if ($insertmt->execute([$imgName, $prodName, $price, $quantity])) {
            $_SESSION['message'] = "Product Added Successfully";
            $_SESSION['type'] = "success";
        }else{
            $_SESSION['message'] = "Failed to upload image";
            $_SESSION['type'] = "error";
        }
    
}

// Handle Update Slider
if (isset($_POST['upd-product'])) {

    
    $prodName   = $_POST['prod-name'];
    $editId     = $_POST['edit-id'];
    $unitPrice  = $_POST['price'];
    $quantity   = $_POST['quantity'];
    
    // $prodImg    = $_FILES['prod-Image']['name'];
    // $edit_tmp   = $_FILES['prod-Image']['tmp_name'];
    
    // $retnImg    = $_POST['returnImg']; // holding image value from db


    // if (!empty($prodImg)) {
    //     $imgName = uniqid() . "_" . $prodImg; // unique name
    //     move_uploaded_file($edit_tmp, "prod-img/$imgName");  
    // }
    // else{
    //     $imgName = $retnImg;
    // }
$imgName = "removed";
    try{
        $update = "UPDATE products 
                    SET prodImg = ?, 
                    prodName = ?, 
                    unit_price = ?,
                    quantity = ?
                    WHERE prodId = ?";
        $updatesmt = $pdo->prepare($update);
        $updatesmt->execute([$imgName, $prodName, $unitPrice, $quantity,  $editId]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $_SESSION['message'] = "Product Updated Successfully";
        $_SESSION['type'] = "success";

    }catch(PDOExecption $e){
        echo "unable to update slider".$e->getMessage();
    }
  
}


// Handle Delete Slider
if (isset($_POST['DeleteBtn'])) {
    if (!empty($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $prodId) {

            // get data from table based on the prodId
            $select = "SELECT * FROM products WHERE prodId = ?";
            $stmt = $pdo->prepare($select);
            $stmt->execute([$prodId]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $prodName = $row['prodName'];
                // $prodImg  = $row['prodImg'];
                $prodImg = "removed";
                $unitPrice = $row['unit_price'];
                $quantity = $row['quantity'];

            // Insert the above data into trash table
            $insert = "INSERT INTO products_trash(prodImg, prodName, unit_price, quantity)
                        VALUES(?, ?, ?, ?)";
            $insertStmt = $pdo->prepare($insert);
            $insertStmt->execute([$prodImg, $prodName, $unitPrice, $quantity]);
            }

            // Then delete from the products table
            $delete = "DELETE FROM products WHERE prodId = ?";
            $delStmt = $pdo->prepare($delete);
            $delStmt->execute([$prodId]);


            $_SESSION['message'] = "Moved to Trash Successfully";
            $_SESSION['type'] = "success";
        }
    }
}
?>

<div id="notification-containers" class="notification-containers"></div>
<div class="insider">
    <div class="container">
        <div class="cat-page">
            <div class="cat-page-header d-flex justify-content-between align-items-center">
                <h5>All Products</h5>
                <div>
                    <button class="btn btn-success" onclick="openModal('modal-add')">Add New <i class="fa fa-plus-circle"></i></button>
                    <button class="btn btn-danger" onclick="handleDelete()">Trash Now <i class="fa fa-trash"></i></button>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header text-center">
                    <h5>Manage Product(s)</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST" id="mainForm">
                        <!-- Delete Confirmation Modal -->
                        <div id="modal-delete" class="modal">
                            <div class="modal-content" style="margin-top:150px;">
                                <div class="modal-header">Delete Confirmation</div>
                                <div class="modal-body">Are you sure you want to move product to the trash?</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="closeModal('modal-delete')">No, Cancel</button>
                                    <button type="submit" name="DeleteBtn" class="btn btn-danger">Yes, Move</button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="SelectAllBoxes"></th>
                                        <th>ID</th>
                                        <!-- <th>Images</th> -->
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Product Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sn = 0;
                                    $fetch = "SELECT * FROM products  
                                              ORDER BY prodId DESC ";
                                    $stmt = $pdo->prepare($fetch);
                                    $stmt->execute([]);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $sn++;
                                        $prodId = $row['prodId'];
                                        // $prodImg = $row['prodImg'];
                                        $prodName = $row['prodName'];
                                        $price = $row['unit_price'];
                                        $quantity = $row['quantity'];

                                        if ($quantity > 0) {
                                            $status = "Available";
                                            $status_type = 'success_stutus';
                                        }else{
                                            $status = "Not Available";
                                            $status_type = 'error_status'; 
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="checkBoxArray[]" value="<?= $prodId ?>" class='checkBoxes'>
                                            </td>
                                            <td><?= $sn ?></td>
                                            <!-- <td>
                                                <img src="prod-img/<?php echo $prodImg;?>" style="width:50px; height:50px;">
                                            </td> -->
                                            <td>
                                                <?= htmlspecialchars($prodName) ?>
                                            </td>
                                            <td>₦<?php echo $price;?></td>
                                            <td><?php echo $quantity;?></td>
                                            <td style="text-align: center; padding-top: 20px;"><span class="<?php echo $status_type?>"><?php echo $status;?></span></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="openModal('modal-<?= $prodId ?>')">
                                                    Edit <i class="fa fa-edit"></i>
                                                </button>
                                                
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <?php EditProduct();?>
                                    <!-- End while loop -->
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Add New Modal -->
            <?php AddProduct();?>
        </div>
   
    </div>
</div>


<?php include 'includes/footer.php'; ?>

<!-- DataTables & jQuery -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
        $('#SelectAllBoxes').click(function () {
            $('.checkBoxes').prop('checked', this.checked);
        });
    });

    function openModal(id) {
        document.getElementById(id).style.display = "block";
    }

    function closeModal(id) {
        document.getElementById(id).style.display = "none";
    }

    function handleDelete() {
        const checked = document.querySelectorAll("input[name='checkBoxArray[]']:checked");
        if (checked.length === 0) {
            alert("No products selected!");
            return;
        }
        openModal('modal-delete');
    }
   
</script>


<!-- Modal Styling -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 99999;
        left: 0; top: 0;
        width: 100%; height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);

    }

    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 500px;
        animation: fadeIn 0.3s;
    }

    .modal-header, .modal-footer {
        font-weight: bold;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /*.input-group button{
      background: #fff; 
      border-top-right-radius: 1px; 
      border-bottom-right-radius: 1px; 
      outline: none; 
      border:0.9px solid gray
    }
    .input-group input{
      border:0.9px solid gray
    }*/
    .label-wraps{
        width: 100%;
        padding-left: 30px;
        padding-right: 30px;
        display: flex;
        justify-content: space-between;
      
    }
    .input-wraps{
        width: 100%;
        display: flex;
        gap:8px;
        padding: 5px;
    }
    .price-box{
        width: 50%;
        height: 55px;
        /*border-bottom: 2px solid #ddd;*/
        border:2px solid #ddd;
        padding: 15px;
        border-radius: 10px;
    }
    .price-box span{
        font-size: 18px;
        color: #666;
        /*font-weight: bold;*/
    }
    .price-box input{
        width: 85%;
        
        border:none;
        outline: none;
        font-size: 16px;
        color: 888;
       /* height: 20px;*/
    }
    .quant-box{
        width: 50%;
        height: 55px;
        /*border-bottom: 2px solid #ddd;*/
        border:2px solid #ddd;
        padding: 15px;
        border-radius: 10px;
    }
    .quant-box input{
        width: 100%;
        border:none;
        outline: none;
        font-size: 16px;
        color: 888;
    }
</style>


<script type="text/javascript">
    document.getElementById("fileImg").onchange = function(){
      document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image
      document.getElementById("cancel").style.display = "block";
      document.getElementById("uploads").style.display = "none";
    }

    var userImage = document.getElementById('image').src;
    document.getElementById("cancel").onclick = function(){
      document.getElementById("image").src = userImage; // Back to previous image
      document.getElementById("cancel").style.display = "none";
      document.getElementById("uploads").style.display = "block";
    }      
</script>


<script>
document.querySelectorAll('.editImageInput').forEach(function(input) {
    input.addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = input.closest('.modal').querySelector('.editImagePreview');

        if (file && preview) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>
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

