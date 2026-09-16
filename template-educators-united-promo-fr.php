<?php
/**
 * Template Name: Educators United - Promo Page (FR - temporary, no WPML)
 *
 * TEMPORARY STOPGAP: French copy hardcoded directly into this duplicate
 * template while the WPML license situation gets sorted out, so there's
 * something real to put in front of QA/the client. Once WPML is installed
 * and licensed, the intent is to retire this file and go back to a single
 * template (template-educators-united-promo.php) with WPML doing the
 * language switch — see fr-copy-mapping.md for the source copy used here
 * and inc/functions/eu_promo_translate_string.php for how that'll work.
 *
 * Because this isn't using eu_promo_t()/WPML, any future copy edits made to
 * the English template will NOT automatically apply here — this file will
 * need the same edit made by hand until it's retired.
 *
 * Quiz card graphic: uses VraiOuFaux.png (the French equivalent of
 * TrueOrFalse.png on the EN template, added 2026-09-01). The earlier
 * .PromoQuizCardLabelText text fallback is no longer used here but is left
 * in the SCSS in case it's needed again.
 */

    $PageFieldPreface = "default_page_options-";
    $FormType = "";
    $StickAlertBool = "";
    $HasBanner = "NoBannerClass"; // we render our own hero below, skip the default banner

    // Browser tab title: campaign brand name, not the site's dev placeholder
    // title. Must be added before wp_head() runs (see get_template_part()
    // call below), since that's what outputs the <title> tag.
    add_filter( 'pre_get_document_title', function () {
        return 'Pas Un Jeu';
    } );

    // Social preview (Open Graph / Twitter Card) tags — read via $GLOBALS by
    // inc/headers/header-main.php (see the comment there for why).
    $GLOBALS['EU_SocialTitle']       = 'Pas Un Jeu';
    $GLOBALS['EU_SocialDescription'] = "L'éducation, c'est pas un jeu. Pourquoi le gouvernement de l'Ontario ne prend pas ça au sérieux?";
    $GLOBALS['EU_SocialImageURL']    = get_template_directory_uri() . '/images/promo/ScrapeFR.png';
    $GLOBALS['EU_SocialLocale']      = 'fr_CA';

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

    $HeroHostCutoutURL = eu_promo_field( 'host_image', $PostID, get_template_directory_uri() . '/images/promo/host-fr.png' );

    // Reciprocal link back to the English page, for the language toggle. Hardcoded to
    // notagame.ca (not home_url()) on purpose: WPML's domain-based language negotiation
    // filters home_url() to whatever domain the CURRENT request came in on, so on pasunjeu.ca
    // this would resolve back to pasunjeu.ca itself instead of crossing over to English.
    $EnglishPageURL = 'https://notagame.ca/';
