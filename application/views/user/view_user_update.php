
<div class="panel-body" style="float:right;width:85%">
	<div class="table-responsive">
		<h2>修改用户信息</h2>
		<form class="form-horizontal" role="form" method="post" action="<?php echo  base_url("user/update_user_info")?>">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 用户ID </label>
				<div class="col-sm-9">
					<input type="text" name="id"  class="col-xs-10 col-sm-5" value="<?php echo $user_info['id']?>" />
				</div>
			</div>

			<div class="space-4"></div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 用户名 </label>
				<div class="col-sm-9">
					<input type="text" name="user_name"  class="col-xs-10 col-sm-5" value="<?php echo $user_info['user_name']?>" />
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 密码 </label>
				<div class="col-sm-9">
					<input type="text" name="pwd"  class="col-xs-10 col-sm-5" value="<?php echo $user_info['pwd']?>"/>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<input class="btn btn-info" type="submit" value="Submit"/>
				</div></div>
		</form>

	</div></div>



















