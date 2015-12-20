<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>
	<script src="<?php echo base_url(); ?>assets/js/WdatePicker.js"></script>
	</head>
	<body>
		<form id="add" method="post" action="<?php echo  base_url("book/add_book_info")?>">
<!--			<input type="text" value="" name="id" />-->
			<input type="text" value="" name="book_name" />
			<input type="text" value="" name="type_name" />
			<input type="text" value="" name="author" />
			<input type=text name='publish_date' style="width:100px" value="" onClick="WdatePicker({dateFmt: 'yyyy-MM-dd'});" />
			<input type="submit" />
		</form>
		
	</body>
</html>
