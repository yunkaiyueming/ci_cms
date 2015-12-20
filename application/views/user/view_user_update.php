<div class="sidebar" id="sidebar">
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'fixed');
		} catch (e) {
		}
	</script>
	<ul class="nav nav-list">
		<?php foreach ($menus as $menu): ?>
			<li class="active open">
				<a href="#" class="dropdown-toggle">
					<i class='icon-dashboard'></i>
					<span class="menu-text"><?php echo $menu['desc']; ?></span>
					<b class="arrow icon-angle-down"></b>
				</a>
				<ul class="submenu">
					<?php foreach ($menu['level2_menus'] as $level2_menu): ?>
						<li <?php if (preg_match($level2_menu['active_pattern'], $this->uri->uri_string())) echo 'class="active"'; ?>>
							<a href="<?php echo base_url($level2_menu['url']); ?>">
								<i class="icon-double-angle-right"></i><?php echo $level2_menu['desc']; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</li>
		<?php endforeach; ?>
	</ul>

</div>
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



















