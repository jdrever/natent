(function() {
  "use strict";
  const Heading_vue_vue_type_style_index_0_lang = "";
  function normalizeComponent(scriptExports, render, staticRenderFns, functionalTemplate, injectStyles, scopeId, moduleIdentifier, shadowMode) {
    var options = typeof scriptExports === "function" ? scriptExports.options : scriptExports;
    if (render) {
      options.render = render;
      options.staticRenderFns = staticRenderFns;
      options._compiled = true;
    }
    if (functionalTemplate) {
      options.functional = true;
    }
    if (scopeId) {
      options._scopeId = "data-v-" + scopeId;
    }
    var hook;
    if (moduleIdentifier) {
      hook = function(context) {
        context = context || this.$vnode && this.$vnode.ssrContext || this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext;
        if (!context && typeof __VUE_SSR_CONTEXT__ !== "undefined") {
          context = __VUE_SSR_CONTEXT__;
        }
        if (injectStyles) {
          injectStyles.call(this, context);
        }
        if (context && context._registeredComponents) {
          context._registeredComponents.add(moduleIdentifier);
        }
      };
      options._ssrRegister = hook;
    } else if (injectStyles) {
      hook = shadowMode ? function() {
        injectStyles.call(
          this,
          (options.functional ? this.parent : this).$root.$options.shadowRoot
        );
      } : injectStyles;
    }
    if (hook) {
      if (options.functional) {
        options._injectStyles = hook;
        var originalRender = options.render;
        options.render = function renderWithStyleInjection(h, context) {
          hook.call(context);
          return originalRender(h, context);
        };
      } else {
        var existing = options.beforeCreate;
        options.beforeCreate = existing ? [].concat(existing, hook) : [hook];
      }
    }
    return {
      exports: scriptExports,
      options
    };
  }
  const _sfc_main$2 = {
    computed: {
      textField() {
        return this.field("text", {
          marks: true
        });
      }
    },
    methods: {
      focus() {
        this.$refs.input.focus();
      }
    }
  };
  var _sfc_render$2 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "k-block-type-heading-input", attrs: { "data-level": _vm.content.level } }, [_c("k-writer", { ref: "input", attrs: { "inline": true, "marks": _vm.textField.marks, "placeholder": _vm.textField.placeholder, "value": _vm.content.text }, on: { "input": function($event) {
      return _vm.update({ text: $event });
    } } })], 1);
  };
  var _sfc_staticRenderFns$2 = [];
  _sfc_render$2._withStripped = true;
  var __component__$2 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$2,
    _sfc_render$2,
    _sfc_staticRenderFns$2,
    false,
    null,
    null,
    null,
    null
  );
  __component__$2.options.__file = "C:/Users/tomdr/natent/src/site/plugins/careful-guides/src/components/Heading.vue";
  const Heading = __component__$2.exports;
  const Activity_vue_vue_type_style_index_0_lang = "";
  const _sfc_main$1 = {};
  var _sfc_render$1 = function render() {
    var _vm = this, _c = _vm._self._c;
    _vm._self._setupProxy;
    return _c("div", { staticClass: "container-fluid rounded m-1 p-2 bg-light" }, [_vm.content.activitytitle ? _c("div", [_c("h2", { staticClass: "text-dark display-6" }, [_c("i", { staticClass: "bi bi-heart-pulse" }), _vm._v("\xA0ACTIVITY:\xA0" + _vm._s(_vm.content.activitytitle))])]) : _vm._e(), _vm.content.activitycontent ? _c("div", [_vm._v(" " + _vm._s(_vm.content.activitycontent) + " ")]) : _vm._e()]);
  };
  var _sfc_staticRenderFns$1 = [];
  _sfc_render$1._withStripped = true;
  var __component__$1 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$1,
    _sfc_render$1,
    _sfc_staticRenderFns$1,
    false,
    null,
    null,
    null,
    null
  );
  __component__$1.options.__file = "C:/Users/tomdr/natent/src/site/plugins/careful-guides/src/components/Activity.vue";
  const Activity = __component__$1.exports;
  const File_vue_vue_type_style_index_0_lang = "";
  const _sfc_main = {
    computed: {
      file() {
        return this.content.file[0] || {};
      },
      label() {
        return this.content.label || "";
      }
    }
  };
  var _sfc_render = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("k-block-figure", { attrs: { "is-empty": !_vm.file.url, "empty-icon": "file", "empty-text": "No file selected yet \u2026" }, on: { "open": _vm.open, "update": _vm.update } }, [_c("div", { staticClass: "k-block-type-file-wrapper" }, [_c("p", [_vm._v("File: " + _vm._s(_vm.file.filename))]), _c("p", [_vm._v("Label: " + _vm._s(_vm.label))])])]);
  };
  var _sfc_staticRenderFns = [];
  _sfc_render._withStripped = true;
  var __component__ = /* @__PURE__ */ normalizeComponent(
    _sfc_main,
    _sfc_render,
    _sfc_staticRenderFns,
    false,
    null,
    null,
    null,
    null
  );
  __component__.options.__file = "C:/Users/tomdr/natent/src/site/plugins/careful-guides/src/components/File.vue";
  const File = __component__.exports;
  panel.plugin("careful-digital/guides", {
    blocks: {
      activity: Activity,
      heading: Heading,
      file: File
    }
  });
})();