?>
<main id="Main" class="PromoPage PromoPageFR">

    <!-- ============ HERO ============ -->
    <section class="PromoHero" style="background-image: linear-gradient(180deg, rgba(20,10,20,0.1) 0%, rgba(20,10,20,0.35) 100%), url('<?php echo esc_url( $HeroImageURL ); ?>');">

        <img class="PromoHeroBadge" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/notagame-fr-trimmed.png' ); ?>" alt="Pas un jeu">

        <a href="<?php echo esc_url( $EnglishPageURL ); ?>" class="PromoHeroLangToggle" aria-label="Anglais">EN</a>

        <div class="container">
            <img class="PromoHeroHost" src="<?php echo esc_url( $HeroHostCutoutURL ); ?>" alt="Un animateur de jeu télévisé en veston à carreaux, qui pointe vers le spectateur.">

            <div class="PromoHeroContent">
                <h1 class="PromoHeroTitle">Le gouvernement<br>de l&rsquo;Ontario en<br>sait-il vraiment<br>plus que vous?</h1>
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
                <?php echo esc_html( eu_promo_field( 'quiz_intro_text', $PostID, 'Le gouvernement de l’Ontario mérite un gros zéro en matière de financement scolaire. Vous pensez pouvoir faire mieux? À vous de jouer.' ) ); ?>
                </p>
                <img class="PromoQuizSparkleBg" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/StarburstOnBlack.png' ); ?>" alt="" aria-hidden="true">
            </div>

            <?php
                $QuizLabelImgURL   = eu_promo_field( 'quiz_label_image', $PostID, get_template_directory_uri() . '/images/promo/VraiOuFaux.png' );
                $TilePurpleImgURL  = eu_promo_field( 'tile_purple_image', $PostID, get_template_directory_uri() . '/images/promo/PurpleTile_Long.png' );
                $TileRustImgURL    = eu_promo_field( 'tile_rust_image', $PostID, get_template_directory_uri() . '/images/promo/RedTile_Long.png' );
                $TileTealImgURL    = eu_promo_field( 'tile_teal_image', $PostID, get_template_directory_uri() . '/images/promo/TealTile_Long.png' );
            ?>

            <div class="PromoQuizGrid">

                <button type="button" class="PromoQuizCard PromoQuizCardPurple" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz1" aria-haspopup="dialog" style="background-image: url('<?php echo esc_url( $TilePurpleImgURL ); ?>');">
                    <img class="PromoQuizCardLabelImg" src="<?php echo esc_url( $QuizLabelImgURL ); ?>" alt="Vrai ou Faux">
                    <span class="PromoQuizCardStatement"><?php echo esc_html( eu_promo_field( 'quiz_card_1_statement', $PostID, 'Le personnel enseignant ne défend que ses propres intérêts.' ) ); ?></span>
                </button>

                <button type="button" class="PromoQuizCard PromoQuizCardRust" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz2" aria-haspopup="dialog" style="background-image: url('<?php echo esc_url( $TileRustImgURL ); ?>');">
                    <img class="PromoQuizCardLabelImg" src="<?php echo esc_url( $QuizLabelImgURL ); ?>" alt="Vrai ou Faux">
                    <span class="PromoQuizCardStatement"><?php echo esc_html( eu_promo_field( 'quiz_card_2_statement', $PostID, 'Le gouvernement de l’Ontario investit plus que jamais dans le système d’éducation publique.' ) ); ?></span>
                </button>

                <button type="button" class="PromoQuizCard PromoQuizCardTeal" data-bs-toggle="modal" data-bs-target="#PromoModalQuiz3" aria-haspopup="dialog" style="background-image: url('<?php echo esc_url( $TileTealImgURL ); ?>');">
                    <img class="PromoQuizCardLabelImg" src="<?php echo esc_url( $QuizLabelImgURL ); ?>" alt="Vrai ou Faux">
                    <span class="PromoQuizCardStatement"><?php echo esc_html( eu_promo_field( 'quiz_card_3_statement', $PostID, 'Tout le monde devrait se soucier de l’avenir des élèves de l’Ontario.' ) ); ?></span>
                </button>

            </div>

            <p class="PromoQuizCaption">Cliquez pour voir la r&eacute;ponse</p>
        </div>
    </section>

    <!-- ============ VIDEO ============ -->
    <section class="PromoVideo" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/images/promo/gold-bg.jpg' ); ?>');">
        <div class="container">
            <div class="PromoVideoWrapper">
                <!-- TODO: swap this whole countdown block for the real video embed
                     once a URL is provided — client-requested stopgap until the
                     Oct 12 launch. Same target as the EN template — see its
                     comment for the EST/EDT note. -->
                <div class="PromoVideoPlaceholder PromoVideoCountdown" data-countdown-target="2026-10-12T16:00:00Z">
                    <span class="PromoVideoCountdownIntro">Vid&eacute;o disponible dans</span>
                    <div class="PromoVideoCountdownGrid">
                        <div class="PromoVideoCountdownUnit">
                            <span class="PromoVideoCountdownNumber" data-unit="days">00</span>
                            <span class="PromoVideoCountdownLabel">Jours</span>
                        </div>
                        <div class="PromoVideoCountdownUnit">
                            <span class="PromoVideoCountdownNumber" data-unit="hours">00</span>
                            <span class="PromoVideoCountdownLabel">Heures</span>
                        </div>
                        <div class="PromoVideoCountdownUnit">
                            <span class="PromoVideoCountdownNumber" data-unit="minutes">00</span>
                            <span class="PromoVideoCountdownLabel">Minutes</span>
                        </div>
                        <div class="PromoVideoCountdownUnit">
                            <span class="PromoVideoCountdownNumber" data-unit="seconds">00</span>
                            <span class="PromoVideoCountdownLabel">Secondes</span>
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
        $JeopardyBgURL   = eu_promo_field( 'jeopardy_bg_image', $PostID, get_template_directory_uri() . '/images/promo/SET7.png' );
        $JeopardyIconURL = eu_promo_field( 'jeopardy_icon_image', $PostID, get_template_directory_uri() . '/images/promo/star.png' );
    ?>
    <section class="JeopardySection">
        <div class="JeopardyPhotoBand">
            <img class="JeopardyPhotoBandImg" src="<?php echo esc_url( $JeopardyBgURL ); ?>" alt="" aria-hidden="true">
            <div class="JeopardyPhotoBandTopFade" aria-hidden="true"></div>
            <div class="JeopardyPhotoBandFade" aria-hidden="true"></div>
            <div class="container">
                <h2 class="JeopardyHeadline"><?php echo stripTagsAllowBoldBreakItalics( eu_promo_field( 'jeopardy_headline', $PostID, 'L&rsquo;avenir de l&rsquo;&eacute;ducation de l&rsquo;Ontario est en jeu!' ) ); ?></h2>
            </div>
        </div>

        <div class="JeopardyOverlay">
            <div class="container">
                <p class="JeopardyLabel"><?php echo esc_html( eu_promo_field( 'jeopardy_label', $PostID, 'Nos élèves sont confrontés à :' ) ); ?></p>

                <div class="JeopardyGrid">

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><img src="<?php echo esc_url( $JeopardyIconURL ); ?>" alt="" aria-hidden="true"></span>
                        <h3 class="JeopardyTitle"><?php echo esc_html( eu_promo_field( 'jeopardy_col1_title', $PostID, 'Des classes surchargées avec des besoins de plus en plus complexes' ) ); ?></h3>
                        <p class="JeopardyText"><?php echo esc_html( eu_promo_field( 'jeopardy_col1_text', $PostID, 'Il est difficile de gérer une classe de 30 élèves et plus tout en offrant un soutien individuel.' ) ); ?></p>
                    </div>

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><img src="<?php echo esc_url( $JeopardyIconURL ); ?>" alt="" aria-hidden="true"></span>
                        <h3 class="JeopardyTitle"><?php echo esc_html( eu_promo_field( 'jeopardy_col2_title', $PostID, 'Des écoles sous-financées' ) ); ?></h3>
                        <p class="JeopardyText"><?php echo esc_html( eu_promo_field( 'jeopardy_col2_text', $PostID, "Cours annulés, programmes abolis, matériel scolaire insuffisant\xC2\xA0: les élèves perdent accès à ce dont ils ont besoin pour réussir." ) ); ?></p>
                    </div>

                    <div class="JeopardyColumn">
                        <span class="JeopardyIcon"><img src="<?php echo esc_url( $JeopardyIconURL ); ?>" alt="" aria-hidden="true"></span>
                        <h3 class="JeopardyTitle"><?php echo esc_html( eu_promo_field( 'jeopardy_col3_title', $PostID, 'Un manque de personnel' ) ); ?></h3>
                        <p class="JeopardyText"><?php echo esc_html( eu_promo_field( 'jeopardy_col3_text', $PostID, 'Les écoles n’ont pas assez de personnel pour répondre aux besoins de chaque enfant et ce sont les plus vulnérables qui en paient le prix.' ) ); ?></p>
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
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Fermer">
                    <img class="PromoModalQuizCloseIcon" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/WhiteX.png' ); ?>" alt="" aria-hidden="true">
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictFalse" id="PromoModalQuiz1Label">FAUX</p>
                    <div class="PromoModalQuizText">
                        <p>
                        <?php echo esc_html( eu_promo_field( 'modal_1_body', $PostID, 'Le personnel enseignant est dévoué à ses élèves. Vous lui faites confiance pour prendre soin de vos enfants, protéger leurs intérêts et les préparer pour l’avenir. La priorité est d’assurer aux élèves l’accès à des écoles sécuritaires et bien financées, avec tout le soutien nécessaire à leur réussite.' ) ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade PromoModal PromoModalQuiz" id="PromoModalQuiz2" tabindex="-1" aria-labelledby="PromoModalQuiz2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content PromoModalQuizRust" style="background-image: linear-gradient(135deg, rgba(30,8,8,0.35) 0%, rgba(58,18,18,0.55) 100%), url('<?php echo esc_url( $ModalTileRustURL ); ?>');">
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Fermer">
                    <img class="PromoModalQuizCloseIcon" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/WhiteX.png' ); ?>" alt="" aria-hidden="true">
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictFalse">FAUX</p>
                    <div class="PromoModalQuizText">
                        <p><?php echo esc_html( eu_promo_field( 'modal_2_body_intro', $PostID, 'À première vue, un budget de 30,3 milliards de dollars pour l’année scolaire 2025-2026 semble impressionnant. Mais dans les faits, c’est loin d’être suffisant.' ) ); ?></p>
                        <ul>
                            <li><p><?php echo stripTagsAllowBoldBreakItalics( eu_promo_field( 'modal_2_body_li1', $PostID, 'En réalité, les écoles recevront 260&nbsp;$ <em>de moins</em> par élève cette année comparativement à 2018-2019, en tenant compte de l’inflation et de la croissance des inscriptions.' ) ); ?></p></li>
                            <li><p><?php echo esc_html( eu_promo_field( 'modal_2_body_li2', $PostID, 'Autrement dit, 6,5 milliards de dollars ont été coupés dans l’éducation de nos enfants.' ) ); ?></p></li>
                            <li><p><?php echo esc_html( eu_promo_field( 'modal_2_body_li3', $PostID, 'Le financement réel par élève est à son plus bas en dix ans et la situation continuera d’empirer.' ) ); ?></p></li>
                        </ul>
                        <p><?php echo esc_html( eu_promo_field( 'modal_2_body_outro', $PostID, "Les écoles publiques de l’Ontario n’ont jamais reçu aussi peu de financement et les conséquences sont claires\xC2\xA0: classes surchargées, ressources réduites, soutien insuffisant pour les élèves." ) ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade PromoModal PromoModalQuiz" id="PromoModalQuiz3" tabindex="-1" aria-labelledby="PromoModalQuiz3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content PromoModalQuizTeal" style="background-image: linear-gradient(135deg, rgba(8,26,22,0.35) 0%, rgba(8,26,22,0.55) 100%), url('<?php echo esc_url( $ModalTileTealURL ); ?>');">
                <button type="button" class="PromoModalQuizCloseBtn" data-bs-dismiss="modal" aria-label="Fermer">
                    <img class="PromoModalQuizCloseIcon" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/WhiteX.png' ); ?>" alt="" aria-hidden="true">
                </button>
                <div class="modal-body PromoModalQuizBody">
                    <p class="PromoModalQuizVerdict PromoModalQuizVerdictTrue">VRAI</p>
                    <div class="PromoModalQuizText">

                        <p>
                        <?php echo esc_html( eu_promo_field( 'modal_3_body', $PostID, 'Que nous soyons parents, proches aidants ou citoyens préoccupés, l’avenir des élèves de l’Ontario concerne tout le monde! Ces enfants deviendront des membres actifs sur le marché du travail et dans nos communautés. Ils méritent toutes les chances d’atteindre leur plein potentiel, tout comme vous! Il est de notre devoir de veiller les uns sur les autres.' ) ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- "About Educators United" modal, opened from the footer logo -->
    <div class="modal fade PromoModal PromoModalAbout" id="PromoModalAbout" tabindex="-1" aria-label="Ensemble pour l&rsquo;&eacute;ducation" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content PromoModalAboutContent">
                <button type="button" class="PromoModalAboutCloseBtn" data-bs-dismiss="modal" aria-label="Fermer">
                    <img class="PromoModalAboutCloseIcon" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/PurpleX.png' ); ?>" alt="" aria-hidden="true">
                </button>
                <div class="modal-body PromoModalAboutBody">
                    <div class="PromoModalAboutBrand">
                        <img class="PromoModalAboutLogo PromoModalAboutLogoFR" src="<?php echo esc_url( eu_promo_field( 'about_logo_image', $PostID, get_template_directory_uri() . '/images/promo/EducatorsUnitedPurple-FR.png' ) ); ?>" alt="Ensemble pour l&rsquo;&eacute;ducation">
                    </div>
                    <div class="PromoModalAboutText">
                        <p><?php echo esc_html( eu_promo_field( 'about_intro', $PostID, 'La coalition Ensemble pour l’éducation rassemble parents, personnel scolaire et enseignant, ainsi que jeunes préoccupés par l’avenir des élèves de l’Ontario. Et bien que nos réalités soient différentes, la même cause nous unit.' ) ); ?></p>
                        <p><?php echo esc_html( eu_promo_field( 'about_goal_label', $PostID, "Notre mission repose sur trois objectifs\xC2\xA0:" ) ); ?></p>
                        <p class="PromoModalAboutGoal"><?php echo esc_html( eu_promo_field( 'about_goal_1', $PostID, '1. Sensibiliser la population aux classes surchargées, au sous-financement et au manque de personnel qui affectent nos écoles publiques' ) ); ?></p>
                        <p class="PromoModalAboutGoal"><?php echo esc_html( eu_promo_field( 'about_goal_2', $PostID, '2. Rappeler que le sort de nos élèves est aussi le nôtre' ) ); ?></p>
                        <p class="PromoModalAboutGoal"><?php echo esc_html( eu_promo_field( 'about_goal_3', $PostID, '3. Réclamer au gouvernement de l’Ontario un meilleur financement du système d’éducation publique' ) ); ?></p>
                        <p><?php echo esc_html( eu_promo_field( 'about_outro', $PostID, 'L’avenir de l’Ontario est en jeu, mais la partie n’est pas encore finie. Joignez-vous à nous et partagez le message.' ) ); ?></p>
                        <hr class="PromoModalAboutDivider">
                        <p class="PromoModalAboutNote"><?php echo esc_html( eu_promo_field( 'about_note', $PostID, 'Ontario Forward est un organisme à but non lucratif et non partisan, porté par le soutien de milliers de personnes engagées à bâtir un avenir meilleur pour l’Ontario.' ) ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

    <!-- ============ CLOSING STATEMENT ============ -->
    <section class="ClosingStatement" style="background-image: linear-gradient(135deg, rgba(58,18,18,0.55) 0%, rgba(30,8,8,0.75) 100%), url('<?php echo esc_url( get_template_directory_uri() . '/images/promo/velvet-bg.jpg' ); ?>');">
        <div class="container">
            <p class="ClosingStatementLine1"><?php echo stripTagsAllowBoldBreakItalics( eu_promo_field( 'closing_line_1', $PostID, 'L&rsquo;&eacute;ducation, c&rsquo;est pas un jeu.' ) ); ?></p>
            <p class="ClosingStatementLine2"><?php echo esc_html( eu_promo_field( 'closing_line_2', $PostID, 'Pourquoi le gouvernement de l’Ontario ne prend pas ça au sérieux?' ) ); ?></p>
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
                        <img class="PromoFooterLogo" src="<?php echo esc_url( eu_promo_field( 'footer_logo_image', $PostID, get_template_directory_uri() . '/images/promo/EducatorUnited-FR-trimmed.png' ) ); ?>" alt="Ensemble pour l&rsquo;&eacute;ducation">
                    </button>
                    <p class="PromoFooterLegal">
                        <?php // TEMPORARY: no French Privacy Policy page yet (see fr-copy-mapping.md) —
                              // links to the English page for now rather than a dead "#" link. ?>
                        <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">Politique de confidentialit&eacute;</a><br>
                        &copy; Educators United <?php echo esc_html( date( 'Y' ) ); ?>
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
