<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CZA_Bouwbedrijf
 */

// Theme vars
$site_name     = get_bloginfo('name');
$site_url      = get_site_url();
$logo_url      = get_theme_file_uri('/assets/img/Logo.svg');

// ACF Vars
$site_header = get_field('site_header', 'option');
$phone       = $site_header['phone'] ?? '';
$email       = $site_header['email'] ?? '';
$social_links = [];

	if (!empty($site_header['social_media'])) {
		foreach ($site_header['social_media'] as $item) {
			$url = $item['url'] ?? '';
			if (filter_var($url, FILTER_VALIDATE_URL)) {
				$social_links[] = esc_url($url);
			}
		}
	}
?>

<?php if (!empty($site_name) || !empty($social_links) || !empty($phone) || !empty($email)) : ?>
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Organization",
		"name": "<?php echo esc_js($site_name); ?>",
		"url": "<?php echo esc_url($site_url); ?>",
		"logo": "<?php echo esc_url($logo_url); ?>",
		<?php if ($phone) : ?>
		"telephone": "<?php echo esc_js($phone); ?>",
		<?php endif; ?>
		<?php if ($email) : ?>
		"email": "<?php echo esc_js($email); ?>",
		<?php endif; ?>
		<?php if (!empty($social_links)) : ?>
		"sameAs": <?php echo json_encode($social_links, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
		<?php endif; ?>
	}
	</script>
<?php endif; ?>

