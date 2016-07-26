
<div class="panel-body" style="float:right;width:85%">
	<div class="table-responsive">
		<h2>给用户分配角色</h2>
		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('user/add_user_role') ?>">
			<?php foreach ($role_infos as $role_info) :?>
			<div class="form-group">
				<div class="col-sm-9">
					<lable>
						<input type="hidden" value="<?php echo $_GET['id'];?>" name="userid">
						<input type="checkbox" value="<?php echo $role_info['id']; ?>" name="check_role[]"/>
					   <?php echo $role_info['desc']; ?>
					</lable>
				</div>
			</div>
			<div class="space-4"></div>
           <?php endforeach;?>

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<input class="btn btn-info" type="submit" value="Submit"/>
				</div></div>
		</form>

	</div></div>
<script>
	$(function(){
		var role_ids="<?php echo $user_str_has_role;?>";
		role_id=role_ids.split('#');
	    for(var i=0;i< role_id.length-1;i++){
			$("input[type=checkbox][name='check_role[]'][value='" + role_id[i] + "']").attr("checked", true); 
		}
	})
	
</script>




