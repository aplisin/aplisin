import * as cd from 'codeages-design';
import { isEmpty } from '../../libs/common/utils';

require('./index.less');

class Index {
  constructor() {
    Index.initForm();
  }

  static initForm() {
    if (!isEmpty($('.select-options').find("[selected='selected']").text())) {
      $('.select-value').text($('.select-options').find("[selected='selected']").text());
    }

    cd.select({
      el: '#user_keywordType',
      type: 'single'
    });
  }
}

new Index();
