webpackJsonp([2],{

/***/ "./assets/app/app.js":
/*!***************************!*\
  !*** ./assets/app/app.js ***!
  \***************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {__webpack_require__(/*! ./app.scss */ "./assets/app/app.scss");

// loads the jquery package from node_modules
if ($.support.pjax) {
    // $(document).pjax('data-pjax a, a[data-pjax]', '#content-container');
    $(document).on('click', 'a[data-pjax]', function (event) {
        var pjaxContainer = $(event.target).data('pjax-container');

        $.pjax.click(event, {
            container: pjaxContainer
        });
    });
}
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./assets/app/app.scss":
/*!*****************************!*\
  !*** ./assets/app/app.scss ***!
  \*****************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })

},["./assets/app/app.js"]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwL2FwcC5zY3NzP2VlNTYiXSwibmFtZXMiOlsicmVxdWlyZSIsIiQiLCJzdXBwb3J0IiwicGpheCIsImRvY3VtZW50Iiwib24iLCJldmVudCIsInBqYXhDb250YWluZXIiLCJ0YXJnZXQiLCJkYXRhIiwiY2xpY2siLCJjb250YWluZXIiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7eUNBQUEsbUJBQUFBLENBQVEseUNBQVI7O0FBRUE7QUFDQSxJQUFJQyxFQUFFQyxPQUFGLENBQVVDLElBQWQsRUFBb0I7QUFDaEI7QUFDQUYsTUFBRUcsUUFBRixFQUFZQyxFQUFaLENBQWUsT0FBZixFQUF3QixjQUF4QixFQUF3QyxVQUFTQyxLQUFULEVBQWdCO0FBQ3BELFlBQUlDLGdCQUFnQk4sRUFBRUssTUFBTUUsTUFBUixFQUFnQkMsSUFBaEIsQ0FBcUIsZ0JBQXJCLENBQXBCOztBQUVBUixVQUFFRSxJQUFGLENBQU9PLEtBQVAsQ0FBYUosS0FBYixFQUFvQjtBQUNoQkssdUJBQVdKO0FBREssU0FBcEI7QUFHSCxLQU5EO0FBT0gsQzs7Ozs7Ozs7Ozs7OztBQ1pELHlDIiwiZmlsZSI6ImFwcC9hcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyJyZXF1aXJlKCcuL2FwcC5zY3NzJyk7XG5cbi8vIGxvYWRzIHRoZSBqcXVlcnkgcGFja2FnZSBmcm9tIG5vZGVfbW9kdWxlc1xuaWYgKCQuc3VwcG9ydC5wamF4KSB7XG4gICAgLy8gJChkb2N1bWVudCkucGpheCgnZGF0YS1wamF4IGEsIGFbZGF0YS1wamF4XScsICcjY29udGVudC1jb250YWluZXInKTtcbiAgICAkKGRvY3VtZW50KS5vbignY2xpY2snLCAnYVtkYXRhLXBqYXhdJywgZnVuY3Rpb24oZXZlbnQpIHtcbiAgICAgICAgbGV0IHBqYXhDb250YWluZXIgPSAkKGV2ZW50LnRhcmdldCkuZGF0YSgncGpheC1jb250YWluZXInKTtcblxuICAgICAgICAkLnBqYXguY2xpY2soZXZlbnQsIHtcbiAgICAgICAgICAgIGNvbnRhaW5lcjogcGpheENvbnRhaW5lcixcbiAgICAgICAgfSk7XG4gICAgfSk7XG59XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9hc3NldHMvYXBwL2FwcC5qcyIsIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luXG5cblxuLy8vLy8vLy8vLy8vLy8vLy8vXG4vLyBXRUJQQUNLIEZPT1RFUlxuLy8gLi9hc3NldHMvYXBwL2FwcC5zY3NzXG4vLyBtb2R1bGUgaWQgPSAuL2Fzc2V0cy9hcHAvYXBwLnNjc3Ncbi8vIG1vZHVsZSBjaHVua3MgPSAyIl0sInNvdXJjZVJvb3QiOiIifQ==