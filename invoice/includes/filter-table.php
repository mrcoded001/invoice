<div class="card-body" >
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Invoice Id</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <td>Product</td>
                                    <td>Quantity</td>
                                    <th>Date</th>
                                    <th>Pay Type</th>
                                    <td>Cashier</td>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="dataOutput">
                            <?php
                            if (isset($_POST['sort-submit'])) {
                                $month          = $_POST['month-sort'];
                                $rangeFrom      = $_POST['range-from'];
                                $rangeTo        = $_POST['range-to'];

                                if (empty($month || $rangeFrom && $rangeTo)) {
                                    $_SESSION['message'] = 'Invalid Values';
                                    $_SESSION['type'] = 'error';
                                }else{
                                    if (!empty($month)) {
                                        // select this month from invoice_tbl
                                        $startDate = $month . '-01 00:00:00';
                                        $endDate = date("Y-m-t 23:59:59", strtotime($startDate));
                                        
                                        $filter_result = $month;
                                        
                                        $getMonth = "SELECT * FROM invoice_tabl WHERE created BETWEEN ? AND ?";
                                        $stmt = $pdo->prepare($getMonth);
                                        $stmt->execute([$startDate, $endDate]);

                                        $sn = 0;

                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $id         = $row['id'];
                                            $invoiceId  = $row['invoiceId'];
                                            $customer   = $row['customer'];
                                            $amount     = $row['amount'];
                                            $payType    = $row['payment_type'];
                                            $cashier    = $row['cashier'];
                                            $created    = $row['created'];
                                            $quantity   = $row['quantity'];
                                            $product    = $row['prodName'];
                                            $sn = $sn + 1; ?>

                                            <tr>
                                                <td><?php echo $sn;?></td>
                                                <td><?php echo $invoiceId;?></td>
                                                <td><?php echo $customer;?></td>
                                                <td>₦<?php echo $amount;?></td>
                                                <td><?php echo $product;?></td>
                                                <td><?php echo $quantity;?></td>
                                                <td><?php echo $created?></td>
                                                <td><?php echo $payType?></td>
                                                <td><?php echo $cashier?></td>
                                                <td> <button type="button" class="btn btn-primary">
                                                        View <i class="fa fa-eye"></i>
                                                    </button>   
                                                </td>
                                            </tr>
                                        <?php }
                                    }else if (!empty($rangeFrom && $rangeTo)) {
                                        // get data from db
                                        $getRange = "SELECT * FROM invoice_tabl WHERE created BETWEEN ? AND ?";
                                        $filter_result = 'From: $rangeFrom - $rangeTo';
                                        $stmet = $pdo->prepare($getRange);
                                        $stmet->execute([$rangeFrom, $rangeTo]);
                                        $sn = 0;
                                        while ($dataRow = $stmet->fetch(PDO::FETCH_ASSOC)) {
                                            $id         = $dataRow['id'];
                                            $invoiceId  = $dataRow['invoiceId'];
                                            $customer   = $dataRow['customer'];
                                            $amount     = $dataRow['amount'];
                                            $payType    = $dataRow['payment_type'];
                                            $cashier    = $dataRow['cashier'];
                                            $created    = $dataRow['created'];
                                            $quantity   = $dataRow['quantity'];
                                            $product    = $dataRow['prodName'];
                                            $sn = $sn + 1;?>

                                        <tr>
                                            
                                            <td><?php echo $sn;?></td>
                                            <td><?php echo $invoiceId;?></td>
                                            <td><?php echo $customer;?></td>
                                            <td>₦<?php echo $amount;?></td>
                                            <td><?php echo $product;?></td>
                                            <td><?php echo $quantity;?></td>
                                            <td><?php echo $created?></td>
                                            <td><?php echo $payType?></td>
                                            <td><?php echo $cashier?></td>
                                            <td> <button type="button" class="btn btn-primary">
                                                    View <i class="fa fa-eye"></i>
                                                </button>   
                                            </td>
                                        </tr>

                                        <?php }
                                    }
                                }

                            }else{
                                // Print everything
                                $getAllData = "SELECT * FROM invoice_tabl";
                                $allStmt = $pdo->prepare($getAllData);
                                $allStmt->execute();
                                $srn = 0;
                                $filter_result = "All Data" ;
                                while ($AllData = $allStmt->fetch(PDO::FETCH_ASSOC)) {

                                    $id         = $AllData['id'];
                                    $invoiceId  = $AllData['invoiceId'];
                                    $customer   = $AllData['customer'];
                                    $amount     = $AllData['amount'];
                                    $payType    = $AllData['payment_type'];
                                    $cashier    = $AllData['cashier'];
                                    $created    = $AllData['created'];
                                    $quantity   = $AllData['quantity'];
                                    $product    = $AllData['prodName'];
                                    $srn = $srn + 1;?>

                                <tr>
                                    
                                    <td><?php echo $srn;?></td>
                                    <td><?php echo $invoiceId;?></td>
                                    <td><?php echo $customer;?></td>
                                    <td>₦<?php echo $amount;?></td>
                                    <td><?php echo $product;?></td>
                                    <td><?php echo $quantity;?>
                                    <td><?php echo $created?></td>
                                    <td><?php echo $payType?></td>
                                    <td><?php echo $cashier?></td>
                                    <td> <button type="button" class="btn btn-primary">
                                            View <i class="fa fa-eye"></i>
                                        </button>   
                                    </td>
                                </tr>
                                    
                               <?php  }

                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>