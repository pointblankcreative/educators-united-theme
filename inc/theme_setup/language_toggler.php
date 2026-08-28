<?php

function language_desktop_toggler() {
    if (function_exists('icl_get_languages')) {
        // Get languages that have a translation for the current page
        $languages = icl_get_languages('skip_missing=1');

        if (count($languages) > 1) {
            echo '<div class="LanguageTogglerWrapper">';

            foreach ($languages as $language) {
                if (!$language['active']) {
                    echo '<a href="' . esc_url($language['url']) . '" class="LanguageToggler">' . esc_html($language['native_name']) . '</a>';
                }
            }

            echo '</div>';
        }
    }
}

function language_mobile_toggler() {
    if (function_exists('icl_get_languages')) {
        // Get languages that have a translation for the current page
        $languages = icl_get_languages('skip_missing=1');

        if (count($languages) > 1) {
            echo '<div class="LanguageTogglerWrapper d-flex align-items-center">';

            foreach ($languages as $language) {
                if (!$language['active']) {
                    echo '<a href="' . esc_url($language['url']) . '" class="LanguageToggler">' . esc_html($language['native_name']) . '</a>';
                } else {
                    echo '<p class="LanguageToggler Active">' . esc_html($language['native_name']) . '</p>';
                }
            }

            echo '</div>';
        }
    }
}