/* eslint-disable require-jsdoc,max-len,eol-last,no-invalid-this */
require('./app.scss');
import NProgress from 'nprogress';

export default class App {
  constructor() {
    this.init();
  }

  init() {
    this.initializing();
  }

  initializing() {
    // loads the jquery package from node_modules
    if ($.support.pjax) {
      // $(document).pjax('data-pjax a, a[data-pjax]', '#content-container');
      $(document).on('click', 'a[data-pjax]', function(event) {
        let pjaxContainer = $(event.target).data('pjax');

        $.pjax.click(event, {
          container: pjaxContainer,
        });
      });

      $(document).on('pjax:start', NProgress.start).on('pjax:end', NProgress.done);
    }

    $('.sidebar .sidebar-menus .nav-link').on('click', function(event) {
      if ($(event.target).find('i').hasClass('fa-angle-right')) {
        $(event.target).find('.fa-angle-right').removeClass('fa-angle-right').addClass('fa-angle-down');
      } else if ($(event.target).find('i').hasClass('fa-angle-down')) {
        $(event.target).find('.fa-angle-down').removeClass('fa-angle-down').addClass('fa-angle-right');
      }
    });
  }
}

new App();