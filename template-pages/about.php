<?php
/**
 * Template name: About
 */
get_header();
?>

<section class="about-banner" style="background-image:url(<?= get_the_post_thumbnail_url( get_queried_object_id(), 'full' ) ?>)">
	<div class="container">
		<h1><?php the_title() ?></h1>
		<?php the_content() ?>


		<?= rwmb_meta( 'intro_text' ) ?>
	</div>
</section>

<section class="about-content">
	<div class="container">
		<h2 class="wow fadeInUp">Roto Frank <span class="light">Asia Pacific</span></h2>

		<div class="row">
			<div class="col-6 col-left">
				<?= rwmb_meta( 'left_content' ) ?>

				<div class="splide about-slider">
					
					<div class="splide__track">
						<div class="splide__list">
							<?php foreach ( rwmb_meta( 'slider' ) as $img ) : ?>
								<img class="splide__slide" src="<?= $img[ 'full_url' ] ?>">
							<?php endforeach; ?>
						</div>
					</div>
					<div class="splide__arrows">
						<button class="splide__arrow splide__arrow--prev">
							<img src="<?= NOVUS_IMG . '/small-arrow-prev.svg' ?>" alt="">
						</button>
						<button class="splide__arrow splide__arrow--next">
							<img src="<?= NOVUS_IMG . '/small-arrow.svg' ?>" alt="">
						</button>
					</div>
				</div>
			</div>

			<div class="col-6 col-right">
				<div class="float-img" style="background-image:url(<?= rwmb_meta( 'right_image' )[ 'full_url' ] ?>)"></div>

				<div class="accordions">
					<?php
					$tabs = rwmb_meta( 'group' );

					foreach ( $tabs as $p ) :
					?>
						<button class="control">
							<img src="<?= NOVUS_IMG . '/arrow.svg' ?>">
							<?= $p[ 'label' ] ?>
						</button>
						<div class="panel"><?= $p[ 'text' ] ?></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="about-number">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="item wow fadeInUp">
					<h3>10</h3>
					<h4>Years warranty</h4>
				</div>
			</div>

			<div class="col-6">
				<div class="item wow fadeInUp">
					<h3>18</h3>
					<h4>Production sites</h4>
				</div>
			</div>
			<div class="col-6">
				<div class="item wow fadeInUp">
					<h3>41</h3>
					<h4>Sales subsidiaries</h4>
				</div>
			</div>
			<div class="col-6">
				<div class="item wow fadeInUp">
					<h3>28</h3>
					<h4>Logistics and distribution centers</h4>
				</div>
			</div>
			<div class="col-6">
				<div class="item wow fadeInUp">
					<h3>3500</h3>
					<h4>Patents</h4>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();