<?php
    // ACF Vars
    $team_content = get_field('content', 'option');
    $team_members = get_field('team', 'option'); 

?>
<section class="team-carousel" itemscope itemtype="https://schema.org/Organization" data-animate="fade-in-up">
    <div class="team-carousel__container">

        <?php if ($team_content): ?>
        <div class="team-carousel__intro" itemprop="description">
            <?php echo $team_content; ?>
        </div>
        <?php endif; ?>

        <?php if ($team_members): ?>
            <div class="team-carousel__wrapper">
                <div class="swiper team-swiper" data-autoplay="true">
                    <div class="swiper-wrapper">
                        <?php foreach ($team_members as $member): 
                            $image = $member['image'];
                            $name = $member['name'];
                            $role = $member['role'];
                        ?>
                        <div class="swiper-slide">
                            <article class="team-card card" itemprop="employee" itemscope itemtype="https://schema.org/Person" data-animate="fade-in-up">
                                <?php if ($image): ?>
                                    <div class="team-card__clip"></div>
                                    <figure class="team-card__image">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? $name); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>" loading="lazy" itemprop="image" />
                                    </figure>
                                <?php endif; ?>

                                <div class="team-card__content">
                                    <?php if ($name): ?>
                                        <h3 class="team-card__name" itemprop="name"><?php echo esc_html($name); ?></h3>
                                    <?php endif; ?>
                                    <?php if ($role): ?>
                                        <p class="team-card__role" itemprop="jobTitle"><?php echo esc_html($role); ?></p>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>