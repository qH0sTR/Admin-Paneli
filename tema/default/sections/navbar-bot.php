<footer> 
		<div class="footer"> 
			<nav> 
				<ul> 
					<li><a href="/">Anasayfa</a></li>
					<?php menu_alt();  ?>
					<li><a href="/iletisim">iletisim</a></li>
				</ul>
			</nav>

			<div style="clear:both;"></div>
				<hr />
				<p> 
					<?= $iletisim["iletisim_adres"]; ?>
				</p>
				<hr />
			</div>
			<div style="position: absolute; right: 0;" class="sosyal"> 
				<h2>Bizi Takip Edin</h2>
				<a class="btn btn-social-icon btn-facebook" target="_blank" href="<?= $row['iletisim_facebook']; ?>">
					<span class="fa fa-facebook"></span>
				</a>
				<a class="btn btn-social-icon btn-twitter" target="_blank" href="<?= $row['iletisim_twitter']; ?>">
					<span class="fa fa-twitter"></span>
				</a>
				<a class="btn btn-social-icon btn-instagram" target="_blank" href="<?= $row['iletisim_instagram']; ?>">
					<span class="fa fa-instagram"></span>
				</a>
			</div>
		</div>
	 </footer>