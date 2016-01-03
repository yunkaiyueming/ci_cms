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
						<li <?php if(preg_match($level2_menu['active_pattern'], $this->uri->uri_string())) echo 'class="active"'; ?>>
							<a href="<?php echo base_url($level2_menu['url']); ?>">
								<i class="icon-double-angle-right"></i><?php echo $level2_menu['desc']; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</li>
		<?php endforeach; ?>
	</ul>

	<div class="sidebar-collapse" id="sidebar-collapse">
		<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
	</div>
</div>






