<?php

// Define our boxes
$boxes = array(
	array(
		'length' => 50,
		'width' => 50,
		'height' => 8
	),
	array(
		'length' => 33,
		'width' => 8,
		'height' => 8
	),
	array(
		'length' => 16,
		'width' => 20,
		'height' => 8
	),
	array(
		'length' => 3,
		'width' => 18,
		'height' => 8
	),
	array(
		'length' => 14,
		'width' => 2,
		'height' => 8
	),
);

// Initialize LAFFPack
$lp = new \Cloudstek\PhpLaff\Packer();

// Start packing our nice boxes
$lp->pack($boxes);

// Collect our container details
$c_size = $lp->get_container_dimensions();
$c_volume = $lp->get_container_volume();
$c_levels = $lp->get_levels();

// Collect remaining boxes details
$r_boxes = $lp->get_remaining_boxes();
$r_volume = $lp->get_remaining_volume();
$r_num_boxes = 0;
if(is_array($r_boxes)) {
	foreach($r_boxes as $level)
		$r_num_boxes += count($level);
}

// Collect packed boxes details
$p_boxes = $lp->get_packed_boxes();
$p_volume = $lp->get_packed_volume();
$p_num_boxes = 0;
if(is_array($p_boxes)) {
	foreach($p_boxes as $level)
		$p_num_boxes += count($level);
};
	
// Calculate our waste
$w_volume = $c_volume - $p_volume;
$w_percent = $c_volume > 0 && $p_volume > 0 ? (($c_volume - $p_volume) / $c_volume) * 100 : 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
  <style type="text/css" media="screen">
	body {
		font-family: monospace;
	}
	
	#container {
		width: 400px;
		border: 2px solid #FF9900;
		padding: 10px;
	}
	
	#container .title {
		display: inline-block;
		margin-bottom: 5px;
	}
	
	#container .description {
		color: #999;
		display: inline-block;
	}
	
	#container .level {
		padding: 10px;
		border: 2px solid #55AA00;
		position: relative;
	}
	
	#container .level:not(:first-child) {
		margin-top: 5px;
	}
	
		#container .level .box {
			padding: 5px;
			border: 2px solid #33AACC;
		}
		
		#container .level .box:not(:first-child) {
			margin-top: 5px;
		}
			
			#container .level .box>.title {
				display: inline-block;
				margin-bottom: 0;
			}
			
  </style>
</head>
<body>
	<h2>Packed boxes</h2>
	<p>
		<b>Packed boxes:</b> <?php echo $p_num_boxes; ?><br />
		<b>Total volume:</b> <?php echo $p_volume; ?>(cm3)<br />
		<b>Wasted space:</b> <?php echo $w_volume ?>(cm3) / <span style="color: hsl(0, 100%, <?php echo $w_percent / 2; ?>%);"><?php echo $w_percent; ?>%</span>
	</p>
	
	<h2>Remaining boxes</h2>
	<p>
		<b>Remaining boxes:</b> <?php echo count($r_boxes); ?><br />
		<b>Total volume:</b> <?php echo $r_volume; ?>(cm3)
	</p>
	
	<h2>Result</h2>
	<div id="container">
		<span class="title">Container</span>
		<span class="description"><?php echo $c_size['length'];?>x<?php echo $c_size['width'];?>x<?php echo $c_size['height'];?>(cm)</span>
		<span class="description"><?php echo $c_volume; ?>(cm3)</span>
	
		<?php for($i = 0; $i < $c_levels; $i++): ?>
		<div class="level">
			<span class="title">Level <?php echo $i; ?></span>
			<?php $ld = $lp->get_level_dimensions($i); ?>
			<span class="description"><?php echo $ld['length']; ?>x<?php echo $ld['width']; ?>x<?php echo $ld['height']; ?>(cm)</span>
			<span class="description"><?php echo $ld['length'] * $ld['width']; ?>(cm2)</span>
			<div class="boxes">
				<?php foreach($p_boxes[$i] as $k => $box): ?>
				<div class="box">
					<span class="title">Box <?php echo $k; ?></span>
					<span class="description"><?php echo $box['length']; ?>x<?php echo $box['width']; ?>x<?php echo $box['height']; ?>(cm)</span>
					<span class="description"><?php echo $box['length'] * $box['width']; ?>(cm2)</span>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endfor; ?>
	</div>
</body>
</html>