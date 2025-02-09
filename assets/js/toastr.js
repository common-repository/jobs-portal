!(function(e) {
	e(["jquery"], function(e) {
		return (function() {
			function t(e, t, n) {
				return g({
					type: O.error,
					iconClass: m().iconClasses.error,
					message: e,
					optionsOverride: n,
					title: t
				});
			}
			function n(t, n) {
				return t ||
					(t = m()), (v = e("#" + t.containerId)), v.length ? v : (n && (v = u(t)), v);
			}
			function i(e, t, n) {
				return g({
					type: O.info,
					iconClass: m().iconClasses.info,
					message: e,
					optionsOverride: n,
					title: t
				});
			}
			function o(e) {
				w = e;
			}
			function s(e, t, n) {
				return g({
					type: O.success,
					iconClass: m().iconClasses.success,
					message: e,
					optionsOverride: n,
					title: t
				});
			}
			function a(e, t, n) {
				return g({
					type: O.warning,
					iconClass: m().iconClasses.warning,
					message: e,
					optionsOverride: n,
					title: t
				});
			}
			function r(e, t) {
				var i = m();
				v || n(i), l(e, i, t) || d(i);
			}
			function c(t) {
				var i = m();
				return v ||
					n(
						i
					), t && 0 === e(":focus", t).length ? void h(t) : void (v.children().length && v.remove());
			}
			function d(t) {
				for (var n = v.children(), i = n.length - 1; i >= 0; i--) l(e(n[i]), t);
			}
			function l(t, n, i) {
				var o = i && i.force ? i.force : !1;
				return t && (o || 0 === e(":focus", t).length)
					? (
							t[n.hideMethod]({
								duration: n.hideDuration,
								easing: n.hideEasing,
								complete: function() {
									h(t);
								}
							}),
							!0
						)
					: !1;
			}
			function u(t) {
				return (v = e("<div/>")
					.attr("id", t.containerId)
					.addClass(t.positionClass)
					.attr("aria-live", "polite")
					.attr("role", "alert")), v.appendTo(e(t.target)), v;
			}
			function p() {
				return {
					tapToDismiss: !0,
					toastClass: "toast",
					containerId: "toast-container",
					debug: !1,
					showMethod: "fadeIn",
					showDuration: 300,
					showEasing: "swing",
					onShown: void 0,
					hideMethod: "fadeOut",
					hideDuration: 1e3,
					hideEasing: "swing",
					onHidden: void 0,
					closeMethod: !1,
					closeDuration: !1,
					closeEasing: !1,
					extendedTimeOut: 1e3,
					iconClasses: {
						error: "toast-error",
						info: "toast-info",
						success: "toast-success",
						warning: "toast-warning"
					},
					iconClass: "toast-info",
					positionClass: "toast-top-right",
					timeOut: 5e3,
					titleClass: "toast-title",
					messageClass: "toast-message",
					escapeHtml: !1,
					target: "body",
					closeHtml: '<button type="button">&times;</button>',
					newestOnTop: !0,
					preventDuplicates: !1,
					progressBar: !1
				};
			}
			function f(e) {
				w && w(e);
			}
			function g(t) {
				function i(e) {
					return null == e &&
						(e =
							""), new String(e).replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "&#39;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
				}
				function o() {
					r(), d(), l(), u(), p(), c();
				}
				function s() {
					y.hover(
						b,
						O
					), !x.onclick && x.tapToDismiss && y.click(w), x.closeButton &&
						k &&
						k.click(function(e) {
							e.stopPropagation
								? e.stopPropagation()
								: void 0 !== e.cancelBubble &&
									e.cancelBubble !== !0 &&
									(e.cancelBubble = !0), w(!0);
						}), x.onclick &&
						y.click(function(e) {
							x.onclick(e), w();
						});
				}
				function a() {
					y.hide(), y[x.showMethod]({ duration: x.showDuration, easing: x.showEasing, complete: x.onShown }), x.timeOut > 0 && ((H = setTimeout(w, x.timeOut)), (q.maxHideTime = parseFloat(x.timeOut)), (q.hideEta = new Date().getTime() + q.maxHideTime), x.progressBar && (q.intervalId = setInterval(D, 10)));
				}
				function r() {
					t.iconClass && y.addClass(x.toastClass).addClass(E);
				}
				function c() {
					x.newestOnTop ? v.prepend(y) : v.append(y);
				}
				function d() {
					t.title &&
						(
							I.append(x.escapeHtml ? i(t.title) : t.title).addClass(
								x.titleClass
							),
							y.append(I)
						);
				}
				function l() {
					t.message &&
						(
							M.append(x.escapeHtml ? i(t.message) : t.message).addClass(
								x.messageClass
							),
							y.append(M)
						);
				}
				function u() {
					x.closeButton &&
						(
							k.addClass("toast-close-button").attr("role", "button"),
							y.prepend(k)
						);
				}
				function p() {
					x.progressBar && (B.addClass("toast-progress"), y.prepend(B));
				}
				function g(e, t) {
					if (e.preventDuplicates) {
						if (t.message === C) return !0;
						C = t.message;
					}
					return !1;
				}
				function w(t) {
					var n = t && x.closeMethod !== !1 ? x.closeMethod : x.hideMethod,
						i = t && x.closeDuration !== !1 ? x.closeDuration : x.hideDuration,
						o = t && x.closeEasing !== !1 ? x.closeEasing : x.hideEasing;
					return !e(":focus", y).length || t
						? (
								clearTimeout(q.intervalId),
								y[n]({
									duration: i,
									easing: o,
									complete: function() {
										h(y), x.onHidden &&
											"hidden" !== j.state &&
											x.onHidden(), (j.state =
											"hidden"), (j.endTime = new Date()), f(j);
									}
								})
							)
						: void 0;
				}
				function O() {
					(x.timeOut > 0 || x.extendedTimeOut > 0) &&
						(
							(H = setTimeout(w, x.extendedTimeOut)),
							(q.maxHideTime = parseFloat(x.extendedTimeOut)),
							(q.hideEta = new Date().getTime() + q.maxHideTime)
						);
				}
				function b() {
					clearTimeout(
						H
					), (q.hideEta = 0), y.stop(!0, !0)[x.showMethod]({ duration: x.showDuration, easing: x.showEasing });
				}
				function D() {
					var e = (q.hideEta - new Date().getTime()) / q.maxHideTime * 100;
					B.width(e + "%");
				}
				var x = m(),
					E = t.iconClass || x.iconClass;
				if (
					(
						"undefined" != typeof t.optionsOverride &&
							(
								(x = e.extend(x, t.optionsOverride)),
								(E = t.optionsOverride.iconClass || E)
							),
						!g(x, t)
					)
				) {
					T++, (v = n(x, !0));
					var H = null,
						y = e("<div/>"),
						I = e("<div/>"),
						M = e("<div/>"),
						B = e("<div/>"),
						k = e(x.closeHtml),
						q = { intervalId: null, hideEta: null, maxHideTime: null },
						j = {
							toastId: T,
							state: "visible",
							startTime: new Date(),
							options: x,
							map: t
						};
					return o(), a(), s(), f(j), x.debug && console && console.log(j), y;
				}
			}
			function m() {
				return e.extend({}, p(), b.options);
			}
			function h(e) {
				v ||
					(v = n()), e.is(":visible") || (e.remove(), (e = null), 0 === v.children().length && (v.remove(), (C = void 0)));
			}
			var v,
				w,
				C,
				T = 0,
				O = {
					error: "error",
					info: "info",
					success: "success",
					warning: "warning"
				},
				b = {
					clear: r,
					remove: c,
					error: t,
					getContainer: n,
					info: i,
					options: {},
					subscribe: o,
					success: s,
					version: "2.1.2",
					warning: a
				};
			return b;
		})();
	});
})(
	"function" == typeof define && define.amd
		? define
		: function(e, t) {
				"undefined" != typeof module && module.exports
					? (module.exports = t(require("jquery")))
					: (window.toastr = t(window.jQuery));
			}
);
//# sourceMappingURL=toastr.js.map
