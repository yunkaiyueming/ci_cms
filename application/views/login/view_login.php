<div class="main-container">
	<div class="main-content">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-1">
				<div class="login-container">
					<div class="space-6"></div>
					<div class="position-relative">
						<div id="login-box" class="login-box visible widget-box no-border">
							<div class="widget-body">
								<div class="widget-main">
									<h4 class="header blue lighter bigger">
										<i class="icon-legal green"></i>
										雷尚科技 • Rayjoy Hammer
									</h4>

									<div class="space-6"></div>
									<form action="<?php echo site_url('login/do_login')?>" method="post">
										<fieldset>
											<input type="hidden" name="action" value="login">
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="text" id="user_name" name="user_name" class="form-control" placeholder="用户名"/>
													<i class="icon-user"></i>
												</span>
											</label>

											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="password" name="pwd" class="form-control" placeholder="密码"/>
													<i class="icon-lock"></i>
												</span>
											</label>
											
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="text" id="check_code" name="check_code" class="form-control" placeholder="请输入验证码！"/>
													<input type="image" src="<?php echo base_url('Validate/create_validate_code')?>">
													<i class="icon-user"></i>
												</span>
											</label>
											
											<div id="msg"><?php if(isset($error)) {echo "<font color='red'>Failed: $error !!!</font>";} ?></div>
											<div class="clearfix">
												<button type="submit" class="width-100 btn btn-sm btn-primary">
													<i class="icon-key"></i>
													登录
												</button>
											</div>
											
											<div class="space"></div>
										</fieldset></form>
								</div>
							</div><!-- /widget-body -->
						</div><!-- /signup-box -->
					</div><!-- /position-relative -->
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div>
</div><!-- /.main-container -->

<script type="text/javascript">
	$(function() {
		$("#msg").mouseover(function(){
			$("#msg").fadeOut(1000);
		});
	});
</script>