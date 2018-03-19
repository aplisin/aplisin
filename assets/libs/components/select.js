import * as cd from 'codeages-design';
import { isEmpty } from '../common/utils';

class Select {
  constructor() {
    Select.initSelect();
  }

  static initSelect() {
    if (!isEmpty('.cd-select-single')) {
      cd.select({
        el: '.cd-select-single',
        type: 'single'
      });
    }

    if (!isEmpty('.cd-select-multiple')) {
      cd.select({
        el: '.cd-select-multiple',
        type: 'multiple'
      });
    }

    if (!isEmpty($(".select-options [selected='selected']").text())) {
      $('.select-value').text($(".select-options [selected='selected']").text());
    }
  }
}

new Select();
