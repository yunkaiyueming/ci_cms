
<div class="panel-body" style="float:right;width:85%" id="book_infos">
	<div class="table-responsive">
		<!-- 约定：表格显示的项及次序靠$item_descs来控制 -->
		<table class="table table-bordered table-hover table-striped tablesorter">
			<?php foreach ($infos as $report_item): ?>
				<tbody>
					<tr>
						<td><?php echo $report_item['title'] ?></td>
						<td><a href="<?php echo $report_item['content_url']; ?>" target="_other">查看</a></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>







