<?php
/**
 * WPML String Translation helper for the Educators United promo page.
 *
 * The promo page's copy is hardcoded into template-educators-united-promo.php
 * (rather than pulled from post content/ACF fields), so WPML's normal
 * per-page translation flow doesn't see it. This registers each string with
 * WPML's String Translation module and returns the translated version when
 * one exists.
 *
 * Safe no-op until WPML (with the String Translation add-on) is installed
 * and active: both the action and filter below simply pass through when
 * WPML's hooks aren't registered, so wrapping strings with this now doesn't
 * change anything on the front end until WPML is live.
 *
 * Once WPML is active, every string wrapped with this will show up under
 * WPML -> String Translation (context: "educators-united-promo") ready to
 * translate.
 *
 * @param string $string  The original (English) copy.
 * @param string $name    A unique, stable identifier for this string within
 *                         the "educators-united-promo" context (used to match
 *                         translations back up — don't reuse names for
 *                         different copy, and don't rename existing ones
 *                         after they've been translated).
 * @return string
 */
function eu_promo_t( $string, $name ) {
    $context = 'educators-united-promo';

    do_action( 'wpml_register_single_string', $context, $name, $string );

    return apply_filters( 'wpml_translate_single_string', $string, $context, $name );
}
