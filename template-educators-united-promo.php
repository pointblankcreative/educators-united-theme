<?php
/**
 * Template Name: Educators United - Promo Page
 *
 * Custom promo landing page:
 *  - Full-bleed hero with background image
 *  - Headline / intro section
 *  - 3 clickable panels, each opening its own modal with more detail
 *
 * All copy on this page is wrapped with eu_promo_t() (see
 * inc/functions/eu_promo_translate_string.php), which registers each string
 * with WPML's String Translation module under the "educators-united-promo"
 * context. This is a safe no-op until WPML (with the String Translation
 * add-on) is installed and active — once it is, every string here becomes
 * translatable from WPML -> String Translation without further template
 * changes. The page's featured image / video URL still need real content
 * regardless of language.
 */

    $PageFieldPreface = "default_page_options-";
    $FormType = "";
    $StickAlertBool = "";
    $HasBanner = "NoBannerClass"; // we render our own hero below, skip the default banner

    // Browser tab title: campaign brand name, not the site's dev placeholder
    // title ("26026 Educators United – Public Awareness Campaign"). Must be
    // added before wp_head() runs (see get_template_part() call below), since
    // that's what outputs the <title> tag.
    add_filter( 'pre_get_document_title', function () {
        return 'Not A Game';
    } );

    // Social preview (Open Graph / Twitter Card) tags — read via $GLOBALS by
    // inc/headers/header-main.php (see the comment there for why).
    $GLOBALS['EU_SocialTitle']       = 'Not A Game';
    $GLOBALS['EU_SocialDescription'] = "Education is not a game. It's time the Ontario Government stopped treating it like one.";
    $GLOBALS['EU_SocialImageURL']    = get_template_directory_uri() . '/images/promo/ScrapeEN.png';
    $GLOBALS['EU_SocialLocale']      = 'en_CA';

    // NOTE: We intentionally don't include header.php here. This page has its
    // own custom hero (with its own logo badge/nav-free design) and doesn't
    // use the theme's default site header/nav bar. This mirrors the same
    // per-page approach already used for the footer below. Other pages are
    // unaffected — header.php itself is untouched.
    include get_stylesheet_directory() . '/inc/sections/scripts/section-header-footer-scripts.php';
    get_template_part( 'inc/headers/header', 'main' );
    ?>
    </head>
    <body id="BodyID" class="preload">
    <?php wp_body_open(); ?>
    <?php

    $PageTitle = get_the_title();

    // Hero background image: use the page featured image if one is set,
    // otherwise fall back to the curtain background asset.
    if ( has_post_thumbnail() ) {
        $HeroImageURL = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    } else {
        $HeroImageURL = get_template_directory_uri() . '/images/promo/VelvetCurtain.png';
    }

    // ACF-editable content lives on this page (post ID), with the original
    // hardcoded copy/images as a fallback via eu_promo_field() — see
    // acf-json/group_promo_page_content.json and fr-copy-mapping.md.
    $PostID = get_the_ID();

    $HeroHostCutoutURL = eu_promo_field( 'host_image', $PostID, get_template_directory_uri() . '/images/promo/host-en.png' );
