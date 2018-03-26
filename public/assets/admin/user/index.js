webpackJsonp([1],{

/***/ "./assets/admin/user/index.js":
/*!************************************!*\
  !*** ./assets/admin/user/index.js ***!
  \************************************/
/*! no exports provided */
/*! all exports used */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__libs_components_select__ = __webpack_require__(/*! ../../libs/components/select */ "./assets/libs/components/select.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__libs_components_modal__ = __webpack_require__(/*! ../../libs/components/modal */ "./assets/libs/components/modal.js");



__webpack_require__(/*! ./index.less */ "./assets/admin/user/index.less");

/***/ }),

/***/ "./assets/admin/user/index.less":
/*!**************************************!*\
  !*** ./assets/admin/user/index.less ***!
  \**************************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./assets/libs/common/utils.js":
/*!*************************************!*\
  !*** ./assets/libs/common/utils.js ***!
  \*************************************/
/*! exports provided: Browser, isLogin, isMobileDevice, delHtmlTag, initTooltips, initPopover, sec2Time, time2Sec, arrayToJson, isEmpty */
/*! exports used: isEmpty */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* unused harmony export Browser */
/* unused harmony export isLogin */
/* unused harmony export isMobileDevice */
/* unused harmony export delHtmlTag */
/* unused harmony export initTooltips */
/* unused harmony export initPopover */
/* unused harmony export sec2Time */
/* unused harmony export time2Sec */
/* unused harmony export arrayToJson */
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return isEmpty; });
/* eslint-disable prefer-destructuring,no-cond-assign,no-nested-ternary,radix,no-shadow */
var Browser = {};
var userAgent = navigator.userAgent.toLowerCase();
var s = void 0;

(s = userAgent.match(/msie ([\d.]+)/)) ? Browser.ie = s[1] : (s = userAgent.match(/firefox\/([\d.]+)/)) ? Browser.firefox = s[1] : (s = userAgent.match(/chrome\/([\d.]+)/)) ? Browser.chrome = s[1] : (s = userAgent.match(/opera.([\d.]+)/)) ? Browser.opera = s[1] : (s = userAgent.match(/version\/([\d.]+).*safari/)) ? Browser.safari = s[1] : 0;

Browser.ie10 = /MSIE\s+10.0/i.test(navigator.userAgent);
Browser.ie11 = /Trident\/7\./.test(navigator.userAgent);
Browser.edge = /Edge\/13./i.test(navigator.userAgent);

var isMobileDevice = function isMobileDevice() {
  return navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i);
};

var delHtmlTag = function delHtmlTag(str) {
  return str.replace(/<[^>]+>/g, '').replace(/&nbsp;/ig, '');
};

var initTooltips = function initTooltips() {
  $('[data-toggle="tooltip"]').tooltip({
    html: true
  });
};

var initPopover = function initPopover() {
  $('[data-toggle="popover"]').popover({
    html: true
  });
};

var sec2Time = function sec2Time(sec) {
  var time = '';
  var h = parseInt(sec % 86400 / 3600);
  var s = parseInt(sec % 3600 / 60);
  var m = sec % 60;
  if (h > 0) {
    time += h + ':';
  }
  if (s.toString().length < 2) {
    time += '0' + s + ':';
  } else {
    time += s + ':';
  }
  if (m.toString().length < 2) {
    time += '0' + m;
  } else {
    time += m;
  }
  return time;
};

var time2Sec = function time2Sec(time) {
  var arry = time.split(':');
  var sec = 0;
  for (var i = 0; i < arry.length; i++) {
    if (arry.length > 2) {
      if (i === 0) {
        sec += arry[i] * 3600;
      }
      if (i === 1) {
        sec += arry[i] * 60;
      }
      if (i === 2) {
        sec += parseInt(arry[i]);
      }
    }
    if (arry.length <= 2) {
      if (i === 0) {
        sec += arry[i] * 60;
      }
      if (i === 1) {
        sec += parseInt(arry[i]);
      }
    }
  }
  return sec;
};

var isLogin = function isLogin() {
  return $("meta[name='is-login']").attr('content') == 1;
};

var isEmpty = function isEmpty(obj) {
  return obj === null || obj === '' || obj === undefined || Object.keys(obj).length === 0;
};

