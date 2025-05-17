<?php session_start();?>
<?php include'includes/header.php';?>
<?php include'includes/sidebar.php';?>
<?php include'includes/navbar.php';?>
<?php include'includes/functions.php';?>
<style>.sideNav{height:118vh;}
@media(max-width: 992px){
    .sideNav{
        height: 128vh;
    }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="insider" style="margin-top: -15px;">
    <div class="container-flud">
        <span style="font-weight: bold;">Hi <?php echo $username;?>, Welcome.</span>
        <div class="all-cards">
            <div class="row row-cols-2">
                <div class="col-lg-3 mt-3">
                    <a href="products.php">
                        <div class="single-card success">
                            <div class="content-card">
                                <h4><?php echo TotalProduct();?></h4>
                                <span>Total Products</span>
                            </div>
                            <div class="icon-card">
                                <!-- <label>$</label> -->
                                <i class="fa fa-box"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 mt-3">
                    <a href="">
                        <div class="single-card info">
                            <div class="content-card">
                                <h4><?php echo TotalCustomer();?></h4>
                                <span>Total Customers</span>
                            </div>
                            <div class="icon-card">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 mt-3">
                    <a href="trash.php">
                        <div class="single-card danger">
                            <div class="content-card">
                                <h4><?php echo TrashProduct();?></h4>
                                <span>Trash Products</span>
                            </div>
                            <div class="icon-card">
                                <i class="fa fa-trash"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 mt-3">
                    <a href="">
                        <div class="single-card warning">
                            <div class="content-card">
                                <h4><?php echo ExpiryProduct();?></h4>
                                <span>Expiry Products</span>
                            </div>
                            <div class="icon-card">
                                <i class="fa fa-exclamation-circle"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 mt-3">
                    <a href="">
                        <div class="single-card primary">
                            <div class="content-card">
                                <h4>20</h4>
                                <span>All Users</span>
                            </div>
                            <div class="icon-card">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 mt-3">
                    <a href="">
                        <div class="single-card notifications">
                            <div class="content-card">
                                <h4><?php echo ExpiryProduct();?></h4>
                                <span>Notifications</span>
                            </div>
                            <div class="icon-card">
                                <i class="fa fa-bell"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 mt-3">
                    <a href="">
                        <div class="single-card invoice">
                            <div class="content-card">
                                <h4><?php echo TotalInvoice();?></h4>
                                <span>Total Invoices</span>
                            </div>
                            <div class="icon-card">
                                <i class="fa fa-file-pdf"></i>
                            </div>
                        </div>
                    </a>
                </div>
                                
            </div>
        </div>
    </div>
    <!-- Chart Section -->
    <canvas id="salesChart" width="800" height="300"></canvas>

    <script>
      const ctx = document.getElementById('salesChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
          datasets: [{
            label: 'Monthly Sales (₦)',
            data: [50000, 75000, 60000, 90000, 120000],
            backgroundColor: '#007bff'
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { display: false },
            title: {
              display: true,
              text: 'Monthly Sales Overview'
            }
          }
        }
      });

      function applyFilter() {
        alert("Filter logic can be added here based on selected fields.");
      }
    </script>
</div>





<?php include'includes/footer.php';?>