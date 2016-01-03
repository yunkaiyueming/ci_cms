
<div class="panel-body" style="float:right;width:85%">
	<div class="table-responsive">
		<h2>给用户分配权限</h2>
		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('Functions/add_function_role_modle') ?>">
			<div class="form-group">
				<div class="col-sm-9">
					<lable>角色</lable>
					<div class="space-4"></div>
					<select id="select_role" name="select_role">
			<?php foreach ($role_infos as $role_info) :?>
						<option value="<?php echo $role_info['id'] ;?>"><?php echo $role_info['desc']?></option>	
		    <?php endforeach;?>	   
					</select>
				</div>
			</div>
			<div class="space-4"></div>
           
			
			<div class="form-group">
				<div class="col-sm-9">
					<lable>模块</lable>
					<div class="space-4"></div>
			<?php foreach ($modle_infos as $modle_info) :
				  ?>
					<label>	<input type="checkbox" name="checkbox_modle[]" value="<?php echo $modle_info['id'];?>" 
								   <?php echo in_array($modle_info['id'], $sys_modles)?'checked':'' ?>>
						<?php echo $modle_info['modle_name'];?>
					</label>
					<div class="space-4"></div>
		    <?php endforeach;?>	   
					
				</div>
			</div>
			<div class="space-4"></div>

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<input class="btn btn-info" type="submit" value="Submit"/>
				</div></div>
		</form>

	</div></div>




