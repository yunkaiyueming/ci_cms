<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>
	
	</head>
	<body>
		<form id="update" method="post" action="<?php echo  base_url("book/update_book_info")?>">
			<input type="text" value="<?php echo $book_info['id']?>" name="id" />
			<input type="text" value="<?php echo $book_info['book_name']?>" name="book_name" />
			<input type="text" value="<?php echo $book_info['type_name']?>" name="type_name" />
			<input type="text" value="<?php echo $book_info['author']?>" name="author" />
			<input type=text name='publish_date' style="width:100px" value="<?php echo $book_info['publish_date']?>" onClick="WdatePicker({dateFmt: 'yyyy-MM-dd'});" />
			<input type="submit" />
		</form>
		
	</body>
</html>
