require('./app.scss');

import NProgress from 'NProgress';
import 'nprogress/nprogress.css';

// loads the jquery package from node_modules
if ($.support.pjax) {
    // $(document).pjax('data-pjax a, a[data-pjax]', '#content-container');
    $(document).on('click', 'a[data-pjax]', function(event) {
        let pjaxContainer = $(event.target).data('pjax-container');

        $.pjax.click(event, {
            container: pjaxContainer,
        });
    });
}

// 顶部加载条，TODO:使用在全局js中
$(document).on('pjax:start', NProgress.start).on('pjax:end', NProgress.done);