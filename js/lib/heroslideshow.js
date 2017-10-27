define(["jquery", "modernizr"], function(e) {
    return e.fn.heroSlideshow = function(t) {
        function o(t, s) {
            this.options = t, this.container = s, this.index = 0, this.id = this.container.attr("id"), this.mv = !1, this.id || (this.id = this.container.data("id")), this.imgs = this.container.find("img,.hero-video").not(".no-hero-slideshow").hide().data("slideshow-trigger", !1);
            if (i)
                for (var o in r)
                    r.hasOwnProperty(o) && this.imgs.filter("img").css(r[o], "translateZ(0)");
            this.imgs.eq(this.index).show().is(".hero-video") ? this.container.addClass("slide-video") : this.container.removeClass("slide-video"), e(this.imgs.get().reverse()).each(e.proxy(function(t, n) {
                e(n).css("z-index", t + 1)
            }, this));
            var a = e([]);
            this.nav = {prev: e('<div class="slideshow-prev"><i class="icon-angle-left"></i></div>'), next: e('<div class="slideshow-next"><i class="icon-angle-right"></i></div>'), caption: this.container.find(".caption"), overlay: this.container.find(".hero-caption-overlay"), index: a, dots: a, fullscreen: a, download: a};
            var f = e('[data-for="detail-hero-image"]');
            f.size() && (this.nav.index = f.find(".slideshow-slide span"), this.nav.dots = f.find(".slideshow-paging .nav"), this.nav.fullscreen = f.find(".slideshow").not(".download"), this.nav.download = f.find(".slideshow.download")), this.container.append(this.nav.prev, this.nav.next), this.nav.prev.off().on("click", e.proxy(function(e) {
                e.preventDefault(), this.mv || this.prev()
            }, this)), this.nav.next.off().on("click", e.proxy(function(e) {
                e.preventDefault(), this.mv || this.next()
            }, this)), this.nav.dots.off("click").on("click", e.proxy(function(t) {
                t.preventDefault(), t.stopPropagation(), t.stopImmediatePropagation();
                var n = e(t.currentTarget).index();
                this.show(n)
            }, this)), this.nav.fullscreen.attr("href", "").off().on("click", e.proxy(function(e) {
                e.preventDefault(), e.stopPropagation(), e.stopImmediatePropagation();
                if (window.slideshow && window.slideshow.length > 0) {
                    for (var t = 0; t < window.heroSlideshow.length; t++)
                        window.heroSlideshow[t].pauseVideos(), n && window.heroSlideshow[t].resetVideos();
                    window.slideshow[0].open(this.index)
                }
            }, this)), n && (u.call(this), this.options.showArrows = !1), this.options.showArrows ? (this.container.on("mouseenter", e.proxy(function() {
                this.nav.prev.add(this.nav.next).fadeTo(t.animDuration, 1)
            }, this)).on("mouseleave", e.proxy(function() {
                this.nav.prev.add(this.nav.next).fadeTo(t.animDuration, 0)
            }, this)), this.nav.prev.add(this.nav.next).on("mouseenter", function() {
                e(this).find("i").fadeTo(t.animDuration, 1)
            }).on("mouseleave", function() {
                e(this).find("i").fadeTo(t.animDuration, .5)
            })) : this.nav.prev.add(this.nav.next).show().find("i").remove()
        }
        function u(t) {
            t || (t = this.container);
            var n = {x: 0, y: 0}, s = {}, o = !1, u = !1, a = 10, f = 5, l = function(e) {
                if (o)
                    return!0;
                var t = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                n = {x: t.pageX, y: t.pageY}, this.mv = !1
            }, c = function(e) {
                if (o || u)
                    return;
                var t = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                if (!this.mv)
                    if (t.pageX < n.x - a || t.pageX > n.x + a)
                        this.mv = !0, this.imgs.find("iframe").css("pointer-events", "none"), s.current = this.imgs.eq(this.index).css("z-index", 1), s.prev = this.imgs.eq(this.index - 1 < 0 ? this.imgs.size() - 1 : this.index - 1).css("left", -s.current.width() + "px"), s.next = this.imgs.eq(this.index + 1 > this.imgs.size() - 1 ? 0 : this.index + 1).css("left", s.current.width() + "px"), s.all = s.current.add(s.prev).add(s.next), s.prev.add(s.next).css({position: "absolute", top: 0, width: s.current.width() + "px", height: s.current.height() + "px", zIndex: 0}).show().fadeTo(0, 1);
                    else if (t.pageY < n.y - f || t.pageY > n.y + f) {
                        u = !0;
                        return
                    }
                if (this.mv) {
                    e.preventDefault();
                    var l = t.pageX - n.x;
                    for (var c in r)
                        r.hasOwnProperty(c) && s.all.css(r[c], i ? "translate3d(" + l + "px,0,0)" : "translate(" + l + "px,0)")
                }
            }, h = function(t) {
                u = !1, this.imgs.find("iframe").css("pointer-events", "auto");
                if (o || !this.mv)
                    return!0;
                var a = t.originalEvent.touches[0] || t.originalEvent.changedTouches[0], f = a.pageX - n.x, l = Math.abs(f), c = s.current.width(), h = s.current, p = 0, d = this.options.animDuration * 1.5 * l / c;
                Math.abs(f) >= c / 3 && (h = f > 0 ? s.prev : s.next, p = f > 0 ? c : -c, d = this.options.animDuration * 1.5 * (c - l) / c), o = !0, e({a: f}).animate({a: p}, {duration: d, step: function(e) {
                        for (var t in r)
                            r.hasOwnProperty(t) && s.all.css(r[t], i ? "translate3d(" + e + "px,0,0)" : "translate(" + e + "px,0)")
                    }, complete: e.proxy(function() {
                        s.all.not(h.css("display", "block")).hide();
                        for (var t in r)
                            r.hasOwnProperty(t) && s.all.css(r[t], i ? "translateZ(0)" : "");
                        s.all.css({position: "", width: "", height: "", zIndex: "", left: ""}), this.index = this.imgs.index(h), this.show(this.index), setTimeout(e.proxy(function() {
                            this.mv = !1, o = !1
                        }, this), 0)
                    }, this)})
            };
            t.on("touchstart", e.proxy(l, this)).on("touchmove", e.proxy(c, this)).on("touchend touchcancel", e.proxy(h, this))
        }
        window.heroSlideshow = [];
        var n = window.Modernizr ? window.Modernizr.touch : "ontouchstart"in window, r = {webkitTransform: "-webkit-transform", OTransform: "-o-transform", msTransform: "-ms-transform", MozTransform: "-moz-transform", transform: "transform"}, i = function() {
            var e = document.createElement("p"), t, n = {};
            document.body.insertBefore(e, null);
            for (var i in r)
                e.style[i] !== undefined && (n[i] = r[i], e.style[i] = "translate3d(1px,1px,1px)", t = window.getComputedStyle(e).getPropertyValue(r[i]));
            return document.body.removeChild(e), r = n, t !== undefined && t.length > 0 && t !== "none"
        }(), s = {animDuration: 250, showArrows: !0};
        return o.prototype.show = function(t) {
            if (t != this.index) {
                var r = this.imgs.eq(this.index), i = this.imgs.eq(t);
                if (!r.size() || !i.size())
                    return;
                i.css({position: "absolute"}), i.is("img") && i.css({top: 0, left: 0}), r.fadeTo(0, 1).stop(!0, !0).fadeTo(this.options.animDuration, 0), i.fadeTo(0, 0).stop(!0, !0).fadeTo(this.options.animDuration, 1, function() {
                    i.css({position: "", display: "block", left: "", top: ""}), r.hide()
                }), this.index = t, this.pauseVideos(), n && this.resetVideos()
            }
            for (var s = 0; s < window.heroSlideshow.length; s++)
                window.heroSlideshow[s].id == this.id && window.heroSlideshow[s].index != this.index && window.heroSlideshow[s].show(this.index);
            this.nav.index.text(this.index + 1), this.nav.dots.removeClass("active").eq(this.index).addClass("active");
            var o = this.imgs.eq(this.index);
            o.is(".hero-video") ? this.container.addClass("slide-video") : this.container.removeClass("slide-video"), this.nav.download.attr("href", o.attr("data-slideshow") || o.attr("src"));
            if (o.attr("data-url") !== "") {
                var u = e('<a href=""></a>');
                u.html(o.attr("data-caption")), u.attr("href", o.attr("data-url")), this.nav.caption.html(u);
                if (o.attr("data-overlay")) {
                    var a = decodeURIComponent((o.attr("data-overlay") + "").replace(/%(?![\da-f]{2})/gi, function() {
                        return"%25"
                    }));
                    a && (this.nav.overlay.html(a), this.nav.overlay.show())
                } else
                    this.nav.overlay.hide()
            } else {
                var f = e('<span class="homepage-caption"></span>');
                o.attr("data-caption") !== "" ? this.nav.caption.html(f.append(o.attr("data-caption"))) : this.nav.caption.html("")
            }
        }, o.prototype.prev = function() {
            var e = this.index - 1;
            e < 0 && (e = this.imgs.size() - 1), this.show(e)
        }, o.prototype.next = function() {
            var e = this.index + 1;
            e > this.imgs.size() - 1 && (e = 0), this.show(e)
        }, o.prototype.pauseVideos = function() {
            this.container.find("iframe").each(function() {
                this.contentWindow.postMessage('{"event":"command","func":"pauseVideo"}', "*"), this.contentWindow.postMessage('{"method":"pause"}', "*")
            })
        }, o.prototype.resetVideos = function() {
            this.container.find("iframe").each(function() {
                var t = e(this).parent().html();
                e(this).parent().html(t)
            })
        }, e(this).each(function() {
            if (!e(this).data("heroSlideshow") && e(this).find("img,.hero-video").size() > 1) {
                var n = new o(e.extend(s, t), e(this));
                window.heroSlideshow.push(n), e(this).data("heroSlideshow", n)
            }
        }), this
    }, {start: function() {
            e("div.hero-slideshow").heroSlideshow()
        }}
});