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
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_codeages_design__ = __webpack_require__(/*! codeages-design */ "./node_modules/codeages-design/src/codeages-design.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__libs_common_utils__ = __webpack_require__(/*! ../../libs/common/utils */ "./assets/libs/common/utils.js");
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




__webpack_require__(/*! ./index.less */ "./assets/admin/user/index.less");

var Index = function () {
  function Index() {
    _classCallCheck(this, Index);

    Index.initForm();
  }

  _createClass(Index, null, [{
    key: 'initForm',
    value: function initForm() {
      if (!Object(__WEBPACK_IMPORTED_MODULE_1__libs_common_utils__["a" /* isEmpty */])($('.select-options').find("[selected='selected']").text())) {
        $('.select-value').text($('.select-options').find("[selected='selected']").text());
      }

      __WEBPACK_IMPORTED_MODULE_0_codeages_design__["select"]({
        el: '#user_keywordType',
        type: 'single'
      });
    }
  }]);

  return Index;
}();

new Index();
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

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
      if (i == 0) {
        sec += arry[i] * 3600;
      }
      if (i == 1) {
        sec += arry[i] * 60;
      }
      if (i == 2) {
        sec += parseInt(arry[i]);
      }
    }
    if (arry.length <= 2) {
      if (i == 0) {
        sec += arry[i] * 60;
      }
      if (i == 1) {
        sec += parseInt(arry[i]);
      }
    }
  }
  return sec;
};

var isLogin = function isLogin() {
  return $("meta[name='is-login']").attr("content") == 1;
};

