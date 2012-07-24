<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<title>Rotate layout</title>
	
	<?php 
		$boxTotalArray = array(7);
		$columnTotalArray = array(3);
		$boxTotal = $boxTotalArray[rand(0,count($boxTotalArray)-1)]; 
		$columnTotal = $columnTotalArray[rand(0,count($columnTotalArray)-1)]; 	
		
	?>
	
	<!-- CSS
  ================================================== -->
	<style type="text/css">
	html, body{
		margin:0;
		padding:0;
		background:#eee;
		overflow:hidden;
		font-family:arial;
		font-size:12px;
	}
	.box{
		float:left;
		width:<?php echo 100/$columnTotal; ?>%;
		height:25.0%;
		display:block;
		background:#ccc;
		position:relative;
		overflow:hidden;
	}
	.box:hover .box-inner img{
		opacity:0.6;
	}
	.box-inner{
		position:absolute;
		left:0;
		top:0;
		width:100%;
		height:100%;
		margin: -2px;
		border:1px solid grey;
		overflow:hidden;
	}
	.box-inner .info{
		position:absolute;
		top:5px;
		left:5px;
		background:rgba(255,255,255,0.8);
		padding:2px 8px;
	}
	.box-inner .info h2{
		margin:0;
		padding:0;
	}
	.box-inner img{
		position:absolute;
		top:0px;
		left:0px;
	}
	</style>
	
	<!-- JQuery
  ================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	
	<script type="text/javascript">
		
	
	var stage = {
		'height' : 0,
		'width' : 0
	};
	
	var imgW = 900;
	var imgH = 600;
	var ratio = imgW/imgH;
	var boxH = [];
	var boxW = [];
	var newRatio = [];
	var newimgH = [];
	var newimgW = [];
	var centerValue = [];
	
	function setup(){
		stage.width = $(window).width();
		stage.height = $(window).height();
		$('#wrap').css('height',stage.height);
		$('#wrap').css('width',stage.width);
		
		for(var c=0; c<7; c++){
			boxH[c] = $('.style'+c+' .box-inner').innerHeight();
			boxW[c] = $('.style'+c+' .box-inner').innerWidth();
		}
		
		$('.box.style0').css('height',boxH[1]*3);
		$('.box.style0').css('width',boxW[1]*2);
		boxH[0] = $('.style0 .box-inner').innerHeight();
		boxW[0] = $('.style0 .box-inner').innerWidth();
		
		for(var c=0; c<7; c++){

			$('.style'+c+' .stats').html('w' + boxW[c] + ' h' + boxH[c]);
			
			newRatio[c] = boxW[c] / boxH[c];
			
			if(newRatio[c] > ratio){
				$('.style'+c+' .box-inner img').css('height','auto');
				$('.style'+c+' .box-inner img').css('width','100%');
				
				newimgH[c] = $('.style'+c+' .box-inner img').innerHeight();
				centerValue[c] = -1*((newimgH[c]-boxH[c])/2);
				$('.style'+c+' .box-inner img').css('top', centerValue[c]);
				$('.style'+c+' .box-inner img').css('left', 0);
			}else{
				$('.style'+c+' .box-inner img').css('height','100%');
				$('.style'+c+' .box-inner img').css('width','auto');
				
				newimgW[c] = $('.style'+c+' .box-inner img').innerWidth();
				centerValue[c] = -1*((newimgW[c]-boxW[c])/2);
				$('.style'+c+' .box-inner img').css('left', centerValue[c]);
				$('.style'+c+' .box-inner img').css('top', 0);
			}
			
		}
	}
	
	$(window).resize(function(){
		setup();
	});
	$(window).load(function(){
		$(document).ready(function(){
			setup();
		});
	});
	
	</script>
	
</head>
<body>
	<div id="wrap">
	<?php for($i=0; $i<$boxTotal; $i++) : ?>
		<div class="box style<?php echo $i; ?>">
			<div class='box-inner'>
				<img src='images/test<?php echo rand(1,5); ?>.jpg' />
				<div class='info'>
					<h2><?php echo 'BOX'.$i; ?></h2>
					<div class='stats'></div>
				</div>
			</div>
		</div>
	<?php endfor; ?>
	</div>
</body>
</html>
