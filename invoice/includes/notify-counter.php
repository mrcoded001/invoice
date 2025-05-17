<?php session_start();?>
<?php include'db.php';?>
<?php 
	if (isset($_SESSION['brandName'])) {
	    $brandName = $_SESSION['brandName'];
	}else{
	    header('location:logout.php');
	};
?>
<?php 
$status = "Not_Seen";
// count notification 
$notifyCount = "SELECT DISTINCT senderName, timeSent, message 
                FROM notifications
                WHERE (receiverName = ? || senderName = ?)
                AND status = ?";
$counterPdo = $pdo->prepare($notifyCount);
$counterPdo->execute([$brandName, $brandName, $status]);
$dataCounter = $counterPdo->rowCount();

if ($dataCounter > 10) {

    $counter = "10+"; 
}else{
    $counter = $dataCounter;
}
?>
<?php echo $counter;?>