var isEmpty = function isEmpty(obj) {
  return obj === null || obj === "" || obj === undefined || Object.keys(obj).length === 0;
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

/***/ })

},["./assets/admin/user/index.js"]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5sZXNzP2U4OTUiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2xpYnMvY29tbW9uL3V0aWxzLmpzIl0sIm5hbWVzIjpbInJlcXVpcmUiLCJJbmRleCIsImluaXRGb3JtIiwiaXNFbXB0eSIsIiQiLCJmaW5kIiwidGV4dCIsImNkIiwiZWwiLCJ0eXBlIiwiQnJvd3NlciIsInVzZXJBZ2VudCIsIm5hdmlnYXRvciIsInRvTG93ZXJDYXNlIiwicyIsIm1hdGNoIiwiaWUiLCJmaXJlZm94IiwiY2hyb21lIiwib3BlcmEiLCJzYWZhcmkiLCJpZTEwIiwidGVzdCIsImllMTEiLCJlZGdlIiwiaXNNb2JpbGVEZXZpY2UiLCJkZWxIdG1sVGFnIiwic3RyIiwicmVwbGFjZSIsImluaXRUb29sdGlwcyIsInRvb2x0aXAiLCJodG1sIiwiaW5pdFBvcG92ZXIiLCJwb3BvdmVyIiwic2VjMlRpbWUiLCJzZWMiLCJ0aW1lIiwiaCIsInBhcnNlSW50IiwibSIsInRvU3RyaW5nIiwibGVuZ3RoIiwidGltZTJTZWMiLCJhcnJ5Iiwic3BsaXQiLCJpIiwiaXNMb2dpbiIsImF0dHIiLCJvYmoiLCJ1bmRlZmluZWQiLCJPYmplY3QiLCJrZXlzIiwiYXJyYXlUb0pzb24iLCJmb3JtQXJyYXkiLCJkYXRhQXJyYXkiLCJlYWNoIiwibmFtZSIsInB1c2giLCJ2YWx1ZSJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBQUE7QUFDQTs7QUFFQSxtQkFBQUEsQ0FBUSxvREFBUjs7SUFFTUMsSztBQUNKLG1CQUFjO0FBQUE7O0FBQ1pBLFVBQU1DLFFBQU47QUFDRDs7OzsrQkFFaUI7QUFDaEIsVUFBSSxDQUFDLDJFQUFBQyxDQUFRQyxFQUFFLGlCQUFGLEVBQXFCQyxJQUFyQixDQUEwQix1QkFBMUIsRUFBbURDLElBQW5ELEVBQVIsQ0FBTCxFQUF5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QUN2QixTQUFPQSxRQUFRLElBQVIsSUFBZ0JBLFFBQVEsRUFBeEIsSUFBOEJBLFFBQVFDLFNBQXRDLElBQW1EQyxPQUFPQyxJQUFQLENBQVlILEdBQVosRUFBaUJQLE1BQWpCLEtBQTRCLENBQXRGO0FBQ0QsQ0FGRDs7QUFJQSxJQUFNVyxjQUFjLFNBQWRBLFdBQWMsQ0FBQ0MsU0FBRCxFQUFlO0FBQ2pDLE1BQU1DLFlBQVksRUFBbEI7QUFDQWxELElBQUVtRCxJQUFGLENBQU9GLFNBQVAsRUFBa0IsWUFBVztBQUMzQixRQUFJQyxVQUFVLEtBQUtFLElBQWYsQ0FBSixFQUEwQjtBQUN4QixVQUFJLENBQUNGLFVBQVUsS0FBS0UsSUFBZixFQUFxQkMsSUFBMUIsRUFBZ0M7QUFDOUJILGtCQUFVLEtBQUtFLElBQWYsSUFBdUIsQ0FBQ0YsVUFBVSxLQUFLRSxJQUFmLENBQUQsQ0FBdkI7QUFDRDtBQUNERixnQkFBVSxLQUFLRSxJQUFmLEVBQXFCQyxJQUFyQixDQUEwQixLQUFLQyxLQUFMLElBQWMsRUFBeEM7QUFDRCxLQUxELE1BS087QUFDTEosZ0JBQVUsS0FBS0UsSUFBZixJQUF1QixLQUFLRSxLQUFMLElBQWMsRUFBckM7QUFDRDtBQUNGLEdBVEQ7O0FBV0EsU0FBT0osU0FBUDtBQUNELENBZEQiLCJmaWxlIjoiYWRtaW4vdXNlci9pbmRleC5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCAqIGFzIGNkIGZyb20gJ2NvZGVhZ2VzLWRlc2lnbic7XG5pbXBvcnQgeyBpc0VtcHR5IH0gZnJvbSAnLi4vLi4vbGlicy9jb21tb24vdXRpbHMnO1xuXG5yZXF1aXJlKCcuL2luZGV4Lmxlc3MnKTtcblxuY2xhc3MgSW5kZXgge1xuICBjb25zdHJ1Y3RvcigpIHtcbiAgICBJbmRleC5pbml0Rm9ybSgpO1xuICB9XG5cbiAgc3RhdGljIGluaXRGb3JtKCkge1xuICAgIGlmICghaXNFbXB0eSgkKCcuc2VsZWN0LW9wdGlvbnMnKS5maW5kKFwiW3NlbGVjdGVkPSdzZWxlY3RlZCddXCIpLnRleHQoKSkpIHtcbiAgICAgICQoJy5zZWxlY3QtdmFsdWUnKS50ZXh0KCQoJy5zZWxlY3Qtb3B0aW9ucycpLmZpbmQoXCJbc2VsZWN0ZWQ9J3NlbGVjdGVkJ11cIikudGV4dCgpKTtcbiAgICB9XG5cbiAgICBjZC5zZWxlY3Qoe1xuICAgICAgZWw6ICcjdXNlcl9rZXl3b3JkVHlwZScsXG4gICAgICB0eXBlOiAnc2luZ2xlJ1xuICAgIH0pO1xuICB9XG59XG5cbm5ldyBJbmRleCgpO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vYXNzZXRzL2FkbWluL3VzZXIvaW5kZXguanMiLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpblxuXG5cbi8vLy8vLy8vLy8vLy8vLy8vL1xuLy8gV0VCUEFDSyBGT09URVJcbi8vIC4vYXNzZXRzL2FkbWluL3VzZXIvaW5kZXgubGVzc1xuLy8gbW9kdWxlIGlkID0gLi9hc3NldHMvYWRtaW4vdXNlci9pbmRleC5sZXNzXG4vLyBtb2R1bGUgY2h1bmtzID0gMSIsImNvbnN0IEJyb3dzZXIgPSB7fTtcbmxldCB1c2VyQWdlbnQgPSBuYXZpZ2F0b3IudXNlckFnZW50LnRvTG93ZXJDYXNlKCk7XG5sZXQgcztcblxuKHMgPSB1c2VyQWdlbnQubWF0Y2goL21zaWUgKFtcXGQuXSspLykpID8gQnJvd3Nlci5pZSA9IHNbMV06XG4gIChzID0gdXNlckFnZW50Lm1hdGNoKC9maXJlZm94XFwvKFtcXGQuXSspLykpID8gQnJvd3Nlci5maXJlZm94ID0gc1sxXSA6XG4gICAgKHMgPSB1c2VyQWdlbnQubWF0Y2goL2Nocm9tZVxcLyhbXFxkLl0rKS8pKSA/IEJyb3dzZXIuY2hyb21lID0gc1sxXSA6XG4gICAgICAocyA9IHVzZXJBZ2VudC5tYXRjaCgvb3BlcmEuKFtcXGQuXSspLykpID8gQnJvd3Nlci5vcGVyYSA9IHNbMV0gOlxuICAgICAgICAocyA9IHVzZXJBZ2VudC5tYXRjaCgvdmVyc2lvblxcLyhbXFxkLl0rKS4qc2FmYXJpLykpID8gQnJvd3Nlci5zYWZhcmkgPSBzWzFdIDogMDtcblxuQnJvd3Nlci5pZTEwID0gL01TSUVcXHMrMTAuMC9pLnRlc3QobmF2aWdhdG9yLnVzZXJBZ2VudClcbkJyb3dzZXIuaWUxMSA9ICgvVHJpZGVudFxcLzdcXC4vKS50ZXN0KG5hdmlnYXRvci51c2VyQWdlbnQpO1xuQnJvd3Nlci5lZGdlID0gL0VkZ2VcXC8xMy4vaS50ZXN0KG5hdmlnYXRvci51c2VyQWdlbnQpO1xuXG5cbmNvbnN0IGlzTW9iaWxlRGV2aWNlID0gKCkgPT4ge1xuICByZXR1cm4gbmF2aWdhdG9yLnVzZXJBZ2VudC5tYXRjaCgvKGlQaG9uZXxpUG9kfEFuZHJvaWR8aW9zfGlQYWQpL2kpO1xufTtcblxuY29uc3QgZGVsSHRtbFRhZyA9IChzdHIpID0+IHtcbiAgcmV0dXJuIHN0ci5yZXBsYWNlKC88W14+XSs+L2csICcnKS5yZXBsYWNlKC8mbmJzcDsvaWcsICcnKTtcbn07XG5cbmNvbnN0IGluaXRUb29sdGlwcyA9ICgpID0+IHtcbiAgJCgnW2RhdGEtdG9nZ2xlPVwidG9vbHRpcFwiXScpLnRvb2x0aXAoe1xuICAgIGh0bWw6IHRydWUsXG4gIH0pO1xufTtcblxuY29uc3QgaW5pdFBvcG92ZXIgPSAoKSA9PiB7XG4gICQoJ1tkYXRhLXRvZ2dsZT1cInBvcG92ZXJcIl0nKS5wb3BvdmVyKHtcbiAgICBodG1sOiB0cnVlLFxuICB9KTtcbn1cblxuY29uc3Qgc2VjMlRpbWUgPSAoc2VjKSA9PiB7XG4gIGxldCB0aW1lID0gJyc7XG4gIGxldCBoID0gcGFyc2VJbnQoKHNlYyAlIDg2NDAwKSAvIDM2MDApO1xuICBsZXQgcyA9IHBhcnNlSW50KChzZWMgJSAzNjAwKSAvIDYwKTtcbiAgbGV0IG0gPSBzZWMgJSA2MDtcbiAgaWYgKGggPiAwKSB7XG4gICAgdGltZSArPSBoICsgJzonO1xuICB9XG4gIGlmIChzLnRvU3RyaW5nKCkubGVuZ3RoIDwgMikge1xuICAgIHRpbWUgKz0gJzAnICsgcyArICc6JztcbiAgfSBlbHNlIHtcbiAgICB0aW1lICs9IHMgKyAnOic7XG4gIH1cbiAgaWYgKG0udG9TdHJpbmcoKS5sZW5ndGggPCAyKSB7XG4gICAgdGltZSArPSAnMCcgKyBtO1xuICB9IGVsc2Uge1xuICAgIHRpbWUgKz0gbTtcbiAgfVxuICByZXR1cm4gdGltZTtcbn07XG5cbmNvbnN0IHRpbWUyU2VjID0gKHRpbWUpID0+IHtcbiAgbGV0IGFycnkgPSB0aW1lLnNwbGl0KCc6Jyk7XG4gIGxldCBzZWMgPSAwO1xuICBmb3IgKGxldCBpID0gMDsgaSA8IGFycnkubGVuZ3RoOyBpKyspIHtcbiAgICBpZiAoYXJyeS5sZW5ndGggPiAyKSB7XG4gICAgICBpZiAoaSA9PSAwKSB7XG4gICAgICAgIHNlYyArPSBhcnJ5W2ldICogMzYwMDtcbiAgICAgIH1cbiAgICAgIGlmIChpID09IDEpIHtcbiAgICAgICAgc2VjICs9IGFycnlbaV0gKiA2MDtcbiAgICAgIH1cbiAgICAgIGlmIChpID09IDIpIHtcbiAgICAgICAgc2VjICs9IHBhcnNlSW50KGFycnlbaV0pO1xuICAgICAgfVxuICAgIH1cbiAgICBpZiAoYXJyeS5sZW5ndGggPD0gMikge1xuICAgICAgaWYgKGkgPT0gMCkge1xuICAgICAgICBzZWMgKz0gYXJyeVtpXSAqIDYwO1xuICAgICAgfVxuICAgICAgaWYgKGkgPT0gMSkge1xuICAgICAgICBzZWMgKz0gcGFyc2VJbnQoYXJyeVtpXSk7XG4gICAgICB9XG4gICAgfVxuICB9XG4gIHJldHVybiBzZWM7XG59O1xuXG5jb25zdCBpc0xvZ2luID0gKCkgPT4gJChcIm1ldGFbbmFtZT0naXMtbG9naW4nXVwiKS5hdHRyKFwiY29udGVudFwiKSA9PSAxO1xuXG5jb25zdCBpc0VtcHR5ID0gKG9iaikgPT4ge1xuICByZXR1cm4gb2JqID09PSBudWxsIHx8IG9iaiA9PT0gXCJcIiB8fCBvYmogPT09IHVuZGVmaW5lZCB8fCBPYmplY3Qua2V5cyhvYmopLmxlbmd0aCA9PT0gMDtcbn07XG5cbmNvbnN0IGFycmF5VG9Kc29uID0gKGZvcm1BcnJheSkgPT4ge1xuICBjb25zdCBkYXRhQXJyYXkgPSB7fTtcbiAgJC5lYWNoKGZvcm1BcnJheSwgZnVuY3Rpb24oKSB7XG4gICAgaWYgKGRhdGFBcnJheVt0aGlzLm5hbWVdKSB7XG4gICAgICBpZiAoIWRhdGFBcnJheVt0aGlzLm5hbWVdLnB1c2gpIHtcbiAgICAgICAgZGF0YUFycmF5W3RoaXMubmFtZV0gPSBbZGF0YUFycmF5W3RoaXMubmFtZV1dO1xuICAgICAgfVxuICAgICAgZGF0YUFycmF5W3RoaXMubmFtZV0ucHVzaCh0aGlzLnZhbHVlIHx8ICcnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgZGF0YUFycmF5W3RoaXMubmFtZV0gPSB0aGlzLnZhbHVlIHx8ICcnO1xuICAgIH1cbiAgfSk7XG5cbiAgcmV0dXJuIGRhdGFBcnJheTtcbn07XG5cbmV4cG9ydCB7XG4gIEJyb3dzZXIsXG4gIGlzTG9naW4sXG4gIGlzTW9iaWxlRGV2aWNlLFxuICBkZWxIdG1sVGFnLFxuICBpbml0VG9vbHRpcHMsXG4gIGluaXRQb3BvdmVyLFxuICBzZWMyVGltZSxcbiAgdGltZTJTZWMsXG4gIGFycmF5VG9Kc29uLFxuICBpc0VtcHR5XG59O1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL2Fzc2V0cy9saWJzL2NvbW1vbi91dGlscy5qcyJdLCJzb3VyY2VSb290IjoiIn0=