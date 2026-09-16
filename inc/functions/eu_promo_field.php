<?php
/**
 * ACF field getter for the Educators United promo page, with a fallback.
 *
 * The promo page's client-editable copy/images (see acf-json/group_promo_page_content.json)
 * fall back to the original hardcoded value whenever a field is blank/unset —
 * both so a brand-new page isn't blank before anyone's touched the fields,
 * and so a client accidentally clearing a field doesn't break the layout.
 *
 * @param string $name     ACF field name (see group_promo_page_content.json).
 * @param int    $post_id  Post ID to read the field from.
 * @param mixed  $default  Value to use when the field is empty/unset.
 * @return mixed
 */
function eu_promo_field( $name, $post_id, $default ) {
    $value = function_exists( 'get_field' ) ? get_field( $name, $post_id ) : null;

    return ( $value === '' || $value === false || $value === null ) ? $default : $value;
}
