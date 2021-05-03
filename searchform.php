<div class="search-wrapper">
	<form role="search" method="get" class="search-form" action="<?= site_url('/'); ?>">
		<input type="search" class="search-field" placeholder="Search" value="" name="s">
		<input type="hidden" name="post_type" value="post" />
		<button type="submit" class="search-submit">
			<img src="<?= NOVUS_IMG . '/search.svg' ?>">
		</button>
	</form>
	
	<div id="search-result"></div>
</div>