?>
<main id="Main" class="PromoPage">

    <!-- ============ HERO ============ -->
    <section class="PromoHero" style="background-image: linear-gradient(180deg, rgba(20,10,20,0.1) 0%, rgba(20,10,20,0.35) 100%), url('<?php echo esc_url( $HeroImageURL ); ?>');">

        <img class="PromoHeroBadge" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/notagame-en-trimmed.png' ); ?>" alt="<?php echo esc_attr( eu_promo_t( 'Not a Game', 'hero-badge-alt' ) ); ?>">

        <?php
            // Hardcoded to the pasunjeu.ca vanity domain (not home_url()) on purpose: WPML's
            // domain-based language negotiation filters home_url() to whatever domain the
            // CURRENT request came in on, so a relative/home_url()-based link here would just
            // point back at notagame.ca itself instead of crossing over to the French domain.
            // See fr-copy-mapping.md for the language-toggle link history.
            $FrenchPageURL = 'https://pasunjeu.ca/';
        ?>
        <a href="<?php echo esc_url( $FrenchPageURL ); ?>" class="PromoHeroLangToggle" aria-label="<?php echo esc_attr( eu_promo_t( 'French', 'hero-lang-toggle-aria' ) ); ?>">FR</a>

        <div class="container">
            <img class="PromoHeroHost" src="<?php echo esc_url( $HeroHostCutoutURL ); ?>" alt="<?php echo esc_attr( eu_promo_t( 'A game show host in a plaid suit, pointing at the viewer.', 'hero-host-alt' ) ); ?>">

            <div class="PromoHeroContent">
                <h1 class="PromoHeroTitle"><?php echo eu_promo_t( 'Are you<br class="PromoHeroTitleBreak--desktop"> smarter<br class="PromoHeroTitleBreak--mobile"> than<br class="PromoHeroTitleBreak--desktop"> the Ontario<br>Government?', 'hero-h1' ); ?></h1>
            </div>
        </div>

        <div class="PromoHeroDots" aria-hidden="true">
            <?php
                // Render more dots than any browser width could need at a fixed
                // size + gap (see .PromoHeroDots in SCSS); CSS overflow:hidden
                // clips the extras, so the visible count grows/shrinks with the
                // viewport instead of being a fixed number.
                for ( $i = 0; $i < 200; $i++ ) :
            ?>
                <span class="PromoHeroDot PromoHeroDot<?php echo esc_attr( ( $i % 3 ) + 1 ); ?>"></span>
            <?php endfor; ?>
        </div>
    </section>

    <!-- ============ TRUE OR FALSE CARDS ============ -->
    <section id="WhyItMatters" class="PromoQuiz">
        <div class="container">
            <div class="PromoQuizIntro">
                <p class="PromoQuizIntroText">
                <?php echo esc_html( eu_promo_field( 'quiz_intro_text', $PostID, "When it comes to publicly funded education, Ontario's government has the answers all wrong. Think you can do any better? Now’s your chance to find out." ) ); ?>
                </p>
                <img class="PromoQuizSparkleBg" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/StarburstOnBlack.png' ); ?>" alt="" aria-hidden="true">
            </div>

            <div class="PromoQuizGrid">

                <?php
                    $QuizLabelImgURL   = eu_promo_field( 'quiz_label_image', $PostID, get_template_directory_uri() . '/images/promo/TrueOrFalse.png' );
                    $TilePurpleImgURL  = eu_promo_field( 'tile_purple_image', $PostID, get_template_directory_uri() . '/images/promo/PurpleTile_Long.png' );
                    $TileRustImgURL    = eu_promo_field( 'tile_rust_image', $PostID, get_template_directory_uri() . '/images/promo/RedTile_Long.png' );
                    $TileTealImgURL    = eu_promo_field( 'tile_teal_image', $PostID, get_template_directory_uri() . '/images/promo/TealTile_Long.png' );
                ?>

                <button type="button" class="PromoQuizCard PromoQuizCardPurple" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz1" aria-haspopup="dialog" style="background-image: url('<?php echo esc_url( $TilePurpleImgURL ); ?>');">
                    <img class="PromoQuizCardLabelImg" src="<?php echo esc_url( $QuizLabelImgURL ); ?>" alt="<?php echo esc_attr( eu_promo_t( 'True or False', 'quiz-label-true-or-false-alt' ) ); ?>">
                    <span class="PromoQuizCardStatement"><?php echo esc_html( eu_promo_field( 'quiz_card_1_statement', $PostID, 'Educators are in it for themselves.' ) ); ?></span>
                </button>

                <button type="button" class="PromoQuizCard PromoQuizCardRust" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz2" aria-haspopup="dialog" style="background-image: url('<?php echo esc_url( $TileRustImgURL ); ?>');">
                    <img class="PromoQuizCardLabelImg" src="<?php echo esc_url( $QuizLabelImgURL ); ?>" alt="<?php echo esc_attr( eu_promo_t( 'True or False', 'quiz-label-true-or-false-alt' ) ); ?>">
                    <span class="PromoQuizCardStatement"><?php echo esc_html( eu_promo_field( 'quiz_card_2_statement', $PostID, 'The Ontario Government is investing more than ever in publicly funded education?' ) ); ?></span>
                </button>

                <button type="button" class="PromoQuizCard PromoQuizCardTeal" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz3" aria-haspopup="dialog" style="background-image: url('<?php echo esc_url( $TileTealImgURL ); ?>');">
                    <img class="PromoQuizCardLabelImg" src="<?php echo esc_url( $QuizLabelImgURL ); ?>" alt="<?php echo esc_attr( eu_promo_t( 'True or False', 'quiz-label-true-or-false-alt' ) ); ?>">
                    <span class="PromoQuizCardStatement"><?php echo esc_html( eu_promo_field( 'quiz_card_3_statement', $PostID, 'Everyone should care about Ontario’s students.' ) ); ?></span>
                </button>

            </div>

            <p class="PromoQuizCaption"><?php echo esc_html( eu_promo_t( 'Click for the Answer', 'quiz-caption' ) ); ?></p>
        </div>
    </section>

    <!-- ============ VIDEO ============ -->
    <section class="PromoVideo" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/images/promo/gold-bg.jpg' ); ?>');">
        <div class="container">
            <div class="PromoVideoWrapper">
                <!-- TODO: swap this whole countdown block for the real video embed
                     (YouTube/Vimeo iframe or WP oEmbed) once a URL is provided —
                     client-requested stopgap until the Oct 12 launch.
                     Target time is 16:00 UTC = noon Eastern *Daylight* Time
                     (Oct 12 falls under EDT/UTC-4, not standard-time EST/UTC-5;
                     using real Eastern-local noon rather than a literal "EST"
                     offset, since that's almost certainly what's meant). -->
                <div class="PromoVideoPlaceholder PromoVideoCountdown" data-countdown-target="2026-10-12T16:00:00Z">
                    <span class="PromoVideoCountdownIntro"><?php echo esc_html( eu_promo_t( 'Video launches in', 'video-countdown-intro' ) ); ?></span>
                    <div class="PromoVideoCountdownGrid">
                        <div class="PromoVideoCountdownUnit">
                            <span class="PromoVideoCountdownNumber" data-unit="days">00</span>
                            <span class="PromoVideoCountdownLabel"><?php echo esc_html( eu_promo_t( 'Days', 'video-countdown-days' ) ); ?></span>
                        </div>
                        <div class="PromoVideoCountdownUnit">
                            <span class="PromoVideoCountdownNumber" data-unit="hours">00</span>
                            <span class="PromoVideoCountdownLabel"><?php echo esc_html( eu_promo_t( 'Hours', 'video-countdown-hours' ) ); ?></span>
                        </div>
                        <div class="PromoVideoCountdownUnit">
                            <span class="PromoVideoCountdownNumber" data-unit="minutes">00</span>
                            <span class="PromoVideoCountdownLabel"><?php echo esc_html( eu_promo_t( 'Minutes', 'video-countdown-minutes' ) ); ?></span>
                        </div>
                        <div class="PromoVideoCountdownUnit">
                            <span class="PromoVideoCountdownNumber" data-unit="seconds">00</span>
                            <span class="PromoVideoCountdownLabel"><?php echo esc_html( eu_promo_t( 'Seconds', 'video-countdown-seconds' ) ); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="PromoHeroDots PromoVideoDots" aria-hidden="true">
        <?php
            // Same fairground dot-strip as the hero (see .PromoHeroDots in SCSS
            // for how the responsive dot count/animation works); this copy just
            // sits in normal flow under the video section instead of pinned
            // absolute to the bottom of the hero.
            for ( $i = 0; $i < 200; $i++ ) :
        ?>
            <span class="PromoHeroDot PromoHeroDot<?php echo esc_attr( ( $i % 3 ) + 1 ); ?>"></span>
        <?php endfor; ?>
    </div>

    <!-- ============ JEOPARDY / STAKES SECTION ============ -->
    <?php
        $JeopardyBgURL   = eu_promo_field( 'jeopardy_bg_image', $PostID, get_template_directory_uri() . '/images/promo/SET6.png' );
        $JeopardyIconURL = eu_promo_field( 'jeopardy_icon_image', $PostID, get_template_directory_uri() . '/images/promo/star.png' );
    ?>
    <section class="JeopardySection">
        <div class="JeopardyPhotoBand">
            <img class="JeopardyPhotoBandImg" src="<?php echo esc_url( $JeopardyBgURL ); ?>" alt="" aria-hidden="true">
            <div class="JeopardyPhotoBandTopFade" aria-hidden="true"></div>
            <div class="JeopardyPhotoBandFade" aria-hidden="true"></div>
            <div class="container">
                <h2 class="JeopardyHeadline"><?php echo stripTagsAllowBoldBreakItalics( eu_promo_field( 'jeopardy_headline', $PostID, 'Ontario’s future<br>is in jeopardy!' ) ); ?></h2>
            </div>
        </div>

        <div class="JeopardyOverlay">
            <div class="container">
                <p class="JeopardyLabel"><?php echo esc_html( eu_promo_field( 'jeopardy_label', $PostID, 'Students are facing:' ) ); ?></p>

                <div class="JeopardyGrid">

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><img src="<?php echo esc_url( $JeopardyIconURL ); ?>" alt="" aria-hidden="true"></span>
                        <h3 class="JeopardyTitle"><?php echo esc_html( eu_promo_field( 'jeopardy_col1_title', $PostID, 'Overcrowded and increasingly complex classrooms' ) ); ?></h3>
                        <p class="JeopardyText"><?php echo esc_html( eu_promo_field( 'jeopardy_col1_text', $PostID, "It’s harder for students' individual needs to be met in a class of 30+." ) ); ?></p>
                    </div>

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><img src="<?php echo esc_url( $JeopardyIconURL ); ?>" alt="" aria-hidden="true"></span>
                        <h3 class="JeopardyTitle"><?php echo esc_html( eu_promo_field( 'jeopardy_col2_title', $PostID, 'Underresourced schools' ) ); ?></h3>
                        <p class="JeopardyText"><?php echo esc_html( eu_promo_field( 'jeopardy_col2_text', $PostID, 'Between cancelled classes, shuttered programs, and insufficient school supplies, students are losing access to the things they need to thrive.' ) ); ?></p>
                    </div>

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><img src="<?php echo esc_url( $JeopardyIconURL ); ?>" alt="" aria-hidden="true"></span>
                        <h3 class="JeopardyTitle"><?php echo esc_html( eu_promo_field( 'jeopardy_col3_title', $PostID, 'Short staffing' ) ); ?></h3>
                        <p class="JeopardyText"><?php echo esc_html( eu_promo_field( 'jeopardy_col3_text', $PostID, 'Schools do not have enough staff to meet the needs of every student, as government underfunding leaves vulnerable kids behind.' ) ); ?></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ============ MODALS ============ -->

    <?php
    // Each modal's background matches the quiz panel that opens it — reuse
    // the same (ACF-editable, with fallback) URLs fetched above so the two
    // stay in sync automatically.
    $ModalTilePurpleURL = $TilePurpleImgURL;
    $ModalTileRustURL   = $TileRustImgURL;
    $ModalTileTealURL   = $TileTealImgURL;
    ?>

    <div class="modal fade PromoModal PromoModalQuiz" id="PromoModalQuiz1" tabindex="-1" aria-labelledby="PromoModalQuiz1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content PromoModalQuizPurple" style="background-image: linear-gradient(135deg, rgba(20,8,26,0.35) 0%, rgba(20,8,26,0.55) 100%), url('<?php echo esc_url( $ModalTilePurpleURL ); ?>');">
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                    <img class="PromoModalQuizCloseIcon" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/WhiteX.png' ); ?>" alt="" aria-hidden="true">
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictFalse" id="PromoModalQuiz1Label"><?php echo esc_html( eu_promo_t( 'False', 'modal-verdict-false' ) ); ?></p>
                    <div class="PromoModalQuizText">
                        <p>
                        <?php echo esc_html( eu_promo_field( 'modal_1_body', $PostID, 'Educators are dedicated to their students. These are the people you trust to care for students, protect their best interests, and prepare them for their futures. Their top priority is ensuring schools are safe, supportive, and well-resourced.' ) ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade PromoModal PromoModalQuiz" id="PromoModalQuiz2" tabindex="-1" aria-labelledby="PromoModalQuiz2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content PromoModalQuizRust" style="background-image: linear-gradient(135deg, rgba(30,8,8,0.35) 0%, rgba(58,18,18,0.55) 100%), url('<?php echo esc_url( $ModalTileRustURL ); ?>');">
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                    <img class="PromoModalQuizCloseIcon" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/WhiteX.png' ); ?>" alt="" aria-hidden="true">
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictFalse"><?php echo esc_html( eu_promo_t( 'False', 'modal-verdict-false' ) ); ?></p>
                    <div class="PromoModalQuizText">
                        <p><?php echo esc_html( eu_promo_field( 'modal_2_body_intro', $PostID, 'Despite claims of “historic investments” in education:' ) ); ?></p>
                        <ul>
                            <li><p><?php echo stripTagsAllowBoldBreakItalics( eu_promo_field( 'modal_2_body_li1', $PostID, 'Schools will actually receive $260 <em>less</em> per student this year compared to 2018-19, once you adjust for inflation and enrollment.' ) ); ?></p></li>
                            <li><p><?php echo esc_html( eu_promo_field( 'modal_2_body_li2', $PostID, 'That means $6.5 billion has been stripped from kids’ classrooms and their education.' ) ); ?></p></li>
                            <li><p><?php echo esc_html( eu_promo_field( 'modal_2_body_li3', $PostID, 'Real per-student funding has fallen to its lowest level in a decade, and is projected to continue to decline.' ) ); ?></p></li>
                        </ul>
                        <p><?php echo esc_html( eu_promo_field( 'modal_2_body_outro', $PostID, 'It’s clear Ontario’s publicly funded schools are seeing less funding than ever. That means crowded classrooms, reduced resources, and less support for students.' ) ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade PromoModal PromoModalQuiz" id="PromoModalQuiz3" tabindex="-1" aria-labelledby="PromoModalQuiz3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content PromoModalQuizTeal" style="background-image: linear-gradient(135deg, rgba(8,26,22,0.35) 0%, rgba(8,26,22,0.55) 100%), url('<?php echo esc_url( $ModalTileTealURL ); ?>');">
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                    <img class="PromoModalQuizCloseIcon" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/WhiteX.png' ); ?>" alt="" aria-hidden="true">
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictTrue"><?php echo esc_html( eu_promo_t( 'True', 'modal-verdict-true' ) ); ?></p>
                    <div class="PromoModalQuizText">

                        <p>
                        <?php echo esc_html( eu_promo_field( 'modal_3_body', $PostID, 'Whether you’re a parent, caregiver, or concerned citizen, what happens to Ontario’s students affects your future! These kids will grow up to be community members and working professionals. They deserve every opportunity to reach their full potential, and so do you! We should all be looking out for one another.' ) ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- "About Educators United" modal, opened from the footer logo -->
    <?php $AboutLogoURL = eu_promo_field( 'about_logo_image', $PostID, get_template_directory_uri() . '/images/promo/EducatorsUnitedPurple-EN.png' ); ?>
    <div class="modal fade PromoModal PromoModalAbout" id="PromoModalAbout" tabindex="-1" aria-label="<?php echo esc_attr( eu_promo_t( 'Educators United', 'about-modal-title-alt' ) ); ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content PromoModalAboutContent">
                <button type="button" class="PromoModalAboutCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                    <img class="PromoModalAboutCloseIcon" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/PurpleX.png' ); ?>" alt="" aria-hidden="true">
                </button>
                <div class="modal-body PromoModalAboutBody">
                    <div class="PromoModalAboutBrand">
                        <img class="PromoModalAboutLogo" src="<?php echo esc_url( $AboutLogoURL ); ?>" alt="<?php echo esc_attr( eu_promo_t( 'Educators United', 'footer-logo-alt' ) ); ?>">
                    </div>
                    <div class="PromoModalAboutText">
                        <p><?php echo esc_html( eu_promo_field( 'about_intro', $PostID, "Educators United is a coalition of parents, education workers, teachers, and youth who are concerned about the future of Ontario's students. Though we come from many different backgrounds, our shared purpose is advocacy." ) ); ?></p>
                        <p><?php echo esc_html( eu_promo_field( 'about_goal_label', $PostID, 'Our goal is threefold:' ) ); ?></p>
                        <p class="PromoModalAboutGoal"><?php echo esc_html( eu_promo_field( 'about_goal_1', $PostID, '1. To create awareness about the overcrowding, underfunding, and short staffing that impacts our publicly funded schools' ) ); ?></p>
                        <p class="PromoModalAboutGoal"><?php echo esc_html( eu_promo_field( 'about_goal_2', $PostID, '2. To build understanding that what happens to students affects us all' ) ); ?></p>
                        <p class="PromoModalAboutGoal"><?php echo esc_html( eu_promo_field( 'about_goal_3', $PostID, '3. To demand the Ontario Government fully resource our public education system' ) ); ?></p>
                        <p><?php echo esc_html( eu_promo_field( 'about_outro', $PostID, "Ontario's future is in jeopardy, but it doesn't have to be. Join us and spread the word." ) ); ?></p>
                        <hr class="PromoModalAboutDivider">
                        <p class="PromoModalAboutNote"><?php echo esc_html( eu_promo_field( 'about_note', $PostID, 'Ontario Forward is a non-partisan, not-for-profit organization fueled by the support of thousands working to move Ontario towards a brighter future.' ) ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

    <!-- ============ CLOSING STATEMENT ============ -->
    <section class="ClosingStatement" style="background-image: linear-gradient(135deg, rgba(58,18,18,0.55) 0%, rgba(30,8,8,0.75) 100%), url('<?php echo esc_url( get_template_directory_uri() . '/images/promo/velvet-bg.jpg' ); ?>');">
        <div class="container">
            <p class="ClosingStatementLine1"><?php echo stripTagsAllowBoldBreakItalics( eu_promo_field( 'closing_line_1', $PostID, 'Education is <br class="ClosingStatementBreak--mobile">not a game.' ) ); ?></p>
            <p class="ClosingStatementLine2"><?php echo esc_html( eu_promo_field( 'closing_line_2', $PostID, 'It’s time the Ontario Government stopped treating it like one.' ) ); ?></p>
        </div>
    </section>

    <!-- ============ PAGE FOOTER ============ -->
    <!-- NOTE: Custom footer for this promo page only (per project decision).
         The theme's site-wide footer (inc/sections/footer/section-main_footer.php)
         is intentionally not used here, and is untouched for other pages. -->
    <footer class="PromoFooter">
        <div class="container">
            <div class="PromoFooterRow">

                <div class="PromoFooterBrand">
                    <button type="button" class="PromoFooterLogoBtn" data-bs-toggle="modal" data-bs-target="#PromoModalAbout" aria-haspopup="dialog">
                        <img class="PromoFooterLogo" src="<?php echo esc_url( eu_promo_field( 'footer_logo_image', $PostID, get_template_directory_uri() . '/images/promo/EducatorsUnited.png' ) ); ?>" alt="<?php echo esc_attr( eu_promo_t( 'Educators United', 'footer-logo-alt' ) ); ?>">
                    </button>
                    <p class="PromoFooterLegal">
                        <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php echo esc_html( eu_promo_t( 'Privacy Statement', 'footer-privacy-link' ) ); ?></a><br>
                        &copy; <?php echo esc_html( eu_promo_t( 'Educators United', 'footer-copyright-name' ) ); ?> <?php echo esc_html( date( 'Y' ) ); ?>
                    </p>
                </div>

                <div class="PromoFooterSocials">
                    <a href="https://bsky.app/profile/educatorsunited.bsky.social" class="PromoFooterSocialIcon" aria-label="Bluesky" target="_blank" rel="noopener noreferrer"><i class="fab fa-bluesky" aria-hidden="true"></i></a>
                    <a href="https://www.facebook.com/people/Educators-United/61593725737983/" class="PromoFooterSocialIcon" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/educatorsunited.on" class="PromoFooterSocialIcon" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a href="https://www.tiktok.com/@educators.united" class="PromoFooterSocialIcon" aria-label="TikTok" target="_blank" rel="noopener noreferrer"><i class="fab fa-tiktok" aria-hidden="true"></i></a>
                    <a href="https://www.youtube.com/@educatorsunited.ontario" class="PromoFooterSocialIcon" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                </div>

                <img class="PromoFooterSparkle" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/Footer_Starburst.png' ); ?>" alt="" aria-hidden="true">

            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>
