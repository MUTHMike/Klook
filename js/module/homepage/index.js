define(["jquery", "UTILS", "sticky", "modernizr", "heroSlideshow", "lazyloading"], function(e, t, n) {
    var r = function(t) {
        var n, r, i, s, o, u, a, f, l, c, h = function() {
            a.toggleClass("icon-cancel").toggleClass("icon-align-left"), a.hasClass("icon-cancel") ? i.show() : i.hide()
        }, p = function() {
            o.show(), f.show();
            if (Modernizr.mq("(max-width: 678px)"))
                o.insertAfter(r).css({position: "relative"}), l.css({"padding-left": 0, "max-width": "auto"}), f.insertAfter(o);
            else {
                o.insertAfter(a).css({position: "absolute"}), f.insertAfter(o);
                var e = Math.min(n.width(), 1024), t = c.offset().left;
                l.css({"padding-left": t, "max-width": e * .8 + t}), s.css({width: Math.max(0, n.width() - 5 - u.width() - l.outerWidth())})
            }
        }, d = function() {
            window.picturefill();
            var e = r.find("img.lazyhero");
            e.lazyload({effect: "fadeIn", load: function() {
                    r.removeClass("hero-loading"), e.removeClass("lazyhero")
                }}), r.heroSlideshow({showArrows: !1})
        }, v = function() {
            var t = f.find(".homepage-grid-title"), n = t.find(".title"), i = n.find(".arrow-down"), s = e(".grid-block").eq(0);
            e(window).on("scroll.homepage resize.homepage touchmove.homepage", function() {
                var t = e(window).innerHeight() - (s.offset().top - e(window).scrollTop());
                t /= s.outerHeight(), i.fadeTo(0, 1 - t)
            }), n.off().on("click", function(n) {
                n.preventDefault();
                var i = Math.max(f.offset().top + 1, r.outerHeight() + t.outerHeight());
                e("html, body").animate({scrollTop: i})
            })
        };
        e(window).off(".homepage"), e(function() {
            n = e(".contents-wrapper"), r = e("div.homepage-hero-b", n), i = e(".homepage-copyright-wrapper", n), o = e(".homepage-hero-bar", n), s = e(".homepage-hero-filler", n), u = e(".homepage-overview-button", n), a = e(".toggle-caption", n), f = e(".homepage-grid-title-wrapper", n), l = e(".homepage-title", n), c = e(".logo").not(".logo-hidden"), e(".homepage-bar-wrapper", n).stick({verticalTopLimit: 340}), a.off("click").on("click", function(e) {
                e.preventDefault(), h()
            }), h(), e(window).on("resize.homepage", p), p();
            var t = setInterval(function() {
                document.readyState === "complete" && (d(), clearInterval(t))
            }, 10);
            v()
        })
    };
    return{start: r}
});