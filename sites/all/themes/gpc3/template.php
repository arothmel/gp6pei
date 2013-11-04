<?php
// $Id: template.php,v 1.21 2009/08/12 04:25:15 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to gpc3_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: gpc3_breadcrumb()
 *
 *   where gpc3 is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/**
 * Implementation of HOOK_theme().
 */
function gpc3_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function gpc3_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */

function gpc3_preprocess_page(&$vars, $hook) {
  global $user;
  $css = array();
  $newcss = array();
  $uri = $_SERVER['REQUEST_URI'];

  if (!empty($vars['banner'])) {
    $vars['body_classes'] .= ' banner ';
  }

  // Dynamic page layout - a subset of pages are liquid layout vs fixed layout.

  $liquid = FALSE;

  if (arg(0) == "civicrm") {
    $liquid = TRUE;
    if (strpos($uri, "contribute/transact")) {
      $liquid = FALSE;
    }
    else if (strpos($uri, "profile/create")) {
      $liquid = FALSE;
    }
  }

  if ($liquid) {
    $css = drupal_add_css(NULL, 'theme', 'all', FALSE);
    //rebuild the themes css array
    foreach ($css['all']['theme'] as $key => $value) {
      if ($key == 'sites/all/themes/gpc3/css/layout-fixed.css') {
        $newcss['sites/all/themes/gpc3/css/layout-liquid.css'] = TRUE;
      }
      else {
        $newcss[$key] = TRUE;
      }
    }
    $css['all']['theme'] = $newcss;
    $vars['styles'] = drupal_get_css($css);
    $vars['layout'] = 'liquid';
    $vars['body_classes'] .= ' liquid-layout ';
  }
  else {
    $vars['layout'] = 'fixed';
    $vars['body_classes'] .= ' fixed-layout ';
  }

  // DEV HACKS
  if (arg(1) == "12383" || arg(1) == "12384") {
    unset($vars['breadcrumb']);
  }

  //if ($user->uid == 21) { dvm( $css); }
  }
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function gpc3_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // gpc3_preprocess_node_page() or gpc3_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function gpc3_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function gpc3_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function gpc3_breadcrumb($breadcrumb) {
  // Determine if we are to display the breadcrumb.
  $show_breadcrumb = theme_get_setting('zen_breadcrumb');
  if ($show_breadcrumb == 'yes' || $show_breadcrumb == 'admin' && arg(0) == 'admin') {

    // Optionally get rid of the homepage link.
    $show_breadcrumb_home = theme_get_setting('zen_breadcrumb_home');
    if (!$show_breadcrumb_home) {
      array_shift($breadcrumb);
    }

    // Return the breadcrumb with separators.
    if (!empty($breadcrumb)) {
      $breadcrumb_separator = theme_get_setting('zen_breadcrumb_separator');
      $trailing_separator = $title = '';
      if (theme_get_setting('zen_breadcrumb_title')) {
        $trailing_separator = $breadcrumb_separator;
        $title = drupal_get_title();
      }
      elseif (theme_get_setting('zen_breadcrumb_trailing')) {
        $trailing_separator = $breadcrumb_separator;
      }
      return '<div class="breadcrumb"><span class="breadcrumb-inner">' . implode($breadcrumb_separator, $breadcrumb) . "$trailing_separator$title</span></div>";
    }
  }
  // Otherwise, return an empty string.
  return '';
}


function gpc3_get_riding_from_url() {
  global $user;
  $uri = $_SERVER['REQUEST_URI'];
  $uri = str_replace("index.php?q=", "", $uri);  //removes the query string if clean urls are broken!
  $section = explode("/", $uri);
  if ($section[1] == 'en' || $section[1] == 'fr') {
    array_shift($section);
  }

  if (($section[1]=="campaign" || $section[1]=="riding") && is_numeric($section[2])) {
    return $section[2];
  } else {
    return NULL;
  }
}

function phptemplate_webform_mail_message_10198($form_values, $node, $sid, $cid) {
  return _phptemplate_callback('webform-mail-10198', array('form_values' => $form_values, 'node' => $node, 'sid' => $sid, 'cid' => $cid));
}

function gpc3_menu_item_link($link) {
  global $user;
  //dvm($link);
  
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }

  // If an item is a LOCAL TASK, render it as a tab
  if ($link['type'] & MENU_IS_LOCAL_TASK) {
    $link['title'] = '<span class="tab">' . check_plain($link['title']) . '</span>';
    $link['localized_options']['html'] = TRUE;
  }

  //Menu overrides
  if ($link['title']=="Donate" || $link['title']=="Donnez") {
    //if ($user->uid == 21) { dpm($link); }
    if ($rid = gpc3_get_riding_from_url()) {
      $link['href'] = str_replace("&source=Main_Menu", ("&source=FSA-" . $rid), $link['href']);  //removes the old source!
      $link['href'] = str_replace("&id=1", "&id=6", $link['href']);  //swaps in the local donation page ID
    }
  }
  else if ($link['mlid'] == '11701') {
  	if ($user->uid) {
  		$link['title'] = t('My Account');
  	} else {
  		$link['title'] = t('Login');
  	}
  }
  else if ($link['mlid'] == '11703') {
  	if ($user->uid) {
  	} else {
  		return NULL;
  	}
  }
  
  if ($link['in_active_trail']) {
    $link['options']['attributes']['class'] .=  ' active';
  }

  return l($link['title'], $link['href'], $link['localized_options']);
}

function gpc3_links($links, $attributes = array('class' => 'links')) {
  global $language;
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language->language)) {
        $class .= ' active';
      }
      $output .= '<li'. drupal_attributes(array('class' => $class)) .'>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        if (!empty($key) && $key == 'header-donate') {
          $output .= '<a title="'. $link['title'] .'" href="'. $link['href'] .'"><img src="/'. path_to_theme() .'/images/donate_now_'. $language->language .'.png"></a>';
        } else if ($link['attributes']['class'] == 'header-language-link' && ($key == 'en' || $key == 'fr')) {
          $output .= '<a title="'. $link['title'] .'" href="/'. $key .'/'. $link['href'] .'"><img src="/'. path_to_theme() .'/images/lang_switch_'. $key .'.png"></a>';
        } else {
          $output .= l($link['title'], $link['href'], $link);
        }
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

