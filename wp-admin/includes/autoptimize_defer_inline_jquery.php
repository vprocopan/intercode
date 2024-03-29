<?php
add_action('plugins_loaded','ao_defer_inline_init');

function ao_defer_inline_init() {
	if ( get_option('autoptimize_js_include_inline') != 'on' ) {
		add_filter('autoptimize_html_after_minify','ao_defer_inline_jquery',10,1);
	}
}

function ao_defer_inline_jquery( $in ) {
  if ( preg_match_all( '#<script.*>(.*)</script>#Usmi', $in, $matches, PREG_SET_ORDER ) ) {
    foreach( $matches as $match ) {
      if ( $match[1] !== '' && ( strpos( $match[1], 'jQuery' ) !== false || strpos( $match[1], '$' ) !== false ) ) {
        // inline js that requires jquery, wrap deferring JS around it to defer it. 
        $new_match = 'var aoDeferInlineJQuery=function(){'.$match[1].'}; if (document.readyState === "loading") {document.addEventListener("DOMContentLoaded", aoDeferInlineJQuery);} else {aoDeferInlineJQuery();}';
        $in = str_replace( $match[1], $new_match, $in );
      } else if ( $match[1] === '' && strpos( $match[0], 'src=' ) !== false && strpos( $match[0], 'defer' ) === false ) {
        // linked non-aggregated JS, defer it.
        $new_match = str_replace( '<script ', '<script defer ', $match[0] );
        $in = str_replace( $match[0], $new_match, $in );
      }
    }
  }
  return $in;
}