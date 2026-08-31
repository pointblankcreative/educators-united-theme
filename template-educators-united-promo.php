<?php
/**
 * Template Name: Educators United - Promo Page
 *
 * Custom promo landing page:
 *  - Full-bleed hero with background image
 *  - Headline / intro section
 *  - 3 clickable panels, each opening its own modal with more detail
 *
 * NOTE: Content below is placeholder copy. Swap the hero image, headline
 * copy, and the 3 panel/modal text blocks for real campaign content.
 * French translations will be added once the multilingual plugin (WPML)
 * is installed and licensed.
 */

    $PageFieldPreface = "default_page_options-";
    $FormType = "";
    $StickAlertBool = "";
    $HasBanner = "NoBannerClass"; // we render our own hero below, skip the default banner

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
        $HeroImageURL = get_template_directory_uri() . '/images/promo/curtain-bg.png';
    }

    $HeroHostCutoutURL = get_template_directory_uri() . '/images/promo/host-cutout-trimmed.png';
?>
<main id="Main" class="PromoPage">

    <!-- ============ HERO ============ -->
    <section class="PromoHero" style="background-image: linear-gradient(180deg, rgba(20,10,20,0.1) 0%, rgba(20,10,20,0.35) 100%), url('<?php echo esc_url( $HeroImageURL ); ?>');">

        <img class="PromoHeroBadge" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/notagame-en-trimmed.png' ); ?>" alt="Not a Game">

        <!-- Visual placeholder only; will link to the French version once WPML is installed -->
        <span class="PromoHeroLangToggle" aria-label="French">FR</span>

        <div class="container">
            <img class="PromoHeroHost" src="<?php echo esc_url( $HeroHostCutoutURL ); ?>" alt="A game show host in a purple suit, pointing at the viewer.">

            <div class="PromoHeroContent">
                <h1 class="PromoHeroTitle">Are you smarter<br>than the Ontario<br>Government?</h1>
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
                When it comes to publicly-funded education, Ontario's government has the answers all wrong. Think you can do any better? Now’s your chance to find out.
                </p>
                <i class="fas fa-asterisk PromoQuizSparkleBg PromoQuizSparkleBg1" aria-hidden="true"></i>
                <i class="fas fa-asterisk PromoQuizSparkleBg PromoQuizSparkleBg2" aria-hidden="true"></i>
                <i class="fas fa-asterisk PromoQuizSparkleBg PromoQuizSparkleBg3" aria-hidden="true"></i>
            </div>

            <div class="PromoQuizGrid">

                <button type="button" class="PromoQuizCard PromoQuizCardPurple" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz1" aria-haspopup="dialog">
                    <span class="PromoQuizCardLabel">
                        <i class="fas fa-star PromoQuizCardStar PromoQuizCardStarA" aria-hidden="true"></i>
                        <span class="PromoQuizCardLabelLine1">True or</span>
                        <span class="PromoQuizCardLabelLine2">False</span>
                        <i class="fas fa-star PromoQuizCardStar PromoQuizCardStarB" aria-hidden="true"></i>
                    </span>
                    <span class="PromoQuizCardStatement">Educators are in it for themselves.</span>
                </button>

                <button type="button" class="PromoQuizCard PromoQuizCardRust" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz2" aria-haspopup="dialog">
                    <span class="PromoQuizCardLabel">
                        <i class="fas fa-star PromoQuizCardStar PromoQuizCardStarA" aria-hidden="true"></i>
                        <span class="PromoQuizCardLabelLine1">True or</span>
                        <span class="PromoQuizCardLabelLine2">False</span>
                        <i class="fas fa-star PromoQuizCardStar PromoQuizCardStarB" aria-hidden="true"></i>
                    </span>
                    <span class="PromoQuizCardStatement">The Ontario Government is investing more than ever in publicly-funded education?</span>
                </button>

                <button type="button" class="PromoQuizCard PromoQuizCardTeal" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz3" aria-haspopup="dialog">
                    <span class="PromoQuizCardLabel">
                        <i class="fas fa-star PromoQuizCardStar PromoQuizCardStarA" aria-hidden="true"></i>
                        <span class="PromoQuizCardLabelLine1">True or</span>
                        <span class="PromoQuizCardLabelLine2">False</span>
                        <i class="fas fa-star PromoQuizCardStar PromoQuizCardStarB" aria-hidden="true"></i>
                    </span>
                    <span class="PromoQuizCardStatement">Everyone should care about Ontario&rsquo;s students.</span>
                </button>

            </div>

            <p class="PromoQuizCaption">Click for the Answer</p>
        </div>
    </section>

    <!-- ============ VIDEO ============ -->
    <section class="PromoVideo" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/images/promo/gold-bg.jpg' ); ?>');">
        <div class="container">
            <div class="PromoVideoWrapper">
                <!-- TODO: swap this placeholder for the real video embed (YouTube/Vimeo iframe or WP oEmbed) once a URL is provided. -->
                <div class="PromoVideoPlaceholder">
                    <span class="PromoVideoPlayButton" aria-hidden="true">
                        <i class="fas fa-play" aria-hidden="true"></i>
                    </span>
                    <span class="PromoVideoPlaceholderLabel">Video coming soon</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ JEOPARDY / STAKES SECTION ============ -->
    <section class="JeopardySection" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/images/placeholders/placeholder.jpg' ); ?>');">
        <div class="container">
            <h2 class="JeopardyHeadline">Ontario&rsquo;s Future is in Jeopardy!</h2>
        </div>

        <div class="JeopardyOverlay">
            <div class="container">
                <p class="JeopardyLabel">Students are up against:</p>

                <div class="JeopardyGrid">

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><i class="fas fa-asterisk" aria-hidden="true"></i></span>
                        <h3 class="JeopardyTitle">Overcrowded and increasingly complex classrooms</h3>
                        <p class="JeopardyText">It&rsquo;s hard to balance a class of 30+ while supporting individual needs.</p>
                    </div>

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><i class="fas fa-asterisk" aria-hidden="true"></i></span>
                        <h3 class="JeopardyTitle">Underresourced schools</h3>
                        <p class="JeopardyText">Between cancelled classes, shuttered programs, and insufficient school supplies, students are losing access to the things they need to thrive.</p>
                    </div>

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><i class="fas fa-asterisk" aria-hidden="true"></i></span>
                        <h3 class="JeopardyTitle">Short staffing</h3>
                        <p class="JeopardyText">Schools do not have enough staff to meet the needs of every student, as government underfunding leaves vulnerable kids behind.</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ============ MODALS ============ -->

    <?php $ModalVelvetURL = get_template_directory_uri() . '/images/promo/velvet-bg.jpg'; ?>

    <div class="modal fade PromoModal PromoModalQuiz" id="PromoModalQuiz1" tabindex="-1" aria-labelledby="PromoModalQuiz1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-image: linear-gradient(135deg, rgba(30,8,8,0.35) 0%, rgba(58,18,18,0.55) 100%), url('<?php echo esc_url( $ModalVelvetURL ); ?>');">
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictFalse" id="PromoModalQuiz1Label">False</p>
                    <div class="PromoModalQuizText">
                        <p>
                        Educators are dedicated to their students. These are the people you trust to care for students, protect their best interests, and prepare them for their futures. Their top priority is ensuring schools are safe, supportive, and well-resourced.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade PromoModal PromoModalQuiz" id="PromoModalQuiz2" tabindex="-1" aria-labelledby="PromoModalQuiz2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-image: linear-gradient(135deg, rgba(30,8,8,0.35) 0%, rgba(58,18,18,0.55) 100%), url('<?php echo esc_url( $ModalVelvetURL ); ?>');">
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictFalse">False</p>
                    <div class="PromoModalQuizText">
                        <p class="PromoModalQuizStatement" id="PromoModalQuiz2Label">&ldquo;The Ontario Government is investing more than ever in publicly-funded education.&rdquo;</p>
                        <p>
                            Once adjusted for inflation and enrollment growth, real per-student
                            funding has failed to keep pace &mdash; leaving schools with less to
                            work with than in previous years, not more.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade PromoModal PromoModalQuiz" id="PromoModalQuiz3" tabindex="-1" aria-labelledby="PromoModalQuiz3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-image: linear-gradient(135deg, rgba(30,8,8,0.35) 0%, rgba(58,18,18,0.55) 100%), url('<?php echo esc_url( $ModalVelvetURL ); ?>');">
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictTrue">True</p>
                    <div class="PromoModalQuizText">
                        <p class="PromoModalQuizStatement" id="PromoModalQuiz3Label">&ldquo;Everyone should care about Ontario&rsquo;s students.&rdquo;</p>
                        <p>
                            Every student who is well-supported grows into a more capable, engaged
                            member of society. Strong public education benefits the whole province
                            &mdash; not just families with kids in school.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

    <!-- ============ CLOSING STATEMENT ============ -->
    <section class="ClosingStatement" style="background-image: linear-gradient(135deg, rgba(58,18,18,0.55) 0%, rgba(30,8,8,0.75) 100%), url('<?php echo esc_url( get_template_directory_uri() . '/images/promo/velvet-bg.jpg' ); ?>');">
        <div class="container">
            <p class="ClosingStatementLine1">Education is not a game.</p>
            <p class="ClosingStatementLine2">It&rsquo;s time the Ontario Government stopped treating it like one.</p>
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
                    <p class="PromoFooterLogo">Educators<br>United</p>
                    <p class="PromoFooterLegal">
                        <a href="#">Privacy Statement</a><br>
                        &copy; Educators United <?php echo esc_html( date( 'Y' ) ); ?>
                    </p>
                </div>

                <div class="PromoFooterSocials">
                    <a href="#" class="PromoFooterSocialIcon" aria-label="Bluesky"><i class="fab fa-bluesky" aria-hidden="true"></i></a>
                    <a href="#" class="PromoFooterSocialIcon" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="#" class="PromoFooterSocialIcon" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a href="#" class="PromoFooterSocialIcon" aria-label="TikTok"><i class="fab fa-tiktok" aria-hidden="true"></i></a>
                    <a href="#" class="PromoFooterSocialIcon" aria-label="X"><i class="fab fa-x-twitter" aria-hidden="true"></i></a>
                    <a href="#" class="PromoFooterSocialIcon" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                </div>

                <div class="PromoFooterSparkle" aria-hidden="true">
                    <i class="fas fa-star PromoFooterSparkleStar PromoFooterSparkleStarLg"></i>
                    <i class="fas fa-star PromoFooterSparkleStar PromoFooterSparkleStarSm"></i>
                    <i class="fas fa-star PromoFooterSparkleStar PromoFooterSparkleStarXs"></i>
                </div>

            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>
