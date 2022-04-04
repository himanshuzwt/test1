<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>


</head>
<body>

<div id="container">
	<h1>Event List</h1>

	<div id="body">
		<table class="table" border="1">
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Start Date</th>
				<th>Actions</th>
			</tr>
			<?php 
			foreach($list as $event){ 
				echo "<tr>";
				echo "<td>  ".$event['id']."  </td>";
				echo "<td>  ".$event['event_name']."  </td>";
				echo "<td>  ".$event['event_start_date']."  </td>";
				echo "<td><a href='#' class='view_event button' data-link='".base_url("event/view/{$event['id']}")."'>View</a>  <a href='#' class='delete_event button' data-link='".base_url("event/delete/{$event['id']}")."'>Delete</a></td>";
				echo "</tr>";
			} 
			?>	
		</table>

		<div class="preview_event"> 
			<h2 class="event_name"> </h2>
			<table class="preview_table table" border="1">

			</table>
			<p>Total Recurrence Event: <b><span class="total">555</span></b></p>
		</div>


	</div>

	
</div>

</body>
</html>

<script>

	$(document).ready(function(){
		$('.view_event').click(function(e){
			e.preventDefault();
			var link = $(this).attr('data-link');
			$.ajax({
				url: link,
				success: function(result){
					reponse = $.parseJSON(result);
					var table_html = "<tr><th>Date</th><th>Day</th></tr>";
					$.each(reponse.date_list, function(i, item){
						table_html += "<tr><td>"+item.date+"</td><td>"+item.day+"</td></tr>"
					});
					console.log(table_html);
					$(".event_name").html('');
					$(".event_name").html(reponse.name);
					$(".preview_table").html('');
					$(".preview_table").html(table_html);
					$(".total").html('');
					$(".total").html(reponse.total);
				}
			})
		})

		$('.delete_event').click(function(e){
			e.preventDefault();
			if(confirm('Are you sure to delete?')){
				var link = $(this).attr('data-link');
				$.ajax({
					url: link,
					success: function(result){
						if(result == 1){
							window.location.replace("<?php echo base_url("event/list"); ?>");
						}else{
							alert('No record found');
						}
					}
				})
			}
		})
	})
</script>
