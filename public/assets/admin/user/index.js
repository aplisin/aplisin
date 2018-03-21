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
          maskClosable: false
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5sZXNzP2U4OTUiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2xpYnMvY29tbW9uL3V0aWxzLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9saWJzL2NvbXBvbmVudHMvbW9kYWwuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2xpYnMvY29tcG9uZW50cy9zZWxlY3QuanMiXSwibmFtZXMiOlsicmVxdWlyZSIsIkJyb3dzZXIiLCJ1c2VyQWdlbnQiLCJuYXZpZ2F0b3IiLCJ0b0xvd2VyQ2FzZSIsInMiLCJtYXRjaCIsImllIiwiZmlyZWZveCIsImNocm9tZSIsIm9wZXJhIiwic2FmYXJpIiwiaWUxMCIsInRlc3QiLCJpZTExIiwiZWRnZSIsImlzTW9iaWxlRGV2aWNlIiwiZGVsSHRtbFRhZyIsInN0ciIsInJlcGxhY2UiLCJpbml0VG9vbHRpcHMiLCIkIiwidG9vbHRpcCIsImh0bWwiLCJpbml0UG9wb3ZlciIsInBvcG92ZXIiLCJzZWMyVGltZSIsInNlYyIsInRpbWUiLCJoIiwicGFyc2VJbnQiLCJtIiwidG9TdHJpbmciLCJsZW5ndGgiLCJ0aW1lMlNlYyIsImFycnkiLCJzcGxpdCIsImkiLCJpc0xvZ2luIiwiYXR0ciIsImlzRW1wdHkiLCJvYmoiLCJ1bmRlZmluZWQiLCJPYmplY3QiLCJrZXlzIiwiYXJyYXlUb0pzb24iLCJmb3JtQXJyYXkiLCJkYXRhQXJyYXkiLCJlYWNoIiwibmFtZSIsInB1c2giLCJ2YWx1ZSIsIk1vZGFsIiwiaW5pdE1vZGFsIiwib24iLCJlIiwidXJsIiwidGFyZ2V0IiwiZGF0YSIsImNkIiwiZWwiLCJhamF4IiwibWFza0Nsb3NhYmxlIiwiJG1vZGFsIiwibW9kYWwiLCJ0cmlnZ2VyIiwiU2VsZWN0IiwiaW5pdFNlbGVjdCIsInR5cGUiLCJ0ZXh0Il0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7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Q0QsU0FQRDtBQVFELE9BWEQ7QUFZRDs7Ozs7O0FBR0gsSUFBSWIsS0FBSixHOzs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FDeEJBO0FBQ0E7O0lBRU1jLE07QUFDSixvQkFBYztBQUFBOztBQUNaQSxXQUFPQyxVQUFQO0FBQ0Q7Ozs7aUNBRW1CO0FBQ2xCLFVBQUksQ0FBQyxzRUFBQTNCLENBQVEsbUJBQVIsQ0FBTCxFQUFtQztBQUNqQ21CLFFBQUEsd0RBQVU7QUFDUkMsY0FBSSxtQkFESTtBQUVSUSxnQkFBTTtBQUZFLFNBQVY7QUFJRDs7QUFFRCxVQUFJLENBQUMsc0VBQUE1QixDQUFRLHFCQUFSLENBQUwsRUFBcUM7QUFDbkNtQixRQUFBLHdEQUFVO0FBQ1JDLGNBQUkscUJBREk7QUFFUlEsZ0JBQU07QUFGRSxTQUFWO0FBSUQ7O0FBRUQsVUFBSSxDQUFDLHNFQUFBNUIsQ0FBUW5CLEVBQUUsdUNBQUYsRUFBMkNnRCxJQUEzQyxFQUFSLENBQUwsRUFBaUU7QUFDL0RoRCxVQUFFLGVBQUYsRUFBbUJnRCxJQUFuQixDQUF3QmhELEVBQUUsdUNBQUYsRUFBMkNnRCxJQUEzQyxFQUF4QjtBQUNEO0FBQ0Y7Ozs7OztBQUdILElBQUlILE1BQUosRyIsImZpbGUiOiJhZG1pbi91c2VyL2luZGV4LmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0ICcuLi8uLi9saWJzL2NvbXBvbmVudHMvc2VsZWN0JztcbmltcG9ydCAnLi4vLi4vbGlicy9jb21wb25lbnRzL21vZGFsJztcblxuXG5cblxucmVxdWlyZSgnLi9pbmRleC5sZXNzJyk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5qcyIsIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luXG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5sZXNzXG4vLyBtb2R1bGUgaWQgPSAuL2Fzc2V0cy9hZG1pbi91c2VyL2luZGV4Lmxlc3Ncbi8vIG1vZHVsZSBjaHVua3MgPSAxIiwiLyogZXNsaW50LWRpc2FibGUgcHJlZmVyLWRlc3RydWN0dXJpbmcsbm8tY29uZC1hc3NpZ24sbm8tbmVzdGVkLXRlcm5hcnkscmFkaXgsbm8tc2hhZG93ICovXG5jb25zdCBCcm93c2VyID0ge307XG5jb25zdCB1c2VyQWdlbnQgPSBuYXZpZ2F0b3IudXNlckFnZW50LnRvTG93ZXJDYXNlKCk7XG5sZXQgcztcblxuKHMgPSB1c2VyQWdlbnQubWF0Y2goL21zaWUgKFtcXGQuXSspLykpID8gQnJvd3Nlci5pZSA9IHNbMV0gOlxuICAocyA9IHVzZXJBZ2VudC5tYXRjaCgvZmlyZWZveFxcLyhbXFxkLl0rKS8pKSA/IEJyb3dzZXIuZmlyZWZveCA9IHNbMV0gOlxuICAgIChzID0gdXNlckFnZW50Lm1hdGNoKC9jaHJvbWVcXC8oW1xcZC5dKykvKSkgPyBCcm93c2VyLmNocm9tZSA9IHNbMV0gOlxuICAgICAgKHMgPSB1c2VyQWdlbnQubWF0Y2goL29wZXJhLihbXFxkLl0rKS8pKSA/IEJyb3dzZXIub3BlcmEgPSBzWzFdIDpcbiAgICAgICAgKHMgPSB1c2VyQWdlbnQubWF0Y2goL3ZlcnNpb25cXC8oW1xcZC5dKykuKnNhZmFyaS8pKSA/IEJyb3dzZXIuc2FmYXJpID0gc1sxXSA6IDA7XG5cbkJyb3dzZXIuaWUxMCA9IC9NU0lFXFxzKzEwLjAvaS50ZXN0KG5hdmlnYXRvci51c2VyQWdlbnQpO1xuQnJvd3Nlci5pZTExID0gKC9UcmlkZW50XFwvN1xcLi8pLnRlc3QobmF2aWdhdG9yLnVzZXJBZ2VudCk7XG5Ccm93c2VyLmVkZ2UgPSAvRWRnZVxcLzEzLi9pLnRlc3QobmF2aWdhdG9yLnVzZXJBZ2VudCk7XG5cblxuY29uc3QgaXNNb2JpbGVEZXZpY2UgPSAoKSA9PiB7XG4gIHJldHVybiBuYXZpZ2F0b3IudXNlckFnZW50Lm1hdGNoKC8oaVBob25lfGlQb2R8QW5kcm9pZHxpb3N8aVBhZCkvaSk7XG59O1xuXG5jb25zdCBkZWxIdG1sVGFnID0gKHN0cikgPT4ge1xuICByZXR1cm4gc3RyLnJlcGxhY2UoLzxbXj5dKz4vZywgJycpLnJlcGxhY2UoLyZuYnNwOy9pZywgJycpO1xufTtcblxuY29uc3QgaW5pdFRvb2x0aXBzID0gKCkgPT4ge1xuICAkKCdbZGF0YS10b2dnbGU9XCJ0b29sdGlwXCJdJykudG9vbHRpcCh7XG4gICAgaHRtbDogdHJ1ZSxcbiAgfSk7XG59O1xuXG5jb25zdCBpbml0UG9wb3ZlciA9ICgpID0+IHtcbiAgJCgnW2RhdGEtdG9nZ2xlPVwicG9wb3ZlclwiXScpLnBvcG92ZXIoe1xuICAgIGh0bWw6IHRydWUsXG4gIH0pO1xufTtcblxuY29uc3Qgc2VjMlRpbWUgPSAoc2VjKSA9PiB7XG4gIGxldCB0aW1lID0gJyc7XG4gIGNvbnN0IGggPSBwYXJzZUludCgoc2VjICUgODY0MDApIC8gMzYwMCk7XG4gIGNvbnN0IHMgPSBwYXJzZUludCgoc2VjICUgMzYwMCkgLyA2MCk7XG4gIGNvbnN0IG0gPSBzZWMgJSA2MDtcbiAgaWYgKGggPiAwKSB7XG4gICAgdGltZSArPSBgJHtofTpgO1xuICB9XG4gIGlmIChzLnRvU3RyaW5nKCkubGVuZ3RoIDwgMikge1xuICAgIHRpbWUgKz0gYDAke3N9OmA7XG4gIH0gZWxzZSB7XG4gICAgdGltZSArPSBgJHtzfTpgO1xuICB9XG4gIGlmIChtLnRvU3RyaW5nKCkubGVuZ3RoIDwgMikge1xuICAgIHRpbWUgKz0gYDAke219YDtcbiAgfSBlbHNlIHtcbiAgICB0aW1lICs9IG07XG4gIH1cbiAgcmV0dXJuIHRpbWU7XG59O1xuXG5jb25zdCB0aW1lMlNlYyA9ICh0aW1lKSA9PiB7XG4gIGNvbnN0IGFycnkgPSB0aW1lLnNwbGl0KCc6Jyk7XG4gIGxldCBzZWMgPSAwO1xuICBmb3IgKGxldCBpID0gMDsgaSA8IGFycnkubGVuZ3RoOyBpKyspIHtcbiAgICBpZiAoYXJyeS5sZW5ndGggPiAyKSB7XG4gICAgICBpZiAoaSA9PT0gMCkge1xuICAgICAgICBzZWMgKz0gYXJyeVtpXSAqIDM2MDA7XG4gICAgICB9XG4gICAgICBpZiAoaSA9PT0gMSkge1xuICAgICAgICBzZWMgKz0gYXJyeVtpXSAqIDYwO1xuICAgICAgfVxuICAgICAgaWYgKGkgPT09IDIpIHtcbiAgICAgICAgc2VjICs9IHBhcnNlSW50KGFycnlbaV0pO1xuICAgICAgfVxuICAgIH1cbiAgICBpZiAoYXJyeS5sZW5ndGggPD0gMikge1xuICAgICAgaWYgKGkgPT09IDApIHtcbiAgICAgICAgc2VjICs9IGFycnlbaV0gKiA2MDtcbiAgICAgIH1cbiAgICAgIGlmIChpID09PSAxKSB7XG4gICAgICAgIHNlYyArPSBwYXJzZUludChhcnJ5W2ldKTtcbiAgICAgIH1cbiAgICB9XG4gIH1cbiAgcmV0dXJuIHNlYztcbn07XG5cbmNvbnN0IGlzTG9naW4gPSAoKSA9PiAkKFwibWV0YVtuYW1lPSdpcy1sb2dpbiddXCIpLmF0dHIoJ2NvbnRlbnQnKSA9PSAxO1xuXG5jb25zdCBpc0VtcHR5ID0gKG9iaikgPT4ge1xuICByZXR1cm4gb2JqID09PSBudWxsIHx8IG9iaiA9PT0gJycgfHwgb2JqID09PSB1bmRlZmluZWQgfHwgT2JqZWN0LmtleXMob2JqKS5sZW5ndGggPT09IDA7XG59O1xuXG5jb25zdCBhcnJheVRvSnNvbiA9IChmb3JtQXJyYXkpID0+IHtcbiAgY29uc3QgZGF0YUFycmF5ID0ge307XG4gICQuZWFjaChmb3JtQXJyYXksIGZ1bmN0aW9uKCkge1xuICAgIGlmIChkYXRhQXJyYXlbdGhpcy5uYW1lXSkge1xuICAgICAgaWYgKCFkYXRhQXJyYXlbdGhpcy5uYW1lXS5wdXNoKSB7XG4gICAgICAgIGRhdGFBcnJheVt0aGlzLm5hbWVdID0gW2RhdGFBcnJheVt0aGlzLm5hbWVdXTtcbiAgICAgIH1cbiAgICAgIGRhdGFBcnJheVt0aGlzLm5hbWVdLnB1c2godGhpcy52YWx1ZSB8fCAnJyk7XG4gICAgfSBlbHNlIHtcbiAgICAgIGRhdGFBcnJheVt0aGlzLm5hbWVdID0gdGhpcy52YWx1ZSB8fCAnJztcbiAgICB9XG4gIH0pO1xuXG4gIHJldHVybiBkYXRhQXJyYXk7XG59O1xuXG5leHBvcnQge1xuICBCcm93c2VyLFxuICBpc0xvZ2luLFxuICBpc01vYmlsZURldmljZSxcbiAgZGVsSHRtbFRhZyxcbiAgaW5pdFRvb2x0aXBzLFxuICBpbml0UG9wb3ZlcixcbiAgc2VjMlRpbWUsXG4gIHRpbWUyU2VjLFxuICBhcnJheVRvSnNvbixcbiAgaXNFbXB0eVxufTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL2Fzc2V0cy9saWJzL2NvbW1vbi91dGlscy5qcyIsImltcG9ydCAqIGFzIGNkIGZyb20gJ2NvZGVhZ2VzLWRlc2lnbic7XG5pbXBvcnQgeyBpc0VtcHR5IH0gZnJvbSAnLi4vY29tbW9uL3V0aWxzJztcblxuY2xhc3MgTW9kYWwge1xuICBjb25zdHJ1Y3RvcigpIHtcbiAgICB0aGlzLmluaXRNb2RhbCgpO1xuICB9XG5cbiAgaW5pdE1vZGFsKCkge1xuICAgICQoJ2JvZHknKS5vbignY2xpY2snLCAnW2hyZWY9XCIjbW9kYWxcIl0sIFtkYXRhLXRvZ2dsZT1cIm1vZGFsXCJdJywgKGUpID0+IHtcbiAgICAgIGxldCB1cmwgPSAhaXNFbXB0eSgkKGUudGFyZ2V0KS5kYXRhKCd1cmwnKSkgPyAkKGUudGFyZ2V0KS5kYXRhKCd1cmwnKSA6ICcnO1xuXG4gICAgICBjZC5tb2RhbCh7XG4gICAgICAgIGVsOiAnI2NkLW1vZGFsJyxcbiAgICAgICAgYWpheDogIWlzRW1wdHkodXJsKSxcbiAgICAgICAgdXJsOiB1cmwsXG4gICAgICAgIG1hc2tDbG9zYWJsZTogZmFsc2UsXG4gICAgICB9KS5vbignb2snLCAoJG1vZGFsLCBtb2RhbCkgPT4ge1xuICAgICAgICBtb2RhbC50cmlnZ2VyKCdjbG9zZScpO1xuICAgICAgfSk7XG4gICAgfSk7XG4gIH1cbn1cblxubmV3IE1vZGFsKCk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9hc3NldHMvbGlicy9jb21wb25lbnRzL21vZGFsLmpzIiwiaW1wb3J0ICogYXMgY2QgZnJvbSAnY29kZWFnZXMtZGVzaWduJztcbmltcG9ydCB7IGlzRW1wdHkgfSBmcm9tICcuLi9jb21tb24vdXRpbHMnO1xuXG5jbGFzcyBTZWxlY3Qge1xuICBjb25zdHJ1Y3RvcigpIHtcbiAgICBTZWxlY3QuaW5pdFNlbGVjdCgpO1xuICB9XG5cbiAgc3RhdGljIGluaXRTZWxlY3QoKSB7XG4gICAgaWYgKCFpc0VtcHR5KCcuY2Qtc2VsZWN0LXNpbmdsZScpKSB7XG4gICAgICBjZC5zZWxlY3Qoe1xuICAgICAgICBlbDogJy5jZC1zZWxlY3Qtc2luZ2xlJyxcbiAgICAgICAgdHlwZTogJ3NpbmdsZSdcbiAgICAgIH0pO1xuICAgIH1cblxuICAgIGlmICghaXNFbXB0eSgnLmNkLXNlbGVjdC1tdWx0aXBsZScpKSB7XG4gICAgICBjZC5zZWxlY3Qoe1xuICAgICAgICBlbDogJy5jZC1zZWxlY3QtbXVsdGlwbGUnLFxuICAgICAgICB0eXBlOiAnbXVsdGlwbGUnXG4gICAgICB9KTtcbiAgICB9XG5cbiAgICBpZiAoIWlzRW1wdHkoJChcIi5zZWxlY3Qtb3B0aW9ucyBbc2VsZWN0ZWQ9J3NlbGVjdGVkJ11cIikudGV4dCgpKSkge1xuICAgICAgJCgnLnNlbGVjdC12YWx1ZScpLnRleHQoJChcIi5zZWxlY3Qtb3B0aW9ucyBbc2VsZWN0ZWQ9J3NlbGVjdGVkJ11cIikudGV4dCgpKTtcbiAgICB9XG4gIH1cbn1cblxubmV3IFNlbGVjdCgpO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vYXNzZXRzL2xpYnMvY29tcG9uZW50cy9zZWxlY3QuanMiXSwic291cmNlUm9vdCI6IiJ9