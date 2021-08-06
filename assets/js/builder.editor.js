/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./jet-form-builder-action.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./jet-form-builder-action.js":
/*!************************************!*\
  !*** ./jet-form-builder-action.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var addFilter = wp.hooks.addFilter;
var __ = wp.i18n.__;
var _wp$components = wp.components,
    SelectControl = _wp$components.SelectControl,
    BaseControl = _wp$components.BaseControl;
var _wp$element = wp.element,
    useState = _wp$element.useState,
    useEffect = _wp$element.useEffect;
var _JetFBActions = JetFBActions,
    withPlaceholder = _JetFBActions.Tools.withPlaceholder,
    addAction = _JetFBActions.addAction;
addAction('popup_after_submit', function ShowPopupAction(props) {
  var settings = props.settings,
      onChangeSetting = props.onChangeSetting,
      source = props.source,
      label = props.label;

  var _useState = useState([]),
      _useState2 = _slicedToArray(_useState, 2),
      popups = _useState2[0],
      setPopups = _useState2[1];

  var _useState3 = useState(false),
      _useState4 = _slicedToArray(_useState3, 2),
      isLoading = _useState4[0],
      setLoading = _useState4[1];

  var fetchTypeFields = function fetchTypeFields(provider) {
    if (!provider) {
      return;
    }

    setLoading(true);
    jQuery.ajax({
      url: ajaxurl,
      type: 'GET',
      dataType: 'json',
      data: {
        action: source.ajax_action,
        provider: provider
      }
    }).done(function (response) {
      if (response.success && response.data.popups) {
        setPopups(withPlaceholder(response.data.popups));
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }).always(function () {
      setLoading(false);
    });
  };

  useEffect(function () {
    fetchTypeFields(settings.provider);
  }, []);
  return wp.element.createElement(React.Fragment, null, wp.element.createElement(SelectControl, {
    label: label('provider'),
    value: settings.provider,
    onChange: function onChange(newValue) {
      onChangeSetting(newValue, 'provider');
      fetchTypeFields(newValue);
    },
    options: withPlaceholder(source.providers),
    labelPosition: "side"
  }), settings.provider && wp.element.createElement("div", {
    style: {
      opacity: isLoading ? '0.5' : '1'
    },
    className: "jet-control-full"
  }, wp.element.createElement(SelectControl, {
    label: label('popup'),
    value: settings.popup,
    onChange: function onChange(newValue) {
      return onChangeSetting(newValue, 'popup');
    },
    options: popups,
    labelPosition: "side",
    disabled: isLoading
  })));
});

/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYnVpbGRlci5lZGl0b3IuanMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vamV0LWZvcm0tYnVpbGRlci1hY3Rpb24uanMiXSwic291cmNlc0NvbnRlbnQiOlsiIFx0Ly8gVGhlIG1vZHVsZSBjYWNoZVxuIFx0dmFyIGluc3RhbGxlZE1vZHVsZXMgPSB7fTtcblxuIFx0Ly8gVGhlIHJlcXVpcmUgZnVuY3Rpb25cbiBcdGZ1bmN0aW9uIF9fd2VicGFja19yZXF1aXJlX18obW9kdWxlSWQpIHtcblxuIFx0XHQvLyBDaGVjayBpZiBtb2R1bGUgaXMgaW4gY2FjaGVcbiBcdFx0aWYoaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0pIHtcbiBcdFx0XHRyZXR1cm4gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0uZXhwb3J0cztcbiBcdFx0fVxuIFx0XHQvLyBDcmVhdGUgYSBuZXcgbW9kdWxlIChhbmQgcHV0IGl0IGludG8gdGhlIGNhY2hlKVxuIFx0XHR2YXIgbW9kdWxlID0gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0gPSB7XG4gXHRcdFx0aTogbW9kdWxlSWQsXG4gXHRcdFx0bDogZmFsc2UsXG4gXHRcdFx0ZXhwb3J0czoge31cbiBcdFx0fTtcblxuIFx0XHQvLyBFeGVjdXRlIHRoZSBtb2R1bGUgZnVuY3Rpb25cbiBcdFx0bW9kdWxlc1ttb2R1bGVJZF0uY2FsbChtb2R1bGUuZXhwb3J0cywgbW9kdWxlLCBtb2R1bGUuZXhwb3J0cywgX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cbiBcdFx0Ly8gRmxhZyB0aGUgbW9kdWxlIGFzIGxvYWRlZFxuIFx0XHRtb2R1bGUubCA9IHRydWU7XG5cbiBcdFx0Ly8gUmV0dXJuIHRoZSBleHBvcnRzIG9mIHRoZSBtb2R1bGVcbiBcdFx0cmV0dXJuIG1vZHVsZS5leHBvcnRzO1xuIFx0fVxuXG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlcyBvYmplY3QgKF9fd2VicGFja19tb2R1bGVzX18pXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm0gPSBtb2R1bGVzO1xuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZSBjYWNoZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5jID0gaW5zdGFsbGVkTW9kdWxlcztcblxuIFx0Ly8gZGVmaW5lIGdldHRlciBmdW5jdGlvbiBmb3IgaGFybW9ueSBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQgPSBmdW5jdGlvbihleHBvcnRzLCBuYW1lLCBnZXR0ZXIpIHtcbiBcdFx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhleHBvcnRzLCBuYW1lKSkge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBuYW1lLCB7IGVudW1lcmFibGU6IHRydWUsIGdldDogZ2V0dGVyIH0pO1xuIFx0XHR9XG4gXHR9O1xuXG4gXHQvLyBkZWZpbmUgX19lc01vZHVsZSBvbiBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnIgPSBmdW5jdGlvbihleHBvcnRzKSB7XG4gXHRcdGlmKHR5cGVvZiBTeW1ib2wgIT09ICd1bmRlZmluZWQnICYmIFN5bWJvbC50b1N0cmluZ1RhZykge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBTeW1ib2wudG9TdHJpbmdUYWcsIHsgdmFsdWU6ICdNb2R1bGUnIH0pO1xuIFx0XHR9XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCAnX19lc01vZHVsZScsIHsgdmFsdWU6IHRydWUgfSk7XG4gXHR9O1xuXG4gXHQvLyBjcmVhdGUgYSBmYWtlIG5hbWVzcGFjZSBvYmplY3RcbiBcdC8vIG1vZGUgJiAxOiB2YWx1ZSBpcyBhIG1vZHVsZSBpZCwgcmVxdWlyZSBpdFxuIFx0Ly8gbW9kZSAmIDI6IG1lcmdlIGFsbCBwcm9wZXJ0aWVzIG9mIHZhbHVlIGludG8gdGhlIG5zXG4gXHQvLyBtb2RlICYgNDogcmV0dXJuIHZhbHVlIHdoZW4gYWxyZWFkeSBucyBvYmplY3RcbiBcdC8vIG1vZGUgJiA4fDE6IGJlaGF2ZSBsaWtlIHJlcXVpcmVcbiBcdF9fd2VicGFja19yZXF1aXJlX18udCA9IGZ1bmN0aW9uKHZhbHVlLCBtb2RlKSB7XG4gXHRcdGlmKG1vZGUgJiAxKSB2YWx1ZSA9IF9fd2VicGFja19yZXF1aXJlX18odmFsdWUpO1xuIFx0XHRpZihtb2RlICYgOCkgcmV0dXJuIHZhbHVlO1xuIFx0XHRpZigobW9kZSAmIDQpICYmIHR5cGVvZiB2YWx1ZSA9PT0gJ29iamVjdCcgJiYgdmFsdWUgJiYgdmFsdWUuX19lc01vZHVsZSkgcmV0dXJuIHZhbHVlO1xuIFx0XHR2YXIgbnMgPSBPYmplY3QuY3JlYXRlKG51bGwpO1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLnIobnMpO1xuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkobnMsICdkZWZhdWx0JywgeyBlbnVtZXJhYmxlOiB0cnVlLCB2YWx1ZTogdmFsdWUgfSk7XG4gXHRcdGlmKG1vZGUgJiAyICYmIHR5cGVvZiB2YWx1ZSAhPSAnc3RyaW5nJykgZm9yKHZhciBrZXkgaW4gdmFsdWUpIF9fd2VicGFja19yZXF1aXJlX18uZChucywga2V5LCBmdW5jdGlvbihrZXkpIHsgcmV0dXJuIHZhbHVlW2tleV07IH0uYmluZChudWxsLCBrZXkpKTtcbiBcdFx0cmV0dXJuIG5zO1xuIFx0fTtcblxuIFx0Ly8gZ2V0RGVmYXVsdEV4cG9ydCBmdW5jdGlvbiBmb3IgY29tcGF0aWJpbGl0eSB3aXRoIG5vbi1oYXJtb255IG1vZHVsZXNcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubiA9IGZ1bmN0aW9uKG1vZHVsZSkge1xuIFx0XHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cbiBcdFx0XHRmdW5jdGlvbiBnZXREZWZhdWx0KCkgeyByZXR1cm4gbW9kdWxlWydkZWZhdWx0J107IH0gOlxuIFx0XHRcdGZ1bmN0aW9uIGdldE1vZHVsZUV4cG9ydHMoKSB7IHJldHVybiBtb2R1bGU7IH07XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18uZChnZXR0ZXIsICdhJywgZ2V0dGVyKTtcbiBcdFx0cmV0dXJuIGdldHRlcjtcbiBcdH07XG5cbiBcdC8vIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbFxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5vID0gZnVuY3Rpb24ob2JqZWN0LCBwcm9wZXJ0eSkgeyByZXR1cm4gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG9iamVjdCwgcHJvcGVydHkpOyB9O1xuXG4gXHQvLyBfX3dlYnBhY2tfcHVibGljX3BhdGhfX1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5wID0gXCJcIjtcblxuXG4gXHQvLyBMb2FkIGVudHJ5IG1vZHVsZSBhbmQgcmV0dXJuIGV4cG9ydHNcbiBcdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fKF9fd2VicGFja19yZXF1aXJlX18ucyA9IFwiLi9qZXQtZm9ybS1idWlsZGVyLWFjdGlvbi5qc1wiKTtcbiIsImNvbnN0IHsgYWRkRmlsdGVyIH0gPSB3cC5ob29rcztcclxuY29uc3QgeyBfXyB9ID0gd3AuaTE4bjtcclxuY29uc3Qge1xyXG5cdFx0ICBTZWxlY3RDb250cm9sLFxyXG5cdFx0ICBCYXNlQ29udHJvbCxcclxuXHQgIH0gPSB3cC5jb21wb25lbnRzO1xyXG5cclxuY29uc3Qge1xyXG5cdFx0ICB1c2VTdGF0ZSxcclxuXHRcdCAgdXNlRWZmZWN0LFxyXG5cdCAgfSA9IHdwLmVsZW1lbnQ7XHJcblxyXG5jb25zdCB7IFRvb2xzOiB7IHdpdGhQbGFjZWhvbGRlciB9LCBhZGRBY3Rpb24gfSA9IEpldEZCQWN0aW9ucztcclxuXHJcbmFkZEFjdGlvbiggJ3BvcHVwX2FmdGVyX3N1Ym1pdCcsIGZ1bmN0aW9uIFNob3dQb3B1cEFjdGlvbiggcHJvcHMgKSB7XHJcblxyXG5cdGNvbnN0IHtcclxuXHRcdFx0ICBzZXR0aW5ncyxcclxuXHRcdFx0ICBvbkNoYW5nZVNldHRpbmcsXHJcblx0XHRcdCAgc291cmNlLFxyXG5cdFx0XHQgIGxhYmVsLFxyXG5cdFx0ICB9ID0gcHJvcHM7XHJcblxyXG5cdGNvbnN0IFsgcG9wdXBzLCBzZXRQb3B1cHMgXSA9IHVzZVN0YXRlKCBbXSApO1xyXG5cdGNvbnN0IFsgaXNMb2FkaW5nLCBzZXRMb2FkaW5nIF0gPSB1c2VTdGF0ZSggZmFsc2UgKTtcclxuXHJcblx0Y29uc3QgZmV0Y2hUeXBlRmllbGRzID0gZnVuY3Rpb24oIHByb3ZpZGVyICkge1xyXG5cdFx0aWYgKCAhIHByb3ZpZGVyICkge1xyXG5cdFx0XHRyZXR1cm47XHJcblx0XHR9XHJcblx0XHRzZXRMb2FkaW5nKCB0cnVlICk7XHJcblxyXG5cdFx0alF1ZXJ5LmFqYXgoIHtcclxuXHRcdFx0dXJsOiBhamF4dXJsLFxyXG5cdFx0XHR0eXBlOiAnR0VUJyxcclxuXHRcdFx0ZGF0YVR5cGU6ICdqc29uJyxcclxuXHRcdFx0ZGF0YToge1xyXG5cdFx0XHRcdGFjdGlvbjogc291cmNlLmFqYXhfYWN0aW9uLFxyXG5cdFx0XHRcdHByb3ZpZGVyLFxyXG5cdFx0XHR9LFxyXG5cdFx0fSApLmRvbmUoIGZ1bmN0aW9uKCByZXNwb25zZSApIHtcclxuXHRcdFx0aWYgKCByZXNwb25zZS5zdWNjZXNzICYmIHJlc3BvbnNlLmRhdGEucG9wdXBzICkge1xyXG5cdFx0XHRcdHNldFBvcHVwcyggd2l0aFBsYWNlaG9sZGVyKCByZXNwb25zZS5kYXRhLnBvcHVwcyApICk7XHJcblx0XHRcdH1cclxuXHRcdH0gKS5mYWlsKCBmdW5jdGlvbigganFYSFIsIHRleHRTdGF0dXMsIGVycm9yVGhyb3duICkge1xyXG5cdFx0XHRjb25zb2xlLmxvZyggdGV4dFN0YXR1cywgZXJyb3JUaHJvd24gKTtcclxuXHJcblx0XHR9ICkuYWx3YXlzKCBmdW5jdGlvbigpIHtcclxuXHRcdFx0c2V0TG9hZGluZyggZmFsc2UgKTtcclxuXHRcdH0gKTtcclxuXHR9O1xyXG5cclxuXHR1c2VFZmZlY3QoICgpID0+IHtcclxuXHRcdGZldGNoVHlwZUZpZWxkcyggc2V0dGluZ3MucHJvdmlkZXIgKTtcclxuXHR9LCBbXSApO1xyXG5cclxuXHRyZXR1cm4gPD5cclxuXHRcdDxTZWxlY3RDb250cm9sXHJcblx0XHRcdGxhYmVsPXsgbGFiZWwoICdwcm92aWRlcicgKSB9XHJcblx0XHRcdHZhbHVlPXsgc2V0dGluZ3MucHJvdmlkZXIgfVxyXG5cdFx0XHRvbkNoYW5nZT17IG5ld1ZhbHVlID0+IHtcclxuXHRcdFx0XHRvbkNoYW5nZVNldHRpbmcoIG5ld1ZhbHVlLCAncHJvdmlkZXInIClcclxuXHRcdFx0XHRmZXRjaFR5cGVGaWVsZHMoIG5ld1ZhbHVlICk7XHJcblx0XHRcdH0gfVxyXG5cdFx0XHRvcHRpb25zPXsgd2l0aFBsYWNlaG9sZGVyKCBzb3VyY2UucHJvdmlkZXJzICkgfVxyXG5cdFx0XHRsYWJlbFBvc2l0aW9uPSdzaWRlJ1xyXG5cdFx0Lz5cclxuXHRcdHsgc2V0dGluZ3MucHJvdmlkZXIgJiYgPGRpdiBzdHlsZT17IHsgb3BhY2l0eTogaXNMb2FkaW5nID8gJzAuNScgOiAnMScgfSB9IGNsYXNzTmFtZT0namV0LWNvbnRyb2wtZnVsbCc+XHJcblx0XHRcdDxTZWxlY3RDb250cm9sXHJcblx0XHRcdFx0bGFiZWw9eyBsYWJlbCggJ3BvcHVwJyApIH1cclxuXHRcdFx0XHR2YWx1ZT17IHNldHRpbmdzLnBvcHVwIH1cclxuXHRcdFx0XHRvbkNoYW5nZT17IG5ld1ZhbHVlID0+IG9uQ2hhbmdlU2V0dGluZyggbmV3VmFsdWUsICdwb3B1cCcgKSB9XHJcblx0XHRcdFx0b3B0aW9ucz17IHBvcHVwcyB9XHJcblx0XHRcdFx0bGFiZWxQb3NpdGlvbj0nc2lkZSdcclxuXHRcdFx0XHRkaXNhYmxlZD17IGlzTG9hZGluZyB9XHJcblx0XHRcdC8+XHJcblx0XHQ8L2Rpdj4gfVxyXG5cdDwvPjtcclxufSApIl0sIm1hcHBpbmdzIjoiO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FDbEZBO0FBQ0E7QUFDQTtBQUFBO0FBQUE7QUFLQTtBQUFBO0FBQUE7QUFLQTtBQUFBO0FBQUE7QUFFQTtBQUVBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFNQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRkE7QUFKQTtBQVNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBUkE7QUFVQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBRUE7QUFDQTtBQUNBO0FBQUE7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQU5BO0FBVUE7Ozs7QSIsInNvdXJjZVJvb3QiOiIifQ==