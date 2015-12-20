
<div class="panel-body" style="float:right;width:85%">
	<div class="table-responsive">
		<h2>添加用户</h2>
		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('user/add_user_info') ?>">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 用户名 </label>
				<div class="col-sm-9">
					<input type="text" name="user_name" placeholder="Username" class="col-xs-10 col-sm-5" value="" />
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 密码 </label>
				<div class="col-sm-9">
					<input type="text" name="pwd" placeholder="Password" class="col-xs-10 col-sm-5" value=""/>
				</div>
			</div>

			<div class="space-4"></div>

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<input class="btn btn-info" type="submit" value="Submit"/>
				</div></div>
		</form>

	</div></div>

