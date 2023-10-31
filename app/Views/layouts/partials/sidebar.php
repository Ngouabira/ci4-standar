<div class="left-side-bar">
	<div class="brand-logo">
		<a href="/">
			<img src="/assets/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
			<img src="/assets/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
		</a>
		<div class="close-sidebar" data-toggle="left-sidebar-close">
			<i class="ion-close-round"></i>
		</div>
	</div>
	<div class="menu-block customscroll mCustomScrollbar _mCS_3">
		<div id="mCSB_3" class="mCustomScrollBox mCS-dark-2 mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">
			<div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
				<div class="sidebar-menu icon-style-1 icon-list-style-1">
					<ul id="accordion-menu">
						<li class="dropdown <?=service('request')->uri->getSegment(1) == 'admin' ? 'show' : ''?>">
							<a href="javascript:;" class="dropdown-toggle" data-option="on">
								<span class="micon dw dw-user-1"></span><span class="mtext"><?=translate('base.admin')?></span>
							</a>
							<ul class="submenu" style="display: <?=service('request')->uri->getSegment(1) == 'admin' ? 'block' : 'none'?>;">
								<li><a href="/admin/user" class="<?=service('request')->uri->getSegment(2) == 'user' ? 'active' : ''?>"><?=translate('base.user')?></a></li>
								<li><a href="/admin/role" class="<?=service('request')->uri->getSegment(2) == 'role' ? 'active' : ''?>"><?=translate('base.role')?></a></li>
								<li><a href="/admin/permission" class="<?=service('request')->uri->getSegment(2) == 'permission' ? 'active' : ''?>"><?=translate('base.permission')?></a></li>
							</ul>
						</li>

					</ul>
				</div>
			</div>
			<div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-dark-2 mCSB_scrollTools_vertical mCSB_scrollTools_onDrag_expand" style="display: block;">
				<div class="mCSB_draggerContainer">
					<div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 142px; max-height: 397px; top: 0px;">
						<div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
					</div>
					<div class="mCSB_draggerRail"></div>
				</div>
			</div>
		</div>
	</div>
</div>