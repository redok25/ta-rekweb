<div class="close-all">
	<div id="loader" class="center"></div>
</div>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="" style="margin-left: 1em">
				<!-- SIG Kota Yogyakarta -->
				<img src="image/new-logo.png" height="36">
			</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php" class="hvr-underline-reveal">Beranda</a></li>
				<li><a href="indonesia-map.php" class="hvr-underline-reveal">Peta Indonesia</a></li>
				<?php if (isset($_SESSION['user'])): ?>
					<li>
						<a data-toggle="modal" href='#modal-pw'>
	                         Ubah Password
	                    </a>	
					</li>
				<?php endif ?>
				<li>
                    <?php if (isset($_SESSION['user'])): ?>
                    <a data-toggle="modal" onclick="return konfirm('Yakin ingin logout?', 'php-native/logic.php?logout=true')" class="hvr-rotate">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                    <?php else: ?>
                    <a data-toggle="modal" href='#modal-login' class="hvr-rotate">
                        <i class="fa fa-sign-in"></i> Login
                    </a>	
                    <?php endif ?>
                </li>
			</ul>
		</div>
	</div>
</nav>