var arrayToJson = function arrayToJson(formArray) {
  var dataArray = {};
  $.each(formArray, function () {
    if (dataArray[this.name]) {
      if (!dataArray[this.name].push) {
        dataArray[this.name] = [dataArray[this.name]];
      }
      dataArray[this.name].push(this.value || '');
    } else {
      dataArray[this.name] = this.value || '';
    }
  });

  return dataArray;
};


/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/libs/components/modal.js":
/*!*****************************************!*\
  !*** ./assets/libs/components/modal.js ***!
  \*****************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_codeages_design__ = __webpack_require__(/*! codeages-design */ "./node_modules/codeages-design/src/codeages-design.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__common_utils__ = __webpack_require__(/*! ../common/utils */ "./assets/libs/common/utils.js");
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




var Modal = function () {
  function Modal() {
    _classCallCheck(this, Modal);

    this.initModal();
  }

  _createClass(Modal, [{
    key: 'initModal',
    value: function initModal() {
      $('body').on('click', '[href="#modal"], [data-toggle="modal"]', function (e) {
        var url = !Object(__WEBPACK_IMPORTED_MODULE_1__common_utils__["a" /* isEmpty */])($(e.target).data('url')) ? $(e.target).data('url') : '';

        __WEBPACK_IMPORTED_MODULE_0_codeages_design__["modal"]({
          el: '#cd-modal',
          ajax: !Object(__WEBPACK_IMPORTED_MODULE_1__common_utils__["a" /* isEmpty */])(url),
          url: url,
          maskClosable: $(e.target).data('static') === false ? $(e.target).data('static') : true
        }).on('ok', function ($modal, modal) {
          modal.trigger('close');
        });
      });
    }
  }]);

  return Modal;
}();

new Modal();
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/libs/components/select.js":
/*!******************************************!*\
  !*** ./assets/libs/components/select.js ***!
  \******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_codeages_design__ = __webpack_require__(/*! codeages-design */ "./node_modules/codeages-design/src/codeages-design.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__common_utils__ = __webpack_require__(/*! ../common/utils */ "./assets/libs/common/utils.js");
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




var Select = function () {
  function Select() {
    _classCallCheck(this, Select);

    Select.initSelect();
  }

  _createClass(Select, null, [{
    key: 'initSelect',
    value: function initSelect() {
      if (!Object(__WEBPACK_IMPORTED_MODULE_1__common_utils__["a" /* isEmpty */])('.cd-select-single')) {
        __WEBPACK_IMPORTED_MODULE_0_codeages_design__["select"]({
          el: '.cd-select-single',
          type: 'single'
        });
      }

      if (!Object(__WEBPACK_IMPORTED_MODULE_1__common_utils__["a" /* isEmpty */])('.cd-select-multiple')) {
        __WEBPACK_IMPORTED_MODULE_0_codeages_design__["select"]({
          el: '.cd-select-multiple',
          type: 'multiple'
        });
      }

      if (!Object(__WEBPACK_IMPORTED_MODULE_1__common_utils__["a" /* isEmpty */])($(".select-options [selected='selected']").text())) {
        $('.select-value').text($(".select-options [selected='selected']").text());
      }
    }
  }]);

  return Select;
}();

