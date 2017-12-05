webpackJsonp([2],{

/***/ "./assets/web/app.js":
/*!***************************!*\
  !*** ./assets/web/app.js ***!
  \***************************/
/*! no exports provided */
/*! all exports used */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_nprogress__ = __webpack_require__(/*! nprogress */ "./node_modules/nprogress/nprogress.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_nprogress___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_nprogress__);
__webpack_require__(/*! ./app.scss */ "./assets/web/app.scss");


// loads the jquery package from node_modules
if ($.support.pjax) {
  // $(document).pjax('data-pjax a, a[data-pjax]', '#content-container');
  $(document).on('click', 'a[data-pjax]', function (event) {
    var pjaxContainer = $(event.target).data('pjax');

    $.pjax.click(event, {
      container: pjaxContainer
    });
  });

  $(document).on('pjax:start', __WEBPACK_IMPORTED_MODULE_0_nprogress___default.a.start).on('pjax:end', __WEBPACK_IMPORTED_MODULE_0_nprogress___default.a.done);
}
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/web/app.scss":
/*!*****************************!*\
  !*** ./assets/web/app.scss ***!
  \*****************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })

},["./assets/web/app.js"]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvd2ViL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvd2ViL2FwcC5zY3NzP2UyNTgiXSwibmFtZXMiOlsicmVxdWlyZSIsIiQiLCJzdXBwb3J0IiwicGpheCIsImRvY3VtZW50Iiwib24iLCJldmVudCIsInBqYXhDb250YWluZXIiLCJ0YXJnZXQiLCJkYXRhIiwiY2xpY2siLCJjb250YWluZXIiLCJOUHJvZ3Jlc3MiLCJzdGFydCIsImRvbmUiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7O0FBQUEsbUJBQUFBLENBQVEseUNBQVI7QUFDQTs7QUFFQTtBQUNBLElBQUlDLEVBQUVDLE9BQUYsQ0FBVUMsSUFBZCxFQUFvQjtBQUNsQjtBQUNBRixJQUFFRyxRQUFGLEVBQVlDLEVBQVosQ0FBZSxPQUFmLEVBQXdCLGNBQXhCLEVBQXdDLFVBQVNDLEtBQVQsRUFBZ0I7QUFDdEQsUUFBSUMsZ0JBQWdCTixFQUFFSyxNQUFNRSxNQUFSLEVBQWdCQyxJQUFoQixDQUFxQixNQUFyQixDQUFwQjs7QUFFQVIsTUFBRUUsSUFBRixDQUFPTyxLQUFQLENBQWFKLEtBQWIsRUFBb0I7QUFDbEJLLGlCQUFXSjtBQURPLEtBQXBCO0FBR0QsR0FORDs7QUFRQU4sSUFBRUcsUUFBRixFQUFZQyxFQUFaLENBQWUsWUFBZixFQUE2QixpREFBQU8sQ0FBVUMsS0FBdkMsRUFBOENSLEVBQTlDLENBQWlELFVBQWpELEVBQTZELGlEQUFBTyxDQUFVRSxJQUF2RTtBQUNELEM7Ozs7Ozs7Ozs7Ozs7QUNmRCx5QyIsImZpbGUiOiJ3ZWIvYXBwLmpzIiwic291cmNlc0NvbnRlbnQiOlsicmVxdWlyZSgnLi9hcHAuc2NzcycpO1xuaW1wb3J0IE5Qcm9ncmVzcyBmcm9tICducHJvZ3Jlc3MnO1xuXG4vLyBsb2FkcyB0aGUganF1ZXJ5IHBhY2thZ2UgZnJvbSBub2RlX21vZHVsZXNcbmlmICgkLnN1cHBvcnQucGpheCkge1xuICAvLyAkKGRvY3VtZW50KS5wamF4KCdkYXRhLXBqYXggYSwgYVtkYXRhLXBqYXhdJywgJyNjb250ZW50LWNvbnRhaW5lcicpO1xuICAkKGRvY3VtZW50KS5vbignY2xpY2snLCAnYVtkYXRhLXBqYXhdJywgZnVuY3Rpb24oZXZlbnQpIHtcbiAgICBsZXQgcGpheENvbnRhaW5lciA9ICQoZXZlbnQudGFyZ2V0KS5kYXRhKCdwamF4Jyk7XG5cbiAgICAkLnBqYXguY2xpY2soZXZlbnQsIHtcbiAgICAgIGNvbnRhaW5lcjogcGpheENvbnRhaW5lcixcbiAgICB9KTtcbiAgfSk7XG5cbiAgJChkb2N1bWVudCkub24oJ3BqYXg6c3RhcnQnLCBOUHJvZ3Jlc3Muc3RhcnQpLm9uKCdwamF4OmVuZCcsIE5Qcm9ncmVzcy5kb25lKTtcbn1cblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL2Fzc2V0cy93ZWIvYXBwLmpzIiwiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW5cblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL2Fzc2V0cy93ZWIvYXBwLnNjc3Ncbi8vIG1vZHVsZSBpZCA9IC4vYXNzZXRzL3dlYi9hcHAuc2Nzc1xuLy8gbW9kdWxlIGNodW5rcyA9IDIiXSwic291cmNlUm9vdCI6IiJ9