
<div>
	<select id="book_type" > <?php foreach ($book_type as $book_type_item): ?>
			<option value="<?php echo $book_type_item ?>"><?php echo $book_type_item ?></option>
		<?php endforeach; ?>
	</select>
</div>

<div class="panel-body" style="float:right;width:85%" id="book_infos">
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
			<?php foreach ($book_infos as $report_item): ?>
				<tbody>
					<tr>
						<td><?php echo $report_item['id'] ?></td>
						<td><?php echo $report_item['book_name']; ?></td>
						<td><?php echo $report_item['type_name']; ?></td>
						<td><?php echo $report_item['author']; ?></td>
						<td><?php echo $report_item['publish_date']; ?></td>
						<td><a href="<?php echo site_url("book/add"); ?>">添加</a>
							<a href="<?php echo site_url("book/delete_book_info?id=$report_item[id]"); ?>">删除</a>
							<a href="<?php echo site_url("book/update?id=$report_item[id]"); ?>">更新</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(function() {
		$("#book_type").change(function() {
			var book_type_val = $("#book_type").val();
			$.post("<?php echo site_url('book/ajax_get_book_by_type') ?>", {"book_type": book_type_val}, function(data) {
				var js_json_obj = JSON.parse(data);
				var item_descs = js_json_obj['item_descs'];
				var book_infos = js_json_obj['book_infos'];
				//alert(book_infos);
				var table_str = "<div class=\"table-responsive\">";
				table_str += "<table class=\"table table-bordered table-hover table-striped tablesorter\">";
				table_str += "<thead>";
				table_str += "<tr>";
				for (var j = 0; j < item_descs.length; j++) {
					table_str += "<th>" + item_descs[j] + "</th>";
				}

				table_str += "</tr>";
				for (var i = 0; i < book_infos.length; i++) {
					table_str += "<tr>" +
							"<td>" + book_infos[i].id + "</td>" +
							"<td>" + book_infos[i].book_name + "</td>" +
							"<td>" + book_infos[i].type_name + "</td>" +
							"<td>" + book_infos[i].author + "</td>" +
							"<td>" + book_infos[i].publish_date + "</td>" +
							"<td><a href='<?php echo site_url("book/add"); ?>'>添加</a>" +
							"<a href='<?php echo site_url("book/delete_book_info?id=$report_item[id]"); ?>'>删除</a>" +
							"<a href='<?php echo site_url("book/update?id=$report_item[id]"); ?>'>更新</a>" +
							"</td>" +
							"</tr>";
				}
				table_str += "</tbody></table></div>";

				$("#book_infos").html(table_str);
			});
		});
	});
</script>
