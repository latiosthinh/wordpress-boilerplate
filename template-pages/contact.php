<?php
/**
 * Template Name: Contact
 */
get_header();
?>

<section class="page-banner" style="background-image:url(<?= get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?>)">
	<div class="container">
		<h1 class="section-title"><?php the_title() ?></h1>

		<?php the_content( get_queried_object_id() ) ?>
	</div>
</section>

<section class="contact-form">
	<div class="container">
		<h2 class="title-tag title-tag--small">Contact us</h2>
		<div class="row">
			<div class="col-7">
				<img src="<?= NOVUS_IMG . '/map.jpg' ?>"">
			</div>

			<div class="col-5">
				<?php echo do_shortcode( '[contact-form-7 id="73" title="Home contact"]' ); ?>
			</div>
		</div>
	</div>
</section>

<?php
$download_id = get_page_by_path( 'download' )->ID;
$contact_id  = get_page_by_path( 'contact' )->ID;
?>
<section class="download">
	<div class="container">
		<div class="row">
			<div class="col-6">
				<h3 class="title-tag">Download</h3>
				<p>
					In the Roto media portal you will find all the 
					documentation on our products and services, for example:
				</p>

				<?php foreach ( rwmb_meta( 'download', null, $download_id ) as $dl ) : ?>
					<a href="<?= $dl[ 'url' ] ?>"><?= $dl[ 'label' ] ?></a>
				<?php endforeach; ?>
			</div>

			<div class="col-6">
				<h3 class="roto-btn">Find our partners</h3>
				
				<?php $partner_detail = rwmb_meta( 'partner_detail', null, $contact_id ); ?>

				<select id="partners">
					<option value=""><img src="<?= NOVUS_IMG . '/search.svg' ?>"> Search our customer</option>
				<?php foreach ( $partner_detail as $p ) : ?>
					<option value="<?= $p[ 'name' ] ?>"><?= $p[ 'name' ] ?></option>
				<?php endforeach; ?>
				</select>

				<?php foreach ( $partner_detail as $p ) : ?>
					<div class="partner-detail" data-partner="<?= $p[ 'name' ] ?>"><?= $p[ 'detail' ] ?></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="location">
	<div class="container">
		<h3 class="title-tag">How to find us</h3>
		<div class="row">
			<?php $location = rwmb_meta( 'location_detail', null, $contact_id ); ?>

			<div class="col-12 flags-wrapper">
				<div class="splide flags">
					<div class="splide__track">
						<div class="splide__list">
							<?php foreach ( $location as $l ) : ?>
							<a class="splide__slide <?= $l[ 'text_jq0z4bwg1fa' ] == "Asia-Pacific" ? 'active' : '' ?>" data-location="<?= $l[ 'text_jq0z4bwg1fa' ] ?>">
								<img style="width:40px;height:26px" src="<?= wp_get_attachment_url( $l[ 'flag' ] ) ?>">
							</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<?php foreach ( $location as $l ) : ?>
					<div class="flag-location <?= $l[ 'text_jq0z4bwg1fa' ] == "Asia-Pacific" ? 'active' : '' ?>"
						data-location="<?= $l[ 'text_jq0z4bwg1fa' ] ?>">
						<img style="width:40px;height:26px" src="<?= wp_get_attachment_url( $l[ 'flag' ] ) ?>">
						<?= $l[ 'wysiwyg_e1iqlmz4gsu' ] ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();