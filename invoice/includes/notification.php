<?php session_start();?>
<?php include'db.php';?>
<?php include'functions.php';?>
<?php 
	if (isset($_SESSION['brandName'])) {
	    $brandName = $_SESSION['brandName'];
	}else{
	    header('location:logout.php');
	};
?>
<ul>
	<?php
	$select = "SELECT DISTINCT senderName, receiverName, timeSent, message 
	            FROM notifications
	            WHERE (receiverName = ? || senderName = ?)
	            ORDER BY timeSent DESC";
	$stmt = $pdo->prepare($select);
	$stmt->execute([$brandName, $brandName]);
	while ( $datas = $stmt->fetch(PDO::FETCH_ASSOC)) {
	   $sender      = $datas['senderName'];
	   $receiver    = $datas['receiverName'];
	   $message     = $datas['message'];
	   $timeSent    = $datas['timeSent'];

	   if ($sender == $brandName ) {
	        $title = "You:";
	   }
	   else {
	        $title = "$sender:";

	   }
	?>

	<li>
	    <a href="">
	        <div class="notify-inner">
	           <div class="the-avatar">
	               <i class="fa fa-user"></i>
	           </div>                        
	           <div class="the-not-msg">
	               <h5><?php echo $title;?></h5>
	               <h4><?php if (strlen($message) > 40) {
	                   echo substr($message, 0, 40).'...';
	               }else{
	                echo $message;
	               }?></h4>
	               <span><?php echo TimeDifference();?></span>   
	            </div>   
	       </div>
	   </a> 
	</li>
	<?php };?>
</ul>