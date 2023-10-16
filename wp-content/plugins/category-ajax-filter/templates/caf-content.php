<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

echo "<div class='caf-content d-none'>" . wp_kses_post($caf_content) . "</div>";