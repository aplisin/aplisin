import * as cd from 'codeages-design';
import { isEmpty } from '../common/utils';

class Modal {
  constructor() {
    this.initModal();
  }

  initModal() {
    $('body').on('click', '[href="#modal"], [data-toggle="modal"]', (e) => {
      let url = !isEmpty($(e.target).data('url')) ? $(e.target).data('url') : '';

      cd.modal({
        el: '#cd-modal',
        ajax: !isEmpty(url),
        url: url,
        maskClosable: $(e.target).data('static') === false ? $(e.target).data('static') : true,
      }).on('ok', ($modal, modal) => {
        modal.trigger('close');
      });
    });
  }
}

new Modal();
