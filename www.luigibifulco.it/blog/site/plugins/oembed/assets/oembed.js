$(function() {
  $('.oembed-video .thumb, .oembed-video .play').click(function() {
    var wrapper = $(this).parent();
    var embed = wrapper.find('iframe, object');
    embed.attr('src', embed.attr('data-src'));
    embed.css({'display' : 'block'});
    wrapper.find('.play, .thumb').remove();
  });
});

