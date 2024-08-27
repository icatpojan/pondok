/**
 * Pagination
 * make pagination menu.
 *
 * @author    Musa Sutisna <mus4.sutisn4@gmail.com> (http://gitlab.com/mu545)
 * @link      Gitlab <git@gitlab.com:mu545/javascripts.git> (http://gitlab.com/mu545/javascripts)
 * @license   MIT (http://gitlab.com/mu545/javascripts/LICENSE)
 * @version   1.0
 * @updated   28 Nov 2018
 */

/**
 * Pagination
 *
 * @param   dom       element to embed pagination
 * @param	  object    pagination option
 *          length    total of data per page
 *          offset    current of data offset
 *          total     total of data
 *          numbers   number of button page to show
 *          callback  function will call on page clicked
 * @return  void
 */
var Pagination = function (domPage, option) {
  // a.k.a this
  let self = this;

  // page set
  let config = {
    length : 10,
    offset : 1,
    total : 0,
    numbers : 5,
    callback : null
  };

  /**
   * Initialization.
   *
   * @return	void
   */
  let init = function () {
    self.reload(option);
  };

  /**
   * Set config.
   *
   * @param	object		pagination option
   * @return	void
   */
  this.setConfig = function (option) {
    if (typeof option != 'undefined') {
      config.length = typeof option.length != 'undefined' ? option.length : config.length;
      config.offset = typeof option.offset != 'undefined' ? option.offset : config.offset;
      config.total = typeof option.total  != 'undefined' ? option.total : config.total;
      config.numbers = typeof option.numbers != 'undefined' ? option.numbers : config.numbers;
      config.callback = typeof option.callback === 'function' ? option.callback : config.callback;
    }
  };

  /**
   * Reload page.
   *
   * @param	object		pagination option
   * @return	void
   */
  this.reload = function (option) {
    self.setConfig(option);

    let html = $('<ul class="pagination">');
    let totalPage = Math.ceil(config.total / config.length);
    let currentPage = Math.ceil((config.offset + 1) / config.length);
        currentPage = currentPage == 0 ? 1 : currentPage;
    let firstPage = (currentPage % config.numbers);
        firstPage = (firstPage == 0 ? (currentPage - config.numbers) : (currentPage - firstPage)) + 1;
    let lastPage = (firstPage + config.numbers) - 1;
        lastPage = lastPage >= totalPage ? totalPage : lastPage;
    let previousPage = currentPage - 1;
    let nextPage = currentPage + 1;

    if (previousPage >= 1) {
      $('<li class="page-item"><a class="page-link" href="javascript:void(0)"><i class="fas fa-chevron-left"></i></a></li>')
        .click({page : previousPage}, self.click)
        .appendTo(html);
    } else {
      $('<li class="page-item"><a class="page-link" href="javascript:void(0)"><i class="fas fa-chevron-left"></i></a></li>')
        .appendTo(html);
    }

    for (var numberPage = firstPage; numberPage <= lastPage; numberPage++) {
      if (numberPage === currentPage) {
        $('<li class="page-item active"><a class="page-link">' + numberPage + '</a></li>').appendTo(html);
      } else {
        $('<li class="page-item"><a class="page-link" href="javascript:void(0)">' + numberPage + '</a></li>')
          .click({page : numberPage}, self.click)
          .appendTo(html);
      }
    }

    if (nextPage <= totalPage) {
      $('<li class="page-item"><a class="page-link" href="javascript:void(0)"><i class="fas fa-chevron-right"></i></a></li>')
        .click({page : nextPage}, self.click)
        .appendTo(html);
    } else {
      $('<li class="page-item"><a class="page-link" href="javascript:void(0)"><i class="fas fa-chevron-right"></i></a></li>')
        .appendTo(html);
    }

    domPage.html(html);
  };

  /**
   * Click page.
   *
   * @param	jquery
   * @return	void
   */
  this.click = function (e) {
    if (typeof config.callback === 'function') {
      let dataPage = {
        page : e.data.page,
        length : config.length,
        offset : ((e.data.page * config.length) - config.length)
      };

      config.callback(dataPage);
    }
  };

  // Run init
  init();
};
