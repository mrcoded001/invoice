<?php session_start();?>
<?php include'includes/header.php'; ?>
<?php include'includes/sidebar.php';?>
<?php include'includes/functions.php';?>
<?php include'includes/navbar.php'; ?>
<?php include'includes/filter-result.php';?>
<style>.sideNav{height:112vh;}</style>
<style>
@media(max-width: 992px){
    .sideNav{
        height: 138vh;
    }
}
.filter-container {
        /*background: #f8f9fa;*/
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .filter-group input {
        height: 40px;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        min-width: 160px;
    }

    .filter-group button {
        height: 40px;
        padding: 0 20px;
        border-radius: 5px;
        color: white;
        border: none;
    }
    .filter-group a {
        height: 40px;
        padding: 0 20px;
        border-radius: 5px;
        /*background-color: #198754;*/
        color: white;
        border: none;
        text-decoration: none;
        text-align: center;
        line-height: 40px;
    }

    .dt-button {
        background-color: #343a40 !important;
        color: white !important;
        border-radius: 6px !important;
        padding: 8px 14px !important;
        margin-right: 5px;
        font-size: 14px;
        border: none;
    }

    .dt-button:hover {
        opacity: 0.85;
    }

    /* Add this to your CSS */
    .dataTables_wrapper table tbody tr {
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.4s ease;
    }

    .dataTables_wrapper table tbody tr.row-visible {
      opacity: 1;
      transform: translateY(0);
    }
    .scroll-data{
        margin-top: -20px;
        width: 100%;
        display: flex;
        gap: 20px;
        overflow: auto;
        scrollbar-width:hidden;
        scrollbar-height:auto;
        padding-left: 10px;
        padding-right: 10px;
    }
    .scroll-data::-webkit-scrollbar{
        display: none;
    }
    .single-data{
        width: 250px;
        height: 75px;
        /*background: blue;*/
        padding: 5px;
        display: flex;
        justify-content: space-between;
        border-radius: 10px;
        padding-right: 10px;
        padding-left: 10px;
        align-items: center;
        cursor: pointer;
    }
    .counter-name{

    }
    .counter-name span{
        font-size: 30px;
        color: #fff;
        font-weight: bold;
    }
    .counter-name h4{
        font-size: 20px;
        color: #fff;
    }
    .symbol span{
        font-size: 50px;
        color: #fff;
    }
    .symbol i{
        font-size: 40px;
        color: #fff;
        opacity: 0.2;
    }

    @media(max-width: 992px){
        .counter-name span{
            font-size: 20px;
        }
        .counter-name h4{
            font-size: 15px;
        }
        .symbol i{
            font-size: 30px;
        }
       
    }
    .page-warm span{
        font-weight: bold;
        font-size: 17px;
    }
    
</style>

<div id="notification-containers" class="notification-containers"></div>
<div class="insider" style="margin-top: -10px;">

    <div class="container">
        <div class="page-warm" style="display: flex; justify-content: space-between;">
            <span>Hi, <?php echo $username;?>.</span>
            <button class="btn btn-success" onclick="openModal('modal-add')">Create New <i class="fa fa-plus-circle"></i></button>
        </div>
        <div class="cat-pag" >

            <!-- filter buttons and summary cards -->
            <?php require'includes/card-summary-filter-btn.php';?>

            <div class="card mt-3">
                <div class="card-header text-center" style="display: flex; justify-content: space-between;">
                    <?php
                    if ($filter_result) {?>
                        <div class="sorting" style="padding: 8px; background: #F3F1FE; color: #1F282F; border-radius: 13px; font-size: 16px; font-weight: bold;"><i class="fa fa-sort"></i><?php echo $filter_result;?>
                        </div>
                    <?php }else{
                        echo "Something went wrong";
                    }
                    ?>

                    <h5>Recent Invoice</h5>
                </div>
                <?php require'includes/filter-table.php';?>
            </div>
            
        </div>
   
    </div>
</div>


<div id="modal-add" class="modal">
    <div class="modal-content" style="margin-top:100px;">
        <div class="modal-header">Create New Invoice <i class="fa fa-plus-circle"></i></div>
        <div class="modal-body">
            <form action="" method="POST" enctype="multipart/form-data" id="myForm">
                <!-- Product name -->
                <small>Customer's Full Name.</small>
                <input type="text" name="firstname" class="form-control" placeholder="Customer Name" required autocomplete="off">

                
                <!-- Add product button -->
                <button type="submit" type="submit" name="add-product" class="btn btn-success mt-4">Continue <i class="fa fa-plus-square"></i></button>
            </form>
            <div id="response"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="closeModal('modal-add')">Cancel <i class="fa fa-cancel"></i> &times;</button>
        </div>
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 99999;
        left: 0; top: 0;
        width: 100%; height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
        backdrop-filter:blur(3px);
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

</style>


<?php include 'includes/footer.php'; ?>

<!-- DataTables & jQuery -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<!-- DataTables Buttons Extension -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-2"lfB>rt<"d-flex justify-content-between align-items-center mt-2"ip>',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    className: 'btn btn-success me-2'
                },
                {
                    extend: 'csvHtml5',
                    text: 'Export to CSV',
                    className: 'btn btn-primary me-2'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    className: 'btn btn-danger me-2'
                },
                {
                    extend: 'print',
                    text: 'Print Table',
                    className: 'btn btn-dark'
                }
            ],
            language: {
                searchPlaceholder: "Invoice ID to search...",
                
            },
            pageLength: 10, // default entries per page
            lengthMenu: [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ]
        });
    });

    $(document).ready(function () {
      var table = $('#example').DataTable();

      // Apply animation on draw
      table.on('draw', function () {
        $('#example tbody tr').each(function (index) {
          const row = $(this);
          setTimeout(function () {
            row.addClass('row-visible');
          }, 50 * index); // Staggered animation
        });

        // Remove old classes before applying again
        $('#example tbody tr').removeClass('row-visible');
      });

      // Trigger the first draw
      table.draw();
    });
</script>


<?php include'includes/notification-alert-js.php';?>


<script>
    function openModal(id) {
        document.getElementById(id).style.display = "block";
    }

    function closeModal(id) {
        document.getElementById(id).style.display = "none";
    }
</script>





  <script>
    document.getElementById("myForm").addEventListener("submit", function(e){
      e.preventDefault();
      let form = e.target;
      let formData = new FormData(form);

      fetch("fetch.php",{
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById('response').innerHTML = data;
        form.reset();
      })
      .catch(error =>{
        document.getElementById('response').innerHTML = "Error Submission";
      })
    })
  </script>
</div>