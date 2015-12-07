![oEmbed for Kirby CMS](http://distantnative.com/remote/github/kirby-oembed-github.png)  
[![Release](https://img.shields.io/github/release/distantnative/oembed.svg)](https://github.com/distantnative/oembed/releases) [![Issues](https://img.shields.io/github/issues/distantnative/oembed.svg)](https://github.com/distantnative/oembed/issues) [![License](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://raw.githubusercontent.com/distantnative/oembed/master/LICENSE)
[![Moral License](https://img.shields.io/badge/buy-moral_license-8dae28.svg)](https://gumroad.com/l/kirby-oembed)

This plugin extends [Kirby CMS](http://getkirby.com) with some basic [oEmbed](http://oembed.com) functionalities. It enables Kirby to display embeds of several media sites (e.g. YouTube, Vimeo, Soundcloud) by only providing the URL to the medium. The plugin also includes some [options](#Options) to reduce the site loading time by using lazy videos as well as extensive caching.

It is built on the [Essence](https://github.com/essence) libraries.

**Requires:** PHP 5.5+ (looking into a more compatible solution)


The plugin is free, but I'd appreciate if you'd support me with a [moral license](https://gumroad.com/l/kirby-oembed)!


# Table of Contents
1. [Installation](#Installation)
2. [Usage](#Usage)
3. [Options](#Options)
4. [Examples](#Usage)
5. [Help & Improve](#Help)
6. [Version History](#VersionHistory)


# Installation <a id="Installation"></a>
1. Download [oEmbed](https://github.com/distantnative/oembed/zipball/master/)
2. Copy the files to `site/plugins/oembed/` 
3. Copy the contents of `assets` to `assets/oembed/`
4. Add CSS link to your header (e.g. `site/snippets/header.php`):
```php
echo css('assets/oembed/oembed.css');
```

**If lazy video [option](#Options) is active:**    
5. Add the following JS links to your header (e.g. `site/snippets/header.php`):
```php
echo js(array(
  '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', // requires jQuery
  'assets/oembed/oembed.min.js'
));
```

Instead of including additional CSS and JS links inside your header, you can also include the contents of `assets/oembed.css` and `assets/oembed.js` in your existing CSS and JS files.

### Update
1. Replace the `site/plugins/oembed` and  `assets/oembed` directories with recent version
2. Delete `site/cache/oembed` and `thumbs/oembed`


# Usage <a id="Usage"></a>
**Inside Kirbytext:**  
Use the Kirbytag `(oembed: url)` with the url referring to a supported medium (e.g. YouTube, Vimeo, Soundcloud).
```
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
(oembed: https://www.youtube.com/watch?v=wZZ7oFKsKzY)
```

**Inside templates:**  
Use the field method `->oembed()` on fields that contain an url reffering to a supported medium (e.g. YouTube, Vimeo, Soundcloud).
```php
<?php echo $page->featured_video()->oembed(); ?>
```


# Options <a id="Options"></a>
There are a few options you can set globally for Kirby oEmbed in `site/config/config.php`:
```php
c::set('oembed.autoplay', true);
c::set('oembed.lazyvideo', true);
c::set('oembed.caching', false);
c::set('oembed.cacheexpires', 3600*24);
```
- **oembed.autoplay**:  
Videos start playing automatically after page loaded. Can also be used on a per-tag basis: `(oembed: https://youtube.com/watch?v=wZZ7oFKsKzY autoplay: true)`
- **oembed.lazyvideo**:  
Only after clicking on the thumbnail, the embed (iframe, object) is loaded (default: false)
- **oembed.caching**:  
Enable/disable caching of embed HTML and video thumbnails (default: false)
- **oembed.cacheexpires**:  
Duration after the cached thumbnails expire in seconds (default: 3600)

### Optional parameters
There are a few optional parameters for some media sites. For the Kirbytext tag you can use them in the following way:
 
```
(oembed: https://youtube.com/watch?v=wZZ7oFKsKzY size: smaller)
```

And for the field method `->oembed()`:
```php
<?php echo $page->featured_video()->oembed(array('size' => 'smaller')); ?>
```

The following parameters are available so far:
- **all providers''
    - class
- **YouTube**
    - jsapi (true/false)
- **Vimeo**
    - jsapi (true/false)
- **SoundCloud**
    - size (default/smaller/compact)
    - visual (true/false)
    - artwork (true/false)

You can set these parameters also globally for all oEmbed Kirbytext tags that do not specifiy the parameter themselves in `site/config/config.php`:
```php
c::get('oembed.defaults.visual', 'true');
c::get('oembed.defaults.artwork', 'true');
c::get('oembed.defaults.size', 'compact');
```


# Examples <a id="Examples"></a>
### Blog: Featured Video
Embed featured videos to your blog posts. The URL to the video (e.g. on YouTube or Vimeo) is stored in a field called ´video´ in this example.
```php
// site/snippets/article.php
<article>
  <aside class="entry-meta">...</aside>
  <div class="entry-main">
    <?php if($post->video()!=''): ?>
      <figure class="entry-cover"><?php echo $post->video()->oembed(); ?></figure>
    <?php endif; ?>
    <div class="entry-content"><?php echo $post->text()->kt(); ?></div>
  </div>
</article>
```

![In the panel](http://distantnative.com/remote/github/kirby-oembed-github-example1.png)

![On the front](http://distantnative.com/remote/github/kirby-oembed-github-example2.png)

![On the front playing](http://distantnative.com/remote/github/kirby-oembed-github-example3.png)


# Help & Improve <a id="Help"></a>
*If you have any suggestions for further configuration options, [please let me know](https://github.com/distantnative/oembed/issues/new).*


# Version history <a id="VersionHistory"></a>
**1.0**
- Restructured plugin files and renamed repository to `oembed`
- Updated Essence library to v3
- Added custom class option and default container classes
- Added `jsapi` option
- Improved frameborder handling and validation
- Better thumb caching and low res fallback
- Better cache and thumb dir handling
- Autoplay only on lazyload or with `autoplay` option
- Enhanced CSS browser support

**0.7**
- File structure of plugin repository changed
- Improved HTML validation of plugin output

