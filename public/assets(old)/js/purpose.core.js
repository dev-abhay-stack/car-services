! function (e, t) {
    "use strict";
    "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function (e) {
        if (!e.document) throw new Error("jQuery requires a window with a document");
        return t(e)
    } : t(e)
}("undefined" != typeof window ? window : this, function (e, t) {
    "use strict";
    var n = [],
        i = e.document,
        r = Object.getPrototypeOf,
        o = n.slice,
        s = n.concat,
        a = n.push,
        l = n.indexOf,
        c = {},
        u = c.toString,
        f = c.hasOwnProperty,
        h = f.toString,
        d = h.call(Object),
        p = {},
        g = function (e) {
            return "function" == typeof e && "number" != typeof e.nodeType
        },
        m = function (e) {
            return null != e && e === e.window
        },
        v = {
            type: !0,
            src: !0,
            nonce: !0,
            noModule: !0
        };

    function y(e, t, n) {
        var r, o, s = (n = n || i).createElement("script");
        if (s.text = e, t)
            for (r in v)(o = t[r] || t.getAttribute && t.getAttribute(r)) && s.setAttribute(r, o);
        n.head.appendChild(s).parentNode.removeChild(s)
    }

    function b(e) {
        return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? c[u.call(e)] || "object" : typeof e
    }
    var _ = "3.4.1",
        w = function (e, t) {
            return new w.fn.init(e, t)
        },
        E = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

    function x(e) {
        var t = !!e && "length" in e && e.length,
            n = b(e);
        return !g(e) && !m(e) && ("array" === n || 0 === t || "number" == typeof t && 0 < t && t - 1 in e)
    }
    w.fn = w.prototype = {
        jquery: _,
        constructor: w,
        length: 0,
        toArray: function () {
            return o.call(this)
        },
        get: function (e) {
            return null == e ? o.call(this) : e < 0 ? this[e + this.length] : this[e]
        },
        pushStack: function (e) {
            var t = w.merge(this.constructor(), e);
            return t.prevObject = this, t
        },
        each: function (e) {
            return w.each(this, e)
        },
        map: function (e) {
            return this.pushStack(w.map(this, function (t, n) {
                return e.call(t, n, t)
            }))
        },
        slice: function () {
            return this.pushStack(o.apply(this, arguments))
        },
        first: function () {
            return this.eq(0)
        },
        last: function () {
            return this.eq(-1)
        },
        eq: function (e) {
            var t = this.length,
                n = +e + (e < 0 ? t : 0);
            return this.pushStack(0 <= n && n < t ? [this[n]] : [])
        },
        end: function () {
            return this.prevObject || this.constructor()
        },
        push: a,
        sort: n.sort,
        splice: n.splice
    }, w.extend = w.fn.extend = function () {
        var e, t, n, i, r, o, s = arguments[0] || {},
            a = 1,
            l = arguments.length,
            c = !1;
        for ("boolean" == typeof s && (c = s, s = arguments[a] || {}, a++), "object" == typeof s || g(s) || (s = {}), a === l && (s = this, a--); a < l; a++)
            if (null != (e = arguments[a]))
                for (t in e) i = e[t], "__proto__" !== t && s !== i && (c && i && (w.isPlainObject(i) || (r = Array.isArray(i))) ? (n = s[t], o = r && !Array.isArray(n) ? [] : r || w.isPlainObject(n) ? n : {}, r = !1, s[t] = w.extend(c, o, i)) : void 0 !== i && (s[t] = i));
        return s
    }, w.extend({
        expando: "jQuery" + (_ + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function (e) {
            throw new Error(e)
        },
        noop: function () {},
        isPlainObject: function (e) {
            var t, n;
            return !(!e || "[object Object]" !== u.call(e) || (t = r(e)) && ("function" != typeof (n = f.call(t, "constructor") && t.constructor) || h.call(n) !== d))
        },
        isEmptyObject: function (e) {
            var t;
            for (t in e) return !1;
            return !0
        },
        globalEval: function (e, t) {
            y(e, {
                nonce: t && t.nonce
            })
        },
        each: function (e, t) {
            var n, i = 0;
            if (x(e))
                for (n = e.length; i < n && !1 !== t.call(e[i], i, e[i]); i++);
            else
                for (i in e)
                    if (!1 === t.call(e[i], i, e[i])) break;
            return e
        },
        trim: function (e) {
            return null == e ? "" : (e + "").replace(E, "")
        },
        makeArray: function (e, t) {
            var n = t || [];
            return null != e && (x(Object(e)) ? w.merge(n, "string" == typeof e ? [e] : e) : a.call(n, e)), n
        },
        inArray: function (e, t, n) {
            return null == t ? -1 : l.call(t, e, n)
        },
        merge: function (e, t) {
            for (var n = +t.length, i = 0, r = e.length; i < n; i++) e[r++] = t[i];
            return e.length = r, e
        },
        grep: function (e, t, n) {
            for (var i = [], r = 0, o = e.length, s = !n; r < o; r++) !t(e[r], r) !== s && i.push(e[r]);
            return i
        },
        map: function (e, t, n) {
            var i, r, o = 0,
                a = [];
            if (x(e))
                for (i = e.length; o < i; o++) null != (r = t(e[o], o, n)) && a.push(r);
            else
                for (o in e) null != (r = t(e[o], o, n)) && a.push(r);
            return s.apply([], a)
        },
        guid: 1,
        support: p
    }), "function" == typeof Symbol && (w.fn[Symbol.iterator] = n[Symbol.iterator]), w.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function (e, t) {
        c["[object " + t + "]"] = t.toLowerCase()
    });
    var T = function (e) {
        var t, n, i, r, o, s, a, l, c, u, f, h, d, p, g, m, v, y, b, _ = "sizzle" + 1 * new Date,
            w = e.document,
            E = 0,
            x = 0,
            T = le(),
            C = le(),
            S = le(),
            A = le(),
            D = function (e, t) {
                return e === t && (f = !0), 0
            },
            k = {}.hasOwnProperty,
            N = [],
            I = N.pop,
            O = N.push,
            j = N.push,
            L = N.slice,
            P = function (e, t) {
                for (var n = 0, i = e.length; n < i; n++)
                    if (e[n] === t) return n;
                return -1
            },
            H = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            M = "[\\x20\\t\\r\\n\\f]",
            q = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
            R = "\\[" + M + "*(" + q + ")(?:" + M + "*([*^$|!~]?=)" + M + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + q + "))|)" + M + "*\\]",
            F = ":(" + q + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + R + ")*)|.*)\\)|)",
            W = new RegExp(M + "+", "g"),
            B = new RegExp("^" + M + "+|((?:^|[^\\\\])(?:\\\\.)*)" + M + "+$", "g"),
            U = new RegExp("^" + M + "*," + M + "*"),
            z = new RegExp("^" + M + "*([>+~]|" + M + ")" + M + "*"),
            V = new RegExp(M + "|>"),
            $ = new RegExp(F),
            Q = new RegExp("^" + q + "$"),
            Y = {
                ID: new RegExp("^#(" + q + ")"),
                CLASS: new RegExp("^\\.(" + q + ")"),
                TAG: new RegExp("^(" + q + "|[*])"),
                ATTR: new RegExp("^" + R),
                PSEUDO: new RegExp("^" + F),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + M + "*(even|odd|(([+-]|)(\\d*)n|)" + M + "*(?:([+-]|)" + M + "*(\\d+)|))" + M + "*\\)|)", "i"),
                bool: new RegExp("^(?:" + H + ")$", "i"),
                needsContext: new RegExp("^" + M + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + M + "*((?:-\\d)?\\d*)" + M + "*\\)|)(?=[^-]|$)", "i")
            },
            K = /HTML$/i,
            X = /^(?:input|select|textarea|button)$/i,
            G = /^h\d$/i,
            J = /^[^{]+\{\s*\[native \w/,
            Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            ee = /[+~]/,
            te = new RegExp("\\\\([\\da-f]{1,6}" + M + "?|(" + M + ")|.)", "ig"),
            ne = function (e, t, n) {
                var i = "0x" + t - 65536;
                return i != i || n ? t : i < 0 ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
            },
            ie = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
            re = function (e, t) {
                return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
            },
            oe = function () {
                h()
            },
            se = _e(function (e) {
                return !0 === e.disabled && "fieldset" === e.nodeName.toLowerCase()
            }, {
                dir: "parentNode",
                next: "legend"
            });
        try {
            j.apply(N = L.call(w.childNodes), w.childNodes), N[w.childNodes.length].nodeType
        } catch (t) {
            j = {
                apply: N.length ? function (e, t) {
                    O.apply(e, L.call(t))
                } : function (e, t) {
                    for (var n = e.length, i = 0; e[n++] = t[i++];);
                    e.length = n - 1
                }
            }
        }

        function ae(e, t, i, r) {
            var o, a, c, u, f, p, v, y = t && t.ownerDocument,
                E = t ? t.nodeType : 9;
            if (i = i || [], "string" != typeof e || !e || 1 !== E && 9 !== E && 11 !== E) return i;
            if (!r && ((t ? t.ownerDocument || t : w) !== d && h(t), t = t || d, g)) {
                if (11 !== E && (f = Z.exec(e)))
                    if (o = f[1]) {
                        if (9 === E) {
                            if (!(c = t.getElementById(o))) return i;
                            if (c.id === o) return i.push(c), i
                        } else if (y && (c = y.getElementById(o)) && b(t, c) && c.id === o) return i.push(c), i
                    } else {
                        if (f[2]) return j.apply(i, t.getElementsByTagName(e)), i;
                        if ((o = f[3]) && n.getElementsByClassName && t.getElementsByClassName) return j.apply(i, t.getElementsByClassName(o)), i
                    } if (n.qsa && !A[e + " "] && (!m || !m.test(e)) && (1 !== E || "object" !== t.nodeName.toLowerCase())) {
                    if (v = e, y = t, 1 === E && V.test(e)) {
                        for ((u = t.getAttribute("id")) ? u = u.replace(ie, re) : t.setAttribute("id", u = _), a = (p = s(e)).length; a--;) p[a] = "#" + u + " " + be(p[a]);
                        v = p.join(","), y = ee.test(e) && ve(t.parentNode) || t
                    }
                    try {
                        return j.apply(i, y.querySelectorAll(v)), i
                    } catch (t) {
                        A(e, !0)
                    } finally {
                        u === _ && t.removeAttribute("id")
                    }
                }
            }
            return l(e.replace(B, "$1"), t, i, r)
        }

        function le() {
            var e = [];
            return function t(n, r) {
                return e.push(n + " ") > i.cacheLength && delete t[e.shift()], t[n + " "] = r
            }
        }

        function ce(e) {
            return e[_] = !0, e
        }

        function ue(e) {
            var t = d.createElement("fieldset");
            try {
                return !!e(t)
            } catch (e) {
                return !1
            } finally {
                t.parentNode && t.parentNode.removeChild(t), t = null
            }
        }

        function fe(e, t) {
            for (var n = e.split("|"), r = n.length; r--;) i.attrHandle[n[r]] = t
        }

        function he(e, t) {
            var n = t && e,
                i = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
            if (i) return i;
            if (n)
                for (; n = n.nextSibling;)
                    if (n === t) return -1;
            return e ? 1 : -1
        }

        function de(e) {
            return function (t) {
                return "input" === t.nodeName.toLowerCase() && t.type === e
            }
        }

        function pe(e) {
            return function (t) {
                var n = t.nodeName.toLowerCase();
                return ("input" === n || "button" === n) && t.type === e
            }
        }

        function ge(e) {
            return function (t) {
                return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && se(t) === e : t.disabled === e : "label" in t && t.disabled === e
            }
        }

        function me(e) {
            return ce(function (t) {
                return t = +t, ce(function (n, i) {
                    for (var r, o = e([], n.length, t), s = o.length; s--;) n[r = o[s]] && (n[r] = !(i[r] = n[r]))
                })
            })
        }

        function ve(e) {
            return e && void 0 !== e.getElementsByTagName && e
        }
        for (t in n = ae.support = {}, o = ae.isXML = function (e) {
                var t = e.namespaceURI,
                    n = (e.ownerDocument || e).documentElement;
                return !K.test(t || n && n.nodeName || "HTML")
            }, h = ae.setDocument = function (e) {
                var t, r, s = e ? e.ownerDocument || e : w;
                return s !== d && 9 === s.nodeType && s.documentElement && (p = (d = s).documentElement, g = !o(d), w !== d && (r = d.defaultView) && r.top !== r && (r.addEventListener ? r.addEventListener("unload", oe, !1) : r.attachEvent && r.attachEvent("onunload", oe)), n.attributes = ue(function (e) {
                    return e.className = "i", !e.getAttribute("className")
                }), n.getElementsByTagName = ue(function (e) {
                    return e.appendChild(d.createComment("")), !e.getElementsByTagName("*").length
                }), n.getElementsByClassName = J.test(d.getElementsByClassName), n.getById = ue(function (e) {
                    return p.appendChild(e).id = _, !d.getElementsByName || !d.getElementsByName(_).length
                }), n.getById ? (i.filter.ID = function (e) {
                    var t = e.replace(te, ne);
                    return function (e) {
                        return e.getAttribute("id") === t
                    }
                }, i.find.ID = function (e, t) {
                    if (void 0 !== t.getElementById && g) {
                        var n = t.getElementById(e);
                        return n ? [n] : []
                    }
                }) : (i.filter.ID = function (e) {
                    var t = e.replace(te, ne);
                    return function (e) {
                        var n = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                        return n && n.value === t
                    }
                }, i.find.ID = function (e, t) {
                    if (void 0 !== t.getElementById && g) {
                        var n, i, r, o = t.getElementById(e);
                        if (o) {
                            if ((n = o.getAttributeNode("id")) && n.value === e) return [o];
                            for (r = t.getElementsByName(e), i = 0; o = r[i++];)
                                if ((n = o.getAttributeNode("id")) && n.value === e) return [o]
                        }
                        return []
                    }
                }), i.find.TAG = n.getElementsByTagName ? function (e, t) {
                    return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : n.qsa ? t.querySelectorAll(e) : void 0
                } : function (e, t) {
                    var n, i = [],
                        r = 0,
                        o = t.getElementsByTagName(e);
                    if ("*" === e) {
                        for (; n = o[r++];) 1 === n.nodeType && i.push(n);
                        return i
                    }
                    return o
                }, i.find.CLASS = n.getElementsByClassName && function (e, t) {
                    if (void 0 !== t.getElementsByClassName && g) return t.getElementsByClassName(e)
                }, v = [], m = [], (n.qsa = J.test(d.querySelectorAll)) && (ue(function (e) {
                    p.appendChild(e).innerHTML = "<a id='" + _ + "'></a><select id='" + _ + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && m.push("[*^$]=" + M + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || m.push("\\[" + M + "*(?:value|" + H + ")"), e.querySelectorAll("[id~=" + _ + "-]").length || m.push("~="), e.querySelectorAll(":checked").length || m.push(":checked"), e.querySelectorAll("a#" + _ + "+*").length || m.push(".#.+[+~]")
                }), ue(function (e) {
                    e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                    var t = d.createElement("input");
                    t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && m.push("name" + M + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && m.push(":enabled", ":disabled"), p.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && m.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), m.push(",.*:")
                })), (n.matchesSelector = J.test(y = p.matches || p.webkitMatchesSelector || p.mozMatchesSelector || p.oMatchesSelector || p.msMatchesSelector)) && ue(function (e) {
                    n.disconnectedMatch = y.call(e, "*"), y.call(e, "[s!='']:x"), v.push("!=", F)
                }), m = m.length && new RegExp(m.join("|")), v = v.length && new RegExp(v.join("|")), t = J.test(p.compareDocumentPosition), b = t || J.test(p.contains) ? function (e, t) {
                    var n = 9 === e.nodeType ? e.documentElement : e,
                        i = t && t.parentNode;
                    return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
                } : function (e, t) {
                    if (t)
                        for (; t = t.parentNode;)
                            if (t === e) return !0;
                    return !1
                }, D = t ? function (e, t) {
                    if (e === t) return f = !0, 0;
                    var i = !e.compareDocumentPosition - !t.compareDocumentPosition;
                    return i || (1 & (i = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1) || !n.sortDetached && t.compareDocumentPosition(e) === i ? e === d || e.ownerDocument === w && b(w, e) ? -1 : t === d || t.ownerDocument === w && b(w, t) ? 1 : u ? P(u, e) - P(u, t) : 0 : 4 & i ? -1 : 1)
                } : function (e, t) {
                    if (e === t) return f = !0, 0;
                    var n, i = 0,
                        r = e.parentNode,
                        o = t.parentNode,
                        s = [e],
                        a = [t];
                    if (!r || !o) return e === d ? -1 : t === d ? 1 : r ? -1 : o ? 1 : u ? P(u, e) - P(u, t) : 0;
                    if (r === o) return he(e, t);
                    for (n = e; n = n.parentNode;) s.unshift(n);
                    for (n = t; n = n.parentNode;) a.unshift(n);
                    for (; s[i] === a[i];) i++;
                    return i ? he(s[i], a[i]) : s[i] === w ? -1 : a[i] === w ? 1 : 0
                }), d
            }, ae.matches = function (e, t) {
                return ae(e, null, null, t)
            }, ae.matchesSelector = function (e, t) {
                if ((e.ownerDocument || e) !== d && h(e), n.matchesSelector && g && !A[t + " "] && (!v || !v.test(t)) && (!m || !m.test(t))) try {
                    var i = y.call(e, t);
                    if (i || n.disconnectedMatch || e.document && 11 !== e.document.nodeType) return i
                } catch (e) {
                    A(t, !0)
                }
                return 0 < ae(t, d, null, [e]).length
            }, ae.contains = function (e, t) {
                return (e.ownerDocument || e) !== d && h(e), b(e, t)
            }, ae.attr = function (e, t) {
                (e.ownerDocument || e) !== d && h(e);
                var r = i.attrHandle[t.toLowerCase()],
                    o = r && k.call(i.attrHandle, t.toLowerCase()) ? r(e, t, !g) : void 0;
                return void 0 !== o ? o : n.attributes || !g ? e.getAttribute(t) : (o = e.getAttributeNode(t)) && o.specified ? o.value : null
            }, ae.escape = function (e) {
                return (e + "").replace(ie, re)
            }, ae.error = function (e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }, ae.uniqueSort = function (e) {
                var t, i = [],
                    r = 0,
                    o = 0;
                if (f = !n.detectDuplicates, u = !n.sortStable && e.slice(0), e.sort(D), f) {
                    for (; t = e[o++];) t === e[o] && (r = i.push(o));
                    for (; r--;) e.splice(i[r], 1)
                }
                return u = null, e
            }, r = ae.getText = function (e) {
                var t, n = "",
                    i = 0,
                    o = e.nodeType;
                if (o) {
                    if (1 === o || 9 === o || 11 === o) {
                        if ("string" == typeof e.textContent) return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling) n += r(e)
                    } else if (3 === o || 4 === o) return e.nodeValue
                } else
                    for (; t = e[i++];) n += r(t);
                return n
            }, (i = ae.selectors = {
                cacheLength: 50,
                createPseudo: ce,
                match: Y,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function (e) {
                        return e[1] = e[1].replace(te, ne), e[3] = (e[3] || e[4] || e[5] || "").replace(te, ne), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                    },
                    CHILD: function (e) {
                        return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || ae.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && ae.error(e[0]), e
                    },
                    PSEUDO: function (e) {
                        var t, n = !e[6] && e[2];
                        return Y.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && $.test(n) && (t = s(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function (e) {
                        var t = e.replace(te, ne).toLowerCase();
                        return "*" === e ? function () {
                            return !0
                        } : function (e) {
                            return e.nodeName && e.nodeName.toLowerCase() === t
                        }
                    },
                    CLASS: function (e) {
                        var t = T[e + " "];
                        return t || (t = new RegExp("(^|" + M + ")" + e + "(" + M + "|$)")) && T(e, function (e) {
                            return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                        })
                    },
                    ATTR: function (e, t, n) {
                        return function (i) {
                            var r = ae.attr(i, e);
                            return null == r ? "!=" === t : !t || (r += "", "=" === t ? r === n : "!=" === t ? r !== n : "^=" === t ? n && 0 === r.indexOf(n) : "*=" === t ? n && -1 < r.indexOf(n) : "$=" === t ? n && r.slice(-n.length) === n : "~=" === t ? -1 < (" " + r.replace(W, " ") + " ").indexOf(n) : "|=" === t && (r === n || r.slice(0, n.length + 1) === n + "-"))
                        }
                    },
                    CHILD: function (e, t, n, i, r) {
                        var o = "nth" !== e.slice(0, 3),
                            s = "last" !== e.slice(-4),
                            a = "of-type" === t;
                        return 1 === i && 0 === r ? function (e) {
                            return !!e.parentNode
                        } : function (t, n, l) {
                            var c, u, f, h, d, p, g = o !== s ? "nextSibling" : "previousSibling",
                                m = t.parentNode,
                                v = a && t.nodeName.toLowerCase(),
                                y = !l && !a,
                                b = !1;
                            if (m) {
                                if (o) {
                                    for (; g;) {
                                        for (h = t; h = h[g];)
                                            if (a ? h.nodeName.toLowerCase() === v : 1 === h.nodeType) return !1;
                                        p = g = "only" === e && !p && "nextSibling"
                                    }
                                    return !0
                                }
                                if (p = [s ? m.firstChild : m.lastChild], s && y) {
                                    for (b = (d = (c = (u = (f = (h = m)[_] || (h[_] = {}))[h.uniqueID] || (f[h.uniqueID] = {}))[e] || [])[0] === E && c[1]) && c[2], h = d && m.childNodes[d]; h = ++d && h && h[g] || (b = d = 0) || p.pop();)
                                        if (1 === h.nodeType && ++b && h === t) {
                                            u[e] = [E, d, b];
                                            break
                                        }
                                } else if (y && (b = d = (c = (u = (f = (h = t)[_] || (h[_] = {}))[h.uniqueID] || (f[h.uniqueID] = {}))[e] || [])[0] === E && c[1]), !1 === b)
                                    for (;
                                        (h = ++d && h && h[g] || (b = d = 0) || p.pop()) && ((a ? h.nodeName.toLowerCase() !== v : 1 !== h.nodeType) || !++b || (y && ((u = (f = h[_] || (h[_] = {}))[h.uniqueID] || (f[h.uniqueID] = {}))[e] = [E, b]), h !== t)););
                                return (b -= r) === i || b % i == 0 && 0 <= b / i
                            }
                        }
                    },
                    PSEUDO: function (e, t) {
                        var n, r = i.pseudos[e] || i.setFilters[e.toLowerCase()] || ae.error("unsupported pseudo: " + e);
                        return r[_] ? r(t) : 1 < r.length ? (n = [e, e, "", t], i.setFilters.hasOwnProperty(e.toLowerCase()) ? ce(function (e, n) {
                            for (var i, o = r(e, t), s = o.length; s--;) e[i = P(e, o[s])] = !(n[i] = o[s])
                        }) : function (e) {
                            return r(e, 0, n)
                        }) : r
                    }
                },
                pseudos: {
                    not: ce(function (e) {
                        var t = [],
                            n = [],
                            i = a(e.replace(B, "$1"));
                        return i[_] ? ce(function (e, t, n, r) {
                            for (var o, s = i(e, null, r, []), a = e.length; a--;)(o = s[a]) && (e[a] = !(t[a] = o))
                        }) : function (e, r, o) {
                            return t[0] = e, i(t, null, o, n), t[0] = null, !n.pop()
                        }
                    }),
                    has: ce(function (e) {
                        return function (t) {
                            return 0 < ae(e, t).length
                        }
                    }),
                    contains: ce(function (e) {
                        return e = e.replace(te, ne),
                            function (t) {
                                return -1 < (t.textContent || r(t)).indexOf(e)
                            }
                    }),
                    lang: ce(function (e) {
                        return Q.test(e || "") || ae.error("unsupported lang: " + e), e = e.replace(te, ne).toLowerCase(),
                            function (t) {
                                var n;
                                do {
                                    if (n = g ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return (n = n.toLowerCase()) === e || 0 === n.indexOf(e + "-")
                                } while ((t = t.parentNode) && 1 === t.nodeType);
                                return !1
                            }
                    }),
                    target: function (t) {
                        var n = e.location && e.location.hash;
                        return n && n.slice(1) === t.id
                    },
                    root: function (e) {
                        return e === p
                    },
                    focus: function (e) {
                        return e === d.activeElement && (!d.hasFocus || d.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                    },
                    enabled: ge(!1),
                    disabled: ge(!0),
                    checked: function (e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && !!e.checked || "option" === t && !!e.selected
                    },
                    selected: function (e) {
                        return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
                    },
                    empty: function (e) {
                        for (e = e.firstChild; e; e = e.nextSibling)
                            if (e.nodeType < 6) return !1;
                        return !0
                    },
                    parent: function (e) {
                        return !i.pseudos.empty(e)
                    },
                    header: function (e) {
                        return G.test(e.nodeName)
                    },
                    input: function (e) {
                        return X.test(e.nodeName)
                    },
                    button: function (e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t
                    },
                    text: function (e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                    },
                    first: me(function () {
                        return [0]
                    }),
                    last: me(function (e, t) {
                        return [t - 1]
                    }),
                    eq: me(function (e, t, n) {
                        return [n < 0 ? n + t : n]
                    }),
                    even: me(function (e, t) {
                        for (var n = 0; n < t; n += 2) e.push(n);
                        return e
                    }),
                    odd: me(function (e, t) {
                        for (var n = 1; n < t; n += 2) e.push(n);
                        return e
                    }),
                    lt: me(function (e, t, n) {
                        for (var i = n < 0 ? n + t : t < n ? t : n; 0 <= --i;) e.push(i);
                        return e
                    }),
                    gt: me(function (e, t, n) {
                        for (var i = n < 0 ? n + t : n; ++i < t;) e.push(i);
                        return e
                    })
                }
            }).pseudos.nth = i.pseudos.eq, {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            }) i.pseudos[t] = de(t);
        for (t in {
                submit: !0,
                reset: !0
            }) i.pseudos[t] = pe(t);

        function ye() {}

        function be(e) {
            for (var t = 0, n = e.length, i = ""; t < n; t++) i += e[t].value;
            return i
        }

        function _e(e, t, n) {
            var i = t.dir,
                r = t.next,
                o = r || i,
                s = n && "parentNode" === o,
                a = x++;
            return t.first ? function (t, n, r) {
                for (; t = t[i];)
                    if (1 === t.nodeType || s) return e(t, n, r);
                return !1
            } : function (t, n, l) {
                var c, u, f, h = [E, a];
                if (l) {
                    for (; t = t[i];)
                        if ((1 === t.nodeType || s) && e(t, n, l)) return !0
                } else
                    for (; t = t[i];)
                        if (1 === t.nodeType || s)
                            if (u = (f = t[_] || (t[_] = {}))[t.uniqueID] || (f[t.uniqueID] = {}), r && r === t.nodeName.toLowerCase()) t = t[i] || t;
                            else {
                                if ((c = u[o]) && c[0] === E && c[1] === a) return h[2] = c[2];
                                if ((u[o] = h)[2] = e(t, n, l)) return !0
                            } return !1
            }
        }

        function we(e) {
            return 1 < e.length ? function (t, n, i) {
                for (var r = e.length; r--;)
                    if (!e[r](t, n, i)) return !1;
                return !0
            } : e[0]
        }

        function Ee(e, t, n, i, r) {
            for (var o, s = [], a = 0, l = e.length, c = null != t; a < l; a++)(o = e[a]) && (n && !n(o, i, r) || (s.push(o), c && t.push(a)));
            return s
        }

        function xe(e, t, n, i, r, o) {
            return i && !i[_] && (i = xe(i)), r && !r[_] && (r = xe(r, o)), ce(function (o, s, a, l) {
                var c, u, f, h = [],
                    d = [],
                    p = s.length,
                    g = o || function (e, t, n) {
                        for (var i = 0, r = t.length; i < r; i++) ae(e, t[i], n);
                        return n
                    }(t || "*", a.nodeType ? [a] : a, []),
                    m = !e || !o && t ? g : Ee(g, h, e, a, l),
                    v = n ? r || (o ? e : p || i) ? [] : s : m;
                if (n && n(m, v, a, l), i)
                    for (c = Ee(v, d), i(c, [], a, l), u = c.length; u--;)(f = c[u]) && (v[d[u]] = !(m[d[u]] = f));
                if (o) {
                    if (r || e) {
                        if (r) {
                            for (c = [], u = v.length; u--;)(f = v[u]) && c.push(m[u] = f);
                            r(null, v = [], c, l)
                        }
                        for (u = v.length; u--;)(f = v[u]) && -1 < (c = r ? P(o, f) : h[u]) && (o[c] = !(s[c] = f))
                    }
                } else v = Ee(v === s ? v.splice(p, v.length) : v), r ? r(null, s, v, l) : j.apply(s, v)
            })
        }

        function Te(e) {
            for (var t, n, r, o = e.length, s = i.relative[e[0].type], a = s || i.relative[" "], l = s ? 1 : 0, u = _e(function (e) {
                    return e === t
                }, a, !0), f = _e(function (e) {
                    return -1 < P(t, e)
                }, a, !0), h = [function (e, n, i) {
                    var r = !s && (i || n !== c) || ((t = n).nodeType ? u(e, n, i) : f(e, n, i));
                    return t = null, r
                }]; l < o; l++)
                if (n = i.relative[e[l].type]) h = [_e(we(h), n)];
                else {
                    if ((n = i.filter[e[l].type].apply(null, e[l].matches))[_]) {
                        for (r = ++l; r < o && !i.relative[e[r].type]; r++);
                        return xe(1 < l && we(h), 1 < l && be(e.slice(0, l - 1).concat({
                            value: " " === e[l - 2].type ? "*" : ""
                        })).replace(B, "$1"), n, l < r && Te(e.slice(l, r)), r < o && Te(e = e.slice(r)), r < o && be(e))
                    }
                    h.push(n)
                } return we(h)
        }
        return ye.prototype = i.filters = i.pseudos, i.setFilters = new ye, s = ae.tokenize = function (e, t) {
            var n, r, o, s, a, l, c, u = C[e + " "];
            if (u) return t ? 0 : u.slice(0);
            for (a = e, l = [], c = i.preFilter; a;) {
                for (s in n && !(r = U.exec(a)) || (r && (a = a.slice(r[0].length) || a), l.push(o = [])), n = !1, (r = z.exec(a)) && (n = r.shift(), o.push({
                        value: n,
                        type: r[0].replace(B, " ")
                    }), a = a.slice(n.length)), i.filter) !(r = Y[s].exec(a)) || c[s] && !(r = c[s](r)) || (n = r.shift(), o.push({
                    value: n,
                    type: s,
                    matches: r
                }), a = a.slice(n.length));
                if (!n) break
            }
            return t ? a.length : a ? ae.error(e) : C(e, l).slice(0)
        }, a = ae.compile = function (e, t) {
            var n, r, o, a, l, u, f = [],
                p = [],
                m = S[e + " "];
            if (!m) {
                for (t || (t = s(e)), n = t.length; n--;)(m = Te(t[n]))[_] ? f.push(m) : p.push(m);
                (m = S(e, (r = p, a = 0 < (o = f).length, l = 0 < r.length, u = function (e, t, n, s, u) {
                    var f, p, m, v = 0,
                        y = "0",
                        b = e && [],
                        _ = [],
                        w = c,
                        x = e || l && i.find.TAG("*", u),
                        T = E += null == w ? 1 : Math.random() || .1,
                        C = x.length;
                    for (u && (c = t === d || t || u); y !== C && null != (f = x[y]); y++) {
                        if (l && f) {
                            for (p = 0, t || f.ownerDocument === d || (h(f), n = !g); m = r[p++];)
                                if (m(f, t || d, n)) {
                                    s.push(f);
                                    break
                                } u && (E = T)
                        }
                        a && ((f = !m && f) && v--, e && b.push(f))
                    }
                    if (v += y, a && y !== v) {
                        for (p = 0; m = o[p++];) m(b, _, t, n);
                        if (e) {
                            if (0 < v)
                                for (; y--;) b[y] || _[y] || (_[y] = I.call(s));
                            _ = Ee(_)
                        }
                        j.apply(s, _), u && !e && 0 < _.length && 1 < v + o.length && ae.uniqueSort(s)
                    }
                    return u && (E = T, c = w), b
                }, a ? ce(u) : u))).selector = e
            }
            return m
        }, l = ae.select = function (e, t, n, r) {
            var o, l, c, u, f, h = "function" == typeof e && e,
                d = !r && s(e = h.selector || e);
            if (n = n || [], 1 === d.length) {
                if (2 < (l = d[0] = d[0].slice(0)).length && "ID" === (c = l[0]).type && 9 === t.nodeType && g && i.relative[l[1].type]) {
                    if (!(t = (i.find.ID(c.matches[0].replace(te, ne), t) || [])[0])) return n;
                    h && (t = t.parentNode), e = e.slice(l.shift().value.length)
                }
                for (o = Y.needsContext.test(e) ? 0 : l.length; o-- && (c = l[o], !i.relative[u = c.type]);)
                    if ((f = i.find[u]) && (r = f(c.matches[0].replace(te, ne), ee.test(l[0].type) && ve(t.parentNode) || t))) {
                        if (l.splice(o, 1), !(e = r.length && be(l))) return j.apply(n, r), n;
                        break
                    }
            }
            return (h || a(e, d))(r, t, !g, n, !t || ee.test(e) && ve(t.parentNode) || t), n
        }, n.sortStable = _.split("").sort(D).join("") === _, n.detectDuplicates = !!f, h(), n.sortDetached = ue(function (e) {
            return 1 & e.compareDocumentPosition(d.createElement("fieldset"))
        }), ue(function (e) {
            return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
        }) || fe("type|href|height|width", function (e, t, n) {
            if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
        }), n.attributes && ue(function (e) {
            return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
        }) || fe("value", function (e, t, n) {
            if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue
        }), ue(function (e) {
            return null == e.getAttribute("disabled")
        }) || fe(H, function (e, t, n) {
            var i;
            if (!n) return !0 === e[t] ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
        }), ae
    }(e);
    w.find = T, w.expr = T.selectors, w.expr[":"] = w.expr.pseudos, w.uniqueSort = w.unique = T.uniqueSort, w.text = T.getText, w.isXMLDoc = T.isXML, w.contains = T.contains, w.escapeSelector = T.escape;
    var C = function (e, t, n) {
            for (var i = [], r = void 0 !== n;
                (e = e[t]) && 9 !== e.nodeType;)
                if (1 === e.nodeType) {
                    if (r && w(e).is(n)) break;
                    i.push(e)
                } return i
        },
        S = function (e, t) {
            for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
            return n
        },
        A = w.expr.match.needsContext;

    function D(e, t) {
        return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
    }
    var k = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;

    function N(e, t, n) {
        return g(t) ? w.grep(e, function (e, i) {
            return !!t.call(e, i, e) !== n
        }) : t.nodeType ? w.grep(e, function (e) {
            return e === t !== n
        }) : "string" != typeof t ? w.grep(e, function (e) {
            return -1 < l.call(t, e) !== n
        }) : w.filter(t, e, n)
    }
    w.filter = function (e, t, n) {
        var i = t[0];
        return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === i.nodeType ? w.find.matchesSelector(i, e) ? [i] : [] : w.find.matches(e, w.grep(t, function (e) {
            return 1 === e.nodeType
        }))
    }, w.fn.extend({
        find: function (e) {
            var t, n, i = this.length,
                r = this;
            if ("string" != typeof e) return this.pushStack(w(e).filter(function () {
                for (t = 0; t < i; t++)
                    if (w.contains(r[t], this)) return !0
            }));
            for (n = this.pushStack([]), t = 0; t < i; t++) w.find(e, r[t], n);
            return 1 < i ? w.uniqueSort(n) : n
        },
        filter: function (e) {
            return this.pushStack(N(this, e || [], !1))
        },
        not: function (e) {
            return this.pushStack(N(this, e || [], !0))
        },
        is: function (e) {
            return !!N(this, "string" == typeof e && A.test(e) ? w(e) : e || [], !1).length
        }
    });
    var I, O = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
    (w.fn.init = function (e, t, n) {
        var r, o;
        if (!e) return this;
        if (n = n || I, "string" == typeof e) {
            if (!(r = "<" === e[0] && ">" === e[e.length - 1] && 3 <= e.length ? [null, e, null] : O.exec(e)) || !r[1] && t) return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
            if (r[1]) {
                if (t = t instanceof w ? t[0] : t, w.merge(this, w.parseHTML(r[1], t && t.nodeType ? t.ownerDocument || t : i, !0)), k.test(r[1]) && w.isPlainObject(t))
                    for (r in t) g(this[r]) ? this[r](t[r]) : this.attr(r, t[r]);
                return this
            }
            return (o = i.getElementById(r[2])) && (this[0] = o, this.length = 1), this
        }
        return e.nodeType ? (this[0] = e, this.length = 1, this) : g(e) ? void 0 !== n.ready ? n.ready(e) : e(w) : w.makeArray(e, this)
    }).prototype = w.fn, I = w(i);
    var j = /^(?:parents|prev(?:Until|All))/,
        L = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };

    function P(e, t) {
        for (;
            (e = e[t]) && 1 !== e.nodeType;);
        return e
    }
    w.fn.extend({
        has: function (e) {
            var t = w(e, this),
                n = t.length;
            return this.filter(function () {
                for (var e = 0; e < n; e++)
                    if (w.contains(this, t[e])) return !0
            })
        },
        closest: function (e, t) {
            var n, i = 0,
                r = this.length,
                o = [],
                s = "string" != typeof e && w(e);
            if (!A.test(e))
                for (; i < r; i++)
                    for (n = this[i]; n && n !== t; n = n.parentNode)
                        if (n.nodeType < 11 && (s ? -1 < s.index(n) : 1 === n.nodeType && w.find.matchesSelector(n, e))) {
                            o.push(n);
                            break
                        } return this.pushStack(1 < o.length ? w.uniqueSort(o) : o)
        },
        index: function (e) {
            return e ? "string" == typeof e ? l.call(w(e), this[0]) : l.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
        },
        add: function (e, t) {
            return this.pushStack(w.uniqueSort(w.merge(this.get(), w(e, t))))
        },
        addBack: function (e) {
            return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
        }
    }), w.each({
        parent: function (e) {
            var t = e.parentNode;
            return t && 11 !== t.nodeType ? t : null
        },
        parents: function (e) {
            return C(e, "parentNode")
        },
        parentsUntil: function (e, t, n) {
            return C(e, "parentNode", n)
        },
        next: function (e) {
            return P(e, "nextSibling")
        },
        prev: function (e) {
            return P(e, "previousSibling")
        },
        nextAll: function (e) {
            return C(e, "nextSibling")
        },
        prevAll: function (e) {
            return C(e, "previousSibling")
        },
        nextUntil: function (e, t, n) {
            return C(e, "nextSibling", n)
        },
        prevUntil: function (e, t, n) {
            return C(e, "previousSibling", n)
        },
        siblings: function (e) {
            return S((e.parentNode || {}).firstChild, e)
        },
        children: function (e) {
            return S(e.firstChild)
        },
        contents: function (e) {
            return void 0 !== e.contentDocument ? e.contentDocument : (D(e, "template") && (e = e.content || e), w.merge([], e.childNodes))
        }
    }, function (e, t) {
        w.fn[e] = function (n, i) {
            var r = w.map(this, t, n);
            return "Until" !== e.slice(-5) && (i = n), i && "string" == typeof i && (r = w.filter(i, r)), 1 < this.length && (L[e] || w.uniqueSort(r), j.test(e) && r.reverse()), this.pushStack(r)
        }
    });
    var H = /[^\x20\t\r\n\f]+/g;

    function M(e) {
        return e
    }

    function q(e) {
        throw e
    }

    function R(e, t, n, i) {
        var r;
        try {
            e && g(r = e.promise) ? r.call(e).done(t).fail(n) : e && g(r = e.then) ? r.call(e, t, n) : t.apply(void 0, [e].slice(i))
        } catch (e) {
            n.apply(void 0, [e])
        }
    }
    w.Callbacks = function (e) {
        var t, n;
        e = "string" == typeof e ? (t = e, n = {}, w.each(t.match(H) || [], function (e, t) {
            n[t] = !0
        }), n) : w.extend({}, e);
        var i, r, o, s, a = [],
            l = [],
            c = -1,
            u = function () {
                for (s = s || e.once, o = i = !0; l.length; c = -1)
                    for (r = l.shift(); ++c < a.length;) !1 === a[c].apply(r[0], r[1]) && e.stopOnFalse && (c = a.length, r = !1);
                e.memory || (r = !1), i = !1, s && (a = r ? [] : "")
            },
            f = {
                add: function () {
                    return a && (r && !i && (c = a.length - 1, l.push(r)), function t(n) {
                        w.each(n, function (n, i) {
                            g(i) ? e.unique && f.has(i) || a.push(i) : i && i.length && "string" !== b(i) && t(i)
                        })
                    }(arguments), r && !i && u()), this
                },
                remove: function () {
                    return w.each(arguments, function (e, t) {
                        for (var n; - 1 < (n = w.inArray(t, a, n));) a.splice(n, 1), n <= c && c--
                    }), this
                },
                has: function (e) {
                    return e ? -1 < w.inArray(e, a) : 0 < a.length
                },
                empty: function () {
                    return a && (a = []), this
                },
                disable: function () {
                    return s = l = [], a = r = "", this
                },
                disabled: function () {
                    return !a
                },
                lock: function () {
                    return s = l = [], r || i || (a = r = ""), this
                },
                locked: function () {
                    return !!s
                },
                fireWith: function (e, t) {
                    return s || (t = [e, (t = t || []).slice ? t.slice() : t], l.push(t), i || u()), this
                },
                fire: function () {
                    return f.fireWith(this, arguments), this
                },
                fired: function () {
                    return !!o
                }
            };
        return f
    }, w.extend({
        Deferred: function (t) {
            var n = [
                    ["notify", "progress", w.Callbacks("memory"), w.Callbacks("memory"), 2],
                    ["resolve", "done", w.Callbacks("once memory"), w.Callbacks("once memory"), 0, "resolved"],
                    ["reject", "fail", w.Callbacks("once memory"), w.Callbacks("once memory"), 1, "rejected"]
                ],
                i = "pending",
                r = {
                    state: function () {
                        return i
                    },
                    always: function () {
                        return o.done(arguments).fail(arguments), this
                    },
                    catch: function (e) {
                        return r.then(null, e)
                    },
                    pipe: function () {
                        var e = arguments;
                        return w.Deferred(function (t) {
                            w.each(n, function (n, i) {
                                var r = g(e[i[4]]) && e[i[4]];
                                o[i[1]](function () {
                                    var e = r && r.apply(this, arguments);
                                    e && g(e.promise) ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[i[0] + "With"](this, r ? [e] : arguments)
                                })
                            }), e = null
                        }).promise()
                    },
                    then: function (t, i, r) {
                        var o = 0;

                        function s(t, n, i, r) {
                            return function () {
                                var a = this,
                                    l = arguments,
                                    c = function () {
                                        var e, c;
                                        if (!(t < o)) {
                                            if ((e = i.apply(a, l)) === n.promise()) throw new TypeError("Thenable self-resolution");
                                            c = e && ("object" == typeof e || "function" == typeof e) && e.then, g(c) ? r ? c.call(e, s(o, n, M, r), s(o, n, q, r)) : (o++, c.call(e, s(o, n, M, r), s(o, n, q, r), s(o, n, M, n.notifyWith))) : (i !== M && (a = void 0, l = [e]), (r || n.resolveWith)(a, l))
                                        }
                                    },
                                    u = r ? c : function () {
                                        try {
                                            c()
                                        } catch (e) {
                                            w.Deferred.exceptionHook && w.Deferred.exceptionHook(e, u.stackTrace), o <= t + 1 && (i !== q && (a = void 0, l = [e]), n.rejectWith(a, l))
                                        }
                                    };
                                t ? u() : (w.Deferred.getStackHook && (u.stackTrace = w.Deferred.getStackHook()), e.setTimeout(u))
                            }
                        }
                        return w.Deferred(function (e) {
                            n[0][3].add(s(0, e, g(r) ? r : M, e.notifyWith)), n[1][3].add(s(0, e, g(t) ? t : M)), n[2][3].add(s(0, e, g(i) ? i : q))
                        }).promise()
                    },
                    promise: function (e) {
                        return null != e ? w.extend(e, r) : r
                    }
                },
                o = {};
            return w.each(n, function (e, t) {
                var s = t[2],
                    a = t[5];
                r[t[1]] = s.add, a && s.add(function () {
                    i = a
                }, n[3 - e][2].disable, n[3 - e][3].disable, n[0][2].lock, n[0][3].lock), s.add(t[3].fire), o[t[0]] = function () {
                    return o[t[0] + "With"](this === o ? void 0 : this, arguments), this
                }, o[t[0] + "With"] = s.fireWith
            }), r.promise(o), t && t.call(o, o), o
        },
        when: function (e) {
            var t = arguments.length,
                n = t,
                i = Array(n),
                r = o.call(arguments),
                s = w.Deferred(),
                a = function (e) {
                    return function (n) {
                        i[e] = this, r[e] = 1 < arguments.length ? o.call(arguments) : n, --t || s.resolveWith(i, r)
                    }
                };
            if (t <= 1 && (R(e, s.done(a(n)).resolve, s.reject, !t), "pending" === s.state() || g(r[n] && r[n].then))) return s.then();
            for (; n--;) R(r[n], a(n), s.reject);
            return s.promise()
        }
    });
    var F = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
    w.Deferred.exceptionHook = function (t, n) {
        e.console && e.console.warn && t && F.test(t.name) && e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, n)
    }, w.readyException = function (t) {
        e.setTimeout(function () {
            throw t
        })
    };
    var W = w.Deferred();

    function B() {
        i.removeEventListener("DOMContentLoaded", B), e.removeEventListener("load", B), w.ready()
    }
    w.fn.ready = function (e) {
        return W.then(e).catch(function (e) {
            w.readyException(e)
        }), this
    }, w.extend({
        isReady: !1,
        readyWait: 1,
        ready: function (e) {
            (!0 === e ? --w.readyWait : w.isReady) || (w.isReady = !0) !== e && 0 < --w.readyWait || W.resolveWith(i, [w])
        }
    }), w.ready.then = W.then, "complete" === i.readyState || "loading" !== i.readyState && !i.documentElement.doScroll ? e.setTimeout(w.ready) : (i.addEventListener("DOMContentLoaded", B), e.addEventListener("load", B));
    var U = function (e, t, n, i, r, o, s) {
            var a = 0,
                l = e.length,
                c = null == n;
            if ("object" === b(n))
                for (a in r = !0, n) U(e, t, a, n[a], !0, o, s);
            else if (void 0 !== i && (r = !0, g(i) || (s = !0), c && (s ? (t.call(e, i), t = null) : (c = t, t = function (e, t, n) {
                    return c.call(w(e), n)
                })), t))
                for (; a < l; a++) t(e[a], n, s ? i : i.call(e[a], a, t(e[a], n)));
            return r ? e : c ? t.call(e) : l ? t(e[0], n) : o
        },
        z = /^-ms-/,
        V = /-([a-z])/g;

    function $(e, t) {
        return t.toUpperCase()
    }

    function Q(e) {
        return e.replace(z, "ms-").replace(V, $)
    }
    var Y = function (e) {
        return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
    };

    function K() {
        this.expando = w.expando + K.uid++
    }
    K.uid = 1, K.prototype = {
        cache: function (e) {
            var t = e[this.expando];
            return t || (t = {}, Y(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                value: t,
                configurable: !0
            }))), t
        },
        set: function (e, t, n) {
            var i, r = this.cache(e);
            if ("string" == typeof t) r[Q(t)] = n;
            else
                for (i in t) r[Q(i)] = t[i];
            return r
        },
        get: function (e, t) {
            return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][Q(t)]
        },
        access: function (e, t, n) {
            return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t)
        },
        remove: function (e, t) {
            var n, i = e[this.expando];
            if (void 0 !== i) {
                if (void 0 !== t) {
                    n = (t = Array.isArray(t) ? t.map(Q) : (t = Q(t)) in i ? [t] : t.match(H) || []).length;
                    for (; n--;) delete i[t[n]]
                }(void 0 === t || w.isEmptyObject(i)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
            }
        },
        hasData: function (e) {
            var t = e[this.expando];
            return void 0 !== t && !w.isEmptyObject(t)
        }
    };
    var X = new K,
        G = new K,
        J = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        Z = /[A-Z]/g;

    function ee(e, t, n) {
        var i, r;
        if (void 0 === n && 1 === e.nodeType)
            if (i = "data-" + t.replace(Z, "-$&").toLowerCase(), "string" == typeof (n = e.getAttribute(i))) {
                try {
                    n = "true" === (r = n) || "false" !== r && ("null" === r ? null : r === +r + "" ? +r : J.test(r) ? JSON.parse(r) : r)
                } catch (e) {}
                G.set(e, t, n)
            } else n = void 0;
        return n
    }
    w.extend({
        hasData: function (e) {
            return G.hasData(e) || X.hasData(e)
        },
        data: function (e, t, n) {
            return G.access(e, t, n)
        },
        removeData: function (e, t) {
            G.remove(e, t)
        },
        _data: function (e, t, n) {
            return X.access(e, t, n)
        },
        _removeData: function (e, t) {
            X.remove(e, t)
        }
    }), w.fn.extend({
        data: function (e, t) {
            var n, i, r, o = this[0],
                s = o && o.attributes;
            if (void 0 === e) {
                if (this.length && (r = G.get(o), 1 === o.nodeType && !X.get(o, "hasDataAttrs"))) {
                    for (n = s.length; n--;) s[n] && 0 === (i = s[n].name).indexOf("data-") && (i = Q(i.slice(5)), ee(o, i, r[i]));
                    X.set(o, "hasDataAttrs", !0)
                }
                return r
            }
            return "object" == typeof e ? this.each(function () {
                G.set(this, e)
            }) : U(this, function (t) {
                var n;
                if (o && void 0 === t) return void 0 !== (n = G.get(o, e)) ? n : void 0 !== (n = ee(o, e)) ? n : void 0;
                this.each(function () {
                    G.set(this, e, t)
                })
            }, null, t, 1 < arguments.length, null, !0)
        },
        removeData: function (e) {
            return this.each(function () {
                G.remove(this, e)
            })
        }
    }), w.extend({
        queue: function (e, t, n) {
            var i;
            if (e) return t = (t || "fx") + "queue", i = X.get(e, t), n && (!i || Array.isArray(n) ? i = X.access(e, t, w.makeArray(n)) : i.push(n)), i || []
        },
        dequeue: function (e, t) {
            t = t || "fx";
            var n = w.queue(e, t),
                i = n.length,
                r = n.shift(),
                o = w._queueHooks(e, t);
            "inprogress" === r && (r = n.shift(), i--), r && ("fx" === t && n.unshift("inprogress"), delete o.stop, r.call(e, function () {
                w.dequeue(e, t)
            }, o)), !i && o && o.empty.fire()
        },
        _queueHooks: function (e, t) {
            var n = t + "queueHooks";
            return X.get(e, n) || X.access(e, n, {
                empty: w.Callbacks("once memory").add(function () {
                    X.remove(e, [t + "queue", n])
                })
            })
        }
    }), w.fn.extend({
        queue: function (e, t) {
            var n = 2;
            return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? w.queue(this[0], e) : void 0 === t ? this : this.each(function () {
                var n = w.queue(this, e, t);
                w._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && w.dequeue(this, e)
            })
        },
        dequeue: function (e) {
            return this.each(function () {
                w.dequeue(this, e)
            })
        },
        clearQueue: function (e) {
            return this.queue(e || "fx", [])
        },
        promise: function (e, t) {
            var n, i = 1,
                r = w.Deferred(),
                o = this,
                s = this.length,
                a = function () {
                    --i || r.resolveWith(o, [o])
                };
            for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; s--;)(n = X.get(o[s], e + "queueHooks")) && n.empty && (i++, n.empty.add(a));
            return a(), r.promise(t)
        }
    });
    var te = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        ne = new RegExp("^(?:([+-])=|)(" + te + ")([a-z%]*)$", "i"),
        ie = ["Top", "Right", "Bottom", "Left"],
        re = i.documentElement,
        oe = function (e) {
            return w.contains(e.ownerDocument, e)
        },
        se = {
            composed: !0
        };
    re.getRootNode && (oe = function (e) {
        return w.contains(e.ownerDocument, e) || e.getRootNode(se) === e.ownerDocument
    });
    var ae = function (e, t) {
            return "none" === (e = t || e).style.display || "" === e.style.display && oe(e) && "none" === w.css(e, "display")
        },
        le = function (e, t, n, i) {
            var r, o, s = {};
            for (o in t) s[o] = e.style[o], e.style[o] = t[o];
            for (o in r = n.apply(e, i || []), t) e.style[o] = s[o];
            return r
        };

    function ce(e, t, n, i) {
        var r, o, s = 20,
            a = i ? function () {
                return i.cur()
            } : function () {
                return w.css(e, t, "")
            },
            l = a(),
            c = n && n[3] || (w.cssNumber[t] ? "" : "px"),
            u = e.nodeType && (w.cssNumber[t] || "px" !== c && +l) && ne.exec(w.css(e, t));
        if (u && u[3] !== c) {
            for (l /= 2, c = c || u[3], u = +l || 1; s--;) w.style(e, t, u + c), (1 - o) * (1 - (o = a() / l || .5)) <= 0 && (s = 0), u /= o;
            u *= 2, w.style(e, t, u + c), n = n || []
        }
        return n && (u = +u || +l || 0, r = n[1] ? u + (n[1] + 1) * n[2] : +n[2], i && (i.unit = c, i.start = u, i.end = r)), r
    }
    var ue = {};

    function fe(e, t) {
        for (var n, i, r, o, s, a, l, c = [], u = 0, f = e.length; u < f; u++)(i = e[u]).style && (n = i.style.display, t ? ("none" === n && (c[u] = X.get(i, "display") || null, c[u] || (i.style.display = "")), "" === i.style.display && ae(i) && (c[u] = (l = s = o = void 0, s = (r = i).ownerDocument, a = r.nodeName, (l = ue[a]) || (o = s.body.appendChild(s.createElement(a)), l = w.css(o, "display"), o.parentNode.removeChild(o), "none" === l && (l = "block"), ue[a] = l)))) : "none" !== n && (c[u] = "none", X.set(i, "display", n)));
        for (u = 0; u < f; u++) null != c[u] && (e[u].style.display = c[u]);
        return e
    }
    w.fn.extend({
        show: function () {
            return fe(this, !0)
        },
        hide: function () {
            return fe(this)
        },
        toggle: function (e) {
            return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function () {
                ae(this) ? w(this).show() : w(this).hide()
            })
        }
    });
    var he = /^(?:checkbox|radio)$/i,
        de = /<([a-z][^\/\0>\x20\t\r\n\f]*)/i,
        pe = /^$|^module$|\/(?:java|ecma)script/i,
        ge = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            thead: [1, "<table>", "</table>"],
            col: [2, "<table><colgroup>", "</colgroup></table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: [0, "", ""]
        };

    function me(e, t) {
        var n;
        return n = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && D(e, t) ? w.merge([e], n) : n
    }

    function ve(e, t) {
        for (var n = 0, i = e.length; n < i; n++) X.set(e[n], "globalEval", !t || X.get(t[n], "globalEval"))
    }
    ge.optgroup = ge.option, ge.tbody = ge.tfoot = ge.colgroup = ge.caption = ge.thead, ge.th = ge.td;
    var ye, be, _e = /<|&#?\w+;/;

    function we(e, t, n, i, r) {
        for (var o, s, a, l, c, u, f = t.createDocumentFragment(), h = [], d = 0, p = e.length; d < p; d++)
            if ((o = e[d]) || 0 === o)
                if ("object" === b(o)) w.merge(h, o.nodeType ? [o] : o);
                else if (_e.test(o)) {
            for (s = s || f.appendChild(t.createElement("div")), a = (de.exec(o) || ["", ""])[1].toLowerCase(), l = ge[a] || ge._default, s.innerHTML = l[1] + w.htmlPrefilter(o) + l[2], u = l[0]; u--;) s = s.lastChild;
            w.merge(h, s.childNodes), (s = f.firstChild).textContent = ""
        } else h.push(t.createTextNode(o));
        for (f.textContent = "", d = 0; o = h[d++];)
            if (i && -1 < w.inArray(o, i)) r && r.push(o);
            else if (c = oe(o), s = me(f.appendChild(o), "script"), c && ve(s), n)
            for (u = 0; o = s[u++];) pe.test(o.type || "") && n.push(o);
        return f
    }
    ye = i.createDocumentFragment().appendChild(i.createElement("div")), (be = i.createElement("input")).setAttribute("type", "radio"), be.setAttribute("checked", "checked"), be.setAttribute("name", "t"), ye.appendChild(be), p.checkClone = ye.cloneNode(!0).cloneNode(!0).lastChild.checked, ye.innerHTML = "<textarea>x</textarea>", p.noCloneChecked = !!ye.cloneNode(!0).lastChild.defaultValue;
    var Ee = /^key/,
        xe = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        Te = /^([^.]*)(?:\.(.+)|)/;

    function Ce() {
        return !0
    }

    function Se() {
        return !1
    }

    function Ae(e, t) {
        return e === function () {
            try {
                return i.activeElement
            } catch (e) {}
        }() == ("focus" === t)
    }

    function De(e, t, n, i, r, o) {
        var s, a;
        if ("object" == typeof t) {
            for (a in "string" != typeof n && (i = i || n, n = void 0), t) De(e, a, n, i, t[a], o);
            return e
        }
        if (null == i && null == r ? (r = n, i = n = void 0) : null == r && ("string" == typeof n ? (r = i, i = void 0) : (r = i, i = n, n = void 0)), !1 === r) r = Se;
        else if (!r) return e;
        return 1 === o && (s = r, (r = function (e) {
            return w().off(e), s.apply(this, arguments)
        }).guid = s.guid || (s.guid = w.guid++)), e.each(function () {
            w.event.add(this, t, r, i, n)
        })
    }

    function ke(e, t, n) {
        n ? (X.set(e, t, !1), w.event.add(e, t, {
            namespace: !1,
            handler: function (e) {
                var i, r, s = X.get(this, t);
                if (1 & e.isTrigger && this[t]) {
                    if (s.length)(w.event.special[t] || {}).delegateType && e.stopPropagation();
                    else if (s = o.call(arguments), X.set(this, t, s), i = n(this, t), this[t](), s !== (r = X.get(this, t)) || i ? X.set(this, t, !1) : r = {}, s !== r) return e.stopImmediatePropagation(), e.preventDefault(), r.value
                } else s.length && (X.set(this, t, {
                    value: w.event.trigger(w.extend(s[0], w.Event.prototype), s.slice(1), this)
                }), e.stopImmediatePropagation())
            }
        })) : void 0 === X.get(e, t) && w.event.add(e, t, Ce)
    }
    w.event = {
        global: {},
        add: function (e, t, n, i, r) {
            var o, s, a, l, c, u, f, h, d, p, g, m = X.get(e);
            if (m)
                for (n.handler && (n = (o = n).handler, r = o.selector), r && w.find.matchesSelector(re, r), n.guid || (n.guid = w.guid++), (l = m.events) || (l = m.events = {}), (s = m.handle) || (s = m.handle = function (t) {
                        return void 0 !== w && w.event.triggered !== t.type ? w.event.dispatch.apply(e, arguments) : void 0
                    }), c = (t = (t || "").match(H) || [""]).length; c--;) d = g = (a = Te.exec(t[c]) || [])[1], p = (a[2] || "").split(".").sort(), d && (f = w.event.special[d] || {}, d = (r ? f.delegateType : f.bindType) || d, f = w.event.special[d] || {}, u = w.extend({
                    type: d,
                    origType: g,
                    data: i,
                    handler: n,
                    guid: n.guid,
                    selector: r,
                    needsContext: r && w.expr.match.needsContext.test(r),
                    namespace: p.join(".")
                }, o), (h = l[d]) || ((h = l[d] = []).delegateCount = 0, f.setup && !1 !== f.setup.call(e, i, p, s) || e.addEventListener && e.addEventListener(d, s)), f.add && (f.add.call(e, u), u.handler.guid || (u.handler.guid = n.guid)), r ? h.splice(h.delegateCount++, 0, u) : h.push(u), w.event.global[d] = !0)
        },
        remove: function (e, t, n, i, r) {
            var o, s, a, l, c, u, f, h, d, p, g, m = X.hasData(e) && X.get(e);
            if (m && (l = m.events)) {
                for (c = (t = (t || "").match(H) || [""]).length; c--;)
                    if (d = g = (a = Te.exec(t[c]) || [])[1], p = (a[2] || "").split(".").sort(), d) {
                        for (f = w.event.special[d] || {}, h = l[d = (i ? f.delegateType : f.bindType) || d] || [], a = a[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), s = o = h.length; o--;) u = h[o], !r && g !== u.origType || n && n.guid !== u.guid || a && !a.test(u.namespace) || i && i !== u.selector && ("**" !== i || !u.selector) || (h.splice(o, 1), u.selector && h.delegateCount--, f.remove && f.remove.call(e, u));
                        s && !h.length && (f.teardown && !1 !== f.teardown.call(e, p, m.handle) || w.removeEvent(e, d, m.handle), delete l[d])
                    } else
                        for (d in l) w.event.remove(e, d + t[c], n, i, !0);
                w.isEmptyObject(l) && X.remove(e, "handle events")
            }
        },
        dispatch: function (e) {
            var t, n, i, r, o, s, a = w.event.fix(e),
                l = new Array(arguments.length),
                c = (X.get(this, "events") || {})[a.type] || [],
                u = w.event.special[a.type] || {};
            for (l[0] = a, t = 1; t < arguments.length; t++) l[t] = arguments[t];
            if (a.delegateTarget = this, !u.preDispatch || !1 !== u.preDispatch.call(this, a)) {
                for (s = w.event.handlers.call(this, a, c), t = 0;
                    (r = s[t++]) && !a.isPropagationStopped();)
                    for (a.currentTarget = r.elem, n = 0;
                        (o = r.handlers[n++]) && !a.isImmediatePropagationStopped();) a.rnamespace && !1 !== o.namespace && !a.rnamespace.test(o.namespace) || (a.handleObj = o, a.data = o.data, void 0 !== (i = ((w.event.special[o.origType] || {}).handle || o.handler).apply(r.elem, l)) && !1 === (a.result = i) && (a.preventDefault(), a.stopPropagation()));
                return u.postDispatch && u.postDispatch.call(this, a), a.result
            }
        },
        handlers: function (e, t) {
            var n, i, r, o, s, a = [],
                l = t.delegateCount,
                c = e.target;
            if (l && c.nodeType && !("click" === e.type && 1 <= e.button))
                for (; c !== this; c = c.parentNode || this)
                    if (1 === c.nodeType && ("click" !== e.type || !0 !== c.disabled)) {
                        for (o = [], s = {}, n = 0; n < l; n++) void 0 === s[r = (i = t[n]).selector + " "] && (s[r] = i.needsContext ? -1 < w(r, this).index(c) : w.find(r, this, null, [c]).length), s[r] && o.push(i);
                        o.length && a.push({
                            elem: c,
                            handlers: o
                        })
                    } return c = this, l < t.length && a.push({
                elem: c,
                handlers: t.slice(l)
            }), a
        },
        addProp: function (e, t) {
            Object.defineProperty(w.Event.prototype, e, {
                enumerable: !0,
                configurable: !0,
                get: g(t) ? function () {
                    if (this.originalEvent) return t(this.originalEvent)
                } : function () {
                    if (this.originalEvent) return this.originalEvent[e]
                },
                set: function (t) {
                    Object.defineProperty(this, e, {
                        enumerable: !0,
                        configurable: !0,
                        writable: !0,
                        value: t
                    })
                }
            })
        },
        fix: function (e) {
            return e[w.expando] ? e : new w.Event(e)
        },
        special: {
            load: {
                noBubble: !0
            },
            click: {
                setup: function (e) {
                    var t = this || e;
                    return he.test(t.type) && t.click && D(t, "input") && ke(t, "click", Ce), !1
                },
                trigger: function (e) {
                    var t = this || e;
                    return he.test(t.type) && t.click && D(t, "input") && ke(t, "click"), !0
                },
                _default: function (e) {
                    var t = e.target;
                    return he.test(t.type) && t.click && D(t, "input") && X.get(t, "click") || D(t, "a")
                }
            },
            beforeunload: {
                postDispatch: function (e) {
                    void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                }
            }
        }
    }, w.removeEvent = function (e, t, n) {
        e.removeEventListener && e.removeEventListener(t, n)
    }, w.Event = function (e, t) {
        if (!(this instanceof w.Event)) return new w.Event(e, t);
        e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? Ce : Se, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && w.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[w.expando] = !0
    }, w.Event.prototype = {
        constructor: w.Event,
        isDefaultPrevented: Se,
        isPropagationStopped: Se,
        isImmediatePropagationStopped: Se,
        isSimulated: !1,
        preventDefault: function () {
            var e = this.originalEvent;
            this.isDefaultPrevented = Ce, e && !this.isSimulated && e.preventDefault()
        },
        stopPropagation: function () {
            var e = this.originalEvent;
            this.isPropagationStopped = Ce, e && !this.isSimulated && e.stopPropagation()
        },
        stopImmediatePropagation: function () {
            var e = this.originalEvent;
            this.isImmediatePropagationStopped = Ce, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
        }
    }, w.each({
        altKey: !0,
        bubbles: !0,
        cancelable: !0,
        changedTouches: !0,
        ctrlKey: !0,
        detail: !0,
        eventPhase: !0,
        metaKey: !0,
        pageX: !0,
        pageY: !0,
        shiftKey: !0,
        view: !0,
        char: !0,
        code: !0,
        charCode: !0,
        key: !0,
        keyCode: !0,
        button: !0,
        buttons: !0,
        clientX: !0,
        clientY: !0,
        offsetX: !0,
        offsetY: !0,
        pointerId: !0,
        pointerType: !0,
        screenX: !0,
        screenY: !0,
        targetTouches: !0,
        toElement: !0,
        touches: !0,
        which: function (e) {
            var t = e.button;
            return null == e.which && Ee.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && xe.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
        }
    }, w.event.addProp), w.each({
        focus: "focusin",
        blur: "focusout"
    }, function (e, t) {
        w.event.special[e] = {
            setup: function () {
                return ke(this, e, Ae), !1
            },
            trigger: function () {
                return ke(this, e), !0
            },
            delegateType: t
        }
    }), w.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout"
    }, function (e, t) {
        w.event.special[e] = {
            delegateType: t,
            bindType: t,
            handle: function (e) {
                var n, i = e.relatedTarget,
                    r = e.handleObj;
                return i && (i === this || w.contains(this, i)) || (e.type = r.origType, n = r.handler.apply(this, arguments), e.type = t), n
            }
        }
    }), w.fn.extend({
        on: function (e, t, n, i) {
            return De(this, e, t, n, i)
        },
        one: function (e, t, n, i) {
            return De(this, e, t, n, i, 1)
        },
        off: function (e, t, n) {
            var i, r;
            if (e && e.preventDefault && e.handleObj) return i = e.handleObj, w(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
            if ("object" == typeof e) {
                for (r in e) this.off(r, t, e[r]);
                return this
            }
            return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = Se), this.each(function () {
                w.event.remove(this, e, n, t)
            })
        }
    });
    var Ne = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
        Ie = /<script|<style|<link/i,
        Oe = /checked\s*(?:[^=]|=\s*.checked.)/i,
        je = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

    function Le(e, t) {
        return D(e, "table") && D(11 !== t.nodeType ? t : t.firstChild, "tr") && w(e).children("tbody")[0] || e
    }

    function Pe(e) {
        return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
    }

    function He(e) {
        return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), e
    }

    function Me(e, t) {
        var n, i, r, o, s, a, l, c;
        if (1 === t.nodeType) {
            if (X.hasData(e) && (o = X.access(e), s = X.set(t, o), c = o.events))
                for (r in delete s.handle, s.events = {}, c)
                    for (n = 0, i = c[r].length; n < i; n++) w.event.add(t, r, c[r][n]);
            G.hasData(e) && (a = G.access(e), l = w.extend({}, a), G.set(t, l))
        }
    }

    function qe(e, t, n, i) {
        t = s.apply([], t);
        var r, o, a, l, c, u, f = 0,
            h = e.length,
            d = h - 1,
            m = t[0],
            v = g(m);
        if (v || 1 < h && "string" == typeof m && !p.checkClone && Oe.test(m)) return e.each(function (r) {
            var o = e.eq(r);
            v && (t[0] = m.call(this, r, o.html())), qe(o, t, n, i)
        });
        if (h && (o = (r = we(t, e[0].ownerDocument, !1, e, i)).firstChild, 1 === r.childNodes.length && (r = o), o || i)) {
            for (l = (a = w.map(me(r, "script"), Pe)).length; f < h; f++) c = r, f !== d && (c = w.clone(c, !0, !0), l && w.merge(a, me(c, "script"))), n.call(e[f], c, f);
            if (l)
                for (u = a[a.length - 1].ownerDocument, w.map(a, He), f = 0; f < l; f++) c = a[f], pe.test(c.type || "") && !X.access(c, "globalEval") && w.contains(u, c) && (c.src && "module" !== (c.type || "").toLowerCase() ? w._evalUrl && !c.noModule && w._evalUrl(c.src, {
                    nonce: c.nonce || c.getAttribute("nonce")
                }) : y(c.textContent.replace(je, ""), c, u))
        }
        return e
    }

    function Re(e, t, n) {
        for (var i, r = t ? w.filter(t, e) : e, o = 0; null != (i = r[o]); o++) n || 1 !== i.nodeType || w.cleanData(me(i)), i.parentNode && (n && oe(i) && ve(me(i, "script")), i.parentNode.removeChild(i));
        return e
    }
    w.extend({
        htmlPrefilter: function (e) {
            return e.replace(Ne, "<$1></$2>")
        },
        clone: function (e, t, n) {
            var i, r, o, s, a, l, c, u = e.cloneNode(!0),
                f = oe(e);
            if (!(p.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || w.isXMLDoc(e)))
                for (s = me(u), i = 0, r = (o = me(e)).length; i < r; i++) a = o[i], "input" === (c = (l = s[i]).nodeName.toLowerCase()) && he.test(a.type) ? l.checked = a.checked : "input" !== c && "textarea" !== c || (l.defaultValue = a.defaultValue);
            if (t)
                if (n)
                    for (o = o || me(e), s = s || me(u), i = 0, r = o.length; i < r; i++) Me(o[i], s[i]);
                else Me(e, u);
            return 0 < (s = me(u, "script")).length && ve(s, !f && me(e, "script")), u
        },
        cleanData: function (e) {
            for (var t, n, i, r = w.event.special, o = 0; void 0 !== (n = e[o]); o++)
                if (Y(n)) {
                    if (t = n[X.expando]) {
                        if (t.events)
                            for (i in t.events) r[i] ? w.event.remove(n, i) : w.removeEvent(n, i, t.handle);
                        n[X.expando] = void 0
                    }
                    n[G.expando] && (n[G.expando] = void 0)
                }
        }
    }), w.fn.extend({
        detach: function (e) {
            return Re(this, e, !0)
        },
        remove: function (e) {
            return Re(this, e)
        },
        text: function (e) {
            return U(this, function (e) {
                return void 0 === e ? w.text(this) : this.empty().each(function () {
                    1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
                })
            }, null, e, arguments.length)
        },
        append: function () {
            return qe(this, arguments, function (e) {
                1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || Le(this, e).appendChild(e)
            })
        },
        prepend: function () {
            return qe(this, arguments, function (e) {
                if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                    var t = Le(this, e);
                    t.insertBefore(e, t.firstChild)
                }
            })
        },
        before: function () {
            return qe(this, arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this)
            })
        },
        after: function () {
            return qe(this, arguments, function (e) {
                this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
            })
        },
        empty: function () {
            for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (w.cleanData(me(e, !1)), e.textContent = "");
            return this
        },
        clone: function (e, t) {
            return e = null != e && e, t = null == t ? e : t, this.map(function () {
                return w.clone(this, e, t)
            })
        },
        html: function (e) {
            return U(this, function (e) {
                var t = this[0] || {},
                    n = 0,
                    i = this.length;
                if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
                if ("string" == typeof e && !Ie.test(e) && !ge[(de.exec(e) || ["", ""])[1].toLowerCase()]) {
                    e = w.htmlPrefilter(e);
                    try {
                        for (; n < i; n++) 1 === (t = this[n] || {}).nodeType && (w.cleanData(me(t, !1)), t.innerHTML = e);
                        t = 0
                    } catch (e) {}
                }
                t && this.empty().append(e)
            }, null, e, arguments.length)
        },
        replaceWith: function () {
            var e = [];
            return qe(this, arguments, function (t) {
                var n = this.parentNode;
                w.inArray(this, e) < 0 && (w.cleanData(me(this)), n && n.replaceChild(t, this))
            }, e)
        }
    }), w.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (e, t) {
        w.fn[e] = function (e) {
            for (var n, i = [], r = w(e), o = r.length - 1, s = 0; s <= o; s++) n = s === o ? this : this.clone(!0), w(r[s])[t](n), a.apply(i, n.get());
            return this.pushStack(i)
        }
    });
    var Fe = new RegExp("^(" + te + ")(?!px)[a-z%]+$", "i"),
        We = function (t) {
            var n = t.ownerDocument.defaultView;
            return n && n.opener || (n = e), n.getComputedStyle(t)
        },
        Be = new RegExp(ie.join("|"), "i");

    function Ue(e, t, n) {
        var i, r, o, s, a = e.style;
        return (n = n || We(e)) && ("" !== (s = n.getPropertyValue(t) || n[t]) || oe(e) || (s = w.style(e, t)), !p.pixelBoxStyles() && Fe.test(s) && Be.test(t) && (i = a.width, r = a.minWidth, o = a.maxWidth, a.minWidth = a.maxWidth = a.width = s, s = n.width, a.width = i, a.minWidth = r, a.maxWidth = o)), void 0 !== s ? s + "" : s
    }

    function ze(e, t) {
        return {
            get: function () {
                if (!e()) return (this.get = t).apply(this, arguments);
                delete this.get
            }
        }
    }! function () {
        function t() {
            if (u) {
                c.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", u.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", re.appendChild(c).appendChild(u);
                var t = e.getComputedStyle(u);
                r = "1%" !== t.top, l = 12 === n(t.marginLeft), u.style.right = "60%", a = 36 === n(t.right), o = 36 === n(t.width), u.style.position = "absolute", s = 12 === n(u.offsetWidth / 3), re.removeChild(c), u = null
            }
        }

        function n(e) {
            return Math.round(parseFloat(e))
        }
        var r, o, s, a, l, c = i.createElement("div"),
            u = i.createElement("div");
        u.style && (u.style.backgroundClip = "content-box", u.cloneNode(!0).style.backgroundClip = "", p.clearCloneStyle = "content-box" === u.style.backgroundClip, w.extend(p, {
            boxSizingReliable: function () {
                return t(), o
            },
            pixelBoxStyles: function () {
                return t(), a
            },
            pixelPosition: function () {
                return t(), r
            },
            reliableMarginLeft: function () {
                return t(), l
            },
            scrollboxSize: function () {
                return t(), s
            }
        }))
    }();
    var Ve = ["Webkit", "Moz", "ms"],
        $e = i.createElement("div").style,
        Qe = {};

    function Ye(e) {
        return w.cssProps[e] || Qe[e] || (e in $e ? e : Qe[e] = function (e) {
            for (var t = e[0].toUpperCase() + e.slice(1), n = Ve.length; n--;)
                if ((e = Ve[n] + t) in $e) return e
        }(e) || e)
    }
    var Ke = /^(none|table(?!-c[ea]).+)/,
        Xe = /^--/,
        Ge = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        Je = {
            letterSpacing: "0",
            fontWeight: "400"
        };

    function Ze(e, t, n) {
        var i = ne.exec(t);
        return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : t
    }

    function et(e, t, n, i, r, o) {
        var s = "width" === t ? 1 : 0,
            a = 0,
            l = 0;
        if (n === (i ? "border" : "content")) return 0;
        for (; s < 4; s += 2) "margin" === n && (l += w.css(e, n + ie[s], !0, r)), i ? ("content" === n && (l -= w.css(e, "padding" + ie[s], !0, r)), "margin" !== n && (l -= w.css(e, "border" + ie[s] + "Width", !0, r))) : (l += w.css(e, "padding" + ie[s], !0, r), "padding" !== n ? l += w.css(e, "border" + ie[s] + "Width", !0, r) : a += w.css(e, "border" + ie[s] + "Width", !0, r));
        return !i && 0 <= o && (l += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - o - l - a - .5)) || 0), l
    }

    function tt(e, t, n) {
        var i = We(e),
            r = (!p.boxSizingReliable() || n) && "border-box" === w.css(e, "boxSizing", !1, i),
            o = r,
            s = Ue(e, t, i),
            a = "offset" + t[0].toUpperCase() + t.slice(1);
        if (Fe.test(s)) {
            if (!n) return s;
            s = "auto"
        }
        return (!p.boxSizingReliable() && r || "auto" === s || !parseFloat(s) && "inline" === w.css(e, "display", !1, i)) && e.getClientRects().length && (r = "border-box" === w.css(e, "boxSizing", !1, i), (o = a in e) && (s = e[a])), (s = parseFloat(s) || 0) + et(e, t, n || (r ? "border" : "content"), o, i, s) + "px"
    }

    function nt(e, t, n, i, r) {
        return new nt.prototype.init(e, t, n, i, r)
    }
    w.extend({
        cssHooks: {
            opacity: {
                get: function (e, t) {
                    if (t) {
                        var n = Ue(e, "opacity");
                        return "" === n ? "1" : n
                    }
                }
            }
        },
        cssNumber: {
            animationIterationCount: !0,
            columnCount: !0,
            fillOpacity: !0,
            flexGrow: !0,
            flexShrink: !0,
            fontWeight: !0,
            gridArea: !0,
            gridColumn: !0,
            gridColumnEnd: !0,
            gridColumnStart: !0,
            gridRow: !0,
            gridRowEnd: !0,
            gridRowStart: !0,
            lineHeight: !0,
            opacity: !0,
            order: !0,
            orphans: !0,
            widows: !0,
            zIndex: !0,
            zoom: !0
        },
        cssProps: {},
        style: function (e, t, n, i) {
            if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                var r, o, s, a = Q(t),
                    l = Xe.test(t),
                    c = e.style;
                if (l || (t = Ye(a)), s = w.cssHooks[t] || w.cssHooks[a], void 0 === n) return s && "get" in s && void 0 !== (r = s.get(e, !1, i)) ? r : c[t];
                "string" == (o = typeof n) && (r = ne.exec(n)) && r[1] && (n = ce(e, t, r), o = "number"), null != n && n == n && ("number" !== o || l || (n += r && r[3] || (w.cssNumber[a] ? "" : "px")), p.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (c[t] = "inherit"), s && "set" in s && void 0 === (n = s.set(e, n, i)) || (l ? c.setProperty(t, n) : c[t] = n))
            }
        },
        css: function (e, t, n, i) {
            var r, o, s, a = Q(t);
            return Xe.test(t) || (t = Ye(a)), (s = w.cssHooks[t] || w.cssHooks[a]) && "get" in s && (r = s.get(e, !0, n)), void 0 === r && (r = Ue(e, t, i)), "normal" === r && t in Je && (r = Je[t]), "" === n || n ? (o = parseFloat(r), !0 === n || isFinite(o) ? o || 0 : r) : r
        }
    }), w.each(["height", "width"], function (e, t) {
        w.cssHooks[t] = {
            get: function (e, n, i) {
                if (n) return !Ke.test(w.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? tt(e, t, i) : le(e, Ge, function () {
                    return tt(e, t, i)
                })
            },
            set: function (e, n, i) {
                var r, o = We(e),
                    s = !p.scrollboxSize() && "absolute" === o.position,
                    a = (s || i) && "border-box" === w.css(e, "boxSizing", !1, o),
                    l = i ? et(e, t, i, a, o) : 0;
                return a && s && (l -= Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - parseFloat(o[t]) - et(e, t, "border", !1, o) - .5)), l && (r = ne.exec(n)) && "px" !== (r[3] || "px") && (e.style[t] = n, n = w.css(e, t)), Ze(0, n, l)
            }
        }
    }), w.cssHooks.marginLeft = ze(p.reliableMarginLeft, function (e, t) {
        if (t) return (parseFloat(Ue(e, "marginLeft")) || e.getBoundingClientRect().left - le(e, {
            marginLeft: 0
        }, function () {
            return e.getBoundingClientRect().left
        })) + "px"
    }), w.each({
        margin: "",
        padding: "",
        border: "Width"
    }, function (e, t) {
        w.cssHooks[e + t] = {
            expand: function (n) {
                for (var i = 0, r = {}, o = "string" == typeof n ? n.split(" ") : [n]; i < 4; i++) r[e + ie[i] + t] = o[i] || o[i - 2] || o[0];
                return r
            }
        }, "margin" !== e && (w.cssHooks[e + t].set = Ze)
    }), w.fn.extend({
        css: function (e, t) {
            return U(this, function (e, t, n) {
                var i, r, o = {},
                    s = 0;
                if (Array.isArray(t)) {
                    for (i = We(e), r = t.length; s < r; s++) o[t[s]] = w.css(e, t[s], !1, i);
                    return o
                }
                return void 0 !== n ? w.style(e, t, n) : w.css(e, t)
            }, e, t, 1 < arguments.length)
        }
    }), ((w.Tween = nt).prototype = {
        constructor: nt,
        init: function (e, t, n, i, r, o) {
            this.elem = e, this.prop = n, this.easing = r || w.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = o || (w.cssNumber[n] ? "" : "px")
        },
        cur: function () {
            var e = nt.propHooks[this.prop];
            return e && e.get ? e.get(this) : nt.propHooks._default.get(this)
        },
        run: function (e) {
            var t, n = nt.propHooks[this.prop];
            return this.options.duration ? this.pos = t = w.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : nt.propHooks._default.set(this), this
        }
    }).init.prototype = nt.prototype, (nt.propHooks = {
        _default: {
            get: function (e) {
                var t;
                return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = w.css(e.elem, e.prop, "")) && "auto" !== t ? t : 0
            },
            set: function (e) {
                w.fx.step[e.prop] ? w.fx.step[e.prop](e) : 1 !== e.elem.nodeType || !w.cssHooks[e.prop] && null == e.elem.style[Ye(e.prop)] ? e.elem[e.prop] = e.now : w.style(e.elem, e.prop, e.now + e.unit)
            }
        }
    }).scrollTop = nt.propHooks.scrollLeft = {
        set: function (e) {
            e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
        }
    }, w.easing = {
        linear: function (e) {
            return e
        },
        swing: function (e) {
            return .5 - Math.cos(e * Math.PI) / 2
        },
        _default: "swing"
    }, w.fx = nt.prototype.init, w.fx.step = {};
    var it, rt, ot, st, at = /^(?:toggle|show|hide)$/,
        lt = /queueHooks$/;

    function ct() {
        rt && (!1 === i.hidden && e.requestAnimationFrame ? e.requestAnimationFrame(ct) : e.setTimeout(ct, w.fx.interval), w.fx.tick())
    }

    function ut() {
        return e.setTimeout(function () {
            it = void 0
        }), it = Date.now()
    }

    function ft(e, t) {
        var n, i = 0,
            r = {
                height: e
            };
        for (t = t ? 1 : 0; i < 4; i += 2 - t) r["margin" + (n = ie[i])] = r["padding" + n] = e;
        return t && (r.opacity = r.width = e), r
    }

    function ht(e, t, n) {
        for (var i, r = (dt.tweeners[t] || []).concat(dt.tweeners["*"]), o = 0, s = r.length; o < s; o++)
            if (i = r[o].call(n, t, e)) return i
    }

    function dt(e, t, n) {
        var i, r, o = 0,
            s = dt.prefilters.length,
            a = w.Deferred().always(function () {
                delete l.elem
            }),
            l = function () {
                if (r) return !1;
                for (var t = it || ut(), n = Math.max(0, c.startTime + c.duration - t), i = 1 - (n / c.duration || 0), o = 0, s = c.tweens.length; o < s; o++) c.tweens[o].run(i);
                return a.notifyWith(e, [c, i, n]), i < 1 && s ? n : (s || a.notifyWith(e, [c, 1, 0]), a.resolveWith(e, [c]), !1)
            },
            c = a.promise({
                elem: e,
                props: w.extend({}, t),
                opts: w.extend(!0, {
                    specialEasing: {},
                    easing: w.easing._default
                }, n),
                originalProperties: t,
                originalOptions: n,
                startTime: it || ut(),
                duration: n.duration,
                tweens: [],
                createTween: function (t, n) {
                    var i = w.Tween(e, c.opts, t, n, c.opts.specialEasing[t] || c.opts.easing);
                    return c.tweens.push(i), i
                },
                stop: function (t) {
                    var n = 0,
                        i = t ? c.tweens.length : 0;
                    if (r) return this;
                    for (r = !0; n < i; n++) c.tweens[n].run(1);
                    return t ? (a.notifyWith(e, [c, 1, 0]), a.resolveWith(e, [c, t])) : a.rejectWith(e, [c, t]), this
                }
            }),
            u = c.props;
        for (function (e, t) {
                var n, i, r, o, s;
                for (n in e)
                    if (r = t[i = Q(n)], o = e[n], Array.isArray(o) && (r = o[1], o = e[n] = o[0]), n !== i && (e[i] = o, delete e[n]), (s = w.cssHooks[i]) && "expand" in s)
                        for (n in o = s.expand(o), delete e[i], o) n in e || (e[n] = o[n], t[n] = r);
                    else t[i] = r
            }(u, c.opts.specialEasing); o < s; o++)
            if (i = dt.prefilters[o].call(c, e, u, c.opts)) return g(i.stop) && (w._queueHooks(c.elem, c.opts.queue).stop = i.stop.bind(i)), i;
        return w.map(u, ht, c), g(c.opts.start) && c.opts.start.call(e, c), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always), w.fx.timer(w.extend(l, {
            elem: e,
            anim: c,
            queue: c.opts.queue
        })), c
    }
    w.Animation = w.extend(dt, {
        tweeners: {
            "*": [function (e, t) {
                var n = this.createTween(e, t);
                return ce(n.elem, e, ne.exec(t), n), n
            }]
        },
        tweener: function (e, t) {
            g(e) ? (t = e, e = ["*"]) : e = e.match(H);
            for (var n, i = 0, r = e.length; i < r; i++) n = e[i], dt.tweeners[n] = dt.tweeners[n] || [], dt.tweeners[n].unshift(t)
        },
        prefilters: [function (e, t, n) {
            var i, r, o, s, a, l, c, u, f = "width" in t || "height" in t,
                h = this,
                d = {},
                p = e.style,
                g = e.nodeType && ae(e),
                m = X.get(e, "fxshow");
            for (i in n.queue || (null == (s = w._queueHooks(e, "fx")).unqueued && (s.unqueued = 0, a = s.empty.fire, s.empty.fire = function () {
                    s.unqueued || a()
                }), s.unqueued++, h.always(function () {
                    h.always(function () {
                        s.unqueued--, w.queue(e, "fx").length || s.empty.fire()
                    })
                })), t)
                if (r = t[i], at.test(r)) {
                    if (delete t[i], o = o || "toggle" === r, r === (g ? "hide" : "show")) {
                        if ("show" !== r || !m || void 0 === m[i]) continue;
                        g = !0
                    }
                    d[i] = m && m[i] || w.style(e, i)
                } if ((l = !w.isEmptyObject(t)) || !w.isEmptyObject(d))
                for (i in f && 1 === e.nodeType && (n.overflow = [p.overflow, p.overflowX, p.overflowY], null == (c = m && m.display) && (c = X.get(e, "display")), "none" === (u = w.css(e, "display")) && (c ? u = c : (fe([e], !0), c = e.style.display || c, u = w.css(e, "display"), fe([e]))), ("inline" === u || "inline-block" === u && null != c) && "none" === w.css(e, "float") && (l || (h.done(function () {
                        p.display = c
                    }), null == c && (u = p.display, c = "none" === u ? "" : u)), p.display = "inline-block")), n.overflow && (p.overflow = "hidden", h.always(function () {
                        p.overflow = n.overflow[0], p.overflowX = n.overflow[1], p.overflowY = n.overflow[2]
                    })), l = !1, d) l || (m ? "hidden" in m && (g = m.hidden) : m = X.access(e, "fxshow", {
                    display: c
                }), o && (m.hidden = !g), g && fe([e], !0), h.done(function () {
                    for (i in g || fe([e]), X.remove(e, "fxshow"), d) w.style(e, i, d[i])
                })), l = ht(g ? m[i] : 0, i, h), i in m || (m[i] = l.start, g && (l.end = l.start, l.start = 0))
        }],
        prefilter: function (e, t) {
            t ? dt.prefilters.unshift(e) : dt.prefilters.push(e)
        }
    }), w.speed = function (e, t, n) {
        var i = e && "object" == typeof e ? w.extend({}, e) : {
            complete: n || !n && t || g(e) && e,
            duration: e,
            easing: n && t || t && !g(t) && t
        };
        return w.fx.off ? i.duration = 0 : "number" != typeof i.duration && (i.duration in w.fx.speeds ? i.duration = w.fx.speeds[i.duration] : i.duration = w.fx.speeds._default), null != i.queue && !0 !== i.queue || (i.queue = "fx"), i.old = i.complete, i.complete = function () {
            g(i.old) && i.old.call(this), i.queue && w.dequeue(this, i.queue)
        }, i
    }, w.fn.extend({
        fadeTo: function (e, t, n, i) {
            return this.filter(ae).css("opacity", 0).show().end().animate({
                opacity: t
            }, e, n, i)
        },
        animate: function (e, t, n, i) {
            var r = w.isEmptyObject(e),
                o = w.speed(t, n, i),
                s = function () {
                    var t = dt(this, w.extend({}, e), o);
                    (r || X.get(this, "finish")) && t.stop(!0)
                };
            return s.finish = s, r || !1 === o.queue ? this.each(s) : this.queue(o.queue, s)
        },
        stop: function (e, t, n) {
            var i = function (e) {
                var t = e.stop;
                delete e.stop, t(n)
            };
            return "string" != typeof e && (n = t, t = e, e = void 0), t && !1 !== e && this.queue(e || "fx", []), this.each(function () {
                var t = !0,
                    r = null != e && e + "queueHooks",
                    o = w.timers,
                    s = X.get(this);
                if (r) s[r] && s[r].stop && i(s[r]);
                else
                    for (r in s) s[r] && s[r].stop && lt.test(r) && i(s[r]);
                for (r = o.length; r--;) o[r].elem !== this || null != e && o[r].queue !== e || (o[r].anim.stop(n), t = !1, o.splice(r, 1));
                !t && n || w.dequeue(this, e)
            })
        },
        finish: function (e) {
            return !1 !== e && (e = e || "fx"), this.each(function () {
                var t, n = X.get(this),
                    i = n[e + "queue"],
                    r = n[e + "queueHooks"],
                    o = w.timers,
                    s = i ? i.length : 0;
                for (n.finish = !0, w.queue(this, e, []), r && r.stop && r.stop.call(this, !0), t = o.length; t--;) o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1));
                for (t = 0; t < s; t++) i[t] && i[t].finish && i[t].finish.call(this);
                delete n.finish
            })
        }
    }), w.each(["toggle", "show", "hide"], function (e, t) {
        var n = w.fn[t];
        w.fn[t] = function (e, i, r) {
            return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(ft(t, !0), e, i, r)
        }
    }), w.each({
        slideDown: ft("show"),
        slideUp: ft("hide"),
        slideToggle: ft("toggle"),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, function (e, t) {
        w.fn[e] = function (e, n, i) {
            return this.animate(t, e, n, i)
        }
    }), w.timers = [], w.fx.tick = function () {
        var e, t = 0,
            n = w.timers;
        for (it = Date.now(); t < n.length; t++)(e = n[t])() || n[t] !== e || n.splice(t--, 1);
        n.length || w.fx.stop(), it = void 0
    }, w.fx.timer = function (e) {
        w.timers.push(e), w.fx.start()
    }, w.fx.interval = 13, w.fx.start = function () {
        rt || (rt = !0, ct())
    }, w.fx.stop = function () {
        rt = null
    }, w.fx.speeds = {
        slow: 600,
        fast: 200,
        _default: 400
    }, w.fn.delay = function (t, n) {
        return t = w.fx && w.fx.speeds[t] || t, n = n || "fx", this.queue(n, function (n, i) {
            var r = e.setTimeout(n, t);
            i.stop = function () {
                e.clearTimeout(r)
            }
        })
    }, ot = i.createElement("input"), st = i.createElement("select").appendChild(i.createElement("option")), ot.type = "checkbox", p.checkOn = "" !== ot.value, p.optSelected = st.selected, (ot = i.createElement("input")).value = "t", ot.type = "radio", p.radioValue = "t" === ot.value;
    var pt, gt = w.expr.attrHandle;
    w.fn.extend({
        attr: function (e, t) {
            return U(this, w.attr, e, t, 1 < arguments.length)
        },
        removeAttr: function (e) {
            return this.each(function () {
                w.removeAttr(this, e)
            })
        }
    }), w.extend({
        attr: function (e, t, n) {
            var i, r, o = e.nodeType;
            if (3 !== o && 8 !== o && 2 !== o) return void 0 === e.getAttribute ? w.prop(e, t, n) : (1 === o && w.isXMLDoc(e) || (r = w.attrHooks[t.toLowerCase()] || (w.expr.match.bool.test(t) ? pt : void 0)), void 0 !== n ? null === n ? void w.removeAttr(e, t) : r && "set" in r && void 0 !== (i = r.set(e, n, t)) ? i : (e.setAttribute(t, n + ""), n) : r && "get" in r && null !== (i = r.get(e, t)) ? i : null == (i = w.find.attr(e, t)) ? void 0 : i)
        },
        attrHooks: {
            type: {
                set: function (e, t) {
                    if (!p.radioValue && "radio" === t && D(e, "input")) {
                        var n = e.value;
                        return e.setAttribute("type", t), n && (e.value = n), t
                    }
                }
            }
        },
        removeAttr: function (e, t) {
            var n, i = 0,
                r = t && t.match(H);
            if (r && 1 === e.nodeType)
                for (; n = r[i++];) e.removeAttribute(n)
        }
    }), pt = {
        set: function (e, t, n) {
            return !1 === t ? w.removeAttr(e, n) : e.setAttribute(n, n), n
        }
    }, w.each(w.expr.match.bool.source.match(/\w+/g), function (e, t) {
        var n = gt[t] || w.find.attr;
        gt[t] = function (e, t, i) {
            var r, o, s = t.toLowerCase();
            return i || (o = gt[s], gt[s] = r, r = null != n(e, t, i) ? s : null, gt[s] = o), r
        }
    });
    var mt = /^(?:input|select|textarea|button)$/i,
        vt = /^(?:a|area)$/i;

    function yt(e) {
        return (e.match(H) || []).join(" ")
    }

    function bt(e) {
        return e.getAttribute && e.getAttribute("class") || ""
    }

    function _t(e) {
        return Array.isArray(e) ? e : "string" == typeof e && e.match(H) || []
    }
    w.fn.extend({
        prop: function (e, t) {
            return U(this, w.prop, e, t, 1 < arguments.length)
        },
        removeProp: function (e) {
            return this.each(function () {
                delete this[w.propFix[e] || e]
            })
        }
    }), w.extend({
        prop: function (e, t, n) {
            var i, r, o = e.nodeType;
            if (3 !== o && 8 !== o && 2 !== o) return 1 === o && w.isXMLDoc(e) || (t = w.propFix[t] || t, r = w.propHooks[t]), void 0 !== n ? r && "set" in r && void 0 !== (i = r.set(e, n, t)) ? i : e[t] = n : r && "get" in r && null !== (i = r.get(e, t)) ? i : e[t]
        },
        propHooks: {
            tabIndex: {
                get: function (e) {
                    var t = w.find.attr(e, "tabindex");
                    return t ? parseInt(t, 10) : mt.test(e.nodeName) || vt.test(e.nodeName) && e.href ? 0 : -1
                }
            }
        },
        propFix: {
            for: "htmlFor",
            class: "className"
        }
    }), p.optSelected || (w.propHooks.selected = {
        get: function (e) {
            var t = e.parentNode;
            return t && t.parentNode && t.parentNode.selectedIndex, null
        },
        set: function (e) {
            var t = e.parentNode;
            t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
        }
    }), w.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function () {
        w.propFix[this.toLowerCase()] = this
    }), w.fn.extend({
        addClass: function (e) {
            var t, n, i, r, o, s, a, l = 0;
            if (g(e)) return this.each(function (t) {
                w(this).addClass(e.call(this, t, bt(this)))
            });
            if ((t = _t(e)).length)
                for (; n = this[l++];)
                    if (r = bt(n), i = 1 === n.nodeType && " " + yt(r) + " ") {
                        for (s = 0; o = t[s++];) i.indexOf(" " + o + " ") < 0 && (i += o + " ");
                        r !== (a = yt(i)) && n.setAttribute("class", a)
                    } return this
        },
        removeClass: function (e) {
            var t, n, i, r, o, s, a, l = 0;
            if (g(e)) return this.each(function (t) {
                w(this).removeClass(e.call(this, t, bt(this)))
            });
            if (!arguments.length) return this.attr("class", "");
            if ((t = _t(e)).length)
                for (; n = this[l++];)
                    if (r = bt(n), i = 1 === n.nodeType && " " + yt(r) + " ") {
                        for (s = 0; o = t[s++];)
                            for (; - 1 < i.indexOf(" " + o + " ");) i = i.replace(" " + o + " ", " ");
                        r !== (a = yt(i)) && n.setAttribute("class", a)
                    } return this
        },
        toggleClass: function (e, t) {
            var n = typeof e,
                i = "string" === n || Array.isArray(e);
            return "boolean" == typeof t && i ? t ? this.addClass(e) : this.removeClass(e) : g(e) ? this.each(function (n) {
                w(this).toggleClass(e.call(this, n, bt(this), t), t)
            }) : this.each(function () {
                var t, r, o, s;
                if (i)
                    for (r = 0, o = w(this), s = _t(e); t = s[r++];) o.hasClass(t) ? o.removeClass(t) : o.addClass(t);
                else void 0 !== e && "boolean" !== n || ((t = bt(this)) && X.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === e ? "" : X.get(this, "__className__") || ""))
            })
        },
        hasClass: function (e) {
            var t, n, i = 0;
            for (t = " " + e + " "; n = this[i++];)
                if (1 === n.nodeType && -1 < (" " + yt(bt(n)) + " ").indexOf(t)) return !0;
            return !1
        }
    });
    var wt = /\r/g;
    w.fn.extend({
        val: function (e) {
            var t, n, i, r = this[0];
            return arguments.length ? (i = g(e), this.each(function (n) {
                var r;
                1 === this.nodeType && (null == (r = i ? e.call(this, n, w(this).val()) : e) ? r = "" : "number" == typeof r ? r += "" : Array.isArray(r) && (r = w.map(r, function (e) {
                    return null == e ? "" : e + ""
                })), (t = w.valHooks[this.type] || w.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, r, "value") || (this.value = r))
            })) : r ? (t = w.valHooks[r.type] || w.valHooks[r.nodeName.toLowerCase()]) && "get" in t && void 0 !== (n = t.get(r, "value")) ? n : "string" == typeof (n = r.value) ? n.replace(wt, "") : null == n ? "" : n : void 0
        }
    }), w.extend({
        valHooks: {
            option: {
                get: function (e) {
                    var t = w.find.attr(e, "value");
                    return null != t ? t : yt(w.text(e))
                }
            },
            select: {
                get: function (e) {
                    var t, n, i, r = e.options,
                        o = e.selectedIndex,
                        s = "select-one" === e.type,
                        a = s ? null : [],
                        l = s ? o + 1 : r.length;
                    for (i = o < 0 ? l : s ? o : 0; i < l; i++)
                        if (((n = r[i]).selected || i === o) && !n.disabled && (!n.parentNode.disabled || !D(n.parentNode, "optgroup"))) {
                            if (t = w(n).val(), s) return t;
                            a.push(t)
                        } return a
                },
                set: function (e, t) {
                    for (var n, i, r = e.options, o = w.makeArray(t), s = r.length; s--;)((i = r[s]).selected = -1 < w.inArray(w.valHooks.option.get(i), o)) && (n = !0);
                    return n || (e.selectedIndex = -1), o
                }
            }
        }
    }), w.each(["radio", "checkbox"], function () {
        w.valHooks[this] = {
            set: function (e, t) {
                if (Array.isArray(t)) return e.checked = -1 < w.inArray(w(e).val(), t)
            }
        }, p.checkOn || (w.valHooks[this].get = function (e) {
            return null === e.getAttribute("value") ? "on" : e.value
        })
    }), p.focusin = "onfocusin" in e;
    var Et = /^(?:focusinfocus|focusoutblur)$/,
        xt = function (e) {
            e.stopPropagation()
        };
    w.extend(w.event, {
        trigger: function (t, n, r, o) {
            var s, a, l, c, u, h, d, p, v = [r || i],
                y = f.call(t, "type") ? t.type : t,
                b = f.call(t, "namespace") ? t.namespace.split(".") : [];
            if (a = p = l = r = r || i, 3 !== r.nodeType && 8 !== r.nodeType && !Et.test(y + w.event.triggered) && (-1 < y.indexOf(".") && (y = (b = y.split(".")).shift(), b.sort()), u = y.indexOf(":") < 0 && "on" + y, (t = t[w.expando] ? t : new w.Event(y, "object" == typeof t && t)).isTrigger = o ? 2 : 3, t.namespace = b.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = r), n = null == n ? [t] : w.makeArray(n, [t]), d = w.event.special[y] || {}, o || !d.trigger || !1 !== d.trigger.apply(r, n))) {
                if (!o && !d.noBubble && !m(r)) {
                    for (c = d.delegateType || y, Et.test(c + y) || (a = a.parentNode); a; a = a.parentNode) v.push(a), l = a;
                    l === (r.ownerDocument || i) && v.push(l.defaultView || l.parentWindow || e)
                }
                for (s = 0;
                    (a = v[s++]) && !t.isPropagationStopped();) p = a, t.type = 1 < s ? c : d.bindType || y, (h = (X.get(a, "events") || {})[t.type] && X.get(a, "handle")) && h.apply(a, n), (h = u && a[u]) && h.apply && Y(a) && (t.result = h.apply(a, n), !1 === t.result && t.preventDefault());
                return t.type = y, o || t.isDefaultPrevented() || d._default && !1 !== d._default.apply(v.pop(), n) || !Y(r) || u && g(r[y]) && !m(r) && ((l = r[u]) && (r[u] = null), w.event.triggered = y, t.isPropagationStopped() && p.addEventListener(y, xt), r[y](), t.isPropagationStopped() && p.removeEventListener(y, xt), w.event.triggered = void 0, l && (r[u] = l)), t.result
            }
        },
        simulate: function (e, t, n) {
            var i = w.extend(new w.Event, n, {
                type: e,
                isSimulated: !0
            });
            w.event.trigger(i, null, t)
        }
    }), w.fn.extend({
        trigger: function (e, t) {
            return this.each(function () {
                w.event.trigger(e, t, this)
            })
        },
        triggerHandler: function (e, t) {
            var n = this[0];
            if (n) return w.event.trigger(e, t, n, !0)
        }
    }), p.focusin || w.each({
        focus: "focusin",
        blur: "focusout"
    }, function (e, t) {
        var n = function (e) {
            w.event.simulate(t, e.target, w.event.fix(e))
        };
        w.event.special[t] = {
            setup: function () {
                var i = this.ownerDocument || this,
                    r = X.access(i, t);
                r || i.addEventListener(e, n, !0), X.access(i, t, (r || 0) + 1)
            },
            teardown: function () {
                var i = this.ownerDocument || this,
                    r = X.access(i, t) - 1;
                r ? X.access(i, t, r) : (i.removeEventListener(e, n, !0), X.remove(i, t))
            }
        }
    });
    var Tt = e.location,
        Ct = Date.now(),
        St = /\?/;
    w.parseXML = function (t) {
        var n;
        if (!t || "string" != typeof t) return null;
        try {
            n = (new e.DOMParser).parseFromString(t, "text/xml")
        } catch (t) {
            n = void 0
        }
        return n && !n.getElementsByTagName("parsererror").length || w.error("Invalid XML: " + t), n
    };
    var At = /\[\]$/,
        Dt = /\r?\n/g,
        kt = /^(?:submit|button|image|reset|file)$/i,
        Nt = /^(?:input|select|textarea|keygen)/i;

    function It(e, t, n, i) {
        var r;
        if (Array.isArray(t)) w.each(t, function (t, r) {
            n || At.test(e) ? i(e, r) : It(e + "[" + ("object" == typeof r && null != r ? t : "") + "]", r, n, i)
        });
        else if (n || "object" !== b(t)) i(e, t);
        else
            for (r in t) It(e + "[" + r + "]", t[r], n, i)
    }
    w.param = function (e, t) {
        var n, i = [],
            r = function (e, t) {
                var n = g(t) ? t() : t;
                i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n)
            };
        if (null == e) return "";
        if (Array.isArray(e) || e.jquery && !w.isPlainObject(e)) w.each(e, function () {
            r(this.name, this.value)
        });
        else
            for (n in e) It(n, e[n], t, r);
        return i.join("&")
    }, w.fn.extend({
        serialize: function () {
            return w.param(this.serializeArray())
        },
        serializeArray: function () {
            return this.map(function () {
                var e = w.prop(this, "elements");
                return e ? w.makeArray(e) : this
            }).filter(function () {
                var e = this.type;
                return this.name && !w(this).is(":disabled") && Nt.test(this.nodeName) && !kt.test(e) && (this.checked || !he.test(e))
            }).map(function (e, t) {
                var n = w(this).val();
                return null == n ? null : Array.isArray(n) ? w.map(n, function (e) {
                    return {
                        name: t.name,
                        value: e.replace(Dt, "\r\n")
                    }
                }) : {
                    name: t.name,
                    value: n.replace(Dt, "\r\n")
                }
            }).get()
        }
    });
    var Ot = /%20/g,
        jt = /#.*$/,
        Lt = /([?&])_=[^&]*/,
        Pt = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        Ht = /^(?:GET|HEAD)$/,
        Mt = /^\/\//,
        qt = {},
        Rt = {},
        Ft = "*/".concat("*"),
        Wt = i.createElement("a");

    function Bt(e) {
        return function (t, n) {
            "string" != typeof t && (n = t, t = "*");
            var i, r = 0,
                o = t.toLowerCase().match(H) || [];
            if (g(n))
                for (; i = o[r++];) "+" === i[0] ? (i = i.slice(1) || "*", (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n)
        }
    }

    function Ut(e, t, n, i) {
        var r = {},
            o = e === Rt;

        function s(a) {
            var l;
            return r[a] = !0, w.each(e[a] || [], function (e, a) {
                var c = a(t, n, i);
                return "string" != typeof c || o || r[c] ? o ? !(l = c) : void 0 : (t.dataTypes.unshift(c), s(c), !1)
            }), l
        }
        return s(t.dataTypes[0]) || !r["*"] && s("*")
    }

    function zt(e, t) {
        var n, i, r = w.ajaxSettings.flatOptions || {};
        for (n in t) void 0 !== t[n] && ((r[n] ? e : i || (i = {}))[n] = t[n]);
        return i && w.extend(!0, e, i), e
    }
    Wt.href = Tt.href, w.extend({
        active: 0,
        lastModified: {},
        etag: {},
        ajaxSettings: {
            url: Tt.href,
            type: "GET",
            isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(Tt.protocol),
            global: !0,
            processData: !0,
            async: !0,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            accepts: {
                "*": Ft,
                text: "text/plain",
                html: "text/html",
                xml: "application/xml, text/xml",
                json: "application/json, text/javascript"
            },
            contents: {
                xml: /\bxml\b/,
                html: /\bhtml/,
                json: /\bjson\b/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText",
                json: "responseJSON"
            },
            converters: {
                "* text": String,
                "text html": !0,
                "text json": JSON.parse,
                "text xml": w.parseXML
            },
            flatOptions: {
                url: !0,
                context: !0
            }
        },
        ajaxSetup: function (e, t) {
            return t ? zt(zt(e, w.ajaxSettings), t) : zt(w.ajaxSettings, e)
        },
        ajaxPrefilter: Bt(qt),
        ajaxTransport: Bt(Rt),
        ajax: function (t, n) {
            "object" == typeof t && (n = t, t = void 0), n = n || {};
            var r, o, s, a, l, c, u, f, h, d, p = w.ajaxSetup({}, n),
                g = p.context || p,
                m = p.context && (g.nodeType || g.jquery) ? w(g) : w.event,
                v = w.Deferred(),
                y = w.Callbacks("once memory"),
                b = p.statusCode || {},
                _ = {},
                E = {},
                x = "canceled",
                T = {
                    readyState: 0,
                    getResponseHeader: function (e) {
                        var t;
                        if (u) {
                            if (!a)
                                for (a = {}; t = Pt.exec(s);) a[t[1].toLowerCase() + " "] = (a[t[1].toLowerCase() + " "] || []).concat(t[2]);
                            t = a[e.toLowerCase() + " "]
                        }
                        return null == t ? null : t.join(", ")
                    },
                    getAllResponseHeaders: function () {
                        return u ? s : null
                    },
                    setRequestHeader: function (e, t) {
                        return null == u && (e = E[e.toLowerCase()] = E[e.toLowerCase()] || e, _[e] = t), this
                    },
                    overrideMimeType: function (e) {
                        return null == u && (p.mimeType = e), this
                    },
                    statusCode: function (e) {
                        var t;
                        if (e)
                            if (u) T.always(e[T.status]);
                            else
                                for (t in e) b[t] = [b[t], e[t]];
                        return this
                    },
                    abort: function (e) {
                        var t = e || x;
                        return r && r.abort(t), C(0, t), this
                    }
                };
            if (v.promise(T), p.url = ((t || p.url || Tt.href) + "").replace(Mt, Tt.protocol + "//"), p.type = n.method || n.type || p.method || p.type, p.dataTypes = (p.dataType || "*").toLowerCase().match(H) || [""], null == p.crossDomain) {
                c = i.createElement("a");
                try {
                    c.href = p.url, c.href = c.href, p.crossDomain = Wt.protocol + "//" + Wt.host != c.protocol + "//" + c.host
                } catch (t) {
                    p.crossDomain = !0
                }
            }
            if (p.data && p.processData && "string" != typeof p.data && (p.data = w.param(p.data, p.traditional)), Ut(qt, p, n, T), u) return T;
            for (h in (f = w.event && p.global) && 0 == w.active++ && w.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !Ht.test(p.type), o = p.url.replace(jt, ""), p.hasContent ? p.data && p.processData && 0 === (p.contentType || "").indexOf("application/x-www-form-urlencoded") && (p.data = p.data.replace(Ot, "+")) : (d = p.url.slice(o.length), p.data && (p.processData || "string" == typeof p.data) && (o += (St.test(o) ? "&" : "?") + p.data, delete p.data), !1 === p.cache && (o = o.replace(Lt, "$1"), d = (St.test(o) ? "&" : "?") + "_=" + Ct++ + d), p.url = o + d), p.ifModified && (w.lastModified[o] && T.setRequestHeader("If-Modified-Since", w.lastModified[o]), w.etag[o] && T.setRequestHeader("If-None-Match", w.etag[o])), (p.data && p.hasContent && !1 !== p.contentType || n.contentType) && T.setRequestHeader("Content-Type", p.contentType), T.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + Ft + "; q=0.01" : "") : p.accepts["*"]), p.headers) T.setRequestHeader(h, p.headers[h]);
            if (p.beforeSend && (!1 === p.beforeSend.call(g, T, p) || u)) return T.abort();
            if (x = "abort", y.add(p.complete), T.done(p.success), T.fail(p.error), r = Ut(Rt, p, n, T)) {
                if (T.readyState = 1, f && m.trigger("ajaxSend", [T, p]), u) return T;
                p.async && 0 < p.timeout && (l = e.setTimeout(function () {
                    T.abort("timeout")
                }, p.timeout));
                try {
                    u = !1, r.send(_, C)
                } catch (t) {
                    if (u) throw t;
                    C(-1, t)
                }
            } else C(-1, "No Transport");

            function C(t, n, i, a) {
                var c, h, d, _, E, x = n;
                u || (u = !0, l && e.clearTimeout(l), r = void 0, s = a || "", T.readyState = 0 < t ? 4 : 0, c = 200 <= t && t < 300 || 304 === t, i && (_ = function (e, t, n) {
                    for (var i, r, o, s, a = e.contents, l = e.dataTypes;
                        "*" === l[0];) l.shift(), void 0 === i && (i = e.mimeType || t.getResponseHeader("Content-Type"));
                    if (i)
                        for (r in a)
                            if (a[r] && a[r].test(i)) {
                                l.unshift(r);
                                break
                            } if (l[0] in n) o = l[0];
                    else {
                        for (r in n) {
                            if (!l[0] || e.converters[r + " " + l[0]]) {
                                o = r;
                                break
                            }
                            s || (s = r)
                        }
                        o = o || s
                    }
                    if (o) return o !== l[0] && l.unshift(o), n[o]
                }(p, T, i)), _ = function (e, t, n, i) {
                    var r, o, s, a, l, c = {},
                        u = e.dataTypes.slice();
                    if (u[1])
                        for (s in e.converters) c[s.toLowerCase()] = e.converters[s];
                    for (o = u.shift(); o;)
                        if (e.responseFields[o] && (n[e.responseFields[o]] = t), !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = o, o = u.shift())
                            if ("*" === o) o = l;
                            else if ("*" !== l && l !== o) {
                        if (!(s = c[l + " " + o] || c["* " + o]))
                            for (r in c)
                                if ((a = r.split(" "))[1] === o && (s = c[l + " " + a[0]] || c["* " + a[0]])) {
                                    !0 === s ? s = c[r] : !0 !== c[r] && (o = a[0], u.unshift(a[1]));
                                    break
                                } if (!0 !== s)
                            if (s && e.throws) t = s(t);
                            else try {
                                t = s(t)
                            } catch (e) {
                                return {
                                    state: "parsererror",
                                    error: s ? e : "No conversion from " + l + " to " + o
                                }
                            }
                    }
                    return {
                        state: "success",
                        data: t
                    }
                }(p, _, T, c), c ? (p.ifModified && ((E = T.getResponseHeader("Last-Modified")) && (w.lastModified[o] = E), (E = T.getResponseHeader("etag")) && (w.etag[o] = E)), 204 === t || "HEAD" === p.type ? x = "nocontent" : 304 === t ? x = "notmodified" : (x = _.state, h = _.data, c = !(d = _.error))) : (d = x, !t && x || (x = "error", t < 0 && (t = 0))), T.status = t, T.statusText = (n || x) + "", c ? v.resolveWith(g, [h, x, T]) : v.rejectWith(g, [T, x, d]), T.statusCode(b), b = void 0, f && m.trigger(c ? "ajaxSuccess" : "ajaxError", [T, p, c ? h : d]), y.fireWith(g, [T, x]), f && (m.trigger("ajaxComplete", [T, p]), --w.active || w.event.trigger("ajaxStop")))
            }
            return T
        },
        getJSON: function (e, t, n) {
            return w.get(e, t, n, "json")
        },
        getScript: function (e, t) {
            return w.get(e, void 0, t, "script")
        }
    }), w.each(["get", "post"], function (e, t) {
        w[t] = function (e, n, i, r) {
            return g(n) && (r = r || i, i = n, n = void 0), w.ajax(w.extend({
                url: e,
                type: t,
                dataType: r,
                data: n,
                success: i
            }, w.isPlainObject(e) && e))
        }
    }), w._evalUrl = function (e, t) {
        return w.ajax({
            url: e,
            type: "GET",
            dataType: "script",
            cache: !0,
            async: !1,
            global: !1,
            converters: {
                "text script": function () {}
            },
            dataFilter: function (e) {
                w.globalEval(e, t)
            }
        })
    }, w.fn.extend({
        wrapAll: function (e) {
            var t;
            return this[0] && (g(e) && (e = e.call(this[0])), t = w(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                for (var e = this; e.firstElementChild;) e = e.firstElementChild;
                return e
            }).append(this)), this
        },
        wrapInner: function (e) {
            return g(e) ? this.each(function (t) {
                w(this).wrapInner(e.call(this, t))
            }) : this.each(function () {
                var t = w(this),
                    n = t.contents();
                n.length ? n.wrapAll(e) : t.append(e)
            })
        },
        wrap: function (e) {
            var t = g(e);
            return this.each(function (n) {
                w(this).wrapAll(t ? e.call(this, n) : e)
            })
        },
        unwrap: function (e) {
            return this.parent(e).not("body").each(function () {
                w(this).replaceWith(this.childNodes)
            }), this
        }
    }), w.expr.pseudos.hidden = function (e) {
        return !w.expr.pseudos.visible(e)
    }, w.expr.pseudos.visible = function (e) {
        return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
    }, w.ajaxSettings.xhr = function () {
        try {
            return new e.XMLHttpRequest
        } catch (e) {}
    };
    var Vt = {
            0: 200,
            1223: 204
        },
        $t = w.ajaxSettings.xhr();
    p.cors = !!$t && "withCredentials" in $t, p.ajax = $t = !!$t, w.ajaxTransport(function (t) {
        var n, i;
        if (p.cors || $t && !t.crossDomain) return {
            send: function (r, o) {
                var s, a = t.xhr();
                if (a.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields)
                    for (s in t.xhrFields) a[s] = t.xhrFields[s];
                for (s in t.mimeType && a.overrideMimeType && a.overrideMimeType(t.mimeType), t.crossDomain || r["X-Requested-With"] || (r["X-Requested-With"] = "XMLHttpRequest"), r) a.setRequestHeader(s, r[s]);
                n = function (e) {
                    return function () {
                        n && (n = i = a.onload = a.onerror = a.onabort = a.ontimeout = a.onreadystatechange = null, "abort" === e ? a.abort() : "error" === e ? "number" != typeof a.status ? o(0, "error") : o(a.status, a.statusText) : o(Vt[a.status] || a.status, a.statusText, "text" !== (a.responseType || "text") || "string" != typeof a.responseText ? {
                            binary: a.response
                        } : {
                            text: a.responseText
                        }, a.getAllResponseHeaders()))
                    }
                }, a.onload = n(), i = a.onerror = a.ontimeout = n("error"), void 0 !== a.onabort ? a.onabort = i : a.onreadystatechange = function () {
                    4 === a.readyState && e.setTimeout(function () {
                        n && i()
                    })
                }, n = n("abort");
                try {
                    a.send(t.hasContent && t.data || null)
                } catch (r) {
                    if (n) throw r
                }
            },
            abort: function () {
                n && n()
            }
        }
    }), w.ajaxPrefilter(function (e) {
        e.crossDomain && (e.contents.script = !1)
    }), w.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /\b(?:java|ecma)script\b/
        },
        converters: {
            "text script": function (e) {
                return w.globalEval(e), e
            }
        }
    }), w.ajaxPrefilter("script", function (e) {
        void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
    }), w.ajaxTransport("script", function (e) {
        var t, n;
        if (e.crossDomain || e.scriptAttrs) return {
            send: function (r, o) {
                t = w("<script>").attr(e.scriptAttrs || {}).prop({
                    charset: e.scriptCharset,
                    src: e.url
                }).on("load error", n = function (e) {
                    t.remove(), n = null, e && o("error" === e.type ? 404 : 200, e.type)
                }), i.head.appendChild(t[0])
            },
            abort: function () {
                n && n()
            }
        }
    });
    var Qt, Yt = [],
        Kt = /(=)\?(?=&|$)|\?\?/;
    w.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function () {
            var e = Yt.pop() || w.expando + "_" + Ct++;
            return this[e] = !0, e
        }
    }), w.ajaxPrefilter("json jsonp", function (t, n, i) {
        var r, o, s, a = !1 !== t.jsonp && (Kt.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && Kt.test(t.data) && "data");
        if (a || "jsonp" === t.dataTypes[0]) return r = t.jsonpCallback = g(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, a ? t[a] = t[a].replace(Kt, "$1" + r) : !1 !== t.jsonp && (t.url += (St.test(t.url) ? "&" : "?") + t.jsonp + "=" + r), t.converters["script json"] = function () {
            return s || w.error(r + " was not called"), s[0]
        }, t.dataTypes[0] = "json", o = e[r], e[r] = function () {
            s = arguments
        }, i.always(function () {
            void 0 === o ? w(e).removeProp(r) : e[r] = o, t[r] && (t.jsonpCallback = n.jsonpCallback, Yt.push(r)), s && g(o) && o(s[0]), s = o = void 0
        }), "script"
    }), p.createHTMLDocument = ((Qt = i.implementation.createHTMLDocument("").body).innerHTML = "<form></form><form></form>", 2 === Qt.childNodes.length), w.parseHTML = function (e, t, n) {
        return "string" != typeof e ? [] : ("boolean" == typeof t && (n = t, t = !1), t || (p.createHTMLDocument ? ((r = (t = i.implementation.createHTMLDocument("")).createElement("base")).href = i.location.href, t.head.appendChild(r)) : t = i), s = !n && [], (o = k.exec(e)) ? [t.createElement(o[1])] : (o = we([e], t, s), s && s.length && w(s).remove(), w.merge([], o.childNodes)));
        var r, o, s
    }, w.fn.load = function (e, t, n) {
        var i, r, o, s = this,
            a = e.indexOf(" ");
        return -1 < a && (i = yt(e.slice(a)), e = e.slice(0, a)), g(t) ? (n = t, t = void 0) : t && "object" == typeof t && (r = "POST"), 0 < s.length && w.ajax({
            url: e,
            type: r || "GET",
            dataType: "html",
            data: t
        }).done(function (e) {
            o = arguments, s.html(i ? w("<div>").append(w.parseHTML(e)).find(i) : e)
        }).always(n && function (e, t) {
            s.each(function () {
                n.apply(this, o || [e.responseText, t, e])
            })
        }), this
    }, w.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function (e, t) {
        w.fn[t] = function (e) {
            return this.on(t, e)
        }
    }), w.expr.pseudos.animated = function (e) {
        return w.grep(w.timers, function (t) {
            return e === t.elem
        }).length
    }, w.offset = {
        setOffset: function (e, t, n) {
            var i, r, o, s, a, l, c = w.css(e, "position"),
                u = w(e),
                f = {};
            "static" === c && (e.style.position = "relative"), a = u.offset(), o = w.css(e, "top"), l = w.css(e, "left"), ("absolute" === c || "fixed" === c) && -1 < (o + l).indexOf("auto") ? (s = (i = u.position()).top, r = i.left) : (s = parseFloat(o) || 0, r = parseFloat(l) || 0), g(t) && (t = t.call(e, n, w.extend({}, a))), null != t.top && (f.top = t.top - a.top + s), null != t.left && (f.left = t.left - a.left + r), "using" in t ? t.using.call(e, f) : u.css(f)
        }
    }, w.fn.extend({
        offset: function (e) {
            if (arguments.length) return void 0 === e ? this : this.each(function (t) {
                w.offset.setOffset(this, e, t)
            });
            var t, n, i = this[0];
            return i ? i.getClientRects().length ? (t = i.getBoundingClientRect(), n = i.ownerDocument.defaultView, {
                top: t.top + n.pageYOffset,
                left: t.left + n.pageXOffset
            }) : {
                top: 0,
                left: 0
            } : void 0
        },
        position: function () {
            if (this[0]) {
                var e, t, n, i = this[0],
                    r = {
                        top: 0,
                        left: 0
                    };
                if ("fixed" === w.css(i, "position")) t = i.getBoundingClientRect();
                else {
                    for (t = this.offset(), n = i.ownerDocument, e = i.offsetParent || n.documentElement; e && (e === n.body || e === n.documentElement) && "static" === w.css(e, "position");) e = e.parentNode;
                    e && e !== i && 1 === e.nodeType && ((r = w(e).offset()).top += w.css(e, "borderTopWidth", !0), r.left += w.css(e, "borderLeftWidth", !0))
                }
                return {
                    top: t.top - r.top - w.css(i, "marginTop", !0),
                    left: t.left - r.left - w.css(i, "marginLeft", !0)
                }
            }
        },
        offsetParent: function () {
            return this.map(function () {
                for (var e = this.offsetParent; e && "static" === w.css(e, "position");) e = e.offsetParent;
                return e || re
            })
        }
    }), w.each({
        scrollLeft: "pageXOffset",
        scrollTop: "pageYOffset"
    }, function (e, t) {
        var n = "pageYOffset" === t;
        w.fn[e] = function (i) {
            return U(this, function (e, i, r) {
                var o;
                if (m(e) ? o = e : 9 === e.nodeType && (o = e.defaultView), void 0 === r) return o ? o[t] : e[i];
                o ? o.scrollTo(n ? o.pageXOffset : r, n ? r : o.pageYOffset) : e[i] = r
            }, e, i, arguments.length)
        }
    }), w.each(["top", "left"], function (e, t) {
        w.cssHooks[t] = ze(p.pixelPosition, function (e, n) {
            if (n) return n = Ue(e, t), Fe.test(n) ? w(e).position()[t] + "px" : n
        })
    }), w.each({
        Height: "height",
        Width: "width"
    }, function (e, t) {
        w.each({
            padding: "inner" + e,
            content: t,
            "": "outer" + e
        }, function (n, i) {
            w.fn[i] = function (r, o) {
                var s = arguments.length && (n || "boolean" != typeof r),
                    a = n || (!0 === r || !0 === o ? "margin" : "border");
                return U(this, function (t, n, r) {
                    var o;
                    return m(t) ? 0 === i.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (o = t.documentElement, Math.max(t.body["scroll" + e], o["scroll" + e], t.body["offset" + e], o["offset" + e], o["client" + e])) : void 0 === r ? w.css(t, n, a) : w.style(t, n, r, a)
                }, t, s ? r : void 0, s)
            }
        })
    }), w.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function (e, t) {
        w.fn[t] = function (e, n) {
            return 0 < arguments.length ? this.on(t, null, e, n) : this.trigger(t)
        }
    }), w.fn.extend({
        hover: function (e, t) {
            return this.mouseenter(e).mouseleave(t || e)
        }
    }), w.fn.extend({
        bind: function (e, t, n) {
            return this.on(e, null, t, n)
        },
        unbind: function (e, t) {
            return this.off(e, null, t)
        },
        delegate: function (e, t, n, i) {
            return this.on(t, e, n, i)
        },
        undelegate: function (e, t, n) {
            return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
        }
    }), w.proxy = function (e, t) {
        var n, i, r;
        if ("string" == typeof t && (n = e[t], t = e, e = n), g(e)) return i = o.call(arguments, 2), (r = function () {
            return e.apply(t || this, i.concat(o.call(arguments)))
        }).guid = e.guid = e.guid || w.guid++, r
    }, w.holdReady = function (e) {
        e ? w.readyWait++ : w.ready(!0)
    }, w.isArray = Array.isArray, w.parseJSON = JSON.parse, w.nodeName = D, w.isFunction = g, w.isWindow = m, w.camelCase = Q, w.type = b, w.now = Date.now, w.isNumeric = function (e) {
        var t = w.type(e);
        return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
    }, "function" == typeof define && define.amd && define("jquery", [], function () {
        return w
    });
    var Xt = e.jQuery,
        Gt = e.$;
    return w.noConflict = function (t) {
        return e.$ === w && (e.$ = Gt), t && e.jQuery === w && (e.jQuery = Xt), w
    }, t || (e.jQuery = e.$ = w), w
}),
function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(exports, require("jquery")) : "function" == typeof define && define.amd ? define(["exports", "jquery"], t) : t((e = e || self).bootstrap = {}, e.jQuery)
}(this, function (e, t) {
    "use strict";

    function n(e, t) {
        for (var n = 0; n < t.length; n++) {
            var i = t[n];
            i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
        }
    }

    function i(e, t, i) {
        return t && n(e.prototype, t), i && n(e, i), e
    }

    function r(e) {
        for (var t = 1; t < arguments.length; t++) {
            var n = null != arguments[t] ? arguments[t] : {},
                i = Object.keys(n);
            "function" == typeof Object.getOwnPropertySymbols && (i = i.concat(Object.getOwnPropertySymbols(n).filter(function (e) {
                return Object.getOwnPropertyDescriptor(n, e).enumerable
            }))), i.forEach(function (t) {
                var i, r, o;
                i = e, o = n[r = t], r in i ? Object.defineProperty(i, r, {
                    value: o,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : i[r] = o
            })
        }
        return e
    }
    t = t && t.hasOwnProperty("default") ? t.default : t;
    var o = "transitionend";
    var s = {
        TRANSITION_END: "bsTransitionEnd",
        getUID: function (e) {
            for (; e += ~~(1e6 * Math.random()), document.getElementById(e););
            return e
        },
        getSelectorFromElement: function (e) {
            var t = e.getAttribute("data-target");
            if (!t || "#" === t) {
                var n = e.getAttribute("href");
                t = n && "#" !== n ? n.trim() : ""
            }
            try {
                return document.querySelector(t) ? t : null
            } catch (e) {
                return null
            }
        },
        getTransitionDurationFromElement: function (e) {
            if (!e) return 0;
            var n = t(e).css("transition-duration"),
                i = t(e).css("transition-delay"),
                r = parseFloat(n),
                o = parseFloat(i);
            return r || o ? (n = n.split(",")[0], i = i.split(",")[0], 1e3 * (parseFloat(n) + parseFloat(i))) : 0
        },
        reflow: function (e) {
            return e.offsetHeight
        },
        triggerTransitionEnd: function (e) {
            t(e).trigger(o)
        },
        supportsTransitionEnd: function () {
            return Boolean(o)
        },
        isElement: function (e) {
            return (e[0] || e).nodeType
        },
        typeCheckConfig: function (e, t, n) {
            for (var i in n)
                if (Object.prototype.hasOwnProperty.call(n, i)) {
                    var r = n[i],
                        o = t[i],
                        a = o && s.isElement(o) ? "element" : (l = o, {}.toString.call(l).match(/\s([a-z]+)/i)[1].toLowerCase());
                    if (!new RegExp(r).test(a)) throw new Error(e.toUpperCase() + ': Option "' + i + '" provided type "' + a + '" but expected type "' + r + '".')
                } var l
        },
        findShadowRoot: function (e) {
            if (!document.documentElement.attachShadow) return null;
            if ("function" != typeof e.getRootNode) return e instanceof ShadowRoot ? e : e.parentNode ? s.findShadowRoot(e.parentNode) : null;
            var t = e.getRootNode();
            return t instanceof ShadowRoot ? t : null
        }
    };
    t.fn.emulateTransitionEnd = function (e) {
        var n = this,
            i = !1;
        return t(this).one(s.TRANSITION_END, function () {
            i = !0
        }), setTimeout(function () {
            i || s.triggerTransitionEnd(n)
        }, e), this
    }, t.event.special[s.TRANSITION_END] = {
        bindType: o,
        delegateType: o,
        handle: function (e) {
            if (t(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
        }
    };
    var a = "alert",
        l = "bs.alert",
        c = "." + l,
        u = t.fn[a],
        f = {
            CLOSE: "close" + c,
            CLOSED: "closed" + c,
            CLICK_DATA_API: "click" + c + ".data-api"
        },
        h = function () {
            function e(e) {
                this._element = e
            }
            var n = e.prototype;
            return n.close = function (e) {
                var t = this._element;
                e && (t = this._getRootElement(e)), this._triggerCloseEvent(t).isDefaultPrevented() || this._removeElement(t)
            }, n.dispose = function () {
                t.removeData(this._element, l), this._element = null
            }, n._getRootElement = function (e) {
                var n = s.getSelectorFromElement(e),
                    i = !1;
                return n && (i = document.querySelector(n)), i || (i = t(e).closest(".alert")[0]), i
            }, n._triggerCloseEvent = function (e) {
                var n = t.Event(f.CLOSE);
                return t(e).trigger(n), n
            }, n._removeElement = function (e) {
                var n = this;
                if (t(e).removeClass("show"), t(e).hasClass("fade")) {
                    var i = s.getTransitionDurationFromElement(e);
                    t(e).one(s.TRANSITION_END, function (t) {
                        return n._destroyElement(e, t)
                    }).emulateTransitionEnd(i)
                } else this._destroyElement(e)
            }, n._destroyElement = function (e) {
                t(e).detach().trigger(f.CLOSED).remove()
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this),
                        r = i.data(l);
                    r || (r = new e(this), i.data(l, r)), "close" === n && r[n](this)
                })
            }, e._handleDismiss = function (e) {
                return function (t) {
                    t && t.preventDefault(), e.close(this)
                }
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }]), e
        }();
    t(document).on(f.CLICK_DATA_API, '[data-dismiss="alert"]', h._handleDismiss(new h)), t.fn[a] = h._jQueryInterface, t.fn[a].Constructor = h, t.fn[a].noConflict = function () {
        return t.fn[a] = u, h._jQueryInterface
    };
    var d = "button",
        p = "bs.button",
        g = "." + p,
        m = ".data-api",
        v = t.fn[d],
        y = "active",
        b = '[data-toggle^="button"]',
        _ = ".btn",
        w = {
            CLICK_DATA_API: "click" + g + m,
            FOCUS_BLUR_DATA_API: "focus" + g + m + " blur" + g + m
        },
        E = function () {
            function e(e) {
                this._element = e
            }
            var n = e.prototype;
            return n.toggle = function () {
                var e = !0,
                    n = !0,
                    i = t(this._element).closest('[data-toggle="buttons"]')[0];
                if (i) {
                    var r = this._element.querySelector('input:not([type="hidden"])');
                    if (r) {
                        if ("radio" === r.type)
                            if (r.checked && this._element.classList.contains(y)) e = !1;
                            else {
                                var o = i.querySelector(".active");
                                o && t(o).removeClass(y)
                            } if (e) {
                            if (r.hasAttribute("disabled") || i.hasAttribute("disabled") || r.classList.contains("disabled") || i.classList.contains("disabled")) return;
                            r.checked = !this._element.classList.contains(y), t(r).trigger("change")
                        }
                        r.focus(), n = !1
                    }
                }
                n && this._element.setAttribute("aria-pressed", !this._element.classList.contains(y)), e && t(this._element).toggleClass(y)
            }, n.dispose = function () {
                t.removeData(this._element, p), this._element = null
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this).data(p);
                    i || (i = new e(this), t(this).data(p, i)), "toggle" === n && i[n]()
                })
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }]), e
        }();
    t(document).on(w.CLICK_DATA_API, b, function (e) {
        e.preventDefault();
        var n = e.target;
        t(n).hasClass("btn") || (n = t(n).closest(_)), E._jQueryInterface.call(t(n), "toggle")
    }).on(w.FOCUS_BLUR_DATA_API, b, function (e) {
        var n = t(e.target).closest(_)[0];
        t(n).toggleClass("focus", /^focus(in)?$/.test(e.type))
    }), t.fn[d] = E._jQueryInterface, t.fn[d].Constructor = E, t.fn[d].noConflict = function () {
        return t.fn[d] = v, E._jQueryInterface
    };
    var x = "carousel",
        T = "bs.carousel",
        C = "." + T,
        S = ".data-api",
        A = t.fn[x],
        D = {
            interval: 5e3,
            keyboard: !0,
            slide: !1,
            pause: "hover",
            wrap: !0,
            touch: !0
        },
        k = {
            interval: "(number|boolean)",
            keyboard: "boolean",
            slide: "(boolean|string)",
            pause: "(string|boolean)",
            wrap: "boolean",
            touch: "boolean"
        },
        N = "next",
        I = "prev",
        O = {
            SLIDE: "slide" + C,
            SLID: "slid" + C,
            KEYDOWN: "keydown" + C,
            MOUSEENTER: "mouseenter" + C,
            MOUSELEAVE: "mouseleave" + C,
            TOUCHSTART: "touchstart" + C,
            TOUCHMOVE: "touchmove" + C,
            TOUCHEND: "touchend" + C,
            POINTERDOWN: "pointerdown" + C,
            POINTERUP: "pointerup" + C,
            DRAG_START: "dragstart" + C,
            LOAD_DATA_API: "load" + C + S,
            CLICK_DATA_API: "click" + C + S
        },
        j = "active",
        L = ".active.carousel-item",
        P = ".carousel-indicators",
        H = {
            TOUCH: "touch",
            PEN: "pen"
        },
        M = function () {
            function e(e, t) {
                this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this.touchTimeout = null, this.touchStartX = 0, this.touchDeltaX = 0, this._config = this._getConfig(t), this._element = e, this._indicatorsElement = this._element.querySelector(P), this._touchSupported = "ontouchstart" in document.documentElement || 0 < navigator.maxTouchPoints, this._pointerEvent = Boolean(window.PointerEvent || window.MSPointerEvent), this._addEventListeners()
            }
            var n = e.prototype;
            return n.next = function () {
                this._isSliding || this._slide(N)
            }, n.nextWhenVisible = function () {
                !document.hidden && t(this._element).is(":visible") && "hidden" !== t(this._element).css("visibility") && this.next()
            }, n.prev = function () {
                this._isSliding || this._slide(I)
            }, n.pause = function (e) {
                e || (this._isPaused = !0), this._element.querySelector(".carousel-item-next, .carousel-item-prev") && (s.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null
            }, n.cycle = function (e) {
                e || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval))
            }, n.to = function (e) {
                var n = this;
                this._activeElement = this._element.querySelector(L);
                var i = this._getItemIndex(this._activeElement);
                if (!(e > this._items.length - 1 || e < 0))
                    if (this._isSliding) t(this._element).one(O.SLID, function () {
                        return n.to(e)
                    });
                    else {
                        if (i === e) return this.pause(), void this.cycle();
                        var r = i < e ? N : I;
                        this._slide(r, this._items[e])
                    }
            }, n.dispose = function () {
                t(this._element).off(C), t.removeData(this._element, T), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null
            }, n._getConfig = function (e) {
                return e = r({}, D, e), s.typeCheckConfig(x, e, k), e
            }, n._handleSwipe = function () {
                var e = Math.abs(this.touchDeltaX);
                if (!(e <= 40)) {
                    var t = e / this.touchDeltaX;
                    0 < t && this.prev(), t < 0 && this.next()
                }
            }, n._addEventListeners = function () {
                var e = this;
                this._config.keyboard && t(this._element).on(O.KEYDOWN, function (t) {
                    return e._keydown(t)
                }), "hover" === this._config.pause && t(this._element).on(O.MOUSEENTER, function (t) {
                    return e.pause(t)
                }).on(O.MOUSELEAVE, function (t) {
                    return e.cycle(t)
                }), this._config.touch && this._addTouchEventListeners()
            }, n._addTouchEventListeners = function () {
                var e = this;
                if (this._touchSupported) {
                    var n = function (t) {
                            e._pointerEvent && H[t.originalEvent.pointerType.toUpperCase()] ? e.touchStartX = t.originalEvent.clientX : e._pointerEvent || (e.touchStartX = t.originalEvent.touches[0].clientX)
                        },
                        i = function (t) {
                            e._pointerEvent && H[t.originalEvent.pointerType.toUpperCase()] && (e.touchDeltaX = t.originalEvent.clientX - e.touchStartX), e._handleSwipe(), "hover" === e._config.pause && (e.pause(), e.touchTimeout && clearTimeout(e.touchTimeout), e.touchTimeout = setTimeout(function (t) {
                                return e.cycle(t)
                            }, 500 + e._config.interval))
                        };
                    t(this._element.querySelectorAll(".carousel-item img")).on(O.DRAG_START, function (e) {
                        return e.preventDefault()
                    }), this._pointerEvent ? (t(this._element).on(O.POINTERDOWN, function (e) {
                        return n(e)
                    }), t(this._element).on(O.POINTERUP, function (e) {
                        return i(e)
                    }), this._element.classList.add("pointer-event")) : (t(this._element).on(O.TOUCHSTART, function (e) {
                        return n(e)
                    }), t(this._element).on(O.TOUCHMOVE, function (t) {
                        var n;
                        (n = t).originalEvent.touches && 1 < n.originalEvent.touches.length ? e.touchDeltaX = 0 : e.touchDeltaX = n.originalEvent.touches[0].clientX - e.touchStartX
                    }), t(this._element).on(O.TOUCHEND, function (e) {
                        return i(e)
                    }))
                }
            }, n._keydown = function (e) {
                if (!/input|textarea/i.test(e.target.tagName)) switch (e.which) {
                    case 37:
                        e.preventDefault(), this.prev();
                        break;
                    case 39:
                        e.preventDefault(), this.next()
                }
            }, n._getItemIndex = function (e) {
                return this._items = e && e.parentNode ? [].slice.call(e.parentNode.querySelectorAll(".carousel-item")) : [], this._items.indexOf(e)
            }, n._getItemByDirection = function (e, t) {
                var n = e === N,
                    i = e === I,
                    r = this._getItemIndex(t),
                    o = this._items.length - 1;
                if ((i && 0 === r || n && r === o) && !this._config.wrap) return t;
                var s = (r + (e === I ? -1 : 1)) % this._items.length;
                return -1 === s ? this._items[this._items.length - 1] : this._items[s]
            }, n._triggerSlideEvent = function (e, n) {
                var i = this._getItemIndex(e),
                    r = this._getItemIndex(this._element.querySelector(L)),
                    o = t.Event(O.SLIDE, {
                        relatedTarget: e,
                        direction: n,
                        from: r,
                        to: i
                    });
                return t(this._element).trigger(o), o
            }, n._setActiveIndicatorElement = function (e) {
                if (this._indicatorsElement) {
                    var n = [].slice.call(this._indicatorsElement.querySelectorAll(".active"));
                    t(n).removeClass(j);
                    var i = this._indicatorsElement.children[this._getItemIndex(e)];
                    i && t(i).addClass(j)
                }
            }, n._slide = function (e, n) {
                var i, r, o, a = this,
                    l = this._element.querySelector(L),
                    c = this._getItemIndex(l),
                    u = n || l && this._getItemByDirection(e, l),
                    f = this._getItemIndex(u),
                    h = Boolean(this._interval);
                if (o = e === N ? (i = "carousel-item-left", r = "carousel-item-next", "left") : (i = "carousel-item-right", r = "carousel-item-prev", "right"), u && t(u).hasClass(j)) this._isSliding = !1;
                else if (!this._triggerSlideEvent(u, o).isDefaultPrevented() && l && u) {
                    this._isSliding = !0, h && this.pause(), this._setActiveIndicatorElement(u);
                    var d = t.Event(O.SLID, {
                        relatedTarget: u,
                        direction: o,
                        from: c,
                        to: f
                    });
                    if (t(this._element).hasClass("slide")) {
                        t(u).addClass(r), s.reflow(u), t(l).addClass(i), t(u).addClass(i);
                        var p = parseInt(u.getAttribute("data-interval"), 10);
                        this._config.interval = p ? (this._config.defaultInterval = this._config.defaultInterval || this._config.interval, p) : this._config.defaultInterval || this._config.interval;
                        var g = s.getTransitionDurationFromElement(l);
                        t(l).one(s.TRANSITION_END, function () {
                            t(u).removeClass(i + " " + r).addClass(j), t(l).removeClass(j + " " + r + " " + i), a._isSliding = !1, setTimeout(function () {
                                return t(a._element).trigger(d)
                            }, 0)
                        }).emulateTransitionEnd(g)
                    } else t(l).removeClass(j), t(u).addClass(j), this._isSliding = !1, t(this._element).trigger(d);
                    h && this.cycle()
                }
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this).data(T),
                        o = r({}, D, t(this).data());
                    "object" == typeof n && (o = r({}, o, n));
                    var s = "string" == typeof n ? n : o.slide;
                    if (i || (i = new e(this, o), t(this).data(T, i)), "number" == typeof n) i.to(n);
                    else if ("string" == typeof s) {
                        if (void 0 === i[s]) throw new TypeError('No method named "' + s + '"');
                        i[s]()
                    } else o.interval && o.ride && (i.pause(), i.cycle())
                })
            }, e._dataApiClickHandler = function (n) {
                var i = s.getSelectorFromElement(this);
                if (i) {
                    var o = t(i)[0];
                    if (o && t(o).hasClass("carousel")) {
                        var a = r({}, t(o).data(), t(this).data()),
                            l = this.getAttribute("data-slide-to");
                        l && (a.interval = !1), e._jQueryInterface.call(t(o), a), l && t(o).data(T).to(l), n.preventDefault()
                    }
                }
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }, {
                key: "Default",
                get: function () {
                    return D
                }
            }]), e
        }();
    t(document).on(O.CLICK_DATA_API, "[data-slide], [data-slide-to]", M._dataApiClickHandler), t(window).on(O.LOAD_DATA_API, function () {
        for (var e = [].slice.call(document.querySelectorAll('[data-ride="carousel"]')), n = 0, i = e.length; n < i; n++) {
            var r = t(e[n]);
            M._jQueryInterface.call(r, r.data())
        }
    }), t.fn[x] = M._jQueryInterface, t.fn[x].Constructor = M, t.fn[x].noConflict = function () {
        return t.fn[x] = A, M._jQueryInterface
    };
    var q = "collapse",
        R = "bs.collapse",
        F = "." + R,
        W = t.fn[q],
        B = {
            toggle: !0,
            parent: ""
        },
        U = {
            toggle: "boolean",
            parent: "(string|element)"
        },
        z = {
            SHOW: "show" + F,
            SHOWN: "shown" + F,
            HIDE: "hide" + F,
            HIDDEN: "hidden" + F,
            CLICK_DATA_API: "click" + F + ".data-api"
        },
        V = "show",
        $ = "collapse",
        Q = "collapsing",
        Y = "collapsed",
        K = '[data-toggle="collapse"]',
        X = function () {
            function e(e, t) {
                this._isTransitioning = !1, this._element = e, this._config = this._getConfig(t), this._triggerArray = [].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e.id + '"]'));
                for (var n = [].slice.call(document.querySelectorAll(K)), i = 0, r = n.length; i < r; i++) {
                    var o = n[i],
                        a = s.getSelectorFromElement(o),
                        l = [].slice.call(document.querySelectorAll(a)).filter(function (t) {
                            return t === e
                        });
                    null !== a && 0 < l.length && (this._selector = a, this._triggerArray.push(o))
                }
                this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle()
            }
            var n = e.prototype;
            return n.toggle = function () {
                t(this._element).hasClass(V) ? this.hide() : this.show()
            }, n.show = function () {
                var n, i, r = this;
                if (!(this._isTransitioning || t(this._element).hasClass(V) || (this._parent && 0 === (n = [].slice.call(this._parent.querySelectorAll(".show, .collapsing")).filter(function (e) {
                        return "string" == typeof r._config.parent ? e.getAttribute("data-parent") === r._config.parent : e.classList.contains($)
                    })).length && (n = null), n && (i = t(n).not(this._selector).data(R)) && i._isTransitioning))) {
                    var o = t.Event(z.SHOW);
                    if (t(this._element).trigger(o), !o.isDefaultPrevented()) {
                        n && (e._jQueryInterface.call(t(n).not(this._selector), "hide"), i || t(n).data(R, null));
                        var a = this._getDimension();
                        t(this._element).removeClass($).addClass(Q), this._element.style[a] = 0, this._triggerArray.length && t(this._triggerArray).removeClass(Y).attr("aria-expanded", !0), this.setTransitioning(!0);
                        var l = "scroll" + (a[0].toUpperCase() + a.slice(1)),
                            c = s.getTransitionDurationFromElement(this._element);
                        t(this._element).one(s.TRANSITION_END, function () {
                            t(r._element).removeClass(Q).addClass($).addClass(V), r._element.style[a] = "", r.setTransitioning(!1), t(r._element).trigger(z.SHOWN)
                        }).emulateTransitionEnd(c), this._element.style[a] = this._element[l] + "px"
                    }
                }
            }, n.hide = function () {
                var e = this;
                if (!this._isTransitioning && t(this._element).hasClass(V)) {
                    var n = t.Event(z.HIDE);
                    if (t(this._element).trigger(n), !n.isDefaultPrevented()) {
                        var i = this._getDimension();
                        this._element.style[i] = this._element.getBoundingClientRect()[i] + "px", s.reflow(this._element), t(this._element).addClass(Q).removeClass($).removeClass(V);
                        var r = this._triggerArray.length;
                        if (0 < r)
                            for (var o = 0; o < r; o++) {
                                var a = this._triggerArray[o],
                                    l = s.getSelectorFromElement(a);
                                null !== l && (t([].slice.call(document.querySelectorAll(l))).hasClass(V) || t(a).addClass(Y).attr("aria-expanded", !1))
                            }
                        this.setTransitioning(!0), this._element.style[i] = "";
                        var c = s.getTransitionDurationFromElement(this._element);
                        t(this._element).one(s.TRANSITION_END, function () {
                            e.setTransitioning(!1), t(e._element).removeClass(Q).addClass($).trigger(z.HIDDEN)
                        }).emulateTransitionEnd(c)
                    }
                }
            }, n.setTransitioning = function (e) {
                this._isTransitioning = e
            }, n.dispose = function () {
                t.removeData(this._element, R), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null
            }, n._getConfig = function (e) {
                return (e = r({}, B, e)).toggle = Boolean(e.toggle), s.typeCheckConfig(q, e, U), e
            }, n._getDimension = function () {
                return t(this._element).hasClass("width") ? "width" : "height"
            }, n._getParent = function () {
                var n, i = this;
                s.isElement(this._config.parent) ? (n = this._config.parent, void 0 !== this._config.parent.jquery && (n = this._config.parent[0])) : n = document.querySelector(this._config.parent);
                var r = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]',
                    o = [].slice.call(n.querySelectorAll(r));
                return t(o).each(function (t, n) {
                    i._addAriaAndCollapsedClass(e._getTargetFromElement(n), [n])
                }), n
            }, n._addAriaAndCollapsedClass = function (e, n) {
                var i = t(e).hasClass(V);
                n.length && t(n).toggleClass(Y, !i).attr("aria-expanded", i)
            }, e._getTargetFromElement = function (e) {
                var t = s.getSelectorFromElement(e);
                return t ? document.querySelector(t) : null
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this),
                        o = i.data(R),
                        s = r({}, B, i.data(), "object" == typeof n && n ? n : {});
                    if (!o && s.toggle && /show|hide/.test(n) && (s.toggle = !1), o || (o = new e(this, s), i.data(R, o)), "string" == typeof n) {
                        if (void 0 === o[n]) throw new TypeError('No method named "' + n + '"');
                        o[n]()
                    }
                })
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }, {
                key: "Default",
                get: function () {
                    return B
                }
            }]), e
        }();
    t(document).on(z.CLICK_DATA_API, K, function (e) {
        "A" === e.currentTarget.tagName && e.preventDefault();
        var n = t(this),
            i = s.getSelectorFromElement(this),
            r = [].slice.call(document.querySelectorAll(i));
        t(r).each(function () {
            var e = t(this),
                i = e.data(R) ? "toggle" : n.data();
            X._jQueryInterface.call(e, i)
        })
    }), t.fn[q] = X._jQueryInterface, t.fn[q].Constructor = X, t.fn[q].noConflict = function () {
        return t.fn[q] = W, X._jQueryInterface
    };
    for (var G = "undefined" != typeof window && "undefined" != typeof document, J = ["Edge", "Trident", "Firefox"], Z = 0, ee = 0; ee < J.length; ee += 1)
        if (G && 0 <= navigator.userAgent.indexOf(J[ee])) {
            Z = 1;
            break
        } var te = G && window.Promise ? function (e) {
        var t = !1;
        return function () {
            t || (t = !0, window.Promise.resolve().then(function () {
                t = !1, e()
            }))
        }
    } : function (e) {
        var t = !1;
        return function () {
            t || (t = !0, setTimeout(function () {
                t = !1, e()
            }, Z))
        }
    };

    function ne(e) {
        return e && "[object Function]" === {}.toString.call(e)
    }

    function ie(e, t) {
        if (1 !== e.nodeType) return [];
        var n = e.ownerDocument.defaultView.getComputedStyle(e, null);
        return t ? n[t] : n
    }

    function re(e) {
        return "HTML" === e.nodeName ? e : e.parentNode || e.host
    }

    function oe(e) {
        if (!e) return document.body;
        switch (e.nodeName) {
            case "HTML":
            case "BODY":
                return e.ownerDocument.body;
            case "#document":
                return e.body
        }
        var t = ie(e),
            n = t.overflow,
            i = t.overflowX,
            r = t.overflowY;
        return /(auto|scroll|overlay)/.test(n + r + i) ? e : oe(re(e))
    }
    var se = G && !(!window.MSInputMethodContext || !document.documentMode),
        ae = G && /MSIE 10/.test(navigator.userAgent);

    function le(e) {
        return 11 === e ? se : 10 === e ? ae : se || ae
    }

    function ce(e) {
        if (!e) return document.documentElement;
        for (var t = le(10) ? document.body : null, n = e.offsetParent || null; n === t && e.nextElementSibling;) n = (e = e.nextElementSibling).offsetParent;
        var i = n && n.nodeName;
        return i && "BODY" !== i && "HTML" !== i ? -1 !== ["TH", "TD", "TABLE"].indexOf(n.nodeName) && "static" === ie(n, "position") ? ce(n) : n : e ? e.ownerDocument.documentElement : document.documentElement
    }

    function ue(e) {
        return null !== e.parentNode ? ue(e.parentNode) : e
    }

    function fe(e, t) {
        if (!(e && e.nodeType && t && t.nodeType)) return document.documentElement;
        var n = e.compareDocumentPosition(t) & Node.DOCUMENT_POSITION_FOLLOWING,
            i = n ? e : t,
            r = n ? t : e,
            o = document.createRange();
        o.setStart(i, 0), o.setEnd(r, 0);
        var s, a, l = o.commonAncestorContainer;
        if (e !== l && t !== l || i.contains(r)) return "BODY" === (a = (s = l).nodeName) || "HTML" !== a && ce(s.firstElementChild) !== s ? ce(l) : l;
        var c = ue(e);
        return c.host ? fe(c.host, t) : fe(e, ue(t).host)
    }

    function he(e) {
        var t = "top" === (1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "top") ? "scrollTop" : "scrollLeft",
            n = e.nodeName;
        if ("BODY" !== n && "HTML" !== n) return e[t];
        var i = e.ownerDocument.documentElement;
        return (e.ownerDocument.scrollingElement || i)[t]
    }

    function de(e, t) {
        var n = "x" === t ? "Left" : "Top",
            i = "Left" === n ? "Right" : "Bottom";
        return parseFloat(e["border" + n + "Width"], 10) + parseFloat(e["border" + i + "Width"], 10)
    }

    function pe(e, t, n, i) {
        return Math.max(t["offset" + e], t["scroll" + e], n["client" + e], n["offset" + e], n["scroll" + e], le(10) ? parseInt(n["offset" + e]) + parseInt(i["margin" + ("Height" === e ? "Top" : "Left")]) + parseInt(i["margin" + ("Height" === e ? "Bottom" : "Right")]) : 0)
    }

    function ge(e) {
        var t = e.body,
            n = e.documentElement,
            i = le(10) && getComputedStyle(n);
        return {
            height: pe("Height", t, n, i),
            width: pe("Width", t, n, i)
        }
    }
    var me = function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var i = t[n];
                    i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
                }
            }
            return function (t, n, i) {
                return n && e(t.prototype, n), i && e(t, i), t
            }
        }(),
        ve = function (e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        },
        ye = Object.assign || function (e) {
            for (var t = 1; t < arguments.length; t++) {
                var n = arguments[t];
                for (var i in n) Object.prototype.hasOwnProperty.call(n, i) && (e[i] = n[i])
            }
            return e
        };

    function be(e) {
        return ye({}, e, {
            right: e.left + e.width,
            bottom: e.top + e.height
        })
    }

    function _e(e) {
        var t = {};
        try {
            if (le(10)) {
                t = e.getBoundingClientRect();
                var n = he(e, "top"),
                    i = he(e, "left");
                t.top += n, t.left += i, t.bottom += n, t.right += i
            } else t = e.getBoundingClientRect()
        } catch (e) {}
        var r = {
                left: t.left,
                top: t.top,
                width: t.right - t.left,
                height: t.bottom - t.top
            },
            o = "HTML" === e.nodeName ? ge(e.ownerDocument) : {},
            s = o.width || e.clientWidth || r.right - r.left,
            a = o.height || e.clientHeight || r.bottom - r.top,
            l = e.offsetWidth - s,
            c = e.offsetHeight - a;
        if (l || c) {
            var u = ie(e);
            l -= de(u, "x"), c -= de(u, "y"), r.width -= l, r.height -= c
        }
        return be(r)
    }

    function we(e, t) {
        var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
            i = le(10),
            r = "HTML" === t.nodeName,
            o = _e(e),
            s = _e(t),
            a = oe(e),
            l = ie(t),
            c = parseFloat(l.borderTopWidth, 10),
            u = parseFloat(l.borderLeftWidth, 10);
        n && r && (s.top = Math.max(s.top, 0), s.left = Math.max(s.left, 0));
        var f = be({
            top: o.top - s.top - c,
            left: o.left - s.left - u,
            width: o.width,
            height: o.height
        });
        if (f.marginTop = 0, f.marginLeft = 0, !i && r) {
            var h = parseFloat(l.marginTop, 10),
                d = parseFloat(l.marginLeft, 10);
            f.top -= c - h, f.bottom -= c - h, f.left -= u - d, f.right -= u - d, f.marginTop = h, f.marginLeft = d
        }
        return (i && !n ? t.contains(a) : t === a && "BODY" !== a.nodeName) && (f = function (e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
                i = he(t, "top"),
                r = he(t, "left"),
                o = n ? -1 : 1;
            return e.top += i * o, e.bottom += i * o, e.left += r * o, e.right += r * o, e
        }(f, t)), f
    }

    function Ee(e) {
        if (!e || !e.parentElement || le()) return document.documentElement;
        for (var t = e.parentElement; t && "none" === ie(t, "transform");) t = t.parentElement;
        return t || document.documentElement
    }

    function xe(e, t, n, i) {
        var r = 4 < arguments.length && void 0 !== arguments[4] && arguments[4],
            o = {
                top: 0,
                left: 0
            },
            s = r ? Ee(e) : fe(e, t);
        if ("viewport" === i) o = function (e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
                n = e.ownerDocument.documentElement,
                i = we(e, n),
                r = Math.max(n.clientWidth, window.innerWidth || 0),
                o = Math.max(n.clientHeight, window.innerHeight || 0),
                s = t ? 0 : he(n),
                a = t ? 0 : he(n, "left");
            return be({
                top: s - i.top + i.marginTop,
                left: a - i.left + i.marginLeft,
                width: r,
                height: o
            })
        }(s, r);
        else {
            var a = void 0;
            "scrollParent" === i ? "BODY" === (a = oe(re(t))).nodeName && (a = e.ownerDocument.documentElement) : a = "window" === i ? e.ownerDocument.documentElement : i;
            var l = we(a, s, r);
            if ("HTML" !== a.nodeName || function e(t) {
                    var n = t.nodeName;
                    if ("BODY" === n || "HTML" === n) return !1;
                    if ("fixed" === ie(t, "position")) return !0;
                    var i = re(t);
                    return !!i && e(i)
                }(s)) o = l;
            else {
                var c = ge(e.ownerDocument),
                    u = c.height,
                    f = c.width;
                o.top += l.top - l.marginTop, o.bottom = u + l.top, o.left += l.left - l.marginLeft, o.right = f + l.left
            }
        }
        var h = "number" == typeof (n = n || 0);
        return o.left += h ? n : n.left || 0, o.top += h ? n : n.top || 0, o.right -= h ? n : n.right || 0, o.bottom -= h ? n : n.bottom || 0, o
    }

    function Te(e, t, n, i, r) {
        var o = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;
        if (-1 === e.indexOf("auto")) return e;
        var s = xe(n, i, o, r),
            a = {
                top: {
                    width: s.width,
                    height: t.top - s.top
                },
                right: {
                    width: s.right - t.right,
                    height: s.height
                },
                bottom: {
                    width: s.width,
                    height: s.bottom - t.bottom
                },
                left: {
                    width: t.left - s.left,
                    height: s.height
                }
            },
            l = Object.keys(a).map(function (e) {
                return ye({
                    key: e
                }, a[e], {
                    area: (t = a[e], t.width * t.height)
                });
                var t
            }).sort(function (e, t) {
                return t.area - e.area
            }),
            c = l.filter(function (e) {
                var t = e.width,
                    i = e.height;
                return t >= n.clientWidth && i >= n.clientHeight
            }),
            u = 0 < c.length ? c[0].key : l[0].key,
            f = e.split("-")[1];
        return u + (f ? "-" + f : "")
    }

    function Ce(e, t, n) {
        var i = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : null;
        return we(n, i ? Ee(t) : fe(t, n), i)
    }

    function Se(e) {
        var t = e.ownerDocument.defaultView.getComputedStyle(e),
            n = parseFloat(t.marginTop || 0) + parseFloat(t.marginBottom || 0),
            i = parseFloat(t.marginLeft || 0) + parseFloat(t.marginRight || 0);
        return {
            width: e.offsetWidth + i,
            height: e.offsetHeight + n
        }
    }

    function Ae(e) {
        var t = {
            left: "right",
            right: "left",
            bottom: "top",
            top: "bottom"
        };
        return e.replace(/left|right|bottom|top/g, function (e) {
            return t[e]
        })
    }

    function De(e, t, n) {
        n = n.split("-")[0];
        var i = Se(e),
            r = {
                width: i.width,
                height: i.height
            },
            o = -1 !== ["right", "left"].indexOf(n),
            s = o ? "top" : "left",
            a = o ? "left" : "top",
            l = o ? "height" : "width",
            c = o ? "width" : "height";
        return r[s] = t[s] + t[l] / 2 - i[l] / 2, r[a] = n === a ? t[a] - i[c] : t[Ae(a)], r
    }

    function ke(e, t) {
        return Array.prototype.find ? e.find(t) : e.filter(t)[0]
    }

    function Ne(e, t, n) {
        return (void 0 === n ? e : e.slice(0, function (e, t, n) {
            if (Array.prototype.findIndex) return e.findIndex(function (e) {
                return e[t] === n
            });
            var i = ke(e, function (e) {
                return e[t] === n
            });
            return e.indexOf(i)
        }(e, "name", n))).forEach(function (e) {
            e.function && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
            var n = e.function || e.fn;
            e.enabled && ne(n) && (t.offsets.popper = be(t.offsets.popper), t.offsets.reference = be(t.offsets.reference), t = n(t, e))
        }), t
    }

    function Ie(e, t) {
        return e.some(function (e) {
            var n = e.name;
            return e.enabled && n === t
        })
    }

    function Oe(e) {
        for (var t = [!1, "ms", "Webkit", "Moz", "O"], n = e.charAt(0).toUpperCase() + e.slice(1), i = 0; i < t.length; i++) {
            var r = t[i],
                o = r ? "" + r + n : e;
            if (void 0 !== document.body.style[o]) return o
        }
        return null
    }

    function je(e) {
        var t = e.ownerDocument;
        return t ? t.defaultView : window
    }

    function Le(e) {
        return "" !== e && !isNaN(parseFloat(e)) && isFinite(e)
    }

    function Pe(e, t) {
        Object.keys(t).forEach(function (n) {
            var i = ""; - 1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(n) && Le(t[n]) && (i = "px"), e.style[n] = t[n] + i
        })
    }
    var He = G && /Firefox/i.test(navigator.userAgent);

    function Me(e, t, n) {
        var i = ke(e, function (e) {
                return e.name === t
            }),
            r = !!i && e.some(function (e) {
                return e.name === n && e.enabled && e.order < i.order
            });
        if (!r) {
            var o = "`" + t + "`",
                s = "`" + n + "`";
            console.warn(s + " modifier is required by " + o + " modifier in order to work, be sure to include it before " + o + "!")
        }
        return r
    }
    var qe = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
        Re = qe.slice(3);

    function Fe(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
            n = Re.indexOf(e),
            i = Re.slice(n + 1).concat(Re.slice(0, n));
        return t ? i.reverse() : i
    }
    var We = {
            placement: "bottom",
            positionFixed: !1,
            eventsEnabled: !0,
            removeOnDestroy: !1,
            onCreate: function () {},
            onUpdate: function () {},
            modifiers: {
                shift: {
                    order: 100,
                    enabled: !0,
                    fn: function (e) {
                        var t = e.placement,
                            n = t.split("-")[0],
                            i = t.split("-")[1];
                        if (i) {
                            var r = e.offsets,
                                o = r.reference,
                                s = r.popper,
                                a = -1 !== ["bottom", "top"].indexOf(n),
                                l = a ? "left" : "top",
                                c = a ? "width" : "height",
                                u = {
                                    start: ve({}, l, o[l]),
                                    end: ve({}, l, o[l] + o[c] - s[c])
                                };
                            e.offsets.popper = ye({}, s, u[i])
                        }
                        return e
                    }
                },
                offset: {
                    order: 200,
                    enabled: !0,
                    fn: function (e, t) {
                        var n, i = t.offset,
                            r = e.placement,
                            o = e.offsets,
                            s = o.popper,
                            a = o.reference,
                            l = r.split("-")[0];
                        return n = Le(+i) ? [+i, 0] : function (e, t, n, i) {
                            var r = [0, 0],
                                o = -1 !== ["right", "left"].indexOf(i),
                                s = e.split(/(\+|\-)/).map(function (e) {
                                    return e.trim()
                                }),
                                a = s.indexOf(ke(s, function (e) {
                                    return -1 !== e.search(/,|\s/)
                                }));
                            s[a] && -1 === s[a].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
                            var l = /\s*,\s*|\s+/,
                                c = -1 !== a ? [s.slice(0, a).concat([s[a].split(l)[0]]), [s[a].split(l)[1]].concat(s.slice(a + 1))] : [s];
                            return (c = c.map(function (e, i) {
                                var r = (1 === i ? !o : o) ? "height" : "width",
                                    s = !1;
                                return e.reduce(function (e, t) {
                                    return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? (e[e.length - 1] = t, s = !0, e) : s ? (e[e.length - 1] += t, s = !1, e) : e.concat(t)
                                }, []).map(function (e) {
                                    return function (e, t, n, i) {
                                        var r = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                                            o = +r[1],
                                            s = r[2];
                                        if (!o) return e;
                                        if (0 !== s.indexOf("%")) return "vh" !== s && "vw" !== s ? o : ("vh" === s ? Math.max(document.documentElement.clientHeight, window.innerHeight || 0) : Math.max(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * o;
                                        var a = void 0;
                                        switch (s) {
                                            case "%p":
                                                a = n;
                                                break;
                                            case "%":
                                            case "%r":
                                            default:
                                                a = i
                                        }
                                        return be(a)[t] / 100 * o
                                    }(e, r, t, n)
                                })
                            })).forEach(function (e, t) {
                                e.forEach(function (n, i) {
                                    Le(n) && (r[t] += n * ("-" === e[i - 1] ? -1 : 1))
                                })
                            }), r
                        }(i, s, a, l), "left" === l ? (s.top += n[0], s.left -= n[1]) : "right" === l ? (s.top += n[0], s.left += n[1]) : "top" === l ? (s.left += n[0], s.top -= n[1]) : "bottom" === l && (s.left += n[0], s.top += n[1]), e.popper = s, e
                    },
                    offset: 0
                },
                preventOverflow: {
                    order: 300,
                    enabled: !0,
                    fn: function (e, t) {
                        var n = t.boundariesElement || ce(e.instance.popper);
                        e.instance.reference === n && (n = ce(n));
                        var i = Oe("transform"),
                            r = e.instance.popper.style,
                            o = r.top,
                            s = r.left,
                            a = r[i];
                        r.top = "", r.left = "", r[i] = "";
                        var l = xe(e.instance.popper, e.instance.reference, t.padding, n, e.positionFixed);
                        r.top = o, r.left = s, r[i] = a, t.boundaries = l;
                        var c = t.priority,
                            u = e.offsets.popper,
                            f = {
                                primary: function (e) {
                                    var n = u[e];
                                    return u[e] < l[e] && !t.escapeWithReference && (n = Math.max(u[e], l[e])), ve({}, e, n)
                                },
                                secondary: function (e) {
                                    var n = "right" === e ? "left" : "top",
                                        i = u[n];
                                    return u[e] > l[e] && !t.escapeWithReference && (i = Math.min(u[n], l[e] - ("right" === e ? u.width : u.height))), ve({}, n, i)
                                }
                            };
                        return c.forEach(function (e) {
                            var t = -1 !== ["left", "top"].indexOf(e) ? "primary" : "secondary";
                            u = ye({}, u, f[t](e))
                        }), e.offsets.popper = u, e
                    },
                    priority: ["left", "right", "top", "bottom"],
                    padding: 5,
                    boundariesElement: "scrollParent"
                },
                keepTogether: {
                    order: 400,
                    enabled: !0,
                    fn: function (e) {
                        var t = e.offsets,
                            n = t.popper,
                            i = t.reference,
                            r = e.placement.split("-")[0],
                            o = Math.floor,
                            s = -1 !== ["top", "bottom"].indexOf(r),
                            a = s ? "right" : "bottom",
                            l = s ? "left" : "top",
                            c = s ? "width" : "height";
                        return n[a] < o(i[l]) && (e.offsets.popper[l] = o(i[l]) - n[c]), n[l] > o(i[a]) && (e.offsets.popper[l] = o(i[a])), e
                    }
                },
                arrow: {
                    order: 500,
                    enabled: !0,
                    fn: function (e, t) {
                        var n;
                        if (!Me(e.instance.modifiers, "arrow", "keepTogether")) return e;
                        var i = t.element;
                        if ("string" == typeof i) {
                            if (!(i = e.instance.popper.querySelector(i))) return e
                        } else if (!e.instance.popper.contains(i)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), e;
                        var r = e.placement.split("-")[0],
                            o = e.offsets,
                            s = o.popper,
                            a = o.reference,
                            l = -1 !== ["left", "right"].indexOf(r),
                            c = l ? "height" : "width",
                            u = l ? "Top" : "Left",
                            f = u.toLowerCase(),
                            h = l ? "left" : "top",
                            d = l ? "bottom" : "right",
                            p = Se(i)[c];
                        a[d] - p < s[f] && (e.offsets.popper[f] -= s[f] - (a[d] - p)), a[f] + p > s[d] && (e.offsets.popper[f] += a[f] + p - s[d]), e.offsets.popper = be(e.offsets.popper);
                        var g = a[f] + a[c] / 2 - p / 2,
                            m = ie(e.instance.popper),
                            v = parseFloat(m["margin" + u], 10),
                            y = parseFloat(m["border" + u + "Width"], 10),
                            b = g - e.offsets.popper[f] - v - y;
                        return b = Math.max(Math.min(s[c] - p, b), 0), e.arrowElement = i, e.offsets.arrow = (ve(n = {}, f, Math.round(b)), ve(n, h, ""), n), e
                    },
                    element: "[x-arrow]"
                },
                flip: {
                    order: 600,
                    enabled: !0,
                    fn: function (e, t) {
                        if (Ie(e.instance.modifiers, "inner")) return e;
                        if (e.flipped && e.placement === e.originalPlacement) return e;
                        var n = xe(e.instance.popper, e.instance.reference, t.padding, t.boundariesElement, e.positionFixed),
                            i = e.placement.split("-")[0],
                            r = Ae(i),
                            o = e.placement.split("-")[1] || "",
                            s = [];
                        switch (t.behavior) {
                            case "flip":
                                s = [i, r];
                                break;
                            case "clockwise":
                                s = Fe(i);
                                break;
                            case "counterclockwise":
                                s = Fe(i, !0);
                                break;
                            default:
                                s = t.behavior
                        }
                        return s.forEach(function (a, l) {
                            if (i !== a || s.length === l + 1) return e;
                            i = e.placement.split("-")[0], r = Ae(i);
                            var c, u = e.offsets.popper,
                                f = e.offsets.reference,
                                h = Math.floor,
                                d = "left" === i && h(u.right) > h(f.left) || "right" === i && h(u.left) < h(f.right) || "top" === i && h(u.bottom) > h(f.top) || "bottom" === i && h(u.top) < h(f.bottom),
                                p = h(u.left) < h(n.left),
                                g = h(u.right) > h(n.right),
                                m = h(u.top) < h(n.top),
                                v = h(u.bottom) > h(n.bottom),
                                y = "left" === i && p || "right" === i && g || "top" === i && m || "bottom" === i && v,
                                b = -1 !== ["top", "bottom"].indexOf(i),
                                _ = !!t.flipVariations && (b && "start" === o && p || b && "end" === o && g || !b && "start" === o && m || !b && "end" === o && v);
                            (d || y || _) && (e.flipped = !0, (d || y) && (i = s[l + 1]), _ && (o = "end" === (c = o) ? "start" : "start" === c ? "end" : c), e.placement = i + (o ? "-" + o : ""), e.offsets.popper = ye({}, e.offsets.popper, De(e.instance.popper, e.offsets.reference, e.placement)), e = Ne(e.instance.modifiers, e, "flip"))
                        }), e
                    },
                    behavior: "flip",
                    padding: 5,
                    boundariesElement: "viewport"
                },
                inner: {
                    order: 700,
                    enabled: !1,
                    fn: function (e) {
                        var t = e.placement,
                            n = t.split("-")[0],
                            i = e.offsets,
                            r = i.popper,
                            o = i.reference,
                            s = -1 !== ["left", "right"].indexOf(n),
                            a = -1 === ["top", "left"].indexOf(n);
                        return r[s ? "left" : "top"] = o[n] - (a ? r[s ? "width" : "height"] : 0), e.placement = Ae(t), e.offsets.popper = be(r), e
                    }
                },
                hide: {
                    order: 800,
                    enabled: !0,
                    fn: function (e) {
                        if (!Me(e.instance.modifiers, "hide", "preventOverflow")) return e;
                        var t = e.offsets.reference,
                            n = ke(e.instance.modifiers, function (e) {
                                return "preventOverflow" === e.name
                            }).boundaries;
                        if (t.bottom < n.top || t.left > n.right || t.top > n.bottom || t.right < n.left) {
                            if (!0 === e.hide) return e;
                            e.hide = !0, e.attributes["x-out-of-boundaries"] = ""
                        } else {
                            if (!1 === e.hide) return e;
                            e.hide = !1, e.attributes["x-out-of-boundaries"] = !1
                        }
                        return e
                    }
                },
                computeStyle: {
                    order: 850,
                    enabled: !0,
                    fn: function (e, t) {
                        var n = t.x,
                            i = t.y,
                            r = e.offsets.popper,
                            o = ke(e.instance.modifiers, function (e) {
                                return "applyStyle" === e.name
                            }).gpuAcceleration;
                        void 0 !== o && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");
                        var s, a, l, c, u, f, h, d, p, g, m, v, y, b, _, w, E = void 0 !== o ? o : t.gpuAcceleration,
                            x = ce(e.instance.popper),
                            T = _e(x),
                            C = {
                                position: r.position
                            },
                            S = (s = e, a = window.devicePixelRatio < 2 || !He, c = (l = s.offsets).popper, u = l.reference, f = Math.round, h = Math.floor, d = function (e) {
                                return e
                            }, p = f(u.width), g = f(c.width), m = -1 !== ["left", "right"].indexOf(s.placement), v = -1 !== s.placement.indexOf("-"), b = a ? f : d, {
                                left: (y = a ? m || v || p % 2 == g % 2 ? f : h : d)(p % 2 == 1 && g % 2 == 1 && !v && a ? c.left - 1 : c.left),
                                top: b(c.top),
                                bottom: b(c.bottom),
                                right: y(c.right)
                            }),
                            A = "bottom" === n ? "top" : "bottom",
                            D = "right" === i ? "left" : "right",
                            k = Oe("transform");
                        if (w = "bottom" === A ? "HTML" === x.nodeName ? -x.clientHeight + S.bottom : -T.height + S.bottom : S.top, _ = "right" === D ? "HTML" === x.nodeName ? -x.clientWidth + S.right : -T.width + S.right : S.left, E && k) C[k] = "translate3d(" + _ + "px, " + w + "px, 0)", C[A] = 0, C[D] = 0, C.willChange = "transform";
                        else {
                            var N = "bottom" === A ? -1 : 1,
                                I = "right" === D ? -1 : 1;
                            C[A] = w * N, C[D] = _ * I, C.willChange = A + ", " + D
                        }
                        var O = {
                            "x-placement": e.placement
                        };
                        return e.attributes = ye({}, O, e.attributes), e.styles = ye({}, C, e.styles), e.arrowStyles = ye({}, e.offsets.arrow, e.arrowStyles), e
                    },
                    gpuAcceleration: !0,
                    x: "bottom",
                    y: "right"
                },
                applyStyle: {
                    order: 900,
                    enabled: !0,
                    fn: function (e) {
                        var t, n;
                        return Pe(e.instance.popper, e.styles), t = e.instance.popper, n = e.attributes, Object.keys(n).forEach(function (e) {
                            !1 !== n[e] ? t.setAttribute(e, n[e]) : t.removeAttribute(e)
                        }), e.arrowElement && Object.keys(e.arrowStyles).length && Pe(e.arrowElement, e.arrowStyles), e
                    },
                    onLoad: function (e, t, n, i, r) {
                        var o = Ce(r, t, e, n.positionFixed),
                            s = Te(n.placement, o, t, e, n.modifiers.flip.boundariesElement, n.modifiers.flip.padding);
                        return t.setAttribute("x-placement", s), Pe(t, {
                            position: n.positionFixed ? "fixed" : "absolute"
                        }), n
                    },
                    gpuAcceleration: void 0
                }
            }
        },
        Be = function () {
            function e(t, n) {
                var i = this,
                    r = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
                ! function (t, n) {
                    if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
                }(this), this.scheduleUpdate = function () {
                    return requestAnimationFrame(i.update)
                }, this.update = te(this.update.bind(this)), this.options = ye({}, e.Defaults, r), this.state = {
                    isDestroyed: !1,
                    isCreated: !1,
                    scrollParents: []
                }, this.reference = t && t.jquery ? t[0] : t, this.popper = n && n.jquery ? n[0] : n, this.options.modifiers = {}, Object.keys(ye({}, e.Defaults.modifiers, r.modifiers)).forEach(function (t) {
                    i.options.modifiers[t] = ye({}, e.Defaults.modifiers[t] || {}, r.modifiers ? r.modifiers[t] : {})
                }), this.modifiers = Object.keys(this.options.modifiers).map(function (e) {
                    return ye({
                        name: e
                    }, i.options.modifiers[e])
                }).sort(function (e, t) {
                    return e.order - t.order
                }), this.modifiers.forEach(function (e) {
                    e.enabled && ne(e.onLoad) && e.onLoad(i.reference, i.popper, i.options, e, i.state)
                }), this.update();
                var o = this.options.eventsEnabled;
                o && this.enableEventListeners(), this.state.eventsEnabled = o
            }
            return me(e, [{
                key: "update",
                value: function () {
                    return function () {
                        if (!this.state.isDestroyed) {
                            var e = {
                                instance: this,
                                styles: {},
                                arrowStyles: {},
                                attributes: {},
                                flipped: !1,
                                offsets: {}
                            };
                            e.offsets.reference = Ce(this.state, this.popper, this.reference, this.options.positionFixed), e.placement = Te(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.positionFixed = this.options.positionFixed, e.offsets.popper = De(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = this.options.positionFixed ? "fixed" : "absolute", e = Ne(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e))
                        }
                    }.call(this)
                }
            }, {
                key: "destroy",
                value: function () {
                    return function () {
                        return this.state.isDestroyed = !0, Ie(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.position = "", this.popper.style.top = "", this.popper.style.left = "", this.popper.style.right = "", this.popper.style.bottom = "", this.popper.style.willChange = "", this.popper.style[Oe("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this
                    }.call(this)
                }
            }, {
                key: "enableEventListeners",
                value: function () {
                    return function () {
                        this.state.eventsEnabled || (this.state = function (e, t, n, i) {
                            n.updateBound = i, je(e).addEventListener("resize", n.updateBound, {
                                passive: !0
                            });
                            var r = oe(e);
                            return function e(t, n, i, r) {
                                var o = "BODY" === t.nodeName,
                                    s = o ? t.ownerDocument.defaultView : t;
                                s.addEventListener(n, i, {
                                    passive: !0
                                }), o || e(oe(s.parentNode), n, i, r), r.push(s)
                            }(r, "scroll", n.updateBound, n.scrollParents), n.scrollElement = r, n.eventsEnabled = !0, n
                        }(this.reference, this.options, this.state, this.scheduleUpdate))
                    }.call(this)
                }
            }, {
                key: "disableEventListeners",
                value: function () {
                    return function () {
                        var e, t;
                        this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = (e = this.reference, t = this.state, je(e).removeEventListener("resize", t.updateBound), t.scrollParents.forEach(function (e) {
                            e.removeEventListener("scroll", t.updateBound)
                        }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t))
                    }.call(this)
                }
            }]), e
        }();
    Be.Utils = ("undefined" != typeof window ? window : global).PopperUtils, Be.placements = qe, Be.Defaults = We;
    var Ue = "dropdown",
        ze = "bs.dropdown",
        Ve = "." + ze,
        $e = ".data-api",
        Qe = t.fn[Ue],
        Ye = new RegExp("38|40|27"),
        Ke = {
            HIDE: "hide" + Ve,
            HIDDEN: "hidden" + Ve,
            SHOW: "show" + Ve,
            SHOWN: "shown" + Ve,
            CLICK: "click" + Ve,
            CLICK_DATA_API: "click" + Ve + $e,
            KEYDOWN_DATA_API: "keydown" + Ve + $e,
            KEYUP_DATA_API: "keyup" + Ve + $e
        },
        Xe = "disabled",
        Ge = "show",
        Je = "dropdown-menu-right",
        Ze = '[data-toggle="dropdown"]',
        et = ".dropdown-menu",
        tt = {
            offset: 0,
            flip: !0,
            boundary: "scrollParent",
            reference: "toggle",
            display: "dynamic"
        },
        nt = {
            offset: "(number|string|function)",
            flip: "boolean",
            boundary: "(string|element)",
            reference: "(string|element)",
            display: "string"
        },
        it = function () {
            function e(e, t) {
                this._element = e, this._popper = null, this._config = this._getConfig(t), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners()
            }
            var n = e.prototype;
            return n.toggle = function () {
                if (!this._element.disabled && !t(this._element).hasClass(Xe)) {
                    var n = e._getParentFromElement(this._element),
                        i = t(this._menu).hasClass(Ge);
                    if (e._clearMenus(), !i) {
                        var r = {
                                relatedTarget: this._element
                            },
                            o = t.Event(Ke.SHOW, r);
                        if (t(n).trigger(o), !o.isDefaultPrevented()) {
                            if (!this._inNavbar) {
                                if (void 0 === Be) throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)");
                                var a = this._element;
                                "parent" === this._config.reference ? a = n : s.isElement(this._config.reference) && (a = this._config.reference, void 0 !== this._config.reference.jquery && (a = this._config.reference[0])), "scrollParent" !== this._config.boundary && t(n).addClass("position-static"), this._popper = new Be(a, this._menu, this._getPopperConfig())
                            }
                            "ontouchstart" in document.documentElement && 0 === t(n).closest(".navbar-nav").length && t(document.body).children().on("mouseover", null, t.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), t(this._menu).toggleClass(Ge), t(n).toggleClass(Ge).trigger(t.Event(Ke.SHOWN, r))
                        }
                    }
                }
            }, n.show = function () {
                if (!(this._element.disabled || t(this._element).hasClass(Xe) || t(this._menu).hasClass(Ge))) {
                    var n = {
                            relatedTarget: this._element
                        },
                        i = t.Event(Ke.SHOW, n),
                        r = e._getParentFromElement(this._element);
                    t(r).trigger(i), i.isDefaultPrevented() || (t(this._menu).toggleClass(Ge), t(r).toggleClass(Ge).trigger(t.Event(Ke.SHOWN, n)))
                }
            }, n.hide = function () {
                if (!this._element.disabled && !t(this._element).hasClass(Xe) && t(this._menu).hasClass(Ge)) {
                    var n = {
                            relatedTarget: this._element
                        },
                        i = t.Event(Ke.HIDE, n),
                        r = e._getParentFromElement(this._element);
                    t(r).trigger(i), i.isDefaultPrevented() || (t(this._menu).toggleClass(Ge), t(r).toggleClass(Ge).trigger(t.Event(Ke.HIDDEN, n)))
                }
            }, n.dispose = function () {
                t.removeData(this._element, ze), t(this._element).off(Ve), this._element = null, (this._menu = null) !== this._popper && (this._popper.destroy(), this._popper = null)
            }, n.update = function () {
                this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate()
            }, n._addEventListeners = function () {
                var e = this;
                t(this._element).on(Ke.CLICK, function (t) {
                    t.preventDefault(), t.stopPropagation(), e.toggle()
                })
            }, n._getConfig = function (e) {
                return e = r({}, this.constructor.Default, t(this._element).data(), e), s.typeCheckConfig(Ue, e, this.constructor.DefaultType), e
            }, n._getMenuElement = function () {
                if (!this._menu) {
                    var t = e._getParentFromElement(this._element);
                    t && (this._menu = t.querySelector(et))
                }
                return this._menu
            }, n._getPlacement = function () {
                var e = t(this._element.parentNode),
                    n = "bottom-start";
                return e.hasClass("dropup") ? (n = "top-start", t(this._menu).hasClass(Je) && (n = "top-end")) : e.hasClass("dropright") ? n = "right-start" : e.hasClass("dropleft") ? n = "left-start" : t(this._menu).hasClass(Je) && (n = "bottom-end"), n
            }, n._detectNavbar = function () {
                return 0 < t(this._element).closest(".navbar").length
            }, n._getOffset = function () {
                var e = this,
                    t = {};
                return "function" == typeof this._config.offset ? t.fn = function (t) {
                    return t.offsets = r({}, t.offsets, e._config.offset(t.offsets, e._element) || {}), t
                } : t.offset = this._config.offset, t
            }, n._getPopperConfig = function () {
                var e = {
                    placement: this._getPlacement(),
                    modifiers: {
                        offset: this._getOffset(),
                        flip: {
                            enabled: this._config.flip
                        },
                        preventOverflow: {
                            boundariesElement: this._config.boundary
                        }
                    }
                };
                return "static" === this._config.display && (e.modifiers.applyStyle = {
                    enabled: !1
                }), e
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this).data(ze);
                    if (i || (i = new e(this, "object" == typeof n ? n : null), t(this).data(ze, i)), "string" == typeof n) {
                        if (void 0 === i[n]) throw new TypeError('No method named "' + n + '"');
                        i[n]()
                    }
                })
            }, e._clearMenus = function (n) {
                if (!n || 3 !== n.which && ("keyup" !== n.type || 9 === n.which))
                    for (var i = [].slice.call(document.querySelectorAll(Ze)), r = 0, o = i.length; r < o; r++) {
                        var s = e._getParentFromElement(i[r]),
                            a = t(i[r]).data(ze),
                            l = {
                                relatedTarget: i[r]
                            };
                        if (n && "click" === n.type && (l.clickEvent = n), a) {
                            var c = a._menu;
                            if (t(s).hasClass(Ge) && !(n && ("click" === n.type && /input|textarea/i.test(n.target.tagName) || "keyup" === n.type && 9 === n.which) && t.contains(s, n.target))) {
                                var u = t.Event(Ke.HIDE, l);
                                t(s).trigger(u), u.isDefaultPrevented() || ("ontouchstart" in document.documentElement && t(document.body).children().off("mouseover", null, t.noop), i[r].setAttribute("aria-expanded", "false"), t(c).removeClass(Ge), t(s).removeClass(Ge).trigger(t.Event(Ke.HIDDEN, l)))
                            }
                        }
                    }
            }, e._getParentFromElement = function (e) {
                var t, n = s.getSelectorFromElement(e);
                return n && (t = document.querySelector(n)), t || e.parentNode
            }, e._dataApiKeydownHandler = function (n) {
                if ((/input|textarea/i.test(n.target.tagName) ? !(32 === n.which || 27 !== n.which && (40 !== n.which && 38 !== n.which || t(n.target).closest(et).length)) : Ye.test(n.which)) && (n.preventDefault(), n.stopPropagation(), !this.disabled && !t(this).hasClass(Xe))) {
                    var i = e._getParentFromElement(this),
                        r = t(i).hasClass(Ge);
                    if (r && (!r || 27 !== n.which && 32 !== n.which)) {
                        var o = [].slice.call(i.querySelectorAll(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)"));
                        if (0 !== o.length) {
                            var s = o.indexOf(n.target);
                            38 === n.which && 0 < s && s--, 40 === n.which && s < o.length - 1 && s++, s < 0 && (s = 0), o[s].focus()
                        }
                    } else {
                        if (27 === n.which) {
                            var a = i.querySelector(Ze);
                            t(a).trigger("focus")
                        }
                        t(this).trigger("click")
                    }
                }
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }, {
                key: "Default",
                get: function () {
                    return tt
                }
            }, {
                key: "DefaultType",
                get: function () {
                    return nt
                }
            }]), e
        }();
    t(document).on(Ke.KEYDOWN_DATA_API, Ze, it._dataApiKeydownHandler).on(Ke.KEYDOWN_DATA_API, et, it._dataApiKeydownHandler).on(Ke.CLICK_DATA_API + " " + Ke.KEYUP_DATA_API, it._clearMenus).on(Ke.CLICK_DATA_API, Ze, function (e) {
        e.preventDefault(), e.stopPropagation(), it._jQueryInterface.call(t(this), "toggle")
    }).on(Ke.CLICK_DATA_API, ".dropdown form", function (e) {
        e.stopPropagation()
    }), t.fn[Ue] = it._jQueryInterface, t.fn[Ue].Constructor = it, t.fn[Ue].noConflict = function () {
        return t.fn[Ue] = Qe, it._jQueryInterface
    };
    var rt = "modal",
        ot = "bs.modal",
        st = "." + ot,
        at = t.fn[rt],
        lt = {
            backdrop: !0,
            keyboard: !0,
            focus: !0,
            show: !0
        },
        ct = {
            backdrop: "(boolean|string)",
            keyboard: "boolean",
            focus: "boolean",
            show: "boolean"
        },
        ut = {
            HIDE: "hide" + st,
            HIDDEN: "hidden" + st,
            SHOW: "show" + st,
            SHOWN: "shown" + st,
            FOCUSIN: "focusin" + st,
            RESIZE: "resize" + st,
            CLICK_DISMISS: "click.dismiss" + st,
            KEYDOWN_DISMISS: "keydown.dismiss" + st,
            MOUSEUP_DISMISS: "mouseup.dismiss" + st,
            MOUSEDOWN_DISMISS: "mousedown.dismiss" + st,
            CLICK_DATA_API: "click" + st + ".data-api"
        },
        ft = "modal-open",
        ht = "fade",
        dt = "show",
        pt = ".modal-dialog",
        gt = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
        mt = ".sticky-top",
        vt = function () {
            function e(e, t) {
                this._config = this._getConfig(t), this._element = e, this._dialog = e.querySelector(pt), this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._isTransitioning = !1, this._scrollbarWidth = 0
            }
            var n = e.prototype;
            return n.toggle = function (e) {
                return this._isShown ? this.hide() : this.show(e)
            }, n.show = function (e) {
                var n = this;
                if (!this._isShown && !this._isTransitioning) {
                    t(this._element).hasClass(ht) && (this._isTransitioning = !0);
                    var i = t.Event(ut.SHOW, {
                        relatedTarget: e
                    });
                    t(this._element).trigger(i), this._isShown || i.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), this._adjustDialog(), this._setEscapeEvent(), this._setResizeEvent(), t(this._element).on(ut.CLICK_DISMISS, '[data-dismiss="modal"]', function (e) {
                        return n.hide(e)
                    }), t(this._dialog).on(ut.MOUSEDOWN_DISMISS, function () {
                        t(n._element).one(ut.MOUSEUP_DISMISS, function (e) {
                            t(e.target).is(n._element) && (n._ignoreBackdropClick = !0)
                        })
                    }), this._showBackdrop(function () {
                        return n._showElement(e)
                    }))
                }
            }, n.hide = function (e) {
                var n = this;
                if (e && e.preventDefault(), this._isShown && !this._isTransitioning) {
                    var i = t.Event(ut.HIDE);
                    if (t(this._element).trigger(i), this._isShown && !i.isDefaultPrevented()) {
                        this._isShown = !1;
                        var r = t(this._element).hasClass(ht);
                        if (r && (this._isTransitioning = !0), this._setEscapeEvent(), this._setResizeEvent(), t(document).off(ut.FOCUSIN), t(this._element).removeClass(dt), t(this._element).off(ut.CLICK_DISMISS), t(this._dialog).off(ut.MOUSEDOWN_DISMISS), r) {
                            var o = s.getTransitionDurationFromElement(this._element);
                            t(this._element).one(s.TRANSITION_END, function (e) {
                                return n._hideModal(e)
                            }).emulateTransitionEnd(o)
                        } else this._hideModal()
                    }
                }
            }, n.dispose = function () {
                [window, this._element, this._dialog].forEach(function (e) {
                    return t(e).off(st)
                }), t(document).off(ut.FOCUSIN), t.removeData(this._element, ot), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._isTransitioning = null, this._scrollbarWidth = null
            }, n.handleUpdate = function () {
                this._adjustDialog()
            }, n._getConfig = function (e) {
                return e = r({}, lt, e), s.typeCheckConfig(rt, e, ct), e
            }, n._showElement = function (e) {
                var n = this,
                    i = t(this._element).hasClass(ht);
                this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.setAttribute("aria-modal", !0), t(this._dialog).hasClass("modal-dialog-scrollable") ? this._dialog.querySelector(".modal-body").scrollTop = 0 : this._element.scrollTop = 0, i && s.reflow(this._element), t(this._element).addClass(dt), this._config.focus && this._enforceFocus();
                var r = t.Event(ut.SHOWN, {
                        relatedTarget: e
                    }),
                    o = function () {
                        n._config.focus && n._element.focus(), n._isTransitioning = !1, t(n._element).trigger(r)
                    };
                if (i) {
                    var a = s.getTransitionDurationFromElement(this._dialog);
                    t(this._dialog).one(s.TRANSITION_END, o).emulateTransitionEnd(a)
                } else o()
            }, n._enforceFocus = function () {
                var e = this;
                t(document).off(ut.FOCUSIN).on(ut.FOCUSIN, function (n) {
                    document !== n.target && e._element !== n.target && 0 === t(e._element).has(n.target).length && e._element.focus()
                })
            }, n._setEscapeEvent = function () {
                var e = this;
                this._isShown && this._config.keyboard ? t(this._element).on(ut.KEYDOWN_DISMISS, function (t) {
                    27 === t.which && (t.preventDefault(), e.hide())
                }) : this._isShown || t(this._element).off(ut.KEYDOWN_DISMISS)
            }, n._setResizeEvent = function () {
                var e = this;
                this._isShown ? t(window).on(ut.RESIZE, function (t) {
                    return e.handleUpdate(t)
                }) : t(window).off(ut.RESIZE)
            }, n._hideModal = function () {
                var e = this;
                this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._element.removeAttribute("aria-modal"), this._isTransitioning = !1, this._showBackdrop(function () {
                    t(document.body).removeClass(ft), e._resetAdjustments(), e._resetScrollbar(), t(e._element).trigger(ut.HIDDEN)
                })
            }, n._removeBackdrop = function () {
                this._backdrop && (t(this._backdrop).remove(), this._backdrop = null)
            }, n._showBackdrop = function (e) {
                var n = this,
                    i = t(this._element).hasClass(ht) ? ht : "";
                if (this._isShown && this._config.backdrop) {
                    if (this._backdrop = document.createElement("div"), this._backdrop.className = "modal-backdrop", i && this._backdrop.classList.add(i), t(this._backdrop).appendTo(document.body), t(this._element).on(ut.CLICK_DISMISS, function (e) {
                            n._ignoreBackdropClick ? n._ignoreBackdropClick = !1 : e.target === e.currentTarget && ("static" === n._config.backdrop ? n._element.focus() : n.hide())
                        }), i && s.reflow(this._backdrop), t(this._backdrop).addClass(dt), !e) return;
                    if (!i) return void e();
                    var r = s.getTransitionDurationFromElement(this._backdrop);
                    t(this._backdrop).one(s.TRANSITION_END, e).emulateTransitionEnd(r)
                } else if (!this._isShown && this._backdrop) {
                    t(this._backdrop).removeClass(dt);
                    var o = function () {
                        n._removeBackdrop(), e && e()
                    };
                    if (t(this._element).hasClass(ht)) {
                        var a = s.getTransitionDurationFromElement(this._backdrop);
                        t(this._backdrop).one(s.TRANSITION_END, o).emulateTransitionEnd(a)
                    } else o()
                } else e && e()
            }, n._adjustDialog = function () {
                var e = this._element.scrollHeight > document.documentElement.clientHeight;
                !this._isBodyOverflowing && e && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !e && (this._element.style.paddingRight = this._scrollbarWidth + "px")
            }, n._resetAdjustments = function () {
                this._element.style.paddingLeft = "", this._element.style.paddingRight = ""
            }, n._checkScrollbar = function () {
                var e = document.body.getBoundingClientRect();
                this._isBodyOverflowing = e.left + e.right < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth()
            }, n._setScrollbar = function () {
                var e = this;
                if (this._isBodyOverflowing) {
                    var n = [].slice.call(document.querySelectorAll(gt)),
                        i = [].slice.call(document.querySelectorAll(mt));
                    t(n).each(function (n, i) {
                        var r = i.style.paddingRight,
                            o = t(i).css("padding-right");
                        t(i).data("padding-right", r).css("padding-right", parseFloat(o) + e._scrollbarWidth + "px")
                    }), t(i).each(function (n, i) {
                        var r = i.style.marginRight,
                            o = t(i).css("margin-right");
                        t(i).data("margin-right", r).css("margin-right", parseFloat(o) - e._scrollbarWidth + "px")
                    });
                    var r = document.body.style.paddingRight,
                        o = t(document.body).css("padding-right");
                    t(document.body).data("padding-right", r).css("padding-right", parseFloat(o) + this._scrollbarWidth + "px")
                }
                t(document.body).addClass(ft)
            }, n._resetScrollbar = function () {
                var e = [].slice.call(document.querySelectorAll(gt));
                t(e).each(function (e, n) {
                    var i = t(n).data("padding-right");
                    t(n).removeData("padding-right"), n.style.paddingRight = i || ""
                });
                var n = [].slice.call(document.querySelectorAll("" + mt));
                t(n).each(function (e, n) {
                    var i = t(n).data("margin-right");
                    void 0 !== i && t(n).css("margin-right", i).removeData("margin-right")
                });
                var i = t(document.body).data("padding-right");
                t(document.body).removeData("padding-right"), document.body.style.paddingRight = i || ""
            }, n._getScrollbarWidth = function () {
                var e = document.createElement("div");
                e.className = "modal-scrollbar-measure", document.body.appendChild(e);
                var t = e.getBoundingClientRect().width - e.clientWidth;
                return document.body.removeChild(e), t
            }, e._jQueryInterface = function (n, i) {
                return this.each(function () {
                    var o = t(this).data(ot),
                        s = r({}, lt, t(this).data(), "object" == typeof n && n ? n : {});
                    if (o || (o = new e(this, s), t(this).data(ot, o)), "string" == typeof n) {
                        if (void 0 === o[n]) throw new TypeError('No method named "' + n + '"');
                        o[n](i)
                    } else s.show && o.show(i)
                })
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }, {
                key: "Default",
                get: function () {
                    return lt
                }
            }]), e
        }();
    t(document).on(ut.CLICK_DATA_API, '[data-toggle="modal"]', function (e) {
        var n, i = this,
            o = s.getSelectorFromElement(this);
        o && (n = document.querySelector(o));
        var a = t(n).data(ot) ? "toggle" : r({}, t(n).data(), t(this).data());
        "A" !== this.tagName && "AREA" !== this.tagName || e.preventDefault();
        var l = t(n).one(ut.SHOW, function (e) {
            e.isDefaultPrevented() || l.one(ut.HIDDEN, function () {
                t(i).is(":visible") && i.focus()
            })
        });
        vt._jQueryInterface.call(t(n), a, this)
    }), t.fn[rt] = vt._jQueryInterface, t.fn[rt].Constructor = vt, t.fn[rt].noConflict = function () {
        return t.fn[rt] = at, vt._jQueryInterface
    };
    var yt = ["background", "cite", "href", "itemtype", "longdesc", "poster", "src", "xlink:href"],
        bt = /^(?:(?:https?|mailto|ftp|tel|file):|[^&:\/?#]*(?:[\/?#]|$))/gi,
        _t = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+\/]+=*$/i;

    function wt(e, t, n) {
        if (0 === e.length) return e;
        if (n && "function" == typeof n) return n(e);
        for (var i = (new window.DOMParser).parseFromString(e, "text/html"), r = Object.keys(t), o = [].slice.call(i.body.querySelectorAll("*")), s = function (e, n) {
                var i = o[e],
                    s = i.nodeName.toLowerCase();
                if (-1 === r.indexOf(i.nodeName.toLowerCase())) return i.parentNode.removeChild(i), "continue";
                var a = [].slice.call(i.attributes),
                    l = [].concat(t["*"] || [], t[s] || []);
                a.forEach(function (e) {
                    (function (e, t) {
                        var n = e.nodeName.toLowerCase();
                        if (-1 !== t.indexOf(n)) return -1 === yt.indexOf(n) || Boolean(e.nodeValue.match(bt) || e.nodeValue.match(_t));
                        for (var i = t.filter(function (e) {
                                return e instanceof RegExp
                            }), r = 0, o = i.length; r < o; r++)
                            if (n.match(i[r])) return !0;
                        return !1
                    })(e, l) || i.removeAttribute(e.nodeName)
                })
            }, a = 0, l = o.length; a < l; a++) s(a);
        return i.body.innerHTML
    }
    var Et = "tooltip",
        xt = "bs.tooltip",
        Tt = "." + xt,
        Ct = t.fn[Et],
        St = "bs-tooltip",
        At = new RegExp("(^|\\s)" + St + "\\S+", "g"),
        Dt = ["sanitize", "whiteList", "sanitizeFn"],
        kt = {
            animation: "boolean",
            template: "string",
            title: "(string|element|function)",
            trigger: "string",
            delay: "(number|object)",
            html: "boolean",
            selector: "(string|boolean)",
            placement: "(string|function)",
            offset: "(number|string|function)",
            container: "(string|element|boolean)",
            fallbackPlacement: "(string|array)",
            boundary: "(string|element)",
            sanitize: "boolean",
            sanitizeFn: "(null|function)",
            whiteList: "object"
        },
        Nt = {
            AUTO: "auto",
            TOP: "top",
            RIGHT: "right",
            BOTTOM: "bottom",
            LEFT: "left"
        },
        It = {
            animation: !0,
            template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
            trigger: "hover focus",
            title: "",
            delay: 0,
            html: !1,
            selector: !1,
            placement: "top",
            offset: 0,
            container: !1,
            fallbackPlacement: "flip",
            boundary: "scrollParent",
            sanitize: !0,
            sanitizeFn: null,
            whiteList: {
                "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
                a: ["target", "href", "title", "rel"],
                area: [],
                b: [],
                br: [],
                col: [],
                code: [],
                div: [],
                em: [],
                hr: [],
                h1: [],
                h2: [],
                h3: [],
                h4: [],
                h5: [],
                h6: [],
                i: [],
                img: ["src", "alt", "title", "width", "height"],
                li: [],
                ol: [],
                p: [],
                pre: [],
                s: [],
                small: [],
                span: [],
                sub: [],
                sup: [],
                strong: [],
                u: [],
                ul: []
            }
        },
        Ot = "show",
        jt = {
            HIDE: "hide" + Tt,
            HIDDEN: "hidden" + Tt,
            SHOW: "show" + Tt,
            SHOWN: "shown" + Tt,
            INSERTED: "inserted" + Tt,
            CLICK: "click" + Tt,
            FOCUSIN: "focusin" + Tt,
            FOCUSOUT: "focusout" + Tt,
            MOUSEENTER: "mouseenter" + Tt,
            MOUSELEAVE: "mouseleave" + Tt
        },
        Lt = "fade",
        Pt = "show",
        Ht = "hover",
        Mt = "focus",
        qt = function () {
            function e(e, t) {
                if (void 0 === Be) throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)");
                this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._popper = null, this.element = e, this.config = this._getConfig(t), this.tip = null, this._setListeners()
            }
            var n = e.prototype;
            return n.enable = function () {
                this._isEnabled = !0
            }, n.disable = function () {
                this._isEnabled = !1
            }, n.toggleEnabled = function () {
                this._isEnabled = !this._isEnabled
            }, n.toggle = function (e) {
                if (this._isEnabled)
                    if (e) {
                        var n = this.constructor.DATA_KEY,
                            i = t(e.currentTarget).data(n);
                        i || (i = new this.constructor(e.currentTarget, this._getDelegateConfig()), t(e.currentTarget).data(n, i)), i._activeTrigger.click = !i._activeTrigger.click, i._isWithActiveTrigger() ? i._enter(null, i) : i._leave(null, i)
                    } else {
                        if (t(this.getTipElement()).hasClass(Pt)) return void this._leave(null, this);
                        this._enter(null, this)
                    }
            }, n.dispose = function () {
                clearTimeout(this._timeout), t.removeData(this.element, this.constructor.DATA_KEY), t(this.element).off(this.constructor.EVENT_KEY), t(this.element).closest(".modal").off("hide.bs.modal"), this.tip && t(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, (this._activeTrigger = null) !== this._popper && this._popper.destroy(), this._popper = null, this.element = null, this.config = null, this.tip = null
            }, n.show = function () {
                var e = this;
                if ("none" === t(this.element).css("display")) throw new Error("Please use show on visible elements");
                var n = t.Event(this.constructor.Event.SHOW);
                if (this.isWithContent() && this._isEnabled) {
                    t(this.element).trigger(n);
                    var i = s.findShadowRoot(this.element),
                        r = t.contains(null !== i ? i : this.element.ownerDocument.documentElement, this.element);
                    if (n.isDefaultPrevented() || !r) return;
                    var o = this.getTipElement(),
                        a = s.getUID(this.constructor.NAME);
                    o.setAttribute("id", a), this.element.setAttribute("aria-describedby", a), this.setContent(), this.config.animation && t(o).addClass(Lt);
                    var l = "function" == typeof this.config.placement ? this.config.placement.call(this, o, this.element) : this.config.placement,
                        c = this._getAttachment(l);
                    this.addAttachmentClass(c);
                    var u = this._getContainer();
                    t(o).data(this.constructor.DATA_KEY, this), t.contains(this.element.ownerDocument.documentElement, this.tip) || t(o).appendTo(u), t(this.element).trigger(this.constructor.Event.INSERTED), this._popper = new Be(this.element, o, {
                        placement: c,
                        modifiers: {
                            offset: this._getOffset(),
                            flip: {
                                behavior: this.config.fallbackPlacement
                            },
                            arrow: {
                                element: ".arrow"
                            },
                            preventOverflow: {
                                boundariesElement: this.config.boundary
                            }
                        },
                        onCreate: function (t) {
                            t.originalPlacement !== t.placement && e._handlePopperPlacementChange(t)
                        },
                        onUpdate: function (t) {
                            return e._handlePopperPlacementChange(t)
                        }
                    }), t(o).addClass(Pt), "ontouchstart" in document.documentElement && t(document.body).children().on("mouseover", null, t.noop);
                    var f = function () {
                        e.config.animation && e._fixTransition();
                        var n = e._hoverState;
                        e._hoverState = null, t(e.element).trigger(e.constructor.Event.SHOWN), "out" === n && e._leave(null, e)
                    };
                    if (t(this.tip).hasClass(Lt)) {
                        var h = s.getTransitionDurationFromElement(this.tip);
                        t(this.tip).one(s.TRANSITION_END, f).emulateTransitionEnd(h)
                    } else f()
                }
            }, n.hide = function (e) {
                var n = this,
                    i = this.getTipElement(),
                    r = t.Event(this.constructor.Event.HIDE),
                    o = function () {
                        n._hoverState !== Ot && i.parentNode && i.parentNode.removeChild(i), n._cleanTipClass(), n.element.removeAttribute("aria-describedby"), t(n.element).trigger(n.constructor.Event.HIDDEN), null !== n._popper && n._popper.destroy(), e && e()
                    };
                if (t(this.element).trigger(r), !r.isDefaultPrevented()) {
                    if (t(i).removeClass(Pt), "ontouchstart" in document.documentElement && t(document.body).children().off("mouseover", null, t.noop), this._activeTrigger.click = !1, this._activeTrigger[Mt] = !1, this._activeTrigger[Ht] = !1, t(this.tip).hasClass(Lt)) {
                        var a = s.getTransitionDurationFromElement(i);
                        t(i).one(s.TRANSITION_END, o).emulateTransitionEnd(a)
                    } else o();
                    this._hoverState = ""
                }
            }, n.update = function () {
                null !== this._popper && this._popper.scheduleUpdate()
            }, n.isWithContent = function () {
                return Boolean(this.getTitle())
            }, n.addAttachmentClass = function (e) {
                t(this.getTipElement()).addClass(St + "-" + e)
            }, n.getTipElement = function () {
                return this.tip = this.tip || t(this.config.template)[0], this.tip
            }, n.setContent = function () {
                var e = this.getTipElement();
                this.setElementContent(t(e.querySelectorAll(".tooltip-inner")), this.getTitle()), t(e).removeClass(Lt + " " + Pt)
            }, n.setElementContent = function (e, n) {
                "object" != typeof n || !n.nodeType && !n.jquery ? this.config.html ? (this.config.sanitize && (n = wt(n, this.config.whiteList, this.config.sanitizeFn)), e.html(n)) : e.text(n) : this.config.html ? t(n).parent().is(e) || e.empty().append(n) : e.text(t(n).text())
            }, n.getTitle = function () {
                var e = this.element.getAttribute("data-original-title");
                return e || (e = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), e
            }, n._getOffset = function () {
                var e = this,
                    t = {};
                return "function" == typeof this.config.offset ? t.fn = function (t) {
                    return t.offsets = r({}, t.offsets, e.config.offset(t.offsets, e.element) || {}), t
                } : t.offset = this.config.offset, t
            }, n._getContainer = function () {
                return !1 === this.config.container ? document.body : s.isElement(this.config.container) ? t(this.config.container) : t(document).find(this.config.container)
            }, n._getAttachment = function (e) {
                return Nt[e.toUpperCase()]
            }, n._setListeners = function () {
                var e = this;
                this.config.trigger.split(" ").forEach(function (n) {
                    if ("click" === n) t(e.element).on(e.constructor.Event.CLICK, e.config.selector, function (t) {
                        return e.toggle(t)
                    });
                    else if ("manual" !== n) {
                        var i = n === Ht ? e.constructor.Event.MOUSEENTER : e.constructor.Event.FOCUSIN,
                            r = n === Ht ? e.constructor.Event.MOUSELEAVE : e.constructor.Event.FOCUSOUT;
                        t(e.element).on(i, e.config.selector, function (t) {
                            return e._enter(t)
                        }).on(r, e.config.selector, function (t) {
                            return e._leave(t)
                        })
                    }
                }), t(this.element).closest(".modal").on("hide.bs.modal", function () {
                    e.element && e.hide()
                }), this.config.selector ? this.config = r({}, this.config, {
                    trigger: "manual",
                    selector: ""
                }) : this._fixTitle()
            }, n._fixTitle = function () {
                var e = typeof this.element.getAttribute("data-original-title");
                (this.element.getAttribute("title") || "string" !== e) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""))
            }, n._enter = function (e, n) {
                var i = this.constructor.DATA_KEY;
                (n = n || t(e.currentTarget).data(i)) || (n = new this.constructor(e.currentTarget, this._getDelegateConfig()), t(e.currentTarget).data(i, n)), e && (n._activeTrigger["focusin" === e.type ? Mt : Ht] = !0), t(n.getTipElement()).hasClass(Pt) || n._hoverState === Ot ? n._hoverState = Ot : (clearTimeout(n._timeout), n._hoverState = Ot, n.config.delay && n.config.delay.show ? n._timeout = setTimeout(function () {
                    n._hoverState === Ot && n.show()
                }, n.config.delay.show) : n.show())
            }, n._leave = function (e, n) {
                var i = this.constructor.DATA_KEY;
                (n = n || t(e.currentTarget).data(i)) || (n = new this.constructor(e.currentTarget, this._getDelegateConfig()), t(e.currentTarget).data(i, n)), e && (n._activeTrigger["focusout" === e.type ? Mt : Ht] = !1), n._isWithActiveTrigger() || (clearTimeout(n._timeout), n._hoverState = "out", n.config.delay && n.config.delay.hide ? n._timeout = setTimeout(function () {
                    "out" === n._hoverState && n.hide()
                }, n.config.delay.hide) : n.hide())
            }, n._isWithActiveTrigger = function () {
                for (var e in this._activeTrigger)
                    if (this._activeTrigger[e]) return !0;
                return !1
            }, n._getConfig = function (e) {
                var n = t(this.element).data();
                return Object.keys(n).forEach(function (e) {
                    -1 !== Dt.indexOf(e) && delete n[e]
                }), "number" == typeof (e = r({}, this.constructor.Default, n, "object" == typeof e && e ? e : {})).delay && (e.delay = {
                    show: e.delay,
                    hide: e.delay
                }), "number" == typeof e.title && (e.title = e.title.toString()), "number" == typeof e.content && (e.content = e.content.toString()), s.typeCheckConfig(Et, e, this.constructor.DefaultType), e.sanitize && (e.template = wt(e.template, e.whiteList, e.sanitizeFn)), e
            }, n._getDelegateConfig = function () {
                var e = {};
                if (this.config)
                    for (var t in this.config) this.constructor.Default[t] !== this.config[t] && (e[t] = this.config[t]);
                return e
            }, n._cleanTipClass = function () {
                var e = t(this.getTipElement()),
                    n = e.attr("class").match(At);
                null !== n && n.length && e.removeClass(n.join(""))
            }, n._handlePopperPlacementChange = function (e) {
                var t = e.instance;
                this.tip = t.popper, this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(e.placement))
            }, n._fixTransition = function () {
                var e = this.getTipElement(),
                    n = this.config.animation;
                null === e.getAttribute("x-placement") && (t(e).removeClass(Lt), this.config.animation = !1, this.hide(), this.show(), this.config.animation = n)
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this).data(xt),
                        r = "object" == typeof n && n;
                    if ((i || !/dispose|hide/.test(n)) && (i || (i = new e(this, r), t(this).data(xt, i)), "string" == typeof n)) {
                        if (void 0 === i[n]) throw new TypeError('No method named "' + n + '"');
                        i[n]()
                    }
                })
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }, {
                key: "Default",
                get: function () {
                    return It
                }
            }, {
                key: "NAME",
                get: function () {
                    return Et
                }
            }, {
                key: "DATA_KEY",
                get: function () {
                    return xt
                }
            }, {
                key: "Event",
                get: function () {
                    return jt
                }
            }, {
                key: "EVENT_KEY",
                get: function () {
                    return Tt
                }
            }, {
                key: "DefaultType",
                get: function () {
                    return kt
                }
            }]), e
        }();
    t.fn[Et] = qt._jQueryInterface, t.fn[Et].Constructor = qt, t.fn[Et].noConflict = function () {
        return t.fn[Et] = Ct, qt._jQueryInterface
    };
    var Rt = "popover",
        Ft = "bs.popover",
        Wt = "." + Ft,
        Bt = t.fn[Rt],
        Ut = "bs-popover",
        zt = new RegExp("(^|\\s)" + Ut + "\\S+", "g"),
        Vt = r({}, qt.Default, {
            placement: "right",
            trigger: "click",
            content: "",
            template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
        }),
        $t = r({}, qt.DefaultType, {
            content: "(string|element|function)"
        }),
        Qt = {
            HIDE: "hide" + Wt,
            HIDDEN: "hidden" + Wt,
            SHOW: "show" + Wt,
            SHOWN: "shown" + Wt,
            INSERTED: "inserted" + Wt,
            CLICK: "click" + Wt,
            FOCUSIN: "focusin" + Wt,
            FOCUSOUT: "focusout" + Wt,
            MOUSEENTER: "mouseenter" + Wt,
            MOUSELEAVE: "mouseleave" + Wt
        },
        Yt = function (e) {
            var n, r;

            function o() {
                return e.apply(this, arguments) || this
            }
            r = e, (n = o).prototype = Object.create(r.prototype), (n.prototype.constructor = n).__proto__ = r;
            var s = o.prototype;
            return s.isWithContent = function () {
                return this.getTitle() || this._getContent()
            }, s.addAttachmentClass = function (e) {
                t(this.getTipElement()).addClass(Ut + "-" + e)
            }, s.getTipElement = function () {
                return this.tip = this.tip || t(this.config.template)[0], this.tip
            }, s.setContent = function () {
                var e = t(this.getTipElement());
                this.setElementContent(e.find(".popover-header"), this.getTitle());
                var n = this._getContent();
                "function" == typeof n && (n = n.call(this.element)), this.setElementContent(e.find(".popover-body"), n), e.removeClass("fade show")
            }, s._getContent = function () {
                return this.element.getAttribute("data-content") || this.config.content
            }, s._cleanTipClass = function () {
                var e = t(this.getTipElement()),
                    n = e.attr("class").match(zt);
                null !== n && 0 < n.length && e.removeClass(n.join(""))
            }, o._jQueryInterface = function (e) {
                return this.each(function () {
                    var n = t(this).data(Ft),
                        i = "object" == typeof e ? e : null;
                    if ((n || !/dispose|hide/.test(e)) && (n || (n = new o(this, i), t(this).data(Ft, n)), "string" == typeof e)) {
                        if (void 0 === n[e]) throw new TypeError('No method named "' + e + '"');
                        n[e]()
                    }
                })
            }, i(o, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }, {
                key: "Default",
                get: function () {
                    return Vt
                }
            }, {
                key: "NAME",
                get: function () {
                    return Rt
                }
            }, {
                key: "DATA_KEY",
                get: function () {
                    return Ft
                }
            }, {
                key: "Event",
                get: function () {
                    return Qt
                }
            }, {
                key: "EVENT_KEY",
                get: function () {
                    return Wt
                }
            }, {
                key: "DefaultType",
                get: function () {
                    return $t
                }
            }]), o
        }(qt);
    t.fn[Rt] = Yt._jQueryInterface, t.fn[Rt].Constructor = Yt, t.fn[Rt].noConflict = function () {
        return t.fn[Rt] = Bt, Yt._jQueryInterface
    };
    var Kt = "scrollspy",
        Xt = "bs.scrollspy",
        Gt = "." + Xt,
        Jt = t.fn[Kt],
        Zt = {
            offset: 10,
            method: "auto",
            target: ""
        },
        en = {
            offset: "number",
            method: "string",
            target: "(string|element)"
        },
        tn = {
            ACTIVATE: "activate" + Gt,
            SCROLL: "scroll" + Gt,
            LOAD_DATA_API: "load" + Gt + ".data-api"
        },
        nn = "active",
        rn = ".nav, .list-group",
        on = ".nav-link",
        sn = ".list-group-item",
        an = ".dropdown-item",
        ln = "position",
        cn = function () {
            function e(e, n) {
                var i = this;
                this._element = e, this._scrollElement = "BODY" === e.tagName ? window : e, this._config = this._getConfig(n), this._selector = this._config.target + " " + on + "," + this._config.target + " " + sn + "," + this._config.target + " " + an, this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, t(this._scrollElement).on(tn.SCROLL, function (e) {
                    return i._process(e)
                }), this.refresh(), this._process()
            }
            var n = e.prototype;
            return n.refresh = function () {
                var e = this,
                    n = this._scrollElement === this._scrollElement.window ? "offset" : ln,
                    i = "auto" === this._config.method ? n : this._config.method,
                    r = i === ln ? this._getScrollTop() : 0;
                this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), [].slice.call(document.querySelectorAll(this._selector)).map(function (e) {
                    var n, o = s.getSelectorFromElement(e);
                    if (o && (n = document.querySelector(o)), n) {
                        var a = n.getBoundingClientRect();
                        if (a.width || a.height) return [t(n)[i]().top + r, o]
                    }
                    return null
                }).filter(function (e) {
                    return e
                }).sort(function (e, t) {
                    return e[0] - t[0]
                }).forEach(function (t) {
                    e._offsets.push(t[0]), e._targets.push(t[1])
                })
            }, n.dispose = function () {
                t.removeData(this._element, Xt), t(this._scrollElement).off(Gt), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null
            }, n._getConfig = function (e) {
                if ("string" != typeof (e = r({}, Zt, "object" == typeof e && e ? e : {})).target) {
                    var n = t(e.target).attr("id");
                    n || (n = s.getUID(Kt), t(e.target).attr("id", n)), e.target = "#" + n
                }
                return s.typeCheckConfig(Kt, e, en), e
            }, n._getScrollTop = function () {
                return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop
            }, n._getScrollHeight = function () {
                return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
            }, n._getOffsetHeight = function () {
                return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height
            }, n._process = function () {
                var e = this._getScrollTop() + this._config.offset,
                    t = this._getScrollHeight(),
                    n = this._config.offset + t - this._getOffsetHeight();
                if (this._scrollHeight !== t && this.refresh(), n <= e) {
                    var i = this._targets[this._targets.length - 1];
                    this._activeTarget !== i && this._activate(i)
                } else {
                    if (this._activeTarget && e < this._offsets[0] && 0 < this._offsets[0]) return this._activeTarget = null, void this._clear();
                    for (var r = this._offsets.length; r--;) this._activeTarget !== this._targets[r] && e >= this._offsets[r] && (void 0 === this._offsets[r + 1] || e < this._offsets[r + 1]) && this._activate(this._targets[r])
                }
            }, n._activate = function (e) {
                this._activeTarget = e, this._clear();
                var n = this._selector.split(",").map(function (t) {
                        return t + '[data-target="' + e + '"],' + t + '[href="' + e + '"]'
                    }),
                    i = t([].slice.call(document.querySelectorAll(n.join(","))));
                i.hasClass("dropdown-item") ? (i.closest(".dropdown").find(".dropdown-toggle").addClass(nn), i.addClass(nn)) : (i.addClass(nn), i.parents(rn).prev(on + ", " + sn).addClass(nn), i.parents(rn).prev(".nav-item").children(on).addClass(nn)), t(this._scrollElement).trigger(tn.ACTIVATE, {
                    relatedTarget: e
                })
            }, n._clear = function () {
                [].slice.call(document.querySelectorAll(this._selector)).filter(function (e) {
                    return e.classList.contains(nn)
                }).forEach(function (e) {
                    return e.classList.remove(nn)
                })
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this).data(Xt);
                    if (i || (i = new e(this, "object" == typeof n && n), t(this).data(Xt, i)), "string" == typeof n) {
                        if (void 0 === i[n]) throw new TypeError('No method named "' + n + '"');
                        i[n]()
                    }
                })
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }, {
                key: "Default",
                get: function () {
                    return Zt
                }
            }]), e
        }();
    t(window).on(tn.LOAD_DATA_API, function () {
        for (var e = [].slice.call(document.querySelectorAll('[data-spy="scroll"]')), n = e.length; n--;) {
            var i = t(e[n]);
            cn._jQueryInterface.call(i, i.data())
        }
    }), t.fn[Kt] = cn._jQueryInterface, t.fn[Kt].Constructor = cn, t.fn[Kt].noConflict = function () {
        return t.fn[Kt] = Jt, cn._jQueryInterface
    };
    var un = "bs.tab",
        fn = "." + un,
        hn = t.fn.tab,
        dn = {
            HIDE: "hide" + fn,
            HIDDEN: "hidden" + fn,
            SHOW: "show" + fn,
            SHOWN: "shown" + fn,
            CLICK_DATA_API: "click" + fn + ".data-api"
        },
        pn = "active",
        gn = ".active",
        mn = "> li > .active",
        vn = function () {
            function e(e) {
                this._element = e
            }
            var n = e.prototype;
            return n.show = function () {
                var e = this;
                if (!(this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && t(this._element).hasClass(pn) || t(this._element).hasClass("disabled"))) {
                    var n, i, r = t(this._element).closest(".nav, .list-group")[0],
                        o = s.getSelectorFromElement(this._element);
                    if (r) {
                        var a = "UL" === r.nodeName || "OL" === r.nodeName ? mn : gn;
                        i = (i = t.makeArray(t(r).find(a)))[i.length - 1]
                    }
                    var l = t.Event(dn.HIDE, {
                            relatedTarget: this._element
                        }),
                        c = t.Event(dn.SHOW, {
                            relatedTarget: i
                        });
                    if (i && t(i).trigger(l), t(this._element).trigger(c), !c.isDefaultPrevented() && !l.isDefaultPrevented()) {
                        o && (n = document.querySelector(o)), this._activate(this._element, r);
                        var u = function () {
                            var n = t.Event(dn.HIDDEN, {
                                    relatedTarget: e._element
                                }),
                                r = t.Event(dn.SHOWN, {
                                    relatedTarget: i
                                });
                            t(i).trigger(n), t(e._element).trigger(r)
                        };
                        n ? this._activate(n, n.parentNode, u) : u()
                    }
                }
            }, n.dispose = function () {
                t.removeData(this._element, un), this._element = null
            }, n._activate = function (e, n, i) {
                var r = this,
                    o = (!n || "UL" !== n.nodeName && "OL" !== n.nodeName ? t(n).children(gn) : t(n).find(mn))[0],
                    a = i && o && t(o).hasClass("fade"),
                    l = function () {
                        return r._transitionComplete(e, o, i)
                    };
                if (o && a) {
                    var c = s.getTransitionDurationFromElement(o);
                    t(o).removeClass("show").one(s.TRANSITION_END, l).emulateTransitionEnd(c)
                } else l()
            }, n._transitionComplete = function (e, n, i) {
                if (n) {
                    t(n).removeClass(pn);
                    var r = t(n.parentNode).find("> .dropdown-menu .active")[0];
                    r && t(r).removeClass(pn), "tab" === n.getAttribute("role") && n.setAttribute("aria-selected", !1)
                }
                if (t(e).addClass(pn), "tab" === e.getAttribute("role") && e.setAttribute("aria-selected", !0), s.reflow(e), e.classList.contains("fade") && e.classList.add("show"), e.parentNode && t(e.parentNode).hasClass("dropdown-menu")) {
                    var o = t(e).closest(".dropdown")[0];
                    if (o) {
                        var a = [].slice.call(o.querySelectorAll(".dropdown-toggle"));
                        t(a).addClass(pn)
                    }
                    e.setAttribute("aria-expanded", !0)
                }
                i && i()
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this),
                        r = i.data(un);
                    if (r || (r = new e(this), i.data(un, r)), "string" == typeof n) {
                        if (void 0 === r[n]) throw new TypeError('No method named "' + n + '"');
                        r[n]()
                    }
                })
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }]), e
        }();
    t(document).on(dn.CLICK_DATA_API, '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]', function (e) {
        e.preventDefault(), vn._jQueryInterface.call(t(this), "show")
    }), t.fn.tab = vn._jQueryInterface, t.fn.tab.Constructor = vn, t.fn.tab.noConflict = function () {
        return t.fn.tab = hn, vn._jQueryInterface
    };
    var yn = "toast",
        bn = "bs.toast",
        _n = "." + bn,
        wn = t.fn[yn],
        En = {
            CLICK_DISMISS: "click.dismiss" + _n,
            HIDE: "hide" + _n,
            HIDDEN: "hidden" + _n,
            SHOW: "show" + _n,
            SHOWN: "shown" + _n
        },
        xn = "show",
        Tn = "showing",
        Cn = {
            animation: "boolean",
            autohide: "boolean",
            delay: "number"
        },
        Sn = {
            animation: !0,
            autohide: !0,
            delay: 500
        },
        An = function () {
            function e(e, t) {
                this._element = e, this._config = this._getConfig(t), this._timeout = null, this._setListeners()
            }
            var n = e.prototype;
            return n.show = function () {
                var e = this;
                t(this._element).trigger(En.SHOW), this._config.animation && this._element.classList.add("fade");
                var n = function () {
                    e._element.classList.remove(Tn), e._element.classList.add(xn), t(e._element).trigger(En.SHOWN), e._config.autohide && e.hide()
                };
                if (this._element.classList.remove("hide"), this._element.classList.add(Tn), this._config.animation) {
                    var i = s.getTransitionDurationFromElement(this._element);
                    t(this._element).one(s.TRANSITION_END, n).emulateTransitionEnd(i)
                } else n()
            }, n.hide = function (e) {
                var n = this;
                this._element.classList.contains(xn) && (t(this._element).trigger(En.HIDE), e ? this._close() : this._timeout = setTimeout(function () {
                    n._close()
                }, this._config.delay))
            }, n.dispose = function () {
                clearTimeout(this._timeout), this._timeout = null, this._element.classList.contains(xn) && this._element.classList.remove(xn), t(this._element).off(En.CLICK_DISMISS), t.removeData(this._element, bn), this._element = null, this._config = null
            }, n._getConfig = function (e) {
                return e = r({}, Sn, t(this._element).data(), "object" == typeof e && e ? e : {}), s.typeCheckConfig(yn, e, this.constructor.DefaultType), e
            }, n._setListeners = function () {
                var e = this;
                t(this._element).on(En.CLICK_DISMISS, '[data-dismiss="toast"]', function () {
                    return e.hide(!0)
                })
            }, n._close = function () {
                var e = this,
                    n = function () {
                        e._element.classList.add("hide"), t(e._element).trigger(En.HIDDEN)
                    };
                if (this._element.classList.remove(xn), this._config.animation) {
                    var i = s.getTransitionDurationFromElement(this._element);
                    t(this._element).one(s.TRANSITION_END, n).emulateTransitionEnd(i)
                } else n()
            }, e._jQueryInterface = function (n) {
                return this.each(function () {
                    var i = t(this),
                        r = i.data(bn);
                    if (r || (r = new e(this, "object" == typeof n && n), i.data(bn, r)), "string" == typeof n) {
                        if (void 0 === r[n]) throw new TypeError('No method named "' + n + '"');
                        r[n](this)
                    }
                })
            }, i(e, null, [{
                key: "VERSION",
                get: function () {
                    return "4.3.1"
                }
            }, {
                key: "DefaultType",
                get: function () {
                    return Cn
                }
            }, {
                key: "Default",
                get: function () {
                    return Sn
                }
            }]), e
        }();
    t.fn[yn] = An._jQueryInterface, t.fn[yn].Constructor = An, t.fn[yn].noConflict = function () {
            return t.fn[yn] = wn, An._jQueryInterface
        },
        function () {
            if (void 0 === t) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");
            var e = t.fn.jquery.split(" ")[0].split(".");
            if (e[0] < 2 && e[1] < 9 || 1 === e[0] && 9 === e[1] && e[2] < 1 || 4 <= e[0]) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")
        }(), e.Util = s, e.Alert = h, e.Button = E, e.Carousel = M, e.Collapse = X, e.Dropdown = it, e.Modal = vt, e.Popover = Yt, e.Scrollspy = cn, e.Tab = vn, e.Toast = An, e.Tooltip = qt, Object.defineProperty(e, "__esModule", {
            value: !0
        })
}),
function (e, t) {
    "object" == typeof exports && "object" == typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define([], t) : "object" == typeof exports ? exports.inView = t() : e.inView = t()
}(this, function () {
    return function (e) {
        function t(i) {
            if (n[i]) return n[i].exports;
            var r = n[i] = {
                exports: {},
                id: i,
                loaded: !1
            };
            return e[i].call(r.exports, r, r.exports, t), r.loaded = !0, r.exports
        }
        var n = {};
        return t.m = e, t.c = n, t.p = "", t(0)
    }([function (e, t, n) {
        "use strict";
        var i = function (e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }(n(2));
        e.exports = i.default
    }, function (e, t) {
        e.exports = function (e) {
            var t = typeof e;
            return null != e && ("object" == t || "function" == t)
        }
    }, function (e, t, n) {
        "use strict";

        function i(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = i(n(9)),
            o = i(n(3)),
            s = n(4);
        t.default = function () {
            if ("undefined" != typeof window) {
                var e = {
                        history: []
                    },
                    t = {
                        offset: {},
                        threshold: 0,
                        test: s.inViewport
                    },
                    n = (0, r.default)(function () {
                        e.history.forEach(function (t) {
                            e[t].check()
                        })
                    }, 100);
                ["scroll", "resize", "load"].forEach(function (e) {
                    return addEventListener(e, n)
                }), window.MutationObserver && addEventListener("DOMContentLoaded", function () {
                    new MutationObserver(n).observe(document.body, {
                        attributes: !0,
                        childList: !0,
                        subtree: !0
                    })
                });
                var i = function (n) {
                    if ("string" == typeof n) {
                        var i = [].slice.call(document.querySelectorAll(n));
                        return e.history.indexOf(n) > -1 ? e[n].elements = i : (e[n] = (0, o.default)(i, t), e.history.push(n)), e[n]
                    }
                };
                return i.offset = function (e) {
                    if (void 0 === e) return t.offset;
                    var n = function (e) {
                        return "number" == typeof e
                    };
                    return ["top", "right", "bottom", "left"].forEach(n(e) ? function (n) {
                        return t.offset[n] = e
                    } : function (i) {
                        return n(e[i]) ? t.offset[i] = e[i] : null
                    }), t.offset
                }, i.threshold = function (e) {
                    return "number" == typeof e && e >= 0 && e <= 1 ? t.threshold = e : t.threshold
                }, i.test = function (e) {
                    return "function" == typeof e ? t.test = e : t.test
                }, i.is = function (e) {
                    return t.test(e, t)
                }, i.offset(0), i
            }
        }()
    }, function (e, t) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var n = function () {
                function e(e, t) {
                    for (var n = 0; n < t.length; n++) {
                        var i = t[n];
                        i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
                    }
                }
                return function (t, n, i) {
                    return n && e(t.prototype, n), i && e(t, i), t
                }
            }(),
            i = function () {
                function e(t, n) {
                    (function (e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    })(this, e), this.options = n, this.elements = t, this.current = [], this.handlers = {
                        enter: [],
                        exit: []
                    }, this.singles = {
                        enter: [],
                        exit: []
                    }
                }
                return n(e, [{
                    key: "check",
                    value: function () {
                        var e = this;
                        return this.elements.forEach(function (t) {
                            var n = e.options.test(t, e.options),
                                i = e.current.indexOf(t),
                                r = i > -1,
                                o = !n && r;
                            n && !r && (e.current.push(t), e.emit("enter", t)), o && (e.current.splice(i, 1), e.emit("exit", t))
                        }), this
                    }
                }, {
                    key: "on",
                    value: function (e, t) {
                        return this.handlers[e].push(t), this
                    }
                }, {
                    key: "once",
                    value: function (e, t) {
                        return this.singles[e].unshift(t), this
                    }
                }, {
                    key: "emit",
                    value: function (e, t) {
                        for (; this.singles[e].length;) this.singles[e].pop()(t);
                        for (var n = this.handlers[e].length; --n > -1;) this.handlers[e][n](t);
                        return this
                    }
                }]), e
            }();
        t.default = function (e, t) {
            return new i(e, t)
        }
    }, function (e, t) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        }), t.inViewport = function (e, t) {
            var n = e.getBoundingClientRect(),
                i = n.top,
                r = n.right,
                o = n.bottom,
                s = n.left,
                a = n.width,
                l = n.height,
                c = o,
                u = window.innerWidth - s,
                f = window.innerHeight - i,
                h = r,
                d = t.threshold * a,
                p = t.threshold * l;
            return c > t.offset.top + p && u > t.offset.right + d && f > t.offset.bottom + p && h > t.offset.left + d
        }
    }, function (e, t) {
        (function (t) {
            var n = "object" == typeof t && t && t.Object === Object && t;
            e.exports = n
        }).call(t, function () {
            return this
        }())
    }, function (e, t, n) {
        var i = n(5),
            r = "object" == typeof self && self && self.Object === Object && self,
            o = i || r || Function("return this")();
        e.exports = o
    }, function (e, t, n) {
        var i = n(1),
            r = n(8),
            o = n(10),
            s = "Expected a function",
            a = Math.max,
            l = Math.min;
        e.exports = function (e, t, n) {
            function c(t) {
                var n = p,
                    i = g;
                return p = g = void 0, _ = t, v = e.apply(i, n)
            }

            function u(e) {
                var n = e - b;
                return void 0 === b || n >= t || n < 0 || E && e - _ >= m
            }

            function f() {
                var e = r();
                return u(e) ? h(e) : void(y = setTimeout(f, function (e) {
                    var n = t - (e - b);
                    return E ? l(n, m - (e - _)) : n
                }(e)))
            }

            function h(e) {
                return y = void 0, x && p ? c(e) : (p = g = void 0, v)
            }

            function d() {
                var e = r(),
                    n = u(e);
                if (p = arguments, g = this, b = e, n) {
                    if (void 0 === y) return function (e) {
                        return _ = e, y = setTimeout(f, t), w ? c(e) : v
                    }(b);
                    if (E) return y = setTimeout(f, t), c(b)
                }
                return void 0 === y && (y = setTimeout(f, t)), v
            }
            var p, g, m, v, y, b, _ = 0,
                w = !1,
                E = !1,
                x = !0;
            if ("function" != typeof e) throw new TypeError(s);
            return t = o(t) || 0, i(n) && (w = !!n.leading, m = (E = "maxWait" in n) ? a(o(n.maxWait) || 0, t) : m, x = "trailing" in n ? !!n.trailing : x), d.cancel = function () {
                void 0 !== y && clearTimeout(y), _ = 0, p = b = g = y = void 0
            }, d.flush = function () {
                return void 0 === y ? v : h(r())
            }, d
        }
    }, function (e, t, n) {
        var i = n(6);
        e.exports = function () {
            return i.Date.now()
        }
    }, function (e, t, n) {
        var i = n(7),
            r = n(1),
            o = "Expected a function";
        e.exports = function (e, t, n) {
            var s = !0,
                a = !0;
            if ("function" != typeof e) throw new TypeError(o);
            return r(n) && (s = "leading" in n ? !!n.leading : s, a = "trailing" in n ? !!n.trailing : a), i(e, t, {
                leading: s,
                maxWait: t,
                trailing: a
            })
        }
    }, function (e, t) {
        e.exports = function (e) {
            return e
        }
    }])
}),
function () {
    var e, t;
    e = this.jQuery || window.jQuery, t = e(window), e.fn.stick_in_parent = function (n) {
        var i, r, o, s, a, l, c, u, f, h, d, p;
        for (null == n && (n = {}), f = n.sticky_class, o = n.inner_scrolling, u = n.recalc_every, c = n.parent, a = n.offset_top, s = n.spacer, r = n.bottoming, null == a && (a = 0), null == c && (c = void 0), null == o && (o = !0), null == f && (f = "is_stuck"), i = e(document), null == r && (r = !0), l = function (e) {
                var t;
                return window.getComputedStyle ? (e = window.getComputedStyle(e[0]), t = parseFloat(e.getPropertyValue("width")) + parseFloat(e.getPropertyValue("margin-left")) + parseFloat(e.getPropertyValue("margin-right")), "border-box" !== e.getPropertyValue("box-sizing") && (t += parseFloat(e.getPropertyValue("border-left-width")) + parseFloat(e.getPropertyValue("border-right-width")) + parseFloat(e.getPropertyValue("padding-left")) + parseFloat(e.getPropertyValue("padding-right"))), t) : e.outerWidth(!0)
            }, h = function (n, h, d, p, g, m, v, y) {
                var b, _, w, E, x, T, C, S, A, D, k, N;
                if (!n.data("sticky_kit")) {
                    if (n.data("sticky_kit", !0), x = i.height(), C = n.parent(), null != c && (C = C.closest(c)), !C.length) throw "failed to find stick parent";
                    if (b = w = !1, (k = null != s ? s && n.closest(s) : e("<div />")) && k.css("position", n.css("position")), (S = function () {
                            var e, t, r;
                            if (!y && (x = i.height(), e = parseInt(C.css("border-top-width"), 10), t = parseInt(C.css("padding-top"), 10), h = parseInt(C.css("padding-bottom"), 10), d = C.offset().top + e + t, p = C.height(), w && (b = w = !1, null == s && (n.insertAfter(k), k.detach()), n.css({
                                    position: "",
                                    top: "",
                                    width: "",
                                    bottom: ""
                                }).removeClass(f), r = !0), g = n.offset().top - (parseInt(n.css("margin-top"), 10) || 0) - a, m = n.outerHeight(!0), v = n.css("float"), k && k.css({
                                    width: l(n),
                                    height: m,
                                    display: n.css("display"),
                                    "vertical-align": n.css("vertical-align"),
                                    float: v
                                }), r)) return N()
                        })(), m !== p) return E = void 0, T = a, D = u, N = function () {
                        var e, l, c, _;
                        if (!y && (c = !1, null != D && (0 >= --D && (D = u, S(), c = !0)), c || i.height() === x || S(), c = t.scrollTop(), null != E && (l = c - E), E = c, w ? (r && (_ = c + m + T > p + d, b && !_ && (b = !1, n.css({
                                position: "fixed",
                                bottom: "",
                                top: T
                            }).trigger("sticky_kit:unbottom"))), c < g && (w = !1, T = a, null == s && ("left" !== v && "right" !== v || n.insertAfter(k), k.detach()), e = {
                                position: "",
                                width: "",
                                top: ""
                            }, n.css(e).removeClass(f).trigger("sticky_kit:unstick")), o && (e = t.height(), m + a > e && !b && (T -= l, T = Math.max(e - m, T), T = Math.min(a, T), w && n.css({
                                top: T + "px"
                            })))) : c > g && (w = !0, (e = {
                                position: "fixed",
                                top: T
                            }).width = "border-box" === n.css("box-sizing") ? n.outerWidth() + "px" : n.width() + "px", n.css(e).addClass(f), null == s && (n.after(k), "left" !== v && "right" !== v || k.append(n)), n.trigger("sticky_kit:stick")), w && r && (null == _ && (_ = c + m + T > p + d), !b && _))) return b = !0, "static" === C.css("position") && C.css({
                            position: "relative"
                        }), n.css({
                            position: "absolute",
                            bottom: h,
                            top: "auto"
                        }).trigger("sticky_kit:bottom")
                    }, A = function () {
                        return S(), N()
                    }, _ = function () {
                        if (y = !0, t.off("touchmove", N), t.off("scroll", N), t.off("resize", A), e(document.body).off("sticky_kit:recalc", A), n.off("sticky_kit:detach", _), n.removeData("sticky_kit"), n.css({
                                position: "",
                                bottom: "",
                                top: "",
                                width: ""
                            }), C.position("position", ""), w) return null == s && ("left" !== v && "right" !== v || n.insertAfter(k), k.remove()), n.removeClass(f)
                    }, t.on("touchmove", N), t.on("scroll", N), t.on("resize", A), e(document.body).on("sticky_kit:recalc", A), n.on("sticky_kit:detach", _), setTimeout(N, 0)
                }
            }, d = 0, p = this.length; d < p; d++) n = this[d], h(e(n));
        return this
    }
}.call(this),
    function (e, t) {
        "use strict";
        var n = "file:" === e.location.protocol,
            i = t.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1"),
            r = Array.prototype.forEach || function (e, t) {
                if (null == this || "function" != typeof e) throw new TypeError;
                var n, i = this.length >>> 0;
                for (n = 0; i > n; ++n) n in this && e.call(t, this[n], n, this)
            },
            o = {},
            s = 0,
            a = [],
            l = [],
            c = {},
            u = function (e) {
                return e.cloneNode(!0)
            },
            f = function (e, t) {
                l[e] = l[e] || [], l[e].push(t)
            },
            h = function (t, i) {
                if (void 0 !== o[t]) o[t] instanceof SVGSVGElement ? i(u(o[t])) : f(t, i);
                else {
                    if (!e.XMLHttpRequest) return i("Browser does not support XMLHttpRequest"), !1;
                    o[t] = {}, f(t, i);
                    var r = new XMLHttpRequest;
                    r.onreadystatechange = function () {
                        if (4 === r.readyState) {
                            if (404 === r.status || null === r.responseXML) return i("Unable to load SVG file: " + t), n && i("Note: SVG injection ajax calls do not work locally without adjusting security setting in your browser. Or consider using a local webserver."), i(), !1;
                            if (!(200 === r.status || n && 0 === r.status)) return i("There was a problem injecting the SVG: " + r.status + " " + r.statusText), !1;
                            if (r.responseXML instanceof Document) o[t] = r.responseXML.documentElement;
                            else if (DOMParser && DOMParser instanceof Function) {
                                var e;
                                try {
                                    e = (new DOMParser).parseFromString(r.responseText, "text/xml")
                                } catch (t) {
                                    e = void 0
                                }
                                if (!e || e.getElementsByTagName("parsererror").length) return i("Unable to parse SVG file: " + t), !1;
                                o[t] = e.documentElement
                            }! function (e) {
                                for (var t = 0, n = l[e].length; n > t; t++) ! function (t) {
                                    setTimeout(function () {
                                        l[e][t](u(o[e]))
                                    }, 0)
                                }(t)
                            }(t)
                        }
                    }, r.open("GET", t), r.overrideMimeType && r.overrideMimeType("text/xml"), r.send()
                }
            },
            d = function (t, n, o, l) {
                var u = t.getAttribute("data-src") || t.getAttribute("src");
                if (/\.svg/i.test(u))
                    if (i) - 1 === a.indexOf(t) && (a.push(t), t.setAttribute("src", ""), h(u, function (i) {
                        if (void 0 === i || "string" == typeof i) return l(i), !1;
                        var o = t.getAttribute("id");
                        o && i.setAttribute("id", o);
                        var f = t.getAttribute("title");
                        f && i.setAttribute("title", f);
                        var h = [].concat(i.getAttribute("class") || [], "injected-svg", t.getAttribute("class") || []).join(" ");
                        i.setAttribute("class", function (e) {
                            for (var t = {}, n = (e = e.split(" ")).length, i = []; n--;) t.hasOwnProperty(e[n]) || (t[e[n]] = 1, i.unshift(e[n]));
                            return i.join(" ")
                        }(h));
                        var d = t.getAttribute("style");
                        d && i.setAttribute("style", d);
                        var p = [].filter.call(t.attributes, function (e) {
                            return /^data-\w[\w\-]*$/.test(e.name)
                        });
                        r.call(p, function (e) {
                            e.name && e.value && i.setAttribute(e.name, e.value)
                        });
                        var g, m, v, y, b, _ = {
                            clipPath: ["clip-path"],
                            "color-profile": ["color-profile"],
                            cursor: ["cursor"],
                            filter: ["filter"],
                            linearGradient: ["fill", "stroke"],
                            marker: ["marker", "marker-start", "marker-mid", "marker-end"],
                            mask: ["mask"],
                            pattern: ["fill", "stroke"],
                            radialGradient: ["fill", "stroke"]
                        };
                        Object.keys(_).forEach(function (e) {
                            g = e, v = _[e];
                            for (var t = 0, n = (m = i.querySelectorAll("defs " + g + "[id]")).length; n > t; t++) {
                                var o;
                                y = m[t].id, b = y + "-" + s, r.call(v, function (e) {
                                    for (var t = 0, n = (o = i.querySelectorAll("[" + e + '*="' + y + '"]')).length; n > t; t++) o[t].setAttribute(e, "url(#" + b + ")")
                                }), m[t].id = b
                            }
                        }), i.removeAttribute("xmlns:a");
                        for (var w, E, x = i.querySelectorAll("script"), T = [], C = 0, S = x.length; S > C; C++)(E = x[C].getAttribute("type")) && "application/ecmascript" !== E && "application/javascript" !== E || (w = x[C].innerText || x[C].textContent, T.push(w), i.removeChild(x[C]));
                        if (T.length > 0 && ("always" === n || "once" === n && !c[u])) {
                            for (var A = 0, D = T.length; D > A; A++) new Function(T[A])(e);
                            c[u] = !0
                        }
                        var k = i.querySelectorAll("style");
                        r.call(k, function (e) {
                            e.textContent += ""
                        }), t.parentNode.replaceChild(i, t), delete a[a.indexOf(t)], t = null, s++, l(i)
                    }));
                    else {
                        var f = t.getAttribute("data-fallback") || t.getAttribute("data-png");
                        f ? (t.setAttribute("src", f), l(null)) : o ? (t.setAttribute("src", o + "/" + u.split("/").pop().replace(".svg", ".png")), l(null)) : l("This browser does not support SVG and no PNG fallback was defined.")
                    }
                else l("Attempted to inject a file with a non-svg extension: " + u)
            },
            p = function (e, t, n) {
                var i = (t = t || {}).evalScripts || "always",
                    o = t.pngFallback || !1,
                    s = t.each;
                if (void 0 !== e.length) {
                    var a = 0;
                    r.call(e, function (t) {
                        d(t, i, o, function (t) {
                            s && "function" == typeof s && s(t), n && e.length === ++a && n(a)
                        })
                    })
                } else e ? d(e, i, o, function (t) {
                    s && "function" == typeof s && s(t), n && n(1), e = null
                }) : n && n(0)
            };
        "object" == typeof module && "object" == typeof module.exports ? module.exports = exports = p : "function" == typeof define && define.amd ? define(function () {
            return p
        }) : "object" == typeof e && (e.SVGInjector = p)
    }(window, document),
    function (e, t) {
        "function" == typeof define && define.amd ? define(["jquery"], t) : t("undefined" != typeof exports ? require("jquery") : e.jQuery)
    }(this, function (e) {
        "use strict";

        function t(t) {
            if (i.webkit && !t) return {
                height: 0,
                width: 0
            };
            if (!i.data.outer) {
                var n = {
                    border: "none",
                    "box-sizing": "content-box",
                    height: "200px",
                    margin: "0",
                    padding: "0",
                    width: "200px"
                };
                i.data.inner = e("<div>").css(e.extend({}, n)), i.data.outer = e("<div>").css(e.extend({
                    left: "-1000px",
                    overflow: "scroll",
                    position: "absolute",
                    top: "-1000px"
                }, n)).append(i.data.inner).appendTo("body")
            }
            return i.data.outer.scrollLeft(1e3).scrollTop(1e3), {
                height: Math.ceil(i.data.outer.offset().top - i.data.inner.offset().top || 0),
                width: Math.ceil(i.data.outer.offset().left - i.data.inner.offset().left || 0)
            }
        }

        function n(e) {
            var t = e.originalEvent;
            return !(t.axis && t.axis === t.HORIZONTAL_AXIS || t.wheelDeltaX)
        }
        var i = {
            data: {
                index: 0,
                name: "scrollbar"
            },
            firefox: /firefox/i.test(navigator.userAgent),
            macosx: /mac/i.test(navigator.platform),
            msedge: /edge\/\d+/i.test(navigator.userAgent),
            msie: /(msie|trident)/i.test(navigator.userAgent),
            mobile: /android|webos|iphone|ipad|ipod|blackberry/i.test(navigator.userAgent),
            overlay: null,
            scroll: null,
            scrolls: [],
            webkit: /webkit/i.test(navigator.userAgent) && !/edge\/\d+/i.test(navigator.userAgent)
        };
        i.scrolls.add = function (e) {
            this.remove(e).push(e)
        }, i.scrolls.remove = function (t) {
            for (; e.inArray(t, this) >= 0;) this.splice(e.inArray(t, this), 1);
            return this
        };
        var r = {
                autoScrollSize: !0,
                autoUpdate: !0,
                debug: !1,
                disableBodyScroll: !1,
                duration: 200,
                ignoreMobile: !1,
                ignoreOverlay: !1,
                isRtl: !1,
                scrollStep: 30,
                showArrows: !1,
                stepScrolling: !0,
                scrollx: null,
                scrolly: null,
                onDestroy: null,
                onFallback: null,
                onInit: null,
                onScroll: null,
                onUpdate: null
            },
            o = function (n) {
                i.scroll || (i.overlay = function () {
                    var e = t(!0);
                    return !(e.height || e.width)
                }(), i.scroll = t(), a(), e(window).resize(function () {
                    var e = !1;
                    if (i.scroll && (i.scroll.height || i.scroll.width)) {
                        var n = t();
                        n.height === i.scroll.height && n.width === i.scroll.width || (i.scroll = n, e = !0)
                    }
                    a(e)
                })), this.container = n, this.namespace = ".scrollbar_" + i.data.index++, this.options = e.extend({}, r, window.jQueryScrollbarOptions || {}), this.scrollTo = null, this.scrollx = {}, this.scrolly = {}, n.data(i.data.name, this), i.scrolls.add(this)
            };
        o.prototype = {
            destroy: function () {
                if (this.wrapper) {
                    this.container.removeData(i.data.name), i.scrolls.remove(this);
                    var t = this.container.scrollLeft(),
                        n = this.container.scrollTop();
                    this.container.insertBefore(this.wrapper).css({
                        height: "",
                        margin: "",
                        "max-height": ""
                    }).removeClass("scroll-content scroll-scrollx_visible scroll-scrolly_visible").off(this.namespace).scrollLeft(t).scrollTop(n), this.scrollx.scroll.removeClass("scroll-scrollx_visible").find("div").addBack().off(this.namespace), this.scrolly.scroll.removeClass("scroll-scrolly_visible").find("div").addBack().off(this.namespace), this.wrapper.remove(), e(document).add("body").off(this.namespace), e.isFunction(this.options.onDestroy) && this.options.onDestroy.apply(this, [this.container])
                }
            },
            init: function (t) {
                var r = this,
                    o = this.container,
                    s = this.containerWrapper || o,
                    a = this.namespace,
                    l = e.extend(this.options, t || {}),
                    c = {
                        x: this.scrollx,
                        y: this.scrolly
                    },
                    u = this.wrapper,
                    f = {},
                    h = {
                        scrollLeft: o.scrollLeft(),
                        scrollTop: o.scrollTop()
                    };
                if (i.mobile && l.ignoreMobile || i.overlay && l.ignoreOverlay || i.macosx && !i.webkit) return e.isFunction(l.onFallback) && l.onFallback.apply(this, [o]), !1;
                if (u)(f = {
                    height: "auto",
                    "margin-bottom": -1 * i.scroll.height + "px",
                    "max-height": ""
                })[l.isRtl ? "margin-left" : "margin-right"] = -1 * i.scroll.width + "px", s.css(f);
                else {
                    if (this.wrapper = u = e("<div>").addClass("scroll-wrapper").addClass(o.attr("class")).css("position", "absolute" === o.css("position") ? "absolute" : "relative").insertBefore(o).append(o), l.isRtl && u.addClass("scroll--rtl"), o.is("textarea") && (this.containerWrapper = s = e("<div>").insertBefore(o).append(o), u.addClass("scroll-textarea")), (f = {
                            height: "auto",
                            "margin-bottom": -1 * i.scroll.height + "px",
                            "max-height": ""
                        })[l.isRtl ? "margin-left" : "margin-right"] = -1 * i.scroll.width + "px", s.addClass("scroll-content").css(f), o.on("scroll" + a, function (t) {
                            var n = o.scrollLeft(),
                                s = o.scrollTop();
                            if (l.isRtl) switch (!0) {
                                case i.firefox:
                                    n = Math.abs(n);
                                case i.msedge || i.msie:
                                    n = o[0].scrollWidth - o[0].clientWidth - n
                            }
                            e.isFunction(l.onScroll) && l.onScroll.call(r, {
                                maxScroll: c.y.maxScrollOffset,
                                scroll: s,
                                size: c.y.size,
                                visible: c.y.visible
                            }, {
                                maxScroll: c.x.maxScrollOffset,
                                scroll: n,
                                size: c.x.size,
                                visible: c.x.visible
                            }), c.x.isVisible && c.x.scroll.bar.css("left", n * c.x.kx + "px"), c.y.isVisible && c.y.scroll.bar.css("top", s * c.y.kx + "px")
                        }), u.on("scroll" + a, function () {
                            u.scrollTop(0).scrollLeft(0)
                        }), l.disableBodyScroll) {
                        var d = function (e) {
                            n(e) ? c.y.isVisible && c.y.mousewheel(e) : c.x.isVisible && c.x.mousewheel(e)
                        };
                        u.on("MozMousePixelScroll" + a, d), u.on("mousewheel" + a, d), i.mobile && u.on("touchstart" + a, function (t) {
                            var n = t.originalEvent.touches && t.originalEvent.touches[0] || t,
                                i = n.pageX,
                                r = n.pageY,
                                s = o.scrollLeft(),
                                l = o.scrollTop();
                            e(document).on("touchmove" + a, function (e) {
                                var t = e.originalEvent.targetTouches && e.originalEvent.targetTouches[0] || e;
                                o.scrollLeft(s + i - t.pageX), o.scrollTop(l + r - t.pageY), e.preventDefault()
                            }), e(document).on("touchend" + a, function () {
                                e(document).off(a)
                            })
                        })
                    }
                    e.isFunction(l.onInit) && l.onInit.apply(this, [o])
                }
                e.each(c, function (t, s) {
                    var u = null,
                        f = 1,
                        h = "x" === t ? "scrollLeft" : "scrollTop",
                        d = l.scrollStep,
                        p = function () {
                            var e = o[h]();
                            o[h](e + d), 1 == f && e + d >= g && (e = o[h]()), -1 == f && e + d <= g && (e = o[h]()), o[h]() == e && u && u()
                        },
                        g = 0;
                    s.scroll || (s.scroll = r._getScroll(l["scroll" + t]).addClass("scroll-" + t), l.showArrows && s.scroll.addClass("scroll-element_arrows_visible"), s.mousewheel = function (e) {
                        if (!s.isVisible || "x" === t && n(e)) return !0;
                        if ("y" === t && !n(e)) return c.x.mousewheel(e), !0;
                        var i = -1 * e.originalEvent.wheelDelta || e.originalEvent.detail,
                            a = s.size - s.visible - s.offset;
                        return i || ("x" === t && e.originalEvent.deltaX ? i = 40 * e.originalEvent.deltaX : "y" === t && e.originalEvent.deltaY && (i = 40 * e.originalEvent.deltaY)), (i > 0 && g < a || i < 0 && g > 0) && ((g += i) < 0 && (g = 0), g > a && (g = a), r.scrollTo = r.scrollTo || {}, r.scrollTo[h] = g, setTimeout(function () {
                            r.scrollTo && (o.stop().animate(r.scrollTo, 240, "linear", function () {
                                g = o[h]()
                            }), r.scrollTo = null)
                        }, 1)), e.preventDefault(), !1
                    }, s.scroll.on("MozMousePixelScroll" + a, s.mousewheel).on("mousewheel" + a, s.mousewheel).on("mouseenter" + a, function () {
                        g = o[h]()
                    }), s.scroll.find(".scroll-arrow, .scroll-element_track").on("mousedown" + a, function (n) {
                        if (1 != n.which) return !0;
                        f = 1;
                        var a = {
                                eventOffset: n["x" === t ? "pageX" : "pageY"],
                                maxScrollValue: s.size - s.visible - s.offset,
                                scrollbarOffset: s.scroll.bar.offset()["x" === t ? "left" : "top"],
                                scrollbarSize: s.scroll.bar["x" === t ? "outerWidth" : "outerHeight"]()
                            },
                            c = 0,
                            m = 0;
                        if (e(this).hasClass("scroll-arrow")) {
                            if (f = e(this).hasClass("scroll-arrow_more") ? 1 : -1, d = l.scrollStep * f, g = f > 0 ? a.maxScrollValue : 0, l.isRtl) switch (!0) {
                                case i.firefox:
                                    g = f > 0 ? 0 : -1 * a.maxScrollValue;
                                    break;
                                case i.msie || i.msedge:
                            }
                        } else f = a.eventOffset > a.scrollbarOffset + a.scrollbarSize ? 1 : a.eventOffset < a.scrollbarOffset ? -1 : 0, "x" === t && l.isRtl && (i.msie || i.msedge) && (f *= -1), d = Math.round(.75 * s.visible) * f, g = a.eventOffset - a.scrollbarOffset - (l.stepScrolling ? 1 == f ? a.scrollbarSize : 0 : Math.round(a.scrollbarSize / 2)), g = o[h]() + g / s.kx;
                        return r.scrollTo = r.scrollTo || {}, r.scrollTo[h] = l.stepScrolling ? o[h]() + d : g, l.stepScrolling && (u = function () {
                            g = o[h](), clearInterval(m), clearTimeout(c), c = 0, m = 0
                        }, c = setTimeout(function () {
                            m = setInterval(p, 40)
                        }, l.duration + 100)), setTimeout(function () {
                            r.scrollTo && (o.animate(r.scrollTo, l.duration), r.scrollTo = null)
                        }, 1), r._handleMouseDown(u, n)
                    }), s.scroll.bar.on("mousedown" + a, function (n) {
                        if (1 != n.which) return !0;
                        var c = n["x" === t ? "pageX" : "pageY"],
                            u = o[h]();
                        return s.scroll.addClass("scroll-draggable"), e(document).on("mousemove" + a, function (e) {
                            var n = parseInt((e["x" === t ? "pageX" : "pageY"] - c) / s.kx, 10);
                            "x" === t && l.isRtl && (i.msie || i.msedge) && (n *= -1), o[h](u + n)
                        }), r._handleMouseDown(function () {
                            s.scroll.removeClass("scroll-draggable"), g = o[h]()
                        }, n)
                    }))
                }), e.each(c, function (e, t) {
                    var n = "scroll-scroll" + e + "_visible",
                        i = "x" == e ? c.y : c.x;
                    t.scroll.removeClass(n), i.scroll.removeClass(n), s.removeClass(n)
                }), e.each(c, function (t, n) {
                    e.extend(n, "x" == t ? {
                        offset: parseInt(o.css("left"), 10) || 0,
                        size: o.prop("scrollWidth"),
                        visible: u.width()
                    } : {
                        offset: parseInt(o.css("top"), 10) || 0,
                        size: o.prop("scrollHeight"),
                        visible: u.height()
                    })
                }), this._updateScroll("x", this.scrollx), this._updateScroll("y", this.scrolly), e.isFunction(l.onUpdate) && l.onUpdate.apply(this, [o]), e.each(c, function (e, t) {
                    var n = "x" === e ? "left" : "top",
                        i = "x" === e ? "outerWidth" : "outerHeight",
                        r = "x" === e ? "width" : "height",
                        s = parseInt(o.css(n), 10) || 0,
                        a = t.size,
                        c = t.visible + s,
                        u = t.scroll.size[i]() + (parseInt(t.scroll.size.css(n), 10) || 0);
                    l.autoScrollSize && (t.scrollbarSize = parseInt(u * c / a, 10), t.scroll.bar.css(r, t.scrollbarSize + "px")), t.scrollbarSize = t.scroll.bar[i](), t.kx = (u - t.scrollbarSize) / (a - c) || 1, t.maxScrollOffset = a - c
                }), o.scrollLeft(h.scrollLeft).scrollTop(h.scrollTop).trigger("scroll")
            },
            _getScroll: function (t) {
                var n = {
                    advanced: ['<div class="scroll-element">', '<div class="scroll-element_corner"></div>', '<div class="scroll-arrow scroll-arrow_less"></div>', '<div class="scroll-arrow scroll-arrow_more"></div>', '<div class="scroll-element_outer">', '<div class="scroll-element_size"></div>', '<div class="scroll-element_inner-wrapper">', '<div class="scroll-element_inner scroll-element_track">', '<div class="scroll-element_inner-bottom"></div>', "</div>", "</div>", '<div class="scroll-bar">', '<div class="scroll-bar_body">', '<div class="scroll-bar_body-inner"></div>', "</div>", '<div class="scroll-bar_bottom"></div>', '<div class="scroll-bar_center"></div>', "</div>", "</div>", "</div>"].join(""),
                    simple: ['<div class="scroll-element">', '<div class="scroll-element_outer">', '<div class="scroll-element_size"></div>', '<div class="scroll-element_track"></div>', '<div class="scroll-bar"></div>', "</div>", "</div>"].join("")
                };
                return n[t] && (t = n[t]), t || (t = n.simple), t = "string" == typeof t ? e(t).appendTo(this.wrapper) : e(t), e.extend(t, {
                    bar: t.find(".scroll-bar"),
                    size: t.find(".scroll-element_size"),
                    track: t.find(".scroll-element_track")
                }), t
            },
            _handleMouseDown: function (t, n) {
                var i = this.namespace;
                return e(document).on("blur" + i, function () {
                    e(document).add("body").off(i), t && t()
                }), e(document).on("dragstart" + i, function (e) {
                    return e.preventDefault(), !1
                }), e(document).on("mouseup" + i, function () {
                    e(document).add("body").off(i), t && t()
                }), e("body").on("selectstart" + i, function (e) {
                    return e.preventDefault(), !1
                }), n && n.preventDefault(), !1
            },
            _updateScroll: function (t, n) {
                var r = this.container,
                    o = this.containerWrapper || r,
                    s = "scroll-scroll" + t + "_visible",
                    a = "x" === t ? this.scrolly : this.scrollx,
                    l = parseInt(this.container.css("x" === t ? "left" : "top"), 10) || 0,
                    c = this.wrapper,
                    u = n.size,
                    f = n.visible + l;
                n.isVisible = u - f > 1, n.isVisible ? (n.scroll.addClass(s), a.scroll.addClass(s), o.addClass(s)) : (n.scroll.removeClass(s), a.scroll.removeClass(s), o.removeClass(s)), "y" === t && (r.is("textarea") || u < f ? o.css({
                    height: f + i.scroll.height + "px",
                    "max-height": "none"
                }) : o.css({
                    "max-height": f + i.scroll.height + "px"
                })), n.size == r.prop("scrollWidth") && a.size == r.prop("scrollHeight") && n.visible == c.width() && a.visible == c.height() && n.offset == (parseInt(r.css("left"), 10) || 0) && a.offset == (parseInt(r.css("top"), 10) || 0) || (e.extend(this.scrollx, {
                    offset: parseInt(r.css("left"), 10) || 0,
                    size: r.prop("scrollWidth"),
                    visible: c.width()
                }), e.extend(this.scrolly, {
                    offset: parseInt(r.css("top"), 10) || 0,
                    size: this.container.prop("scrollHeight"),
                    visible: c.height()
                }), this._updateScroll("x" === t ? "y" : "x", a))
            }
        };
        var s = o;
        e.fn.scrollbar = function (t, n) {
            return "string" != typeof t && (n = t, t = "init"), void 0 === n && (n = []), e.isArray(n) || (n = [n]), this.not("body, .scroll-wrapper").each(function () {
                var r = e(this),
                    o = r.data(i.data.name);
                (o || "init" === t) && (o || (o = new s(r)), o[t] && o[t].apply(o, n))
            }), this
        }, e.fn.scrollbar.options = r;
        var a = function () {
            var e = 0;
            return function (t) {
                var n, r, o, s, l, c, u;
                for (n = 0; n < i.scrolls.length; n++) r = (s = i.scrolls[n]).container, o = s.options, l = s.wrapper, c = s.scrollx, u = s.scrolly, (t || o.autoUpdate && l && l.is(":visible") && (r.prop("scrollWidth") != c.size || r.prop("scrollHeight") != u.size || l.width() != c.visible || l.height() != u.visible)) && (s.init(), o.debug && (window.console && console.log({
                    scrollHeight: r.prop("scrollHeight") + ":" + s.scrolly.size,
                    scrollWidth: r.prop("scrollWidth") + ":" + s.scrollx.size,
                    visibleHeight: l.height() + ":" + s.scrolly.visible,
                    visibleWidth: l.width() + ":" + s.scrollx.visible
                }, !0), 0));
                clearTimeout(e), e = setTimeout(a, 300)
            }
        }();
        window.angular && function (e) {
            e.module("jQueryScrollbar", []).provider("jQueryScrollbar", function () {
                var t = r;
                return {
                    setOptions: function (n) {
                        e.extend(t, n)
                    },
                    $get: function () {
                        return {
                            options: e.copy(t)
                        }
                    }
                }
            }).directive("jqueryScrollbar", ["jQueryScrollbar", "$parse", function (e, t) {
                return {
                    restrict: "AC",
                    link: function (n, i, r) {
                        var o = t(r.jqueryScrollbar)(n);
                        i.scrollbar(o || e.options).on("$destroy", function () {
                            i.scrollbar("destroy")
                        })
                    }
                }
            }])
        }(window.angular)
    }),
    function (e) {
        "function" == typeof define && define.amd ? define(["jquery"], e) : e(jQuery)
    }(function (e) {
        "use strict";
        var t, n = 32,
            i = 33,
            r = 34,
            o = 35,
            s = 36,
            a = 38,
            l = 40,
            c = function (t, n) {
                var i, r, o = n.scrollTop(),
                    s = n.prop("scrollHeight"),
                    a = n.prop("clientHeight"),
                    l = t.originalEvent.wheelDelta || -1 * t.originalEvent.detail || -1 * t.originalEvent.deltaY,
                    c = 0;
                return "wheel" === t.type ? (i = n.height() / e(window).height(), c = t.originalEvent.deltaY * i) : this.options.touch && "touchmove" === t.type && (l = t.originalEvent.changedTouches[0].clientY - this.startClientY), {
                    prevent: (r = l > 0 && o + c <= 0) || l < 0 && o + c >= s - a,
                    top: r,
                    scrollTop: o,
                    deltaY: c
                }
            },
            u = function (e, t) {
                var c, u, f = t.scrollTop(),
                    h = {
                        top: !1,
                        bottom: !1
                    };
                return h.top = 0 === f && (e.keyCode === i || e.keyCode === s || e.keyCode === a), h.top || (c = t.prop("scrollHeight"), u = t.prop("clientHeight"), h.bottom = c === f + u && (e.keyCode === n || e.keyCode === r || e.keyCode === o || e.keyCode === l)), h
            },
            f = function (t, n) {
                this.$element = t, this.options = e.extend({}, f.DEFAULTS, this.$element.data(), n), this.enabled = !0, this.startClientY = 0, this.options.unblock && this.$element.on(f.CORE.wheelEventName + f.NAMESPACE, this.options.unblock, e.proxy(f.CORE.unblockHandler, this)), this.$element.on(f.CORE.wheelEventName + f.NAMESPACE, this.options.selector, e.proxy(f.CORE.handler, this)), this.options.touch && (this.$element.on("touchstart" + f.NAMESPACE, this.options.selector, e.proxy(f.CORE.touchHandler, this)), this.$element.on("touchmove" + f.NAMESPACE, this.options.selector, e.proxy(f.CORE.handler, this)), this.options.unblock && this.$element.on("touchmove" + f.NAMESPACE, this.options.unblock, e.proxy(f.CORE.unblockHandler, this))), this.options.keyboard && (this.$element.attr("tabindex", this.options.keyboard.tabindex || 0), this.$element.on("keydown" + f.NAMESPACE, this.options.selector, e.proxy(f.CORE.keyboardHandler, this)), this.options.unblock && this.$element.on("keydown" + f.NAMESPACE, this.options.unblock, e.proxy(f.CORE.unblockHandler, this)))
            };
        f.NAME = "ScrollLock", f.VERSION = "3.1.2", f.NAMESPACE = ".scrollLock", f.ANIMATION_NAMESPACE = f.NAMESPACE + ".effect", f.DEFAULTS = {
            strict: !1,
            strictFn: function (e) {
                return e.prop("scrollHeight") > e.prop("clientHeight")
            },
            selector: !1,
            animation: !1,
            touch: "ontouchstart" in window,
            keyboard: !1,
            unblock: !1
        }, f.CORE = {
            wheelEventName: "onwheel" in document.createElement("div") ? "wheel" : void 0 !== document.onmousewheel ? "mousewheel" : "DOMMouseScroll",
            animationEventName: ["webkitAnimationEnd", "mozAnimationEnd", "MSAnimationEnd", "oanimationend", "animationend"].join(f.ANIMATION_NAMESPACE + " ") + f.ANIMATION_NAMESPACE,
            unblockHandler: function (e) {
                e.__currentTarget = e.currentTarget
            },
            handler: function (t) {
                var n, i, r;
                this.enabled && !t.ctrlKey && (n = e(t.currentTarget), (!0 !== this.options.strict || this.options.strictFn(n)) && (t.stopPropagation(), i = e.proxy(c, this)(t, n), t.__currentTarget && (i.prevent &= e.proxy(c, this)(t, e(t.__currentTarget)).prevent), i.prevent && (t.preventDefault(), i.deltaY && n.scrollTop(i.scrollTop + i.deltaY), r = i.top ? "top" : "bottom", this.options.animation && setTimeout(f.CORE.animationHandler.bind(this, n, r), 0), n.trigger(e.Event(r + f.NAMESPACE)))))
            },
            touchHandler: function (e) {
                this.startClientY = e.originalEvent.touches[0].clientY
            },
            animationHandler: function (e, t) {
                var n = this.options.animation[t],
                    i = this.options.animation.top + " " + this.options.animation.bottom;
                e.off(f.ANIMATION_NAMESPACE).removeClass(i).addClass(n).one(f.CORE.animationEventName, function () {
                    e.removeClass(n)
                })
            },
            keyboardHandler: function (t) {
                var n, i = e(t.currentTarget),
                    r = (i.scrollTop(), u(t, i));
                return t.__currentTarget && (n = u(t, e(t.__currentTarget)), r.top &= n.top, r.bottom &= n.bottom), r.top ? (i.trigger(e.Event("top" + f.NAMESPACE)), this.options.animation && setTimeout(f.CORE.animationHandler.bind(this, i, "top"), 0), !1) : r.bottom ? (i.trigger(e.Event("bottom" + f.NAMESPACE)), this.options.animation && setTimeout(f.CORE.animationHandler.bind(this, i, "bottom"), 0), !1) : void 0
            }
        }, f.prototype.toggleStrict = function () {
            this.options.strict = !this.options.strict
        }, f.prototype.enable = function () {
            this.enabled = !0
        }, f.prototype.disable = function () {
            this.enabled = !1
        }, f.prototype.destroy = function () {
            this.disable(), this.$element.off(f.NAMESPACE), this.$element = null, this.options = null
        }, t = e.fn.scrollLock, e.fn.scrollLock = function (t) {
            return this.each(function () {
                var n = e(this),
                    i = "object" == typeof t && t,
                    r = n.data(f.NAME);
                (r || "destroy" !== t) && (r || n.data(f.NAME, r = new f(n, i)), "string" == typeof t && r[t]())
            })
        }, e.fn.scrollLock.defaults = f.DEFAULTS, e.fn.scrollLock.noConflict = function () {
            return e.fn.scrollLock = t, this
        }
    }),
    function (e, t) {
        "function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", t) : "object" == typeof module && module.exports ? module.exports = t() : e.EvEmitter = t()
    }("undefined" != typeof window ? window : this, function () {
        function e() {}
        var t = e.prototype;
        return t.on = function (e, t) {
            if (e && t) {
                var n = this._events = this._events || {},
                    i = n[e] = n[e] || [];
                return -1 == i.indexOf(t) && i.push(t), this
            }
        }, t.once = function (e, t) {
            if (e && t) {
                this.on(e, t);
                var n = this._onceEvents = this._onceEvents || {};
                return (n[e] = n[e] || {})[t] = !0, this
            }
        }, t.off = function (e, t) {
            var n = this._events && this._events[e];
            if (n && n.length) {
                var i = n.indexOf(t);
                return -1 != i && n.splice(i, 1), this
            }
        }, t.emitEvent = function (e, t) {
            var n = this._events && this._events[e];
            if (n && n.length) {
                n = n.slice(0), t = t || [];
                for (var i = this._onceEvents && this._onceEvents[e], r = 0; r < n.length; r++) {
                    var o = n[r];
                    i && i[o] && (this.off(e, o), delete i[o]), o.apply(this, t)
                }
                return this
            }
        }, t.allOff = function () {
            delete this._events, delete this._onceEvents
        }, e
    }),
    function (e, t) {
        "use strict";
        "function" == typeof define && define.amd ? define(["ev-emitter/ev-emitter"], function (n) {
            return t(e, n)
        }) : "object" == typeof module && module.exports ? module.exports = t(e, require("ev-emitter")) : e.imagesLoaded = t(e, e.EvEmitter)
    }("undefined" != typeof window ? window : this, function (e, t) {
        function n(e, t) {
            for (var n in t) e[n] = t[n];
            return e
        }

        function i(e, t, r) {
            if (!(this instanceof i)) return new i(e, t, r);
            var o = e;
            return "string" == typeof e && (o = document.querySelectorAll(e)), o ? (this.elements = function (e) {
                return Array.isArray(e) ? e : "object" == typeof e && "number" == typeof e.length ? l.call(e) : [e]
            }(o), this.options = n({}, this.options), "function" == typeof t ? r = t : n(this.options, t), r && this.on("always", r), this.getImages(), s && (this.jqDeferred = new s.Deferred), void setTimeout(this.check.bind(this))) : void a.error("Bad element for imagesLoaded " + (o || e))
        }

        function r(e) {
            this.img = e
        }

        function o(e, t) {
            this.url = e, this.element = t, this.img = new Image
        }
        var s = e.jQuery,
            a = e.console,
            l = Array.prototype.slice;
        i.prototype = Object.create(t.prototype), i.prototype.options = {}, i.prototype.getImages = function () {
            this.images = [], this.elements.forEach(this.addElementImages, this)
        }, i.prototype.addElementImages = function (e) {
            "IMG" == e.nodeName && this.addImage(e), !0 === this.options.background && this.addElementBackgroundImages(e);
            var t = e.nodeType;
            if (t && c[t]) {
                for (var n = e.querySelectorAll("img"), i = 0; i < n.length; i++) {
                    var r = n[i];
                    this.addImage(r)
                }
                if ("string" == typeof this.options.background) {
                    var o = e.querySelectorAll(this.options.background);
                    for (i = 0; i < o.length; i++) {
                        var s = o[i];
                        this.addElementBackgroundImages(s)
                    }
                }
            }
        };
        var c = {
            1: !0,
            9: !0,
            11: !0
        };
        return i.prototype.addElementBackgroundImages = function (e) {
            var t = getComputedStyle(e);
            if (t)
                for (var n = /url\((['"])?(.*?)\1\)/gi, i = n.exec(t.backgroundImage); null !== i;) {
                    var r = i && i[2];
                    r && this.addBackground(r, e), i = n.exec(t.backgroundImage)
                }
        }, i.prototype.addImage = function (e) {
            var t = new r(e);
            this.images.push(t)
        }, i.prototype.addBackground = function (e, t) {
            var n = new o(e, t);
            this.images.push(n)
        }, i.prototype.check = function () {
            function e(e, n, i) {
                setTimeout(function () {
                    t.progress(e, n, i)
                })
            }
            var t = this;
            return this.progressedCount = 0, this.hasAnyBroken = !1, this.images.length ? void this.images.forEach(function (t) {
                t.once("progress", e), t.check()
            }) : void this.complete()
        }, i.prototype.progress = function (e, t, n) {
            this.progressedCount++, this.hasAnyBroken = this.hasAnyBroken || !e.isLoaded, this.emitEvent("progress", [this, e, t]), this.jqDeferred && this.jqDeferred.notify && this.jqDeferred.notify(this, e), this.progressedCount == this.images.length && this.complete(), this.options.debug && a && a.log("progress: " + n, e, t)
        }, i.prototype.complete = function () {
            var e = this.hasAnyBroken ? "fail" : "done";
            if (this.isComplete = !0, this.emitEvent(e, [this]), this.emitEvent("always", [this]), this.jqDeferred) {
                var t = this.hasAnyBroken ? "reject" : "resolve";
                this.jqDeferred[t](this)
            }
        }, r.prototype = Object.create(t.prototype), r.prototype.check = function () {
            return this.getIsImageComplete() ? void this.confirm(0 !== this.img.naturalWidth, "naturalWidth") : (this.proxyImage = new Image, this.proxyImage.addEventListener("load", this), this.proxyImage.addEventListener("error", this), this.img.addEventListener("load", this), this.img.addEventListener("error", this), void(this.proxyImage.src = this.img.src))
        }, r.prototype.getIsImageComplete = function () {
            return this.img.complete && this.img.naturalWidth
        }, r.prototype.confirm = function (e, t) {
            this.isLoaded = e, this.emitEvent("progress", [this, this.img, t])
        }, r.prototype.handleEvent = function (e) {
            var t = "on" + e.type;
            this[t] && this[t](e)
        }, r.prototype.onload = function () {
            this.confirm(!0, "onload"), this.unbindEvents()
        }, r.prototype.onerror = function () {
            this.confirm(!1, "onerror"), this.unbindEvents()
        }, r.prototype.unbindEvents = function () {
            this.proxyImage.removeEventListener("load", this), this.proxyImage.removeEventListener("error", this), this.img.removeEventListener("load", this), this.img.removeEventListener("error", this)
        }, o.prototype = Object.create(r.prototype), o.prototype.check = function () {
            this.img.addEventListener("load", this), this.img.addEventListener("error", this), this.img.src = this.url, this.getIsImageComplete() && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents())
        }, o.prototype.unbindEvents = function () {
            this.img.removeEventListener("load", this), this.img.removeEventListener("error", this)
        }, o.prototype.confirm = function (e, t) {
            this.isLoaded = e, this.emitEvent("progress", [this, this.element, t])
        }, i.makeJQueryPlugin = function (t) {
            (t = t || e.jQuery) && ((s = t).fn.imagesLoaded = function (e, t) {
                return new i(this, e, t).jqDeferred.promise(s(this))
            })
        }, i.makeJQueryPlugin(), i
    });



    
    