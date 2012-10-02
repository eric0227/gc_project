<?php
?>

<!-- HEADER /layout/default/header.php -->
<html>
	<head>
		<title> GC Project </title>
		
		<script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
		
		<script>
			var isOpenLog = false;
	
			$(function(){
				$("#logFlag").live('click', function() {
					if(isOpenLog) {
						closeLog();
					} else {
						openLog();
					}
				});	
				showLog();
			});			
			function showLog() {
				$("#logFlag").show();				
				openLog();			
			}	
			function openLog() {				
				$('#logPanel').animate({bottom:'-100px'}, 1000, 'easeInOutCubic');
				$('#logFlag').attr('src', '/gc_project/images/chat_minus.png');
				isOpenLog = true;
			}
			function closeLog() {
				//$("#LogFrame").hide();
				$('#logPanel').animate({bottom:'-475px'}, 1000, 'easeInOutCubic');
				$('#logFlag').attr('src', '/gc_project/images/chat_plus.png');
				isOpenLog = false;
			}
		</script>
		
		<style type="text/css" >
			#logPanel {
				background:#000000;
				color: #FFFFFF;
				position:fixed;
				z-index: 9999;
				border: none;
				overflow: hidden;
				width: 98%;
				height: 508px;
				bottom: -475px;
			}

			#logFlag {
				float: right;
				margin-right: 20px;
				margin-top: 9px;
				cursor: pointer;
			}
			
			#logtitle {
				color: pink;
				text-align:center;
			}
			
			#log {
				padding: 20px;
				font-size: 12px;
				height: 360px;
				overflow: auto;
			}
		</style>
	</head>
	
	<body>	
		HEADER
		
		<div id="logPanel">
			<div id="logtitle">
				Logs
				<img src="./images/chat_plus.png" alt="" id="logFlag" />
			</div>
						
			<div style="clear:both;"></div>
			<div id="log">
				1. Call Method Name : <?=$method?> 
				<br><br>
				2. ParamInfo : <br>
				<?=print_r($params, true)?>
				<br><br>
				3. Request : <br>
				<?=print_r($_REQUEST, true)?>
			</div>
		</div>
		