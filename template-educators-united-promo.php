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

    include_once('header.php');

    $PageTitle = get_the_title();

    // Hero background image: use the page featured image if one is set,
    // otherwise fall back to the theme placeholder image.
    if ( has_post_thumbnail() ) {
        $HeroImageURL = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    } else {
        $HeroImageURL = get_template_directory_uri() . '/images/placeholders/placeholder.jpg';
    }
?>
<main id="Main">

    <!-- ============ HERO ============ -->
    <section class="PromoHero" style="background-image: linear-gradient(180deg, rgba(20,20,45,0.55) 0%, rgba(20,20,45,0.75) 100%), url('<?php echo esc_url( $HeroImageURL ); ?>');">
        <div class="container">
            <div class="PromoHeroContent">
                <p class="PromoEyebrow">Public Awareness Campaign</p>
                <h1 class="PromoHeroTitle">Educators United</h1>
                <p class="PromoHeroSubtitle">Standing together for the future of public education.</p>
                <a href="#WhyItMatters" class="ThemeButton background primary PromoHeroButton">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- ============ HEADLINE / INTRO ============ -->
    <section id="WhyItMatters" class="PromoIntro">
        <div class="container">
            <div class="PromoIntroInner">
                <h2 class="PromoIntroTitle">Why This Fight Matters</h2>
                <p class="PromoIntroText">
                    Educators United brings together teachers, support staff, families, and
                    communities to protect and strengthen public education. Every student
                    deserves a fully-resourced classroom and every educator deserves the
                    support to do their best work. Explore the panels below to learn more
                    about our mission, the challenges educators are facing, and how you can
                    help.
                </p>
            </div>
        </div>
    </section>

    <!-- ============ 3 CLICKABLE PANELS ============ -->
    <section class="PromoPanels">
        <div class="container">
            <div class="PromoPanelsGrid">

                <button type="button" class="PromoPanel" data-bs-toggle="modal" data-bs-target="#PromoModalMission" aria-haspopup="dialog">
                    <span class="PromoPanelIcon"><i class="fas fa-bullseye" aria-hidden="true"></i></span>
                    <span class="PromoPanelTitle">Our Mission</span>
                    <span class="PromoPanelText">
                        Protecting public education and the educators who make it work.
                    </span>
                    <span class="PromoPanelLink">Learn More <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                </button>

                <button type="button" class="PromoPanel" data-bs-toggle="modal" data-bs-target="#PromoModalChallenges" aria-haspopup="dialog">
                    <span class="PromoPanelIcon"><i class="fas fa-triangle-exclamation" aria-hidden="true"></i></span>
                    <span class="PromoPanelTitle">The Challenges We Face</span>
                    <span class="PromoPanelText">
                        Underfunded classrooms, staffing shortages, and rising workloads.
                    </span>
                    <span class="PromoPanelLink">Learn More <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                </button>

                <button type="button" class="PromoPanel" data-bs-toggle="modal" data-bs-target="#PromoModalGetInvolved" aria-haspopup="dialog">
                    <span class="PromoPanelIcon"><i class="fas fa-people-group" aria-hidden="true"></i></span>
                    <span class="PromoPanelTitle">How You Can Help</span>
                    <span class="PromoPanelText">
                        Simple, powerful ways to add your voice to the campaign.
                    </span>
                    <span class="PromoPanelLink">Learn More <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                </button>

            </div>
        </div>
    </section>

    <!-- ============ MODALS ============ -->

    <div class="modal fade PromoModal" id="PromoModalMission" tabindex="-1" aria-labelledby="PromoModalMissionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 id="PromoModalMissionLabel">Our Mission</h4>
                        </div>
                        <div>
                            <button type="button" class="ButtonClose" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <hr/>
                    <p>
                        Educators United exists to protect and strengthen public education for
                        every student, in every community. We believe that well-resourced
                        schools, supported educators, and engaged communities are the
                        foundation of a strong society.
                    </p>
                    <p>
                        We work to raise awareness, organize educators and families, and push
                        for the funding and policy changes public education needs to thrive.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade PromoModal" id="PromoModalChallenges" tabindex="-1" aria-labelledby="PromoModalChallengesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 id="PromoModalChallengesLabel">The Challenges We Face</h4>
                        </div>
                        <div>
                            <button type="button" class="ButtonClose" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <hr/>
                    <p>
                        Classrooms across the country are stretched thin. Chronic underfunding,
                        growing class sizes, and educator shortages are putting real strain on
                        the people and places responsible for shaping the next generation.
                    </p>
                    <p>
                        These challenges affect everyone &mdash; students lose access to the
                        support they need, educators face unsustainable workloads, and
                        communities feel the impact for years to come.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade PromoModal" id="PromoModalGetInvolved" tabindex="-1" aria-labelledby="PromoModalGetInvolvedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 id="PromoModalGetInvolvedLabel">How You Can Help</h4>
                        </div>
                        <div>
                            <button type="button" class="ButtonClose" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <hr/>
                    <p>
                        Change happens when enough people speak up. Here are a few ways to get
                        involved with Educators United today:
                    </p>
                    <ul>
                        <li>Sign up to add your voice to the campaign.</li>
                        <li>Share this page with friends, family, and colleagues.</li>
                        <li>Contact your local representatives about public education funding.</li>
                        <li>Volunteer your time to support local educators and schools.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>

<?php include_once('footer.php'); ?>
