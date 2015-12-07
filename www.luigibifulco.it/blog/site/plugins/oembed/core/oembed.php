<?php

require 'autoload.php';
require 'cache.php';
require 'thumb.php';
require 'template.php';

spl_autoload_register('OembedAutoload::autoload');


use Essence\Essence;

class OEmbed {

  public $url      = null;
  public $thumb    = null;
  public $autoplay = false;
  public $caching  = false;

  protected $media    = null;
  protected $Essence  = null;
  protected $Cache    = null;


  public function __construct($url) {
    $this->url      = $url;

    $this->caching  = c::get('oembed.caching', false);
    if($this->caching) $this->Cache = new OembedCache();

    $this->thumb    = new OembedThumb($this->caching);
    $this->Essence  = new Essence();

  }


  public function get($parameters) {
    if($oembed = $this->media()) {
      $class = isset($parameters['class']) ? $parameters['class'] : false;
      $html  = $this->template($class);
      $html  = OembedTemplate::parameters($html, $oembed->get('providerName'), $parameters);
      return $html;

    } else {
      return $this->url;
    }
  }


  protected function media() {
    if($this->media === null) {
      if($this->caching) $Media = $this->cache();
      if(!isset($Media) or $Media == null) {
          $Media = $this->create();
          if($this->caching) $this->cache($Media);
      }
      $this->media = $Media;
    }
    return $this->media;
  }


  protected function create() {
    $Media = $this->Essence->extract($this->url);
    if($Media) $Media = OembedThumb::highRes($Media);
    return $Media;
  }


  protected function cache($Media = null) {
    if($Media) return $this->Cache->set($this->url, $Media);
    else       return $this->Cache->get($this->url);
  }


  protected function template($class = false) {
    $output = new Brick('div');
    $output->addClass('oembed');
    if($class !== false) {
      $output->addClass($class);
    } else {
      $output->addClass('oembed-'.substr(md5($this->url), 0, 6));
    }

    if ($this->media->get('type') === 'video') {
      $output = OembedTemplate::ratio($output, $this->media);

      if (c::get('oembed.lazyvideo', false)) {
        $output->addClass('oembed-lazyvideo');
      }

      $play  = OembedTemplate::play();
      $output->append($play);
      $thumb = OembedTemplate::thumb($this->thumb->get($this->media()));
      $output->append($thumb);

      $html = OembedTemplate::embed($this->media, $this->autoplay);

    } else {
      $html = $this->media->get('html');
    }

    $html = OembedTemplate::validation($html);
    $output->append($html);

    return $output;
  }

}



