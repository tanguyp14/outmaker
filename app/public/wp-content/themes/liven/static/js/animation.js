/*! WOW - v0.1.8 - 2014-05-09
 * Copyright (c) 2014 Matthieu Aussaguel; Licensed MIT */
(function() {
	"use strict"; 
    var a, b = function(a, b) {
            return function() {
                return a.apply(b, arguments)
            }
        };
    a = function() {
        function a() {}
        return a.prototype.extend = function(a, b) {
            var c, d;
            for (c in a) d = a[c], null != d && (b[c] = d);
            return b
        }, a.prototype.isMobile = function(a) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a)
        }, a
    }(), this.WOW = function() {
        function c(a) {
            null == a && (a = {}), this.scrollCallback = b(this.scrollCallback, this), this.scrollHandler = b(this.scrollHandler, this), this.start = b(this.start, this), this.scrolled = !0, this.config = this.util().extend(a, this.defaults)
        }
        return c.prototype.defaults = {
            boxClass: "wow",
            animateClass: "animated",
            offset: 0,
            mobile: !0
        }, c.prototype.init = function() {
            var a;
            return this.element = window.document.documentElement, "interactive" === (a = document.readyState) || "complete" === a ? this.start() : document.addEventListener("DOMContentLoaded", this.start)
        }, c.prototype.start = function() {
            var a, b, c, d;
            if (this.boxes = this.element.getElementsByClassName(this.config.boxClass), this.boxes.length) {
                if (this.disabled()) return this.resetStyle();
                for (d = this.boxes, b = 0, c = d.length; c > b; b++) a = d[b], this.applyStyle(a, !0);
                return window.addEventListener("scroll", this.scrollHandler, !1), window.addEventListener("resize", this.scrollHandler, !1), this.interval = setInterval(this.scrollCallback, 50)
            }
        }, c.prototype.stop = function() {
            return window.removeEventListener("scroll", this.scrollHandler, !1), window.removeEventListener("resize", this.scrollHandler, !1), null != this.interval ? clearInterval(this.interval) : void 0
        }, c.prototype.show = function(a) {
            return this.applyStyle(a), a.className = "" + a.className + " " + this.config.animateClass
        }, c.prototype.applyStyle = function(a, b) {
            var c, d, e;
            return d = a.getAttribute("data-wow-duration"), c = a.getAttribute("data-wow-delay"), e = a.getAttribute("data-wow-iteration"), this.animate(function(f) {
                return function() {
                    return f.customStyle(a, b, d, c, e)
                }
            }(this))
        }, c.prototype.animate = function() {
            return "requestAnimationFrame" in window ?
            function(a) {
                return window.requestAnimationFrame(a)
            } : function(a) {
                return a()
            }
        }(), c.prototype.resetStyle = function() {
            var a, b, c, d, e;
            for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) a = d[b], e.push(a.setAttribute("style", "visibility: visible;"));
            return e
        }, c.prototype.customStyle = function(a, b, c, d, e) {
            return a.style.visibility = b ? "hidden" : "visible", b && (a.dataset.wowAnimationName = this.animationName(a)), c && this.vendorSet(a.style, {
                animationDuration: c
            }), d && this.vendorSet(a.style, {
                animationDelay: d
            }), e && this.vendorSet(a.style, {
                animationIterationCount: e
            }), this.vendorSet(a.style, {
                animationName: b ? "none" : a.dataset.wowAnimationName
            }), a
        }, c.prototype.vendors = ["moz", "webkit"], c.prototype.vendorSet = function(a, b) {
            var c, d, e, f;
            f = [];
            for (c in b) d = b[c], a["" + c] = d, f.push(function() {
                var b, f, g, h;
                for (g = this.vendors, h = [], b = 0, f = g.length; f > b; b++) e = g[b], h.push(a["" + e + c.charAt(0).toUpperCase() + c.substr(1)] = d);
                return h
            }.call(this));
            return f
        }, c.prototype.vendorCSS = function(a, b) {
            var c, d, e, f, g, h;
            for (d = window.getComputedStyle(a), c = d.getPropertyCSSValue(b), h = this.vendors, f = 0, g = h.length; g > f; f++) e = h[f], c = c || d.getPropertyCSSValue("-" + e + "-" + b);
            return c
        }, c.prototype.animationName = function(a) {
            var b;
            try {
                return null != (b = this.vendorCSS(a, "animation-name")) ? b.cssText : void 0
            } catch (c) {
                return window.getComputedStyle(a).getPropertyValue("animation-name") || "none"
            }
        }, c.prototype.scrollHandler = function() {
            return this.scrolled = !0
        }, c.prototype.scrollCallback = function() {
            var a;
            return this.scrolled && (this.scrolled = !1, this.boxes = function() {
                var b, c, d, e;
                for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) a = d[b], a && (this.isVisible(a) ? this.show(a) : e.push(a));
                return e
            }.call(this), !this.boxes.length) ? this.stop() : void 0
        }, c.prototype.offsetTop = function(a) {
            var b;
            for (b = a.offsetTop; a = a.offsetParent;) b += a.offsetTop;
            return b
        }, c.prototype.isVisible = function(a) {
            var b, c, d, e, f;
            return c = a.getAttribute("data-wow-offset") || this.config.offset, f = window.pageYOffset, e = f + this.element.clientHeight - c, d = this.offsetTop(a), b = d + a.clientHeight, e >= d && b >= f
        }, c.prototype.util = function() {
            return this._util || (this._util = new a)
        }, c.prototype.disabled = function() {
            return !this.config.mobile && this.util().isMobile(navigator.userAgent)
        }, c
    }()
}).call(this);