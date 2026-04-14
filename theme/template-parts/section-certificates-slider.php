<?php
$certificates = get_field('certificates');

if ( ! $certificates || empty( $certificates ) ) return;
?>

<section class="cert-slider" data-animate="fade-in-up">
    <div class="xl:container mx-auto max-xl:px-4 pb-6">
        <h2>Certificeringen</h2>
        <p>Bekijk onze certificeringen hier:</p>
    </div>
    <div class="cert-slider__inner max-xl:px-4">
        
        <!-- ── Linker kolom: afbeelding/logo ── -->
        <div class="cert-slider__visual" aria-hidden="true">
            <?php foreach ( $certificates as $index => $cert ) :
                $img   = $cert['certificate_image'] ?? null;
                $label = $cert['certificate_label'] ?? '';
            ?>
                <div
                    class="cert-slider__image <?= $index === 0 ? 'is-active' : '' ?>"
                    data-cert-slide="<?= $index ?>"
                >
                    <?php if ( $img ) : ?>
                        <img
                            src="<?= esc_url( $img['url'] ) ?>"
                            alt="<?= esc_attr( $img['alt'] ?: $label ) ?>"
                            width="<?= esc_attr( $img['width'] ) ?>"
                            height="<?= esc_attr( $img['height'] ) ?>"
                            loading="lazy"
                        />
                    <?php else : ?>
                        <!-- Geen afbeelding beschikbaar: toon label als fallback -->
                        <div class="cert-slider__image-fallback">
                            <span><?= esc_html( $label ) ?></span>
                        </div>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>
        </div>

        <!-- ── Rechter kolom: tekst + navigatie ── -->
        <div class="cert-slider__content">

            <!-- Teksten (één tegelijk zichtbaar) -->
            <div class="cert-slider__texts">
                <?php foreach ( $certificates as $index => $cert ) :
                    $label = $cert['certificate_label']       ?? '';
                    $title = $cert['certificate_title']       ?? '';
                    $desc  = $cert['certificate_description'] ?? '';
                ?>
                    <div
                        class="cert-slider__text <?= $index === 0 ? 'is-active' : '' ?>"
                        data-cert-slide="<?= $index ?>"
                        aria-hidden="<?= $index === 0 ? 'false' : 'true' ?>"
                    >
                        <?php if ( $label ) : ?>
                            <span class="cert-slider__label"><?= esc_html( $label ) ?></span>
                        <?php endif; ?>

                        <?php if ( $title ) : ?>
                            <h3 class="cert-slider__title"><?= esc_html( $title ) ?></h3>
                        <?php endif; ?>

                        <?php if ( $desc ) : ?>
                            <div class="cert-slider__desc"><?= wp_kses_post( $desc ) ?></div>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>
            </div>

            <!-- Navigatie: vorige / stippen / volgende -->
            <nav class="cert-slider__nav" aria-label="Certificaten navigatie">

                <button
                    class="cert-slider__btn cert-slider__btn--prev"
                    type="button"
                    aria-label="Vorig certificaat"
                >
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5"
                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </button>

                <div class="cert-slider__dots" role="tablist">
                    <?php foreach ( $certificates as $index => $cert ) :
                        $label = $cert['certificate_label'] ?? ( $index + 1 );
                    ?>
                        <button
                            class="cert-slider__dot <?= $index === 0 ? 'is-active' : '' ?>"
                            type="button"
                            role="tab"
                            aria-selected="<?= $index === 0 ? 'true' : 'false' ?>"
                            aria-label="<?= esc_attr( $label ) ?>"
                            data-cert-target="<?= $index ?>"
                        ></button>
                    <?php endforeach; ?>
                </div>

                <button
                    class="cert-slider__btn cert-slider__btn--next"
                    type="button"
                    aria-label="Volgend certificaat"
                >
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5"
                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </button>

            </nav>

        </div><!-- /.cert-slider__content -->

    </div><!-- /.cert-slider__inner -->
</section>