new Select();
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ })

},["./assets/admin/user/index.js"]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5sZXNzP2U4OTUiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2xpYnMvY29tbW9uL3V0aWxzLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9saWJzL2NvbXBvbmVudHMvbW9kYWwuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2xpYnMvY29tcG9uZW50cy9zZWxlY3QuanMiXSwibmFtZXMiOlsicmVxdWlyZSIsIkJyb3dzZXIiLCJ1c2VyQWdlbnQiLCJuYXZpZ2F0b3IiLCJ0b0xvd2VyQ2FzZSIsInMiLCJtYXRjaCIsImllIiwiZmlyZWZveCIsImNocm9tZSIsIm9wZXJhIiwic2FmYXJpIiwiaWUxMCIsInRlc3QiLCJpZTExIiwiZWRnZSIsImlzTW9iaWxlRGV2aWNlIiwiZGVsSHRtbFRhZyIsInN0ciIsInJlcGxhY2UiLCJpbml0VG9vbHRpcHMiLCIkIiwidG9vbHRpcCIsImh0bWwiLCJpbml0UG9wb3ZlciIsInBvcG92ZXIiLCJzZWMyVGltZSIsInNlYyIsInRpbWUiLCJoIiwicGFyc2VJbnQiLCJtIiwidG9TdHJpbmciLCJsZW5ndGgiLCJ0aW1lMlNlYyIsImFycnkiLCJzcGxpdCIsImkiLCJpc0xvZ2luIiwiYXR0ciIsImlzRW1wdHkiLCJvYmoiLCJ1bmRlZmluZWQiLCJPYmplY3QiLCJrZXlzIiwiYXJyYXlUb0pzb24iLCJmb3JtQXJyYXkiLCJkYXRhQXJyYXkiLCJlYWNoIiwibmFtZSIsInB1c2giLCJ2YWx1ZSIsIk1vZGFsIiwiaW5pdE1vZGFsIiwib24iLCJlIiwidXJsIiwidGFyZ2V0IiwiZGF0YSIsImNkIiwiZWwiLCJhamF4IiwibWFza0Nsb3NhYmxlIiwiJG1vZGFsIiwibW9kYWwiLCJ0cmlnZ2VyIiwiU2VsZWN0IiwiaW5pdFNlbGVjdCIsInR5cGUiLCJ0ZXh0Il0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7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aUIsUUFBakIsQ0FBdkMsR0FBb0U7QUFKM0UsU0FBVCxFQUtHSixFQUxILENBS00sSUFMTixFQUtZLFVBQUNTLE1BQUQsRUFBU0MsS0FBVCxFQUFtQjtBQUM3QkEsZ0JBQU1DLE9BQU4sQ0FBYyxPQUFkO0FBQ0QsU0FQRDtBQVFELE9BWEQ7QUFZRDs7Ozs7O0FBR0gsSUFBSWIsS0FBSixHOzs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FDeEJBO0FBQ0E7O0lBRU1jLE07QUFDSixvQkFBYztBQUFBOztBQUNaQSxXQUFPQyxVQUFQO0FBQ0Q7Ozs7aUNBRW1CO0FBQ2xCLFVBQUksQ0FBQyxzRUFBQTNCLENBQVEsbUJBQVIsQ0FBTCxFQUFtQztBQUNqQ21CLFFBQUEsd0RBQVU7QUFDUkMsY0FBSSxtQkFESTtBQUVSUSxnQkFBTTtBQUZFLFNBQVY7QUFJRDs7QUFFRCxVQUFJLENBQUMsc0VBQUE1QixDQUFRLHFCQUFSLENBQUwsRUFBcUM7QUFDbkNtQixRQUFBLHdEQUFVO0FBQ1JDLGNBQUkscUJBREk7QUFFUlEsZ0JBQU07QUFGRSxTQUFWO0FBSUQ7O0FBRUQsVUFBSSxDQUFDLHNFQUFBNUIsQ0FBUW5CLEVBQUUsdUNBQUYsRUFBMkNnRCxJQUEzQyxFQUFSLENBQUwsRUFBaUU7QUFDL0RoRCxVQUFFLGVBQUYsRUFBbUJnRCxJQUFuQixDQUF3QmhELEVBQUUsdUNBQUYsRUFBMkNnRCxJQUEzQyxFQUF4QjtBQUNEO0FBQ0Y7Ozs7OztBQUdILElBQUlILE1BQUosRyIsImZpbGUiOiJhZG1pbi91c2VyL2luZGV4LmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0ICcuLi8uLi9saWJzL2NvbXBvbmVudHMvc2VsZWN0JztcbmltcG9ydCAnLi4vLi4vbGlicy9jb21wb25lbnRzL21vZGFsJztcblxucmVxdWlyZSgnLi9pbmRleC5sZXNzJyk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vYXNzZXRzL2FkbWluL3VzZXIvaW5kZXguanMiLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpblxuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIC4vYXNzZXRzL2FkbWluL3VzZXIvaW5kZXgubGVzc1xuLy8gbW9kdWxlIGlkID0gLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5sZXNzXG4vLyBtb2R1bGUgY2h1bmtzID0gMSIsIi8qIGVzbGludC1kaXNhYmxlIHByZWZlci1kZXN0cnVjdHVyaW5nLG5vLWNvbmQtYXNzaWduLG5vLW5lc3RlZC10ZXJuYXJ5LHJhZGl4LG5vLXNoYWRvdyAqL1xuY29uc3QgQnJvd3NlciA9IHt9O1xuY29uc3QgdXNlckFnZW50ID0gbmF2aWdhdG9yLnVzZXJBZ2VudC50b0xvd2VyQ2FzZSgpO1xubGV0IHM7XG5cbihzID0gdXNlckFnZW50Lm1hdGNoKC9tc2llIChbXFxkLl0rKS8pKSA/IEJyb3dzZXIuaWUgPSBzWzFdIDpcbiAgKHMgPSB1c2VyQWdlbnQubWF0Y2goL2ZpcmVmb3hcXC8oW1xcZC5dKykvKSkgPyBCcm93c2VyLmZpcmVmb3ggPSBzWzFdIDpcbiAgICAocyA9IHVzZXJBZ2VudC5tYXRjaCgvY2hyb21lXFwvKFtcXGQuXSspLykpID8gQnJvd3Nlci5jaHJvbWUgPSBzWzFdIDpcbiAgICAgIChzID0gdXNlckFnZW50Lm1hdGNoKC9vcGVyYS4oW1xcZC5dKykvKSkgPyBCcm93c2VyLm9wZXJhID0gc1sxXSA6XG4gICAgICAgIChzID0gdXNlckFnZW50Lm1hdGNoKC92ZXJzaW9uXFwvKFtcXGQuXSspLipzYWZhcmkvKSkgPyBCcm93c2VyLnNhZmFyaSA9IHNbMV0gOiAwO1xuXG5Ccm93c2VyLmllMTAgPSAvTVNJRVxccysxMC4wL2kudGVzdChuYXZpZ2F0b3IudXNlckFnZW50KTtcbkJyb3dzZXIuaWUxMSA9ICgvVHJpZGVudFxcLzdcXC4vKS50ZXN0KG5hdmlnYXRvci51c2VyQWdlbnQpO1xuQnJvd3Nlci5lZGdlID0gL0VkZ2VcXC8xMy4vaS50ZXN0KG5hdmlnYXRvci51c2VyQWdlbnQpO1xuXG5cbmNvbnN0IGlzTW9iaWxlRGV2aWNlID0gKCkgPT4ge1xuICByZXR1cm4gbmF2aWdhdG9yLnVzZXJBZ2VudC5tYXRjaCgvKGlQaG9uZXxpUG9kfEFuZHJvaWR8aW9zfGlQYWQpL2kpO1xufTtcblxuY29uc3QgZGVsSHRtbFRhZyA9IChzdHIpID0+IHtcbiAgcmV0dXJuIHN0ci5yZXBsYWNlKC88W14+XSs+L2csICcnKS5yZXBsYWNlKC8mbmJzcDsvaWcsICcnKTtcbn07XG5cbmNvbnN0IGluaXRUb29sdGlwcyA9ICgpID0+IHtcbiAgJCgnW2RhdGEtdG9nZ2xlPVwidG9vbHRpcFwiXScpLnRvb2x0aXAoe1xuICAgIGh0bWw6IHRydWUsXG4gIH0pO1xufTtcblxuY29uc3QgaW5pdFBvcG92ZXIgPSAoKSA9PiB7XG4gICQoJ1tkYXRhLXRvZ2dsZT1cInBvcG92ZXJcIl0nKS5wb3BvdmVyKHtcbiAgICBodG1sOiB0cnVlLFxuICB9KTtcbn07XG5cbmNvbnN0IHNlYzJUaW1lID0gKHNlYykgPT4ge1xuICBsZXQgdGltZSA9ICcnO1xuICBjb25zdCBoID0gcGFyc2VJbnQoKHNlYyAlIDg2NDAwKSAvIDM2MDApO1xuICBjb25zdCBzID0gcGFyc2VJbnQoKHNlYyAlIDM2MDApIC8gNjApO1xuICBjb25zdCBtID0gc2VjICUgNjA7XG4gIGlmIChoID4gMCkge1xuICAgIHRpbWUgKz0gYCR7aH06YDtcbiAgfVxuICBpZiAocy50b1N0cmluZygpLmxlbmd0aCA8IDIpIHtcbiAgICB0aW1lICs9IGAwJHtzfTpgO1xuICB9IGVsc2Uge1xuICAgIHRpbWUgKz0gYCR7c306YDtcbiAgfVxuICBpZiAobS50b1N0cmluZygpLmxlbmd0aCA8IDIpIHtcbiAgICB0aW1lICs9IGAwJHttfWA7XG4gIH0gZWxzZSB7XG4gICAgdGltZSArPSBtO1xuICB9XG4gIHJldHVybiB0aW1lO1xufTtcblxuY29uc3QgdGltZTJTZWMgPSAodGltZSkgPT4ge1xuICBjb25zdCBhcnJ5ID0gdGltZS5zcGxpdCgnOicpO1xuICBsZXQgc2VjID0gMDtcbiAgZm9yIChsZXQgaSA9IDA7IGkgPCBhcnJ5Lmxlbmd0aDsgaSsrKSB7XG4gICAgaWYgKGFycnkubGVuZ3RoID4gMikge1xuICAgICAgaWYgKGkgPT09IDApIHtcbiAgICAgICAgc2VjICs9IGFycnlbaV0gKiAzNjAwO1xuICAgICAgfVxuICAgICAgaWYgKGkgPT09IDEpIHtcbiAgICAgICAgc2VjICs9IGFycnlbaV0gKiA2MDtcbiAgICAgIH1cbiAgICAgIGlmIChpID09PSAyKSB7XG4gICAgICAgIHNlYyArPSBwYXJzZUludChhcnJ5W2ldKTtcbiAgICAgIH1cbiAgICB9XG4gICAgaWYgKGFycnkubGVuZ3RoIDw9IDIpIHtcbiAgICAgIGlmIChpID09PSAwKSB7XG4gICAgICAgIHNlYyArPSBhcnJ5W2ldICogNjA7XG4gICAgICB9XG4gICAgICBpZiAoaSA9PT0gMSkge1xuICAgICAgICBzZWMgKz0gcGFyc2VJbnQoYXJyeVtpXSk7XG4gICAgICB9XG4gICAgfVxuICB9XG4gIHJldHVybiBzZWM7XG59O1xuXG5jb25zdCBpc0xvZ2luID0gKCkgPT4gJChcIm1ldGFbbmFtZT0naXMtbG9naW4nXVwiKS5hdHRyKCdjb250ZW50JykgPT0gMTtcblxuY29uc3QgaXNFbXB0eSA9IChvYmopID0+IHtcbiAgcmV0dXJuIG9iaiA9PT0gbnVsbCB8fCBvYmogPT09ICcnIHx8IG9iaiA9PT0gdW5kZWZpbmVkIHx8IE9iamVjdC5rZXlzKG9iaikubGVuZ3RoID09PSAwO1xufTtcblxuY29uc3QgYXJyYXlUb0pzb24gPSAoZm9ybUFycmF5KSA9PiB7XG4gIGNvbnN0IGRhdGFBcnJheSA9IHt9O1xuICAkLmVhY2goZm9ybUFycmF5LCBmdW5jdGlvbigpIHtcbiAgICBpZiAoZGF0YUFycmF5W3RoaXMubmFtZV0pIHtcbiAgICAgIGlmICghZGF0YUFycmF5W3RoaXMubmFtZV0ucHVzaCkge1xuICAgICAgICBkYXRhQXJyYXlbdGhpcy5uYW1lXSA9IFtkYXRhQXJyYXlbdGhpcy5uYW1lXV07XG4gICAgICB9XG4gICAgICBkYXRhQXJyYXlbdGhpcy5uYW1lXS5wdXNoKHRoaXMudmFsdWUgfHwgJycpO1xuICAgIH0gZWxzZSB7XG4gICAgICBkYXRhQXJyYXlbdGhpcy5uYW1lXSA9IHRoaXMudmFsdWUgfHwgJyc7XG4gICAgfVxuICB9KTtcblxuICByZXR1cm4gZGF0YUFycmF5O1xufTtcblxuZXhwb3J0IHtcbiAgQnJvd3NlcixcbiAgaXNMb2dpbixcbiAgaXNNb2JpbGVEZXZpY2UsXG4gIGRlbEh0bWxUYWcsXG4gIGluaXRUb29sdGlwcyxcbiAgaW5pdFBvcG92ZXIsXG4gIHNlYzJUaW1lLFxuICB0aW1lMlNlYyxcbiAgYXJyYXlUb0pzb24sXG4gIGlzRW1wdHlcbn07XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9hc3NldHMvbGlicy9jb21tb24vdXRpbHMuanMiLCJpbXBvcnQgKiBhcyBjZCBmcm9tICdjb2RlYWdlcy1kZXNpZ24nO1xuaW1wb3J0IHsgaXNFbXB0eSB9IGZyb20gJy4uL2NvbW1vbi91dGlscyc7XG5cbmNsYXNzIE1vZGFsIHtcbiAgY29uc3RydWN0b3IoKSB7XG4gICAgdGhpcy5pbml0TW9kYWwoKTtcbiAgfVxuXG4gIGluaXRNb2RhbCgpIHtcbiAgICAkKCdib2R5Jykub24oJ2NsaWNrJywgJ1tocmVmPVwiI21vZGFsXCJdLCBbZGF0YS10b2dnbGU9XCJtb2RhbFwiXScsIChlKSA9PiB7XG4gICAgICBsZXQgdXJsID0gIWlzRW1wdHkoJChlLnRhcmdldCkuZGF0YSgndXJsJykpID8gJChlLnRhcmdldCkuZGF0YSgndXJsJykgOiAnJztcblxuICAgICAgY2QubW9kYWwoe1xuICAgICAgICBlbDogJyNjZC1tb2RhbCcsXG4gICAgICAgIGFqYXg6ICFpc0VtcHR5KHVybCksXG4gICAgICAgIHVybDogdXJsLFxuICAgICAgICBtYXNrQ2xvc2FibGU6ICQoZS50YXJnZXQpLmRhdGEoJ3N0YXRpYycpID09PSBmYWxzZSA/ICQoZS50YXJnZXQpLmRhdGEoJ3N0YXRpYycpIDogdHJ1ZSxcbiAgICAgIH0pLm9uKCdvaycsICgkbW9kYWwsIG1vZGFsKSA9PiB7XG4gICAgICAgIG1vZGFsLnRyaWdnZXIoJ2Nsb3NlJyk7XG4gICAgICB9KTtcbiAgICB9KTtcbiAgfVxufVxuXG5uZXcgTW9kYWwoKTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL2Fzc2V0cy9saWJzL2NvbXBvbmVudHMvbW9kYWwuanMiLCJpbXBvcnQgKiBhcyBjZCBmcm9tICdjb2RlYWdlcy1kZXNpZ24nO1xuaW1wb3J0IHsgaXNFbXB0eSB9IGZyb20gJy4uL2NvbW1vbi91dGlscyc7XG5cbmNsYXNzIFNlbGVjdCB7XG4gIGNvbnN0cnVjdG9yKCkge1xuICAgIFNlbGVjdC5pbml0U2VsZWN0KCk7XG4gIH1cblxuICBzdGF0aWMgaW5pdFNlbGVjdCgpIHtcbiAgICBpZiAoIWlzRW1wdHkoJy5jZC1zZWxlY3Qtc2luZ2xlJykpIHtcbiAgICAgIGNkLnNlbGVjdCh7XG4gICAgICAgIGVsOiAnLmNkLXNlbGVjdC1zaW5nbGUnLFxuICAgICAgICB0eXBlOiAnc2luZ2xlJ1xuICAgICAgfSk7XG4gICAgfVxuXG4gICAgaWYgKCFpc0VtcHR5KCcuY2Qtc2VsZWN0LW11bHRpcGxlJykpIHtcbiAgICAgIGNkLnNlbGVjdCh7XG4gICAgICAgIGVsOiAnLmNkLXNlbGVjdC1tdWx0aXBsZScsXG4gICAgICAgIHR5cGU6ICdtdWx0aXBsZSdcbiAgICAgIH0pO1xuICAgIH1cblxuICAgIGlmICghaXNFbXB0eSgkKFwiLnNlbGVjdC1vcHRpb25zIFtzZWxlY3RlZD0nc2VsZWN0ZWQnXVwiKS50ZXh0KCkpKSB7XG4gICAgICAkKCcuc2VsZWN0LXZhbHVlJykudGV4dCgkKFwiLnNlbGVjdC1vcHRpb25zIFtzZWxlY3RlZD0nc2VsZWN0ZWQnXVwiKS50ZXh0KCkpO1xuICAgIH1cbiAgfVxufVxuXG5uZXcgU2VsZWN0KCk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9hc3NldHMvbGlicy9jb21wb25lbnRzL3NlbGVjdC5qcyJdLCJzb3VyY2VSb290IjoiIn0=