<header id="masthead" class="site-header" itemscope itemtype="https://schema.org/Organization">
    <div class="site-header__upper">
		<div class="upper">
			<!-- Social Media -->
			<?php if (!empty($site_header['social_media'])) : ?>
				<ul class="site-header__social-list">
					<?php foreach ($site_header['social_media'] as $item) :
						$icon = $item['icon'] ?? '';
						$url  = $item['url'] ?? '';

						if ($icon && $url) :
							$icon_url = filter_var($icon, FILTER_VALIDATE_URL) ? $icon : '';
							$icon_alt = 'Social icon';
					?>
						<li class="site-header__social-item">
							<a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="site-header__social-link">
								<img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>" loading="lazy" width="24" height="24" class="site-header__social-icon">
							</a>
						</li>
					<?php endif; endforeach; ?>
				</ul>
			<?php endif; ?>

			<!-- Contact Info -->
			<div class="site-header__contact">
				<?php if ($phone) : ?>
					<a href="tel:<?php echo esc_attr($phone); ?>" class="site-header__contact-item site-header__contact-item--phone" itemprop="telephone">
						<span class="phone-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
								<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
							</svg>
						</span>
						<span class="phone-label"><?php echo esc_html($phone); ?></span>
					</a>
				<?php endif; ?>

				<?php if ($email) : ?>
					<a href="mailto:<?php echo esc_attr($email); ?>" class="site-header__contact-item site-header__contact-item--email" itemprop="email">
						<span class="email-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
								<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
							</svg>
						</span>
						<span class="email-label"><?php echo esc_html($email); ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
        
    </div>
	<div class="site-header__inner">		
        <!-- Logo -->	
        <a href="<?php echo esc_url($site_url); ?>" title="<?php echo esc_attr($site_name); ?>" class="site-header__logo" itemprop="url">
            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($site_name); ?>" width="324" height="165" loading="lazy" itemprop="logo" class="site-header__logo-image">
        </a>
		<div class="site-header__tools">
			<!-- Menu -->
			<nav id="main-navigation" class="main-nav" role="navigation" aria-label="Hoofdmenu">
				<ul class="menu">
					<?php
						wp_nav_menu([
							'menu'        => 3,
							'container'   => false,
							'items_wrap'  => '%3$s', // Verwijdert extra <ul> zodat je eigen <ul> intact blijft
							'fallback_cb' => false
						]);
						?>

						<li class="menu-item menu-item--mobile-only">
							<a href="<?php echo get_site_url(); ?>/offerte-contact" class="menu-link">Vraag offerte aan</a>
						</li>
					</ul>
			</nav>
			<div class="tham tham-e-squeeze tham-w-6">
				<div class="tham-box">
					<div class="tham-inner"></div>
				</div>
			</div>

			<a href="<?php echo esc_url($site_url); ?>/offerte-contact" class="button button--secondary btn--quote group">
				<span class="button-icon">
					<svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M13.77 11.768L11.8884 9.83199C11.8161 9.75701 11.7301 9.69749 11.6354 9.65688C11.5406 9.61626 11.439 9.59535 11.3363 9.59535C11.2337 9.59535 11.1321 9.61626 11.0373 9.65688C10.9426 9.69749 10.8566 9.75701 10.7843 9.83199L8.00076 12.696C7.92869 12.7707 7.87168 12.8594 7.83299 12.9569C7.7943 13.0543 7.77468 13.1587 7.77527 13.264V15.2C7.77527 15.4122 7.85719 15.6156 8.00301 15.7657C8.14882 15.9157 8.34659 16 8.5528 16H10.4344C10.5367 16.0006 10.6382 15.9804 10.7329 15.9406C10.8276 15.9008 10.9138 15.8421 10.9865 15.768L13.77 12.904C13.8429 12.8296 13.9007 12.7411 13.9402 12.6437C13.9797 12.5462 14 12.4416 14 12.336C14 12.2304 13.9797 12.1258 13.9402 12.0283C13.9007 11.9308 13.8429 11.8424 13.77 11.768ZM10.1079 14.4H9.33033V13.6L11.3363 11.536L12.1139 12.336L10.1079 14.4ZM5.44269 14.4H2.33258C2.12637 14.4 1.9286 14.3157 1.78279 14.1657C1.63697 14.0156 1.55505 13.8122 1.55505 13.6V2.4C1.55505 2.18782 1.63697 1.98434 1.78279 1.83431C1.9286 1.68428 2.12637 1.6 2.33258 1.6H6.22022V4C6.22022 4.63652 6.46597 5.24696 6.90342 5.69705C7.34086 6.14714 7.93416 6.39999 8.5528 6.39999H10.8854V7.19999C10.8854 7.41217 10.9673 7.61565 11.1131 7.76568C11.2589 7.91571 11.4567 7.99999 11.6629 7.99999C11.8691 7.99999 12.0669 7.91571 12.2127 7.76568C12.3585 7.61565 12.4404 7.41217 12.4404 7.19999V5.6C12.4404 5.6 12.4404 5.59999 12.4404 5.55199C12.4323 5.4785 12.4167 5.4061 12.3938 5.336V5.264C12.3564 5.18174 12.3065 5.10613 12.2461 5.04L7.58089 0.24C7.51662 0.177773 7.44313 0.126465 7.36318 0.0879998C7.33997 0.084608 7.31642 0.084608 7.29321 0.0879998L7.0444 0H2.33258C1.71394 0 1.12064 0.252856 0.683197 0.702943C0.245754 1.15303 0 1.76348 0 2.4V13.6C0 14.2365 0.245754 14.847 0.683197 15.297C1.12064 15.7471 1.71394 16 2.33258 16H5.44269C5.6489 16 5.84667 15.9157 5.99249 15.7657C6.1383 15.6156 6.22022 15.4122 6.22022 15.2C6.22022 14.9878 6.1383 14.7843 5.99249 14.6343C5.84667 14.4843 5.6489 14.4 5.44269 14.4ZM7.77527 2.728L9.78907 4.8H8.5528C8.34659 4.8 8.14882 4.71571 8.00301 4.56568C7.85719 4.41565 7.77527 4.21217 7.77527 4V2.728ZM3.88764 9.59999H8.5528C8.75901 9.59999 8.95678 9.51571 9.1026 9.36568C9.24841 9.21565 9.33033 9.01217 9.33033 8.79999C9.33033 8.58782 9.24841 8.38434 9.1026 8.23431C8.95678 8.08428 8.75901 7.99999 8.5528 7.99999H3.88764C3.68142 7.99999 3.48366 8.08428 3.33784 8.23431C3.19203 8.38434 3.11011 8.58782 3.11011 8.79999C3.11011 9.01217 3.19203 9.21565 3.33784 9.36568C3.48366 9.51571 3.68142 9.59999 3.88764 9.59999ZM3.88764 6.39999H4.66516C4.87138 6.39999 5.06914 6.31571 5.21496 6.16568C5.36077 6.01565 5.44269 5.81217 5.44269 5.6C5.44269 5.38782 5.36077 5.18434 5.21496 5.03431C5.06914 4.88428 4.87138 4.8 4.66516 4.8H3.88764C3.68142 4.8 3.48366 4.88428 3.33784 5.03431C3.19203 5.18434 3.11011 5.38782 3.11011 5.6C3.11011 5.81217 3.19203 6.01565 3.33784 6.16568C3.48366 6.31571 3.68142 6.39999 3.88764 6.39999ZM5.44269 11.2H3.88764C3.68142 11.2 3.48366 11.2843 3.33784 11.4343C3.19203 11.5843 3.11011 11.7878 3.11011 12C3.11011 12.2122 3.19203 12.4156 3.33784 12.5657C3.48366 12.7157 3.68142 12.8 3.88764 12.8H5.44269C5.6489 12.8 5.84667 12.7157 5.99249 12.5657C6.1383 12.4156 6.22022 12.2122 6.22022 12C6.22022 11.7878 6.1383 11.5843 5.99249 11.4343C5.84667 11.2843 5.6489 11.2 5.44269 11.2Z" fill="#1B1B1B" />
					</svg>
				</span>
				<span class="button-label">Vraag offerte aan</span>
			</a>
		</div>
	</div>
</header>
