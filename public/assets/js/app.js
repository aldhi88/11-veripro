!(function (s) {
    "use strict";
    s("#side-menu").metisMenu(),
        s("#vertical-menu-btn").on("click", function (e) {
            e.preventDefault(), s("body").toggleClass("sidebar-enable"), 992 <= s(window).width() ? s("body").toggleClass("vertical-collpsed") : s("body").removeClass("vertical-collpsed");
        }),
        s("body,html").click(function (e) {
            var t = s("#vertical-menu-btn");
            t.is(e.target) || 0 !== t.has(e.target).length || e.target.closest("div.vertical-menu") || s("body").removeClass("sidebar-enable");
        }),
        s("#sidebar-menu a").each(function () {
            var e = window.location.href.split(/[?#]/)[0];
            this.href == e &&
                (s(this).addClass("active"),
                s(this).parent().addClass("mm-active"),
                s(this).parent().parent().addClass("mm-show"),
                s(this).parent().parent().prev().addClass("mm-active"),
                s(this).parent().parent().parent().addClass("mm-active"),
                s(this).parent().parent().parent().parent().addClass("mm-show"),
                s(this).parent().parent().parent().parent().parent().addClass("mm-active"));
        }),
        s(".navbar-nav a").each(function () {
            var e = window.location.href.split(/[?#]/)[0];
            this.href == e &&
                (s(this).addClass("active"),
                s(this).parent().addClass("active"),
                s(this).parent().parent().addClass("active"),
                s(this).parent().parent().parent().addClass("active"),
                s(this).parent().parent().parent().parent().addClass("active"),
                s(this).parent().parent().parent().parent().parent().addClass("active"));
        }),
        s(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
            return s(this).next().hasClass("show") || s(this).parents(".dropdown-menu").first().find(".show").removeClass("show"), s(this).next(".dropdown-menu").toggleClass("show"), !1;
        });
})(jQuery);
