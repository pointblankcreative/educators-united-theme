<?php
/**
 * Template Name: Educators United - Privacy Policy
 *
 * Plain-language legal page for the promo campaign (notagame.ca / pasunjeu.ca),
 * linked from the campaign footer's "Privacy Statement" link. Mirrors the
 * promo page's custom chrome (no theme header/nav, own simple top bar +
 * footer) rather than the site-wide page.php template, since this page lives
 * under the same standalone campaign design as
 * template-educators-united-promo.php / -fr.php.
 *
 * EN only for now — the French footer's privacy link still points at "#"
 * until client-approved French legal copy is provided (see
 * fr-copy-mapping.md). Content is hardcoded rather than run through
 * eu_promo_t(), since WPML translates full pages, and a document this long
 * isn't practical to manage as dozens of individual translatable strings.
 */

    $PageFieldPreface = "default_page_options-";
    $FormType = "";
    $StickAlertBool = "";
    $HasBanner = "NoBannerClass";

    // Same rationale as the promo templates: this page has its own minimal
    // top bar, not the theme's default site header/nav.
    include get_stylesheet_directory() . '/inc/sections/scripts/section-header-footer-scripts.php';
    get_template_part( 'inc/headers/header', 'main' );
    ?>
    </head>
    <body id="BodyID" class="preload">
    <?php wp_body_open(); ?>
    <main id="Main" class="PromoPage PrivacyPage">

        <!-- ============ SIMPLE TOP BAR ============ -->
        <div class="PrivacyTopBar">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img class="PrivacyTopBarBadge" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/notagame-en-trimmed.png' ); ?>" alt="Not a Game">
            </a>
        </div>

        <!-- ============ LEGAL CONTENT ============ -->
        <div class="container PrivacyContent">

            <h1>Privacy Policy</h1>
            <p class="PrivacyUpdated"><strong>Last updated: September 1st, 2026</strong></p>

            <p>Educators United, a working group represented by Ontario Forward (&ldquo;we&rdquo;, &ldquo;us&rdquo;, &ldquo;our&rdquo;) operates notagame.ca and pasunjeu.ca (the &ldquo;Site&rdquo;). This policy explains what information we collect when you visit the Site, why we collect it, who it is shared with, and the choices available to you.</p>

            <h2>1. Information we collect</h2>
            <p><strong>Information collected automatically.</strong> When you visit the Site, our analytics and advertising technologies automatically receive technical information about your visit, including:</p>
            <ul>
                <li>IP address (which may be truncated or otherwise reduced before storage)</li>
                <li>browser type, browser version, operating system and device type</li>
                <li>screen size and language settings</li>
                <li>the pages you view, how long you spend on them, and how you move between them</li>
                <li>the website, ad or link that referred you to the Site</li>
                <li>approximate location derived from IP address, typically at the city or regional level</li>
                <li>randomly generated identifiers stored in cookies or similar technologies on your device</li>
            </ul>
            <p>We use this information in aggregate to understand how many people reach the Site, which parts of Ontario they come from, which content holds attention, and which advertising placements are working. We do not use it to identify you personally, and we do not attempt to link it to your name.</p>

            <h2>2. Cookies and similar technologies</h2>
            <p>A cookie is a small file placed on your device by a website. The Site and its partners use cookies, pixels, tags, software development kits and similar technologies for the following purposes:</p>
            <ul>
                <li><strong>Strictly necessary:</strong> operating the Site, page delivery, load balancing and security.</li>
                <li><strong>Analytics:</strong> measuring traffic, page performance and content engagement.</li>
                <li><strong>Advertising and measurement:</strong> understanding which advertising campaigns bring visitors to the Site, measuring the reach and effectiveness of those campaigns, limiting how often the same person is shown the same ad, and showing related advertising on other websites, apps and platforms.</li>
            </ul>
            <p>Some of these technologies are set by us, and some are set by third parties whose services run on the Site.</p>
            <p>You can control cookies through your browser settings, including blocking or deleting them. The Site will still work if you do. Browser-level opt-out and industry opt-out options are set out in Section 6.</p>

            <h2>3. Analytics and advertising partners</h2>
            <p>The Site currently uses the following:</p>
            <ul>
                <li><strong>Google Analytics 4</strong> (Google LLC), for website analytics.</li>
                <li><strong>Google Tag Manager</strong> (Google LLC), which is the container that loads and manages the tags described in this section.</li>
                <li><strong>Meta Pixel</strong> (Meta Platforms, Inc.), for advertising measurement and audience building on Facebook, Instagram and Meta&rsquo;s partner network.</li>
            </ul>
            <p>This campaign runs across a number of advertising channels, and the specific measurement partners can change over the life of the campaign. <strong>We may add, remove or replace analytics, advertising, measurement, attribution, audience or brand-study technologies from other providers, and we may permit our media partners and their vendors to place their own measurement technologies on the Site for the same purposes described in this policy.</strong> Any such technology is used for the purposes set out in Section 2 and is subject to this policy and to the provider&rsquo;s own privacy policy. We do not permit third parties to collect information through the Site for purposes unrelated to this campaign.</p>

            <h2>4. How we use information</h2>
            <p>We use the information described above only to:</p>
            <ul>
                <li>measure how many people see, reach and engage with the campaign</li>
                <li>understand which messages, creative and placements perform best, including through brand-lift and other advertising effectiveness studies</li>
                <li>manage advertising delivery, including frequency capping and audience reach</li>
                <li>keep the Site secure and working properly</li>
                <li>report on campaign performance to the organizations funding the campaign, in aggregate form</li>
            </ul>

            <h2>5. Disclosure of information</h2>
            <p>We do not sell your personal information. We do not rent or trade it, and we do not share it with political parties, candidates or campaigns.</p>
            <p>Information is shared only with:</p>
            <ul>
                <li>the service providers and advertising partners described in Section 3, for the purposes in Section 4</li>
                <li>our agency and any vendors engaged to build, host, operate and measure the Site and the campaign, who are permitted to use the information only for those purposes</li>
                <li>authorities, where we are required to do so by law or to establish or defend a legal claim</li>
            </ul>

            <h2>6. Your choices</h2>
            <p><strong>Browser controls.</strong> Most browsers let you block or delete cookies, and several block third-party cookies by default. See your browser&rsquo;s help pages.</p>
            <p><strong>Google Analytics.</strong> You can opt out of Google Analytics across all sites using Google&rsquo;s browser add-on: <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">https://tools.google.com/dlpage/gaoptout</a></p>
            <p><strong>Meta.</strong> You can review and adjust your ad settings in your Facebook or Instagram account under Ad Preferences.</p>
            <p><strong>Interest-based advertising, Canada.</strong> The Digital Advertising Alliance of Canada operates an opt-out for participating companies at <a href="https://youradchoices.ca/en/tools" target="_blank" rel="noopener noreferrer">https://youradchoices.ca/en/tools</a></p>
            <p><strong>Device controls.</strong> Mobile operating systems offer settings such as &ldquo;Limit Ad Tracking&rdquo; (iOS) or the equivalent Android advertising ID controls.</p>
            <p><strong>Global Privacy Control and Do Not Track.</strong> Browsers vary in how they signal tracking preferences, and there is no single agreed standard. Where a browser sends a recognised Global Privacy Control signal, we honour it.</p>
            <p>Opting out through these tools stops interest-based advertising and, in most cases, the associated data collection. It does not stop you seeing advertising, and it does not stop strictly necessary technologies.</p>

            <h2>7. Where information is stored, and for how long</h2>
            <p>Our analytics and advertising partners are located in, or store and process information in, countries outside Canada, including the United States. Information held in another country is subject to that country&rsquo;s laws and may be accessible to its courts, law enforcement and national security authorities under those laws.</p>
            <p>We retain the aggregate analytics reports we need for campaign reporting. Information held by the partners in Section 3 is retained under their own retention schedules. Google Analytics data on this property is set to a retention period of eighteen months.</p>

            <h2>8. Security</h2>
            <p>We use reasonable administrative, technical and physical safeguards appropriate to the sensitivity of the information, which for this Site is technical and non-identifying. No method of transmission or storage is completely secure, and we cannot guarantee absolute security.</p>

            <h2>9. Children</h2>
            <p>The Site is intended for a general adult audience in Ontario. It is not directed at children, and we do not knowingly collect personal information from children. If you believe a child&rsquo;s personal information has reached us, contact us at the address below and we will delete it.</p>

            <h2>10. Your rights, and how to reach us</h2>
            <p>You may ask us what personal information we hold about you, ask for a correction, ask that it be deleted, or make a complaint about how we handle it. Write to:</p>
            <p class="PrivacyAddress">
                Privacy, Educators United<br>
                400-65 St. Clair Avenue East<br>
                Toronto, Ontario M4T 2Y8
            </p>
            <p>We will respond within 30 days. If you are not satisfied with our response, you may contact the Office of the Privacy Commissioner of Canada at <a href="https://priv.gc.ca" target="_blank" rel="noopener noreferrer">priv.gc.ca</a> or 1-800-282-1376.</p>

            <h2>11. Legal framework</h2>
            <p>Ontario Forward is a registered Ontario not-for-profit organization. It does not carry on commercial activity, and it does not collect personal information in the course of commercial activity. We nonetheless apply the ten fair information principles of Canada&rsquo;s <em>Personal Information Protection and Electronic Documents Act</em> (PIPEDA) to the information described in this policy, as a matter of practice. Ontario has no general private-sector privacy statute, so PIPEDA is the relevant federal baseline. If you are a resident of Quebec, or of another province with its own private-sector privacy law, we apply the standards in this policy to your information in the same way.</p>

            <h2>12. Changes to this policy</h2>
            <p>We may update this policy as the campaign develops or as our measurement partners change. The current version is always posted here, with the date at the top. Material changes will be reflected in that date.</p>

        </div>

        <!-- ============ PAGE FOOTER ============ -->
        <!-- Same visual footer as the promo page, but the logo just links home
             here (no About modal on this page to trigger). -->
        <footer class="PromoFooter">
            <div class="container">
                <div class="PromoFooterRow">

                    <div class="PromoFooterBrand">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="PromoFooterLogoBtn">
                            <img class="PromoFooterLogo" src="<?php echo esc_url( get_template_directory_uri() . '/images/promo/EducatorsUnited.png' ); ?>" alt="Educators United">
                        </a>
                        <p class="PromoFooterLegal">
                            <a href="<?php echo esc_url( get_permalink() ); ?>">Privacy Statement</a><br>
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

    </main>

<?php wp_footer(); ?>
</body>
</html>
