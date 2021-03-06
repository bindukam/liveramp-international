var json_file = '/wp-content/themes/liveRamp-Template/standalone-pages/identity-resolution-use-cases-assets/config.json'

! function(e) { var t = function(i) { if (!(this instanceof t)) return new t(i); var s = this;
    s.object = {}, s.options = i, s.settings = {}; var n = { classes: { active_filters: "active-filters", random_button: "btn-surprise", case_study: "case-study", filter_active: "filter-active", filter_group: "filter-group", filter_heading: "filter-heading", filter_option: "filter", filter_options: "filter-options", filters_open: "filters-open", grid_item: "grid-item", grid_item_card: "grid-item-card", grid_item_link: "grid-item-link", open_case_study: "fixed", visible_case_study: "visible" }, elements: { body: "body" }, ids: { grid_container: "grid-container", main: "content-browser" } };
    s.object.selectors = n, s.settings.transition = "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend"; var o = function(e) { var t = s.options;
        t && t[e] && s.options[e]() },
      r = function() { var t = s.object.selectors,
          i = t.classes,
          n = t.elements,
          o = t.ids,
          r = { $body: e(n.body), $case_study: e("." + i.case_study), $filter_group: e("." + i.filter_group), $filter_heading: e("." + i.filter_heading), $filter_option: e("." + i.filter_option), $filter_options: e("." + i.filter_options), $grid_container: e("#" + o.grid_container), $grid_item: e("." + i.grid_item), $grid_item_link: e("." + i.grid_item_link), $main: e("#" + o.main), $random_button: e("." + i.random_button) };
        s.object.elems = r },
      a = function(t) { e('input[name="' + t + '[]"]').each(function() { e(this).prop("checked", !1) }), s.update_grid() },
      c = function() { var t = window.location.href;
        page_url = t.substring(0, t.lastIndexOf("/")), e.ajax({ url: json_file, dataType: "application/json", async: !1, complete: function(e) { s.config = JSON.parse(e.responseText) } }); console.log(page_url); },
      l = function() { return s.settings.hash },
      d = function() { r(), c(), p(), m(), f(); var t = s.object.elems,
          i = s.settings.transition;
        s.settings.url = window.location.href.replace(window.location.hash, "").replace("#", ""), s.settings.hash = window.location.hash.substr(2), l() && s.view_case_study(), t.$body.removeClass("loading"), e(".dot.last").on(i, function(s) { e(".dot.last").off(i), t.$body.addClass("cb-loaded"), e("#preloader").on(i, function(s) { "preloader" === s.target.id && (e("#preloader").off(i), t.$body.addClass("cb-ready").removeClass("cb-loaded")) }) }), o("on_ready", s) },
      f = function() { var t = s.config.cases,
          i = s.object.elems;
        i.$filter_heading.click(function() { var t = e(this).data("filter-type");
          y(t) }), i.$filter_option.click(function() { s.update_grid() }), i.$grid_item.click(function(t) { t.preventDefault(); var i = e(this).data("case-url");
          v(i), s.view_case_study() }), i.$random_button.click(function(e) { e.preventDefault(); var i = t[Math.floor(Math.random() * t.length)].url;
          v(i), s.view_case_study() }), e(".clear-filters").click(function(t) { t.preventDefault(); var i = e(this).data("filter-group");
          a(i) }), e(".close-case-study").click(function(e) { e.preventDefault(), v(), s.view_case_study() }), e(".filter-group-heading .label").click(function() { e(this).closest(".filter-group-heading").toggleClass("filters-open") }) },
      u = function(t) { var i = t; return i.map(function() { return e(this).val() }).get() },
      _ = function() { var t = s.config.cases,
          i = s.object.selectors.classes,
          n = s.object.elems,
          o = s.settings.filters,
          r = []; if (n.$grid_item.removeClass(i.filter_active), n.$grid_container.removeClass(i.active_filters), !e.isEmptyObject(o)) { for (var a = 0; a < t.length; a++) { var c = t[a],
              l = !0; for (var d in o)
              for (var f = c[d], u = o[d], _ = 0; _ < u.length; _++) { var g = u[_];
                l === !0 && (e.inArray(g, f) !== -1 ? e.inArray(c.id, r) === -1 && r.push(c.id) : (e.inArray(c.id, r) !== -1 && r.splice(e.inArray(c.id, r), 1), l = !1)) } n.$grid_container.addClass(i.active_filters) } if (r.length)
            for (var p = 0; p < r.length; p++) e('.grid-item[data-case-id="' + r[p] + '"]').addClass(i.filter_active) } s.settings.active_cases = r, h() },
      g = function() { var t = s.object.selectors.classes,
          i = s.object.elems,
          n = s.config.filters;
        s.settings.filters = {}, e(i.$filter_group).removeClass(t.active_filters); for (var o in n) { var r = e('input:checked[name="' + o + '[]"]'),
            a = u(r);
          a.length && (r.closest(i.$filter_group).addClass(t.active_filters), s.settings.filters[o] = a) } },
      p = function() { var e = s.config.cases;
        s.settings.case_order = [], s.settings.case_position = []; for (var t in e) s.settings.case_order.push(s.config.cases[t].id), s.settings.case_position.push(s.config.cases[t].id) },
      m = function() { var t = s.object.elems,
          i = Math.round(t.$grid_container.outerWidth()),
          n = Math.round(t.$grid_item.outerWidth() / i * 100),
          o = Math.round(100 / n),
          r = Math.ceil(13 / o),
          a = parseFloat(100 / Math.ceil(13 / o)).toFixed(2),
          c = Math.round(t.$grid_item.outerHeight() * r),
          l = Math.round(t.$grid_item.outerHeight() / c * 100);
        t.$grid_container.css("height", c + "px"), t.$grid_item.each(function() { var t = e(this),
            i = t.data("case-id"),
            r = s.settings.case_order.indexOf(i);
          elem_index_position = s.settings.case_position.indexOf(i); var c = elem_index_position % o * n,
            d = Math.floor(elem_index_position / o) * l,
            f = Math.floor(elem_index_position / o) * a,
            u = (r % o * n - c) / n * 100,
            _ = (Math.floor(r / o) * l - d) / l * 100;
          t.css({ left: c + "%", position: "absolute", top: f + "%", transform: "translateX(" + u + "%) translateY(" + _ + "%)", "transition-delay": 50 * r + "ms, 0ms" }), t.children().css("transition-delay", 450 + 50 * r + "ms") }) },
      h = function() { var e = s.settings.active_cases,
          t = s.settings.case_order.slice(),
          i = []; if (s.settings.case_order = [], e.length) { for (var n = 0; n < e.length; n++) i.push(e[n]), t.splice(t.indexOf(e[n]), 1);
          i = i.concat(t), s.settings.case_order = i } else s.settings.case_order = s.settings.case_position },
      v = function(e) { var t;
        s.settings.hash = e || "", t = e ? s.settings.url + "#/" + s.settings.hash : s.settings.url, "function" == typeof window.history.pushState ? window.history.pushState(null, null, t) : window.location = t },
      y = function(t) { var i = s.object.selectors.classes;
        filter_options = s.object.elems.$filter_options; for (var n = t, o = 0; o < filter_options.length; o++) e(filter_options[o]).data("filter-type") === n && e(filter_options[o]).toggleClass(i.filters_open) };
    s.on_ready = function() {}, s.update_grid = function() { g(), _(), m() }, s.view_case_study = function() { var t = s.object.selectors.classes,
        i = s.object.elems,
        n = l(),
        o = "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend";
      n ? i.$case_study.each(function() { e(this).attr("id") === n && (e(this).addClass(t.visible_case_study), i.$body.addClass(t.open_case_study)) }) : (i.$body.removeClass(t.open_case_study), e("#content").on(o, function(s) { e("#content").off(o), i.$case_study.removeClass(t.visible_case_study) })) }, d(), window.ContentBrowser = t, e(window).resize(function() { clearTimeout(window.resize_complete), window.resize_complete = setTimeout(function() { s.update_grid() }, 1e3) }) };
  e(window).on("load", function() { casestudies = new t }) }(jQuery),
function(e) { "undefined" != typeof MktoForms2 && (MktoForms2.loadForm("//app-sj25.marketo.com", "320-CHP-056", 1883, function(t) { t.onSuccess(function() { e(".mkto-form").hide(), t.getFormElem().hide(), e(".form-success").show(); var i = e("<form>", { action: "https://lp.liveramp.com/rs/320-CHP-056/images/13-sweet-id-resolution-use-cases.pdf", target: "_blank" }).append("body");
      i.submit() }) }), e(".form-toggle").click(function() { e("#marketo-form").toggleClass("hidden") })) }(jQuery);
