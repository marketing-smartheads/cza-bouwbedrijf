
<section class="content" itemscope itemtype="https://schema.org/LocalBusiness">
    <?php
        $footer = get_field('footer', 'option');
        $content = get_field('content'); 

        $phone = $footer['phone'] ?? '';
        $email = $footer['email'] ?? '';
        $address = $footer['address'] ?? '';
        $site_name = get_bloginfo('name');
        $site_description = get_bloginfo('description');

        $lead_content = $content['lead_content'] ?? '';
        $sequel_content = $content['sequel__content'] ?? '';
     ?>

    <meta itemprop="name" content="<?= esc_attr($site_name); ?>" />
    <meta itemprop="telephone" content="<?= esc_attr($phone); ?>" />
    <meta itemprop="email" content="<?= esc_attr($email); ?>" />
    <meta itemprop="address" content="<?= esc_attr($address); ?>" />
    <meta itemprop="areaServed" content="Brabant" />
    <meta itemprop="description" content="<?= esc_attr($site_description); ?>" />

    <div class="content__container">
        <?php if ($lead_content) : ?>
        <div class="content__lead" data-animate="fade-in-up" data-delay="100">
            <?= wp_kses_post($lead_content); ?>
        </div>
        <?php endif; ?>

        <?php if ($sequel_content) : ?>
        <div class="content__sequel"  data-animate="fade-in-up" data-delay="900">
            <?= wp_kses_post($sequel_content); ?>
        </div>
        <?php endif; ?>
    </div>
</section>