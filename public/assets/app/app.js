webpackJsonp([1],{

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