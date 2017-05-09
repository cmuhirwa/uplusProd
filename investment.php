<?php include "template/header.php"?>


  <!-- Page -->
  <div class="page animsition">
   <div class="page-header">
      <h1 class="page-title">uPlus 
	  
	 
	  
	  
	  </h1>
      <ol class="breadcrumb">
        <li><a href="home">Home</a></li>
        <li class="active">INVESTMENTS</li>
        <li class="active"><a href="csdrequest.php">CSD</a></li>
      </ol>
      <div class="page-header-actions">
        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-outline btn-round site-tour-trigger">
            <i class="icon md-info" aria-hidden="true"></i>
			<span class="hidden-xs"> I need Help </span>
        </a>
      </div>
    </div>
	
  <div class="page-content container-fluid">
    <div class="row">
	<?php 
		include("db.php");
		$sqlinvest = $investdb ->query("SELECT * FROM `items1`");
		
		while($row = mysqli_fetch_array($sqlinvest)){
			$trust = rand(5,1);
			$companyId = $row['itemCompanyCode'];
			$itemId = $row['itemId'];
			?>
			
			<div class="col-lg-4 col-md-6 col-sm-4">
          <div class="widget widget-shadow">
            <div class="widget-header cover overlay">
              <div class="cover-background height-150" style="background-image: url('../invest/products/<?php echo $row['itemId'];?>.jpg')"></div>
            </div>
            <div class="widget-body padding-horizontal-30 padding-vertical-20" style="height:calc(100% - 250px);">
              <div style="position:relative;padding-left:110px;">
                <a class="avatar avatar-100 bg-white img-bordered" href="javascript:void(0)" style="position:absolute;top:-50px;left:0;">
                  <img src="../invest/company/<?php echo $row['itemCompanyCode'];?>.jpg" alt="">
                </a>
                <div class="margin-bottom-20">
                  <div class="font-size-20"><?php echo $row['itemName'];?></div>
                  <div class="font-size-14">From <?php 
				  $sqlcompany = $investdb ->query("SELECT * FROM `company1` WHERE companyId = '$companyId'");
				  $compRow = mysqli_fetch_array($sqlcompany);
				  echo $compRow['companyName'];
				  ?></div>
                </div>
              </div>
				<ul>
					<li>Pedicted Return: 10%</li>
					<li>Evestment Period: 2 Months</li>
					<li>Trust: <?php echo $trust;?> Year</li>
				</ul>
            </div>
            <div class="widget-footer text-center bg-grey-500 padding-30 height-100">
              <div class="row no-space">
                <div class="col-xs-6">
                  <div class="counter counter-inverse">
                    <span class="counter-number"><?PHP
					$sqlShare = $investdb->query("
					
					SELECT I.`itemId`, I.`itemName`,
IFNULL((SELECT SUM(T.`qty`) FROM `transactions` T WHERE `operation`='In' AND T.`itemCode` = I.`itemId`),0) Ins,
IFNULL((SELECT SUM(T.`qty`) FROM `transactions` T WHERE `operation`='Out' AND T.`itemCode` = I.`itemId`),0)  Outs,
IFNULL((SELECT SUM(T.`qty`) FROM `transactions` T WHERE `operation`='In' AND T.`itemCode` = I.`itemId`),0) -
IFNULL((SELECT SUM(T.`qty`) FROM `transactions` T WHERE `operation`='Out' AND T.`itemCode` = I.`itemId`),0)  Balance
,I.`unitPrice`
FROM `items1` I WHERE I.itemId= '$itemId' AND itemCompanyCode = '$companyId'

					");
					$shareRow = mysqli_fetch_array($sqlShare);
					echo number_format($shareRow['Balance']);
					?></span>
                    <div class="counter-label inline-block margin-left-5">Shares</div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="counter counter-inverse">
                    <span class="counter-number"><?PHP
					$sqlPrice = $investdb->query("SELECT `unitPrice` FROM `theask` WHERE `itemCode` = '$itemId' ORDER BY `transactionId` DESC LIMIT 1");
					$priceRow = mysqli_fetch_array($sqlPrice);
					echo number_format(($priceRow['unitPrice']),2);
					?> Rwf/</span>
                    <div class="counter-label inline-block margin-left-5">Share</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
	
			
			<?php
		}
	?>
		</div>
	
<?php include ("template/footer.php");?>
</body>

</html>



                