<?php
$hero  = get_field('hero', 14);
$video = $hero['video'] ?? null;

if (!$video || empty($video['url'])) {
    return;
}
?>

<div class="hero__video-wrapper hero__video-wrapper--custom">
    <div class="hero__video-loader"></div>

    <video class="hero__video"
        autoplay
        muted
        loop
        playsinline
        webkit-playsinline
        preload="auto"
        aria-hidden="true">
        <source src="<?= esc_url($video['url']) ?>" type="video/mp4">
    </video>
</div>
