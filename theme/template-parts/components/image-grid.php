<?php
$grids = get_field('image_grid');
if ($grids) {
    echo '<section class="image-columns">';
    foreach ($grids as $grid) {
        $style = !empty($grid['background']) ? ' style="background-image: url(\'' . esc_url($grid['background']['sizes']['large']) . '\');"' : '';
        echo '<div' . $style . '>';

        if (!empty($grid['blocks'])) {
            foreach ($grid['blocks'] as $block) {
                $block_style = ($block['type'] === 'image' && !empty($block['image'])) ? ' style="background-image: url(\'' . esc_url($block['image']['sizes']['large']) . '\');"' : '';
                echo '<div class="' . esc_attr($block['type']) . '"' . $block_style . '>';
                if ($block['type'] !== 'image') {
                    if (!empty($block['subtitle'])) echo '<p>' . esc_html($block['subtitle']) . '</p>';
                    if (!empty($block['title'])) echo '<h2>' . esc_html($block['title']) . '</h2>';
                    if (!empty($block['text'])) echo '<p>' . esc_html($block['text']) . '</p>';
                }
                echo '</div>';
            }
        }

        echo '</div>';
    }
    echo '</section>';
}
?>
