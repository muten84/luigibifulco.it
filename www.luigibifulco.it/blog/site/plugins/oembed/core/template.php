<?php

use Multiplayer\Multiplayer;

class OembedTemplate {

  public static function embed($Media, $autoplay) {
    $Multiplayer = new Multiplayer();

    $defaults = array(
      'autoPlay'       => $autoplay or c::get('oembed.lazyvideo', false),
      'showInfos'      => false,
      'showBranding'   => false,
      'showRelated'    => false,
    );
    $embed = $Multiplayer->html($Media->get('url'), $defaults);

    if (c::get('oembed.lazyvideo', false)) {
      $embed = str_replace(' src="', ' data-src="', $embed);
    }

    return $embed;
  }

  public static function ratio($element, $Media) {
    $ratio = ($Media->get('height') / $Media->get('width')) * 100;
    $element->addClass('oembed-video');
    $element->attr('style','padding-top:'.$ratio.'%');
    return $element;
  }

  public static function thumb($thumbnail) {
    $thumb = new Brick('div');
    $thumb->addClass('thumb');
    $thumb->attr('style','background-image: url('.$thumbnail.')');
    return $thumb;
  }

  public static function play() {
    $play = new Brick('div');
    $play->addClass('play');
    $play->append('<img src="'.url('assets/oembed/oembed-play.png').'" alt="Play">');
    return $play;
  }

  public static function validation($html) {
    $html = str_ireplace(array('webkitallowfullscreen', 'mozallowfullscreen'), '', $html);
    $html = str_ireplace('frameborder="0"', 'seamless', $html);
    $html = str_replace('&','&amp;', str_replace('&amp;', '&', $html));
    return $html;
  }

  public static function parameters($html, $type, $parameters = array()) {
    switch ($type) {
      case 'YouTube':
        if(isset($parameters['jsapi']) and $parameters['jsapi'] !== false) {
          $html = str_ireplace('autoplay=', 'enablejsapi=1&amp;autoplay=', $html);
        }
        break;

      case 'Vimeo':
        if(isset($parameters['jsapi']) and $parameters['jsapi'] !== false) {
          $html = str_ireplace('autoplay=', 'api=1&amp;autoplay=', $html);
        }
        break;

      case 'SoundCloud':
        if(isset($parameters['size']) and $parameters['size'] == 'compact') {
          $html = str_ireplace('height="400"', 'height="140"', $html);
        }
        if(isset($parameters['size']) and $parameters['size'] == 'smaller') {
          $html = str_ireplace('height="400"', 'height="300"', $html);
        }
        if(isset($parameters['visual']) and $parameters['visual'] == 'false') {
          $html = str_ireplace('visual=true', 'visual=false', $html);
        }
        if(isset($parameters['artwork']) and $parameters['artwork'] == 'false') {
          $html = str_ireplace('show_artwork=true', 'show_artwork=false', $html);
        }
        break;

      default:
        break;
    }

    return $html;
  }
}
