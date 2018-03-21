/* eslint-disable import/first */
import '../../libs/components/select';
import * as cd from 'codeages-design';
import { isEmpty } from '../../libs/common/utils';

require('./index.less');

class Index {
  constructor () {
    this.initModal();
  }

  initModal() {
    $('body').on('click', '[href="#modal"], [data-toggle="modal"]', (e) => {
      let url = !isEmpty($(e.target).data('url')) ? $(e.target).data('url') : '';

      cd.modal({
        el: '#cd-modal',
        ajax: !isEmpty(url),
        url: url,
        maskClosable: false,
      }).on('ok', ($modal, modal) => {
        modal.trigger('close');
      });
    });
  }
}

new Index();