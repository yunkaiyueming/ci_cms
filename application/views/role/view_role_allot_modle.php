
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
					
					<lable>全选</lable>
					<input type="checkbox" id="input_select_all" > 
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
<script>
	$(function() {
           $("#input_select_all").click(function() {
                $('input[name="checkbox_modle[]"]').prop("checked",this.checked);
            });
            var $subBox = $("input[name='checkbox_modle[]']");
            $subBox.click(function(){
                $("#input_select_all").prop("checked",$subBox.length == $("input[name='checkbox_modle[]']:checked").length ? true : false);
            });
			$("#input_select_all").prop("checked",$subBox.length == $("input[name='checkbox_modle[]']:checked").length ? true : false);
        });
		
	//ajax请求，异步获取角色的权限
	$(function(){
		$("#select_role").change(function(){
			var roleid_var=$("#select_role").val();
			$.post("<?php echo site_url('Role/get_modle_by_roleid')?>",{"roleid": roleid_var},
			function(data){
			    //data:{"modle_infos":[{"mode_ids":"1;2;3;4;"}]}
				var fun_json_obj=JSON.parse(data);
				var modle_ids=fun_json_obj.modle_infos[0].mode_ids;
				modle_id=[];
				modle_id=modle_ids.split(';');
				
				$("input[type=checkbox][name='checkbox_modle[]']").prop("checked", false);
				for(var i=0;i<modle_id.length;i++){
					 $("input[type=checkbox][name='checkbox_modle[]'][value='" + modle_id[i] + "']").prop("checked", true);  
				}
				if((modle_id.length-1)==$("input[name='checkbox_modle[]']").length){
					$("#input_select_all").prop("checked", true);
				}
				else{
					$("#input_select_all").prop("checked", false);
				}
				
			});
		});
	});
</script>




