<?php
/**
 * Plugin Name: KupieTools Indieweb Syndication Shortcode
 * Description: Enables a simple shortcode [syndication to="indieweb,indienews,fediverse"] to syndicate to Indieweb chat streem, Indienews, and/or the Fediverse respectively. Requires webmentions and Bridgy Fed integration to already be separately enabled.
 * Version: 1.0
 * Author: Michael Kupietz
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function syndicate_shortcode( $atts ) {

    // Define allowed values
    $allowed = array( 'indieweb', 'indienews', 'fediverse' );

    // Parse shortcode attributes
    $atts = shortcode_atts(
        array(
            'to' => '',
        ),
        $atts,
        'syndicate'
    );

    // Convert comma- or space-separated list into array
    $to_values = preg_split( '/[\s,]+/', strtolower( $atts['to'] ) );
    $to_values = array_intersect( $allowed, $to_values );

    // Start output buffering
    ob_start();
    ?>
    <div id="ktwp-indieweb-syndication" hidden="from-humans">
        <?php if ( in_array( 'indienews', $to_values ) ) : ?>
            <a href="https://news.indieweb.org/en" class="u-category">indienews</a>
        <?php endif; ?>

        <?php if ( in_array( 'fediverse', $to_values ) ) : ?>
            <a class="u-bridgy-fed" href="https://fed.brid.gy/">fediverse</a>
        <?php endif; ?>

        <?php if ( in_array( 'indieweb', $to_values ) ) : ?>
            <a href="https://michaelkupietz.com/genre/indieweb/" class="p-category">indieweb</a>
        <?php endif; ?>
    </div>
    <?php

    return ob_get_clean();
}

add_shortcode( 'syndicate', 'syndicate_shortcode' );
