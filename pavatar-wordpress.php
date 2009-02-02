<?php

/*
Plugin Name: Pavatar
Version: 0.3
Description: Displays a Pavatar avatar anywhere that get_avatar() is used (contact your theme's author if your theme lacks support).
Plugin URI: http://sourceforge.net/projects/pavatar
 */

include '_pavatar.inc.php';

function _pavatar_wordpress_give_avatar()
{
  global $comment, $_pavatar_email;

  if ($comment)
  {
    $url = get_comment_author_url();
    $_pavatar_email = get_comment_author_email();
  }
  else
  {
    $url = get_the_author_url();
    $_pavatar_email = get_the_author_email();
  }

  _pavatar_init($url);

  return _pavatar_getPavatarCode($url);
}

function _pavatar_wordpress_init()
{
  global $_pavatar_use_gravatar;
  $_pavatar_use_gravatar = true;
}

add_action('init', '_pavatar_wordpress_init');
add_action('wp_footer', '_pavatar_cleanFiles');

add_filter('get_avatar', '_pavatar_wordpress_give_avatar');
