<?php

class OembedCache {
  public    $dir   = null;
  protected $Cache = null;

  public function __construct($dir = null) {
    $this->dir = $dir ? $dir : kirby()->roots()->cache();
    if (!file_exists($this->dir)) mkdir($this->dir);

    $this->Cache = cache::setup('file', array('root' => $this->dir));
  }

  public function get($url) {
    return $this->Cache->get('oembed-' . md5($url));
  }

  public function set($url, $Media) {
    $expires = c::get('oembed.cacheexpires', 60*24);
    return $this->Cache->set('oembed-' . md5($url), $Media, $expires);
  }
}
