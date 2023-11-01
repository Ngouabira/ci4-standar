<div class="header">
	<div class="header-left">
		<div class="menu-icon dw dw-menu"></div>
	</div>

	<div class="user-notification">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">

				<i style="font-size: 24px;  vertical-align: text-bottom;" class="icon-copy fi-web dw-notification"></i>

					<span class=""><?=translate('base.' . session()->get("country")) ?? translate('base.french')?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="/translate/fr"><?=translate('base.french')?></a>
					<a class="dropdown-item" href="/translate/en"><?=translate('base.english')?></a>
				</div>
			</div>
	</div>

		<div class="user-info-dropdown">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
					<span class="user-icon">
						<img src="/uploads/<?=authUser()['image']?>" alt="">
					</span>
					<span class="user-name"><?=authUser()['name']?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="/profile"><i class="dw dw-user1"></i> <?=translate('base.profile')?></a>
					<a class="dropdown-item" href="/logout"><i class="dw dw-logout"></i> <?=translate('base.logout')?></a>
				</div>
			</div>
		</div>
	</div>
</div>