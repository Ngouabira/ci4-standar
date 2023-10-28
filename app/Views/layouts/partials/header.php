
<div class="header">
		<div class="header-left">
		</div>

		<div class="header-right">

			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
						<span class="user-icon">
							<img src="" alt="">
						</span>
						<span class="user-name"><?=session()->get("email")?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="/profile"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="/logout"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>
