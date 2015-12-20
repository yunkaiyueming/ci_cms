
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
			<?php foreach ($file_infos as $report_item): ?>
				<tbody>
					<tr>
						<td><?php echo $report_item[0] ?></td>
						<td><?php echo $report_item[1]; ?></td>
						<td><a href="<?php echo site_url("file/add"); ?>">添加</a>
							<a href="<?php echo site_url("file/delete_file_info?id=$report_item[id]"); ?>">删除</a>
							<a href="<?php echo site_url("file/update?id=$report_item[id]"); ?>">更新</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>