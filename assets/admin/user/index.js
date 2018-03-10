require('./index.less');

class Index {
  constructor() {
    this.initForm();
  }

  initForm() {
    cd.select({
      el: '#user_keywordType',
      type: 'single'
    });
  }
}

new Index();
