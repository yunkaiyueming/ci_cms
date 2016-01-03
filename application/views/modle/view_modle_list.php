
Date: <input type='text' name='date' style="width:100px" value="<?php echo isset($date)?$date:date("Y-m-d"); ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd'});" readonly="readonly" />
<div class="panel-body" style="float:right;width:85%">
	<div class="table-responsive">
		<!-- 约定：表格显示的项及次序靠$item_descs来控制 -->
		<table class="table table-bordered table-hover table-striped tablesorter">
			<thead>
				<tr>
					<?php foreach ($item_descs as $item_desc): ?>
						<th><?php echo $item_desc; ?></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<?php foreach ($user_infos as $report_item): ?>
				<tbody>
					<tr>
						<td><?php echo $report_item['id'] ?></td>
						<td><?php echo $report_item['modle_name']; ?></td>
						<td><?php echo $report_item['modle_desc']; ?></td>
						<td><a href="<?php echo site_url("models/add"); ?>">添加</a>
							<a href="<?php echo site_url("models/delete_model_info?id=$report_item[id]"); ?>">删除</a>
							<a href="<?php echo site_url("models/update?id=$report_item[id]"); ?>">更新</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
