(function() {
    var e, t, n;
    e = this.jQuery, t = e(window), e.fn.stick = function(r) {
        var i, s, o, u, a, f, l;
        r == null && (r = {}), that = this, s = r.sticky_class, s == null && (s = "stuck"), f = r.verticalTopLimit, l = r.verticalTopLimitData || !1, f == null && (f = !1), o = function(e) {
            var r;
            r = e.height(), mTop = e.css("margin-top") == "auto" ? 0 : parseInt(e.css("margin-top"), 10), n = e.offset().top - mTop;
            var i = function() {
                var i, a, l;
                u(), f && o(), a = t.scrollTop(), l = t.height(), a + l < n + r ? (i = {position: "fixed"}, e.css(i).addClass(s).trigger("sticky:stick")) : (i = {position: "absolute"}, e.css(i).removeClass(s).trigger("sticky:unstick"))
            }, o = function() {
                var n, i, s;
                i = t.scrollTop(), s = t.height(), l && (f = parseInt(that.attr("data-verticaltoplimit"))), s + i < f + r ? (n = {top: f - i}, e.css(n)) : (n = {top: "auto"}, e.css(n))
            }, u = function() {
                var t = {position: "absolute"}, r = {position: e.css("position")};
                e.css(t), mTop = e.css("margin-top") == "auto" ? 0 : parseInt(e.css("margin-top"), 10), n = e.offset().top - mTop, e.css(r);
                return
            };
            u(), t.on("scroll", i), t.on("resize", i), setTimeout(i, 0)
        };
        for (u = 0, a = this.length; u < a; u++)
            i = this[u], o(e(i));
        return this
    }
}).call(this);