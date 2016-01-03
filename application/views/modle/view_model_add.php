
<div class="panel-body" style="float:right;width:85%">
	<div class="table-responsive">
		<h2>添加模块信息</h2>
		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('Models/add_model_info') ?>">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 模块名称 </label>
				<div class="col-sm-9">
					<input type="text" name="model_name" placeholder="Modelname" class="col-xs-10 col-sm-5" value="" />
				</div>
			</div>

			<div class="space-4"></div>

			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 模块描述 </label>
				<div class="col-sm-9">
					<input type="text" name="model_desc" placeholder="ModelDescription" class="col-xs-10 col-sm-5" value=""/>
				</div>
			</div>

			<div class="space-4"></div>
			
			

			<div class="clearfix form-actions">
				<div class="col-md-offset-3 col-md-9">
					<input class="btn btn-info" type="submit" value="Submit"/>
				</div></div>
		</form>

	</div></div>

