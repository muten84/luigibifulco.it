<?php 

/**
 * Sublime Video Plugin
 * 
 * @version 2.0
 * @author Bastian Allgeier <http://getkirby.com>
 * 
 */

// shortcut function to add sublime videos to templates and snippets as well.
function sublime($id, $width = false, $height = false, $uid = false, $name = false, $class = false) {
  return kirbytag(array(
    'sublime' => $id,
    'width'   => $width,
    'height'  => $height,
    'uid'     => $uid,
    'name'    => $name,
    'class'   => $class
  ));
}

// kirbytag
kirbytext::$tags['sublime'] = array(
  'attr' => array(
    'width', 
    'height', 
    'uid', 
    'name', 
    'class'
  ),
  'html' => function($tag) {

    $page   = $tag->page();
    $id     = $tag->attr('sublime');
    $class  = $tag->attr('class');
    $videos = array();
    $poster = false;
    
    // gather all video files which match the given id/name    
    foreach($page->videos() as $v) {
      if(preg_match('!^' . preg_quote($id) . '!i', $v->name())) {                          
        $videos[] = $v;
      }
    }

    if(empty($videos)) return false;    

    // find the poster for this video
    foreach($page->images() as $i) {
      if(preg_match('!^' . preg_quote($id) . '!i', $i->name())) {
        $poster = $i;
        break;
      }
    }

    $width  = $tag->attr('width',  c::get('kirbytext.video.width'));
    $height = $tag->attr('height', c::get('kirbytext.video.height'));
    $uid    = $tag->attr('uid', $id);
    $name   = $tag->attr('name', $id);

    $html = new Brick('video');
    $html->attr('width', $width);
    $html->attr('height', $height);
    $html->attr('data-uid', $uid);
    $html->attr('data-name', $name);
    $html->attr('preload', 'none');
    $html->attr('class', trim('video sublime' . $class));

    if($poster) {
      $html->attr('poster', $poster->url());      
    }

    foreach($videos as $video) {

      $source = new Brick('source');
      $source->attr('src', $video->url());
      $source->attr('type', $video->mime());

      if(f::extension($video->name()) == 'hd') {
        $source->attr('data-quality', 'hd');        
      }

      $html->append($source);

    }
        
    return $html;

  }
);