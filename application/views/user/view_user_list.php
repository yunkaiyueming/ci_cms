<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>
	
	</head>
	<body>
		
		<table border="1px">
	    <tr>
			<td>id</td>
			<td>user_name</td>
			<td>pwd</td>
			<td>添加</td>
			<td>删除</td>
			<td>更新</td>
		</tr>
		<?php
       // echo base_url("user/add");
		//echo site_url("user/add");
		//print_r($user_infos);
	    foreach ($user_infos as $key=>$values)
		{
		   echo '<tr><td>'.$values['id'].'</td><td>'.$values['user_name'].'</td><td>'.$values['pwd'].
				   '</td><td><a href="'.base_url("user/add").'"/>添加</td>'
				   . '<td><a href="'.base_url("user/delete_user_info").'?id='.$values['id'].'"/>删除</td>'
				   . '<td><a href="'.  base_url("user/update").'?id='.$values['id'].'">更新</td></tr>';
		}
		?>
		</table>
	</body>
</html>
