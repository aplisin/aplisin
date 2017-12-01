require('./app.scss');

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
