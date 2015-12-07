<?php

require 'core/oembed.php';

/**
 * oEmbed field method: $page->video()->oembed()
 */
field::$methods['oembed'] = function($field, $args = array()) {
  $oembed = new OEmbed($field->value);

  // autoplay setting
  if((isset($args['autoplay']) and $args['autoplay'] == true) or c::get('oembed.autoplay', false)) {
    $oembed->autoplay = true;
  }

  // custom thumbnail
  if (isset($args['thumbnail'])) {
    $oembed->thumb->set($args['thumbnail']);
  }

  return $oembed->get($args);
};


/**
 * oEmbed Kirbytext tag: (oembed: https://youtube.com/watch?v=wZZ7oFKsKzY)
 */
kirbytext::$tags['oembed'] = array(
  'attr' => array(
      'class',
      'thumb',
      'autoplay',
      'artwork',
      'visual',
      'size',
      'color',
      'jsapi',
  ),
  'html' => function($tag) {
    $args = array(
      'class'   => $tag->attr('class', false),
      'artwork' => $tag->attr('artwork', c::get('oembed.defaults.artwork', 'true')),
      'visual'  => $tag->attr('visual', c::get('oembed.defaults.visual', 'true')),
      'size'    => $tag->attr('size', c::get('oembed.defaults.size', 'default')),
      'jsapi'   => $tag->attr('jsapi', false)
    );

    $oembed = new OEmbed($tag->attr('oembed'));

    // autoplay setting
    if($tag->attr('autoplay', c::get('oembed.autoplay', false)) == 'true') {
      $oembed->autoplay = true;
    }

    // custom thumbnail
    if($tag->attr('thumb', false)) {
      $oembed->thumb->set($tag->file($tag->attr('thumb'))->url());
    }

    return $oembed->get($args);
  }
);


