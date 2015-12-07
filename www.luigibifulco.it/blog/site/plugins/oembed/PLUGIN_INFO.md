This plugin extends [Kirby CMS](http://getkirby.com) with some basic [oEmbed](http://oembed.com) functionalities. It enables Kirby to display embeds of several media sites (e.g. YouTube, Vimeo, Soundcloud) by only providing the URL to the medium. The plugin also includes some [options](#Options) to reduce the site loading time by using lazy videos as well as extensive caching.

**Requires:** PHP 5.5+


# Installation
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


# Usage
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

![In the panel](http://distantnative.com/remote/github/kirby-oembed-github-example1.png)

![On the front](http://distantnative.com/remote/github/kirby-oembed-github-example2.png)

![On the front playing](http://distantnative.com/remote/github/kirby-oembed-github-example3.png)


# Options

You can find the full information and documentation of all options over at the [Github repository](https://github.com/distantnative/oembed).
