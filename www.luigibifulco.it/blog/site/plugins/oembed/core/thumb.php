<?php

class OembedThumb {

  public $thumb   = null;
  public $dir     = null;
  public $caching = false;

  public function __construct($caching) {
    $this->dir     = kirby()->roots()->thumbs();
    if (!file_exists($this->dir)) mkdir($this->dir);

    $this->caching = $caching;
  }

  public function set($thumb) {
    $this->thumb = $thumb;
  }

  public function get($Media) {
    if($this->thumb) return $this->thumb;
    else             return $this->cache($Media->get('thumbnail_url'));
  }

  protected function cache($url) {
    if($this->caching) {

      $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . DS . str_replace(kirby()->roots()->index() . DS, '', $this->dir);

      $key  = array('high' => $this->key($url), 'low' => $this->key(self::lowRes($url)));
      $path = array('high' => $this->path($url), 'low' => $this->path(self::lowRes($url)));

      $this->clearCache($path['high']);
      $this->clearCache($path['low']);

      if($this->cached($path['high'])) {
        return $root . DS . $key['high'];

      } elseif($this->cached($path['low'])) {
        return $root . DS . $key['low'];

      } else {
        $file = $this->loadRemote($url);
        file_put_contents($path[$file['type']], $file['file']);
        return $root . DS . $key[$file['type']];
      }

    } else {
      return $url;
    }
  }

  protected function cached($path) {
    return file_exists($path);
  }

  protected function key($url) {
    return 'oembed_' . md5($url) . '.' . pathinfo($url, PATHINFO_EXTENSION);
  }

  protected function path($url) {
    $path = $this->dir . DS . $this->key($url);
    return $path;
  }

  protected function loadRemote($url) {
    $file = @file_get_contents($url);
    if($file === false) {
      $file = file_get_contents(self::lowRes($url));
      return array('type' => 'low', 'file' => $file);
    }
    return array('type' => 'high', 'file' => $file);
  }

  protected function clearCache($path) {
    $expired = time() - c::get('oembed.cacheexpires', 3600*24);
    if(file_exists($path) and filemtime($path) < $expired) {
      unlink($path);
    }
  }

  public static function lowRes($thumbnail) {
    $thumbnail = str_replace('maxresdefault', 'hqdefault', $thumbnail);
    return $thumbnail;
  }

  public static function highRes($Media) {
    $thumbnail = $Media->get('thumbnail_url');
    $thumbnail = str_replace('hqdefault', 'maxresdefault', $thumbnail);
    $Media->set('thumbnail_url', $thumbnail);
    return $Media;
  }
}
