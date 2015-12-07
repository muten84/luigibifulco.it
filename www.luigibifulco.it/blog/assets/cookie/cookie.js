/*!
 * Javascript Cookie v1.5.1
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2014 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	var jQuery;
	if (typeof define === 'function' && define.amd) {
		// AMD (Register as an anonymous module)
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// Node/CommonJS
		try {
			jQuery = require('jquery');
		} catch(e) {}
		module.exports = factory(jQuery);
	} else {
		// Browser globals
		var _OldCookies = window.Cookies;
		var api = window.Cookies = factory(window.jQuery);
		api.noConflict = function() {
			window.Cookies = _OldCookies;
			return api;
		};
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return api.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return api.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(api.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return api.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = api.raw ? s : parseCookieValue(s);
		return isFunction(converter) ? converter(value) : value;
	}

	function extend() {
		var key, options;
		var i = 0;
		var result = {};
		for (; i < arguments.length; i++) {
			options = arguments[ i ];
			for (key in options) {
				result[key] = options[key];
			}
		}
		return result;
	}

	function isFunction(obj) {
		return Object.prototype.toString.call(obj) === '[object Function]';
	}

	var api = function (key, value, options) {

		// Write

		if (arguments.length > 1 && !isFunction(value)) {
			options = extend(api.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setMilliseconds(t.getMilliseconds() + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {},
			// To prevent the for loop in the first place assign an empty array
			// in case there are no cookies at all. Also prevents odd result when
			// calling "get()".
			cookies = document.cookie ? document.cookie.split('; ') : [],
			i = 0,
			l = cookies.length;

		for (; i < l; i++) {
			var parts = cookies[i].split('='),
				name = decode(parts.shift()),
				cookie = parts.join('=');

			if (key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	api.get = api.set = api;
	api.defaults = {};

	api.remove = function (key, options) {
		// Must not alter options, thus extending a fresh object...
		api(key, '', extend(options, { expires: -1 }));
		return !api(key);
	};

	if ( $ ) {
		$.cookie = api;
		$.removeCookie = api.remove;
	}

	return api;
}));

(function ($) {

    $.cookieCuttr = function (options) {

        var defaults = {

            cookieCutter: true, // you'd like to enable the div/section/span etc. hide feature? change this to true

            cookieCutterDeclineOnly: false, // you'd like the CookieCutter to only hide when someone has clicked declined set this to true

            cookieAnalytics: true, // just using a simple analytics package? change this to true

            cookieDeclineButton: true, // this will disable non essential cookies

            cookieAcceptButton: true, // this will disable non essential cookies

            cookieResetButton: false,

            cookieOverlayEnabled: false, // don't want a discreet toolbar? Fine, set this to true

            cookiePolicyLink: '/privacy-policy/', // if applicable, enter the link to your privacy policy here...

            cookieMessage: 'This blog use cookies, you can <a href="{{cookiePolicyLink}}" title="read about our cookies">read about them here</a>. To use the website as intended please...',

            cookieAnalyticsMessage: 'My blog use cookies, just to track visits, there is no store policy for any personal details.',

            cookieErrorMessage: "We\'re sorry, this feature places cookies in your browser and has been disabled. <br>To continue using this functionality, please",

            cookieWhatAreTheyLink: "http://www.allaboutcookies.org/",

            cookieDisable: '',

            cookieExpires: 365,

            cookieAcceptButtonText: "ACCEPT COOKIES",

            cookieDeclineButtonText: "DECLINE COOKIES",

            cookieResetButtonText: "RESET COOKIES FOR THIS WEBSITE",

            cookieWhatAreLinkText: "What are cookies?",

            cookieNotificationLocationBottom: false, // top or bottom - they are your only options, so true for bottom, false for top            

            cookiePolicyPage: false,

            cookiePolicyPageMessage: 'Please read the information below and then choose from the following options',

            cookieDiscreetLink: false,

            cookieDiscreetReset: true,

            cookieDiscreetLinkText: "Cookies?",

            cookieDiscreetPosition: "topleft", //options: topleft, topright, bottomleft, bottomright         

            cookieNoMessage: false, // change to true hide message from all pages apart from your policy page

            cookieDomain: ""

        };

        var options = $.extend(defaults, options);

        var message = defaults.cookieMessage.replace('{{cookiePolicyLink}}', defaults.cookiePolicyLink);

        defaults.cookieMessage = 'We use cookies on this website, you can <a href="' + defaults.cookiePolicyLink + '" title="read about our cookies">read about them here</a>. To use the website as intended please...';

        //convert options

        var cookiePolicyLinkIn = options.cookiePolicyLink;

        var cookieCutter = options.cookieCutter;

        var cookieCutterDeclineOnly = options.cookieCutterDeclineOnly;

        var cookieAnalytics = options.cookieAnalytics;

        var cookieDeclineButton = options.cookieDeclineButton;

        var cookieAcceptButton = options.cookieAcceptButton;

        var cookieResetButton = options.cookieResetButton;

        var cookieOverlayEnabled = options.cookieOverlayEnabled;

        var cookiePolicyLink = options.cookiePolicyLink;

        var cookieMessage = message;

        var cookieAnalyticsMessage = options.cookieAnalyticsMessage;

        var cookieErrorMessage = options.cookieErrorMessage;

        var cookieDisable = options.cookieDisable;

        var cookieWhatAreTheyLink = options.cookieWhatAreTheyLink;

        var cookieExpires = options.cookieExpires;

        var cookieAcceptButtonText = options.cookieAcceptButtonText;

        var cookieDeclineButtonText = options.cookieDeclineButtonText;

        var cookieResetButtonText = options.cookieResetButtonText;

        var cookieWhatAreLinkText = options.cookieWhatAreLinkText;

        var cookieNotificationLocationBottom = options.cookieNotificationLocationBottom;

        var cookiePolicyPage = options.cookiePolicyPage;

        var cookiePolicyPageMessage = options.cookiePolicyPageMessage;

        var cookieDiscreetLink = options.cookieDiscreetLink;

        var cookieDiscreetReset = options.cookieDiscreetReset;

        var cookieDiscreetLinkText = options.cookieDiscreetLinkText;

        var cookieDiscreetPosition = options.cookieDiscreetPosition;

        var cookieNoMessage = options.cookieNoMessage;

        // cookie identifier

        var $cookieAccepted = $.cookie('cc_cookie_accept') == "cc_cookie_accept";

        $.cookieAccepted = function () {

            return $cookieAccepted;

        };

        var $cookieDeclined = $.cookie('cc_cookie_decline') == "cc_cookie_decline";

        $.cookieDeclined = function () {

            return $cookieDeclined;

        };

        // write cookie accept button

        if (cookieAcceptButton) {

            var cookieAccept = ' <a href="#accept" class="cc-cookie-accept">' + cookieAcceptButtonText + '</a> ';

        } else {

            var cookieAccept = "";

        }

        // write cookie decline button

        if (cookieDeclineButton) {

            var cookieDecline = ' <a href="#decline" class="cc-cookie-decline">' + cookieDeclineButtonText + '</a> ';

        } else {

            var cookieDecline = "";

        }

        // write extra class for overlay

        if (cookieOverlayEnabled) {

            var cookieOverlay = 'cc-overlay';

        } else {

            var cookieOverlay = "";

        }

        // to prepend or append, that is the question?

        if ((cookieNotificationLocationBottom) || (cookieDiscreetPosition == "bottomright") || (cookieDiscreetPosition == "bottomleft")) {

            var appOrPre = true;

        } else {

            var appOrPre = false;

        }

        if (($cookieAccepted) || ($cookieDeclined)) {

            // write cookie reset button

            if ((cookieResetButton) && (cookieDiscreetReset)) {

                if (appOrPre) {

                    $('body').append('<div class="cc-cookies cc-discreet"><a class="cc-cookie-reset" href="#" title="' + cookieResetButtonText + '">' + cookieResetButtonText + '</a></div>');

                } else {

                    $('body').prepend('<div class="cc-cookies cc-discreet"><a class="cc-cookie-reset" href="#" title="' + cookieResetButtonText + '">' + cookieResetButtonText + '</a></div>');

                }

                //add appropriate CSS depending on position chosen

                if (cookieDiscreetPosition == "topleft") {

                    $('div.cc-cookies').css("top", "0");

                    $('div.cc-cookies').css("left", "0");

                }

                if (cookieDiscreetPosition == "topright") {

                    $('div.cc-cookies').css("top", "0");

                    $('div.cc-cookies').css("right", "0");

                }

                if (cookieDiscreetPosition == "bottomleft") {

                    $('div.cc-cookies').css("bottom", "0");

                    $('div.cc-cookies').css("left", "0");

                }

                if (cookieDiscreetPosition == "bottomright") {

                    $('div.cc-cookies').css("bottom", "0");

                    $('div.cc-cookies').css("right", "0");

                }

            } else if (cookieResetButton) {

                if (appOrPre) {

                    $('body').append('<div class="cc-cookies"><a href="#" class="cc-cookie-reset">' + cookieResetButtonText + '</a></div>');

                } else {

                    $('body').prepend('<div class="cc-cookies"><a href="#" class="cc-cookie-reset">' + cookieResetButtonText + '</a></div>');

                }

            } else {

                var cookieResetButton = "";

            }

        } else {

            // add message to just after opening body tag

            if ((cookieNoMessage) && (!cookiePolicyPage)) {

                // show no link on any pages APART from the policy page

            } else if ((cookieDiscreetLink) && (!cookiePolicyPage)) { // show discreet link

                if (appOrPre) {

                    $('body').append('<div class="cc-cookies cc-discreet"><a href="' + cookiePolicyLinkIn + '" title="' + cookieDiscreetLinkText + '">' + cookieDiscreetLinkText + '</a></div>');

                } else {

                    $('body').prepend('<div class="cc-cookies cc-discreet"><a href="' + cookiePolicyLinkIn + '" title="' + cookieDiscreetLinkText + '">' + cookieDiscreetLinkText + '</a></div>');

                }

                //add appropriate CSS depending on position chosen

                if (cookieDiscreetPosition == "topleft") {

                    $('div.cc-cookies').css("top", "0");

                    $('div.cc-cookies').css("left", "0");

                }

                if (cookieDiscreetPosition == "topright") {

                    $('div.cc-cookies').css("top", "0");

                    $('div.cc-cookies').css("right", "0");

                }

                if (cookieDiscreetPosition == "bottomleft") {

                    $('div.cc-cookies').css("bottom", "0");

                    $('div.cc-cookies').css("left", "0");

                }

                if (cookieDiscreetPosition == "bottomright") {

                    $('div.cc-cookies').css("bottom", "0");

                    $('div.cc-cookies').css("right", "0");

                }

            } else if (cookieAnalytics) { // show analytics overlay

                if (appOrPre) {

                    $('body').append('<div class="cc-cookies ' + cookieOverlay + '">' + cookieAnalyticsMessage + cookieAccept + cookieDecline + '<a href="' + cookieWhatAreTheyLink + '" title="Visit All about cookies (External link)">' + cookieWhatAreLinkText + '</a></div>');

                } else {

                    $('body').prepend('<div class="cc-cookies ' + cookieOverlay + '">' + cookieAnalyticsMessage + cookieAccept + cookieDecline + '<a href="' + cookieWhatAreTheyLink + '" title="Visit All about cookies (External link)">' + cookieWhatAreLinkText + '</a></div>');

                }

            }

            if (cookiePolicyPage) { // show policy page overlay

                if (appOrPre) {

                    $('body').append('<div class="cc-cookies ' + cookieOverlay + '">' + cookiePolicyPageMessage + " " + ' <a href="#accept" class="cc-cookie-accept">' + cookieAcceptButtonText + '</a> ' + ' <a href="#decline" class="cc-cookie-decline">' + cookieDeclineButtonText + '</a> ' + '</div>');

                } else {

                    $('body').prepend('<div class="cc-cookies ' + cookieOverlay + '">' + cookiePolicyPageMessage + " " + ' <a href="#accept" class="cc-cookie-accept">' + cookieAcceptButtonText + '</a> ' + ' <a href="#decline" class="cc-cookie-decline">' + cookieDeclineButtonText + '</a> ' + '</div>');

                }

            } else if ((!cookieAnalytics) && (!cookieDiscreetLink)) { // show privacy policy option

                if (appOrPre) {

                    $('body').append('<div class="cc-cookies ' + cookieOverlay + '">' + cookieMessage + cookieAccept + cookieDecline + '</div>');

                } else {

                    $('body').prepend('<div class="cc-cookies ' + cookieOverlay + '">' + cookieMessage + cookieAccept + cookieDecline + '</div>');

                }

            }

        }

        if ((cookieCutter) && (!cookieCutterDeclineOnly) && (($cookieDeclined) || (!$cookieAccepted))) {

            $(cookieDisable).html('<div class="cc-cookies-error">' + cookieErrorMessage + ' <a href="#accept" class="cc-cookie-accept">' + cookieAcceptButtonText + '</a> ' + '</div>');

        }

        if ((cookieCutter) && (cookieCutterDeclineOnly) && ($cookieDeclined)) {

            $(cookieDisable).html('<div class="cc-cookies-error">' + cookieErrorMessage + ' <a href="#accept" class="cc-cookie-accept">' + cookieAcceptButtonText + '</a> ' + '</div>');

        }

        // if bottom is true, switch div to bottom if not in discreet mode

        if ((cookieNotificationLocationBottom) && (!cookieDiscreetLink)) {

            $('div.cc-cookies').css("top", "auto");

            $('div.cc-cookies').css("bottom", "0");

        }

        if ((cookieNotificationLocationBottom) && (cookieDiscreetLink) && (cookiePolicyPage)) {

            $('div.cc-cookies').css("top", "auto");

            $('div.cc-cookies').css("bottom", "0");

        }

        // setting the cookies



        // for top bar

        $('.cc-cookie-accept, .cc-cookie-decline').click(function (e) {

            e.preventDefault();

            if ($(this).is('[href$=#decline]')) {

                $.cookie("cc_cookie_accept", null, {

                    path: '/'

                });

                $.cookie("cc_cookie_decline", "cc_cookie_decline", {

                    expires: cookieExpires,

                    path: '/'

                });

                if (options.cookieDomain) {

                    // kill google analytics cookies

                    $.cookie("__utma", null, {

                        domain: '.' + options.cookieDomain,

                        path: '/'

                    });

                    $.cookie("__utmb", null, {

                        domain: '.' + options.cookieDomain,

                        path: '/'

                    });

                    $.cookie("__utmc", null, {

                        domain: '.' + options.cookieDomain,

                        path: '/'

                    });

                    $.cookie("__utmz", null, {

                        domain: '.' + options.cookieDomain,

                        path: '/'

                    });

                }

            } else {

                $.cookie("cc_cookie_decline", null, {

                    path: '/'

                });

                $.cookie("cc_cookie_accept", "cc_cookie_accept", {

                    expires: cookieExpires,

                    path: '/'

                });

            }

            $(".cc-cookies").fadeOut(function () {

                // reload page to activate cookies

                location.reload();

            });

        });

        //reset cookies

        $('a.cc-cookie-reset').click(function (f) {

            f.preventDefault();

            $.cookie("cc_cookie_accept", null, {

                path: '/'

            });

            $.cookie("cc_cookie_decline", null, {

                path: '/'

            });

            $(".cc-cookies").fadeOut(function () {

                // reload page to activate cookies

                location.reload();

            });

        });

        //cookie error accept

        $('.cc-cookies-error a.cc-cookie-accept').click(function (g) {

            g.preventDefault();

            $.cookie("cc_cookie_accept", "cc_cookie_accept", {

                expires: cookieExpires,

                path: '/'

            });

            $.cookie("cc_cookie_decline", null, {

                path: '/'

            });

            // reload page to activate cookies

            location.reload();

        });

    };

})(jQuery);