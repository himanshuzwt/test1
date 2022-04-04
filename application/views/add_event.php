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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<!-- <form mothod="POST" action="<?php echo base_url('event/add_event/'); ?>" > -->
		<?php echo validation_errors(); ?>
		
		<?php echo form_open(base_url('event/add_event')); ?>
			<div class="form-group">
				<label for="event_name">Event Name</label>
				<input type="text" name="event_name" id="event_name" value="<?php echo isset($event_name)?$event_name:''; ?>" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="event_start_date">Start Date</label>
				<input type="text" name="event_start_date" id="event_start_date" value="<?php echo isset($event_start_date)?$event_start_date:''; ?>" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="event_repeat_number">Event Repeat</label>
				<input type="text" name="event_repeat_number" id="event_repeat_number" value="<?php echo isset($event_repeat_number)?$event_repeat_number:''; ?>" class="form-control" required>
				<br>
				<select class="form-control" name="event_repeat_duration" id="event_repeat_duration" value="<?php echo isset($event_repeat_duration)?$event_repeat_duration:''; ?>" required>
					<option value="day">day</option>
					<option value="week">week</option>
					<option value="month">month</option>
					<option value="year">year</option>
				</select>
			</div>
			<!-- <div class="radio form-group">
				<label for="event_end_type">Ends</label>
				<input type="radio" name="event_end_type" id="event_end_type" checked="checked" value="with_end_date" class="" >
				<input type="radio" name="event_end_type" id="with_occrance" value="with_occrance" class="" >
			</div> -->
			<div class="form-check">
				<input class="form-check-input" value="with_end_date" type="radio" name="event_end_type" id="event_end_type1" checked="checked" <?php echo isset($event_end_type) && $event_end_type == 'with_end_date' ?"checked='checked'":"checked='checked'";?>>
				<label class="form-check-label" for="event_end_type1">
					Ends with end date
				</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" value="with_occrance" type="radio" name="event_end_type" id="event_end_type2" <?php echo isset($event_end_type) && $event_end_type == 'with_occrance' ?"checked='checked'":"";?>>
				<label class="form-check-label" for="event_end_type2">
					Ends with occurrence
				</label>
			</div>
			<div class="end_date form-group" <?php echo isset($event_end_type) && $event_end_type == 'with_occrance' ?"style='display:none;'":"style='display:block;'";?>>
				<label for="event_end_date">On Date</label>
				<input type="text" name="event_end_date" id="event_end_date" value="<?php echo isset($event_end_date)?$event_end_date:''; ?>" class="" >
			</div>
			<div class="occurances form-group" <?php echo isset($event_end_type) && $event_end_type == 'with_end_date'  ?"style='display:none;'":(!isset($event_end_type)?"style='display:none;'":"");?>>
				After Occurance
				<input type="text" name="event_occurance" id="event_occurance" value="<?php echo isset($event_occurance)?$event_occurance:''; ?>" class="" > 
			</div>	
			<button class="save btn btn-primary" type="submit">Add</button>
		</form>
	</div>

	
</div>

</body>
</html>

<script>
	$( function() {
		$( "#event_start_date" ).datepicker();
		$( "#event_start_date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#event_end_date" ).datepicker();
		$( "#event_end_date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	} );

	$(document).ready(function(){
		// alert('hiiii');
		// $("div.end_date").show();
		// $("div.occurances").hide();
		$("input[name$='event_end_type']").click(function(){
			var type = $(this).val();
			// alert(type);
			if(type == "with_occrance"){
				$("div.end_date").hide();
				$("div.occurances").show();
			}else if(type == "with_end_date"){
				$("div.end_date").show();
				$("div.occurances").hide();
			}
		})
		// $('form').validate();
		$('form').validate({
			rules:{
				event_name:{
					required:true
				},
				event_start_date:{
					required:true,
				},
				event_end_date:{
					required:{
						depends:function(elem) {
							return $("#event_end_type").val() != ""
						}
					}
				},
				event_occurance:{
					required:{
						depends:function(elem) {
							return $("#with_occrance").val() != ""
						}
					},
					number:{
						depends:function(elem) {
							return $("#with_occrance").val() > 0
						}
					}
				},
				event_repeat_number:{
					required:true,
					number:true
				}
			},
			messages:{
				event_name:{
					required:"Please add event name"
				},
				event_start_date:{
					required:"Please add start date"
				},
				event_end_date:{
					required:"Please add end date"
				},
				event_occurance:{
					required:"Please add event occurrence",
					number:"Please add valid number"
				},
				event_repeat_number:{
					required:"Please add repeat number",
					number:"Please add valid repeat number"
				}
			}
		})
		jQuery.validator.addMethod("validDate", function(value, element) {
        return this.optional(element) || moment(value,"DD/MM/YYYY").isValid();
    }, "Please enter a valid date in the format DD/MM/YYYY");
	})
</script>
