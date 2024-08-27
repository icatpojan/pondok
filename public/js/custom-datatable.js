/**
 * Custom datatable.
 *
 * @sweetalertjs
 * @pagination    1.0.0
 * @param         object
 */
const CustomDataTable = function (config) {
  // a.k.a this
  const self = this;

  // instance of current datatable
  self.instance = null;

  // pagination resource
  self.paginate = {
    offset: 0,
    length: config.paginate || 10,
    total: 0,
    numbers: 5,
    callback: function (page) {
      self.changePage(page)
    },
    query: [],
    instance: null,
    data: []
  };

  /**
   * Data initialization.
   *
   * @return void
   */
  const init = function () {


    swal({
      text: 'loading ...',
      buttons: false,
      closeOnClickOutside: false,
      closeOnEsc: false
    });

    const data = $(config.formId).serializeArray();

    for (var query of data) {
      self.paginate.query[query.name] = query.value;
    }

    self.instance = $(config.id).DataTable({
      serverSide: true,
      ajax: {
        type: 'GET',
        url: config.url,
        data: self.data,
        dataSrc: self.render,
        error: function (err) {
          swal({
            text: err.responseJSON.message,
            icon: 'error',
            button: 'OK'
          });
        }
      },
      lengthChange: false,
      searching: false,
      ordering: false,
      destroy: true,
      paging: false,
      infoCallback: self.info,
      responsive: false,
      createdRow: function (row, data, dataIndex) {
      },
    });

    self.instance.on('xhr.dt', self.xhrDt);
    self.instance.on('draw.dt', self.drawDt);
  }

  /**
   * Data will be send to server.
   *
   * @param   object
   * @return  void
   */
  self.data = function (query) {
    let data = config.data ? config.data() : {};

    return {
      offset: self.paginate.offset,
      length: self.paginate.length,
      ...self.paginate.query,
      ...data
    }
  }

  /**
   * Render result data source.
   *
   * @param   object
   */
  self.render = function (json) {
    const selectedData = json.data[config.dataSrc] || [];
    const resultData = [];

    for (var key in selectedData) {
      resultData.push(config.render(key, selectedData[key]));
    }

    // update pagination
    self.paginate.offset = parseInt(json.data.offset);
    self.paginate.length = parseInt(json.data.length);
    self.paginate.total = parseInt(json.data.total);
    self.paginate.data = selectedData;

    if (self.paginate.instance === null) {
      self.paginate.instance = new Pagination($('#Pagination'), self.paginate);
    } else {
      self.paginate.instance.reload({
        offset: self.paginate.offset,
        length: self.paginate.length,
        total: self.paginate.total
      });
    }

    return resultData;
  }

  /**
   * Info of tables.
   *
   * @return  void
   */
  self.info = function (settings, start, end, max, total, pre) {
    return (`${config.dataSrc} ${self.paginate.offset + 1} to ${(self.paginate.offset + self.paginate.length) > total ? total : (self.paginate.offset + self.paginate.length)} from ${total}`);
  };

  /**
   * Handle on datable recive data.
   *
   * @return  void
   */
  self.xhrDt = function (e, setting, json, xhr) {
    json.recordsTotal = parseInt(json.data.total);
    json.recordsFiltered = parseInt(json.data.total);
  };

  /**
   * Handle on datable completed draw data.
   *
   * @return  void
   */
  self.drawDt = function (e, setting, json, xhr) {
    swal.close();
  };

  /**
   * Reload table data.
   *
   * @param   jquery
   * @return  void
   */
  self.reloadDataWithForm = function (jq) {
    if (jq.preventDefault) {
      jq.preventDefault();
    }
    swal({
      text: 'search data...',
      buttons: false,
      closeOnClickOutside: false,
      closeOnEsc: false
    });
    const data = $(jq.target).serializeArray();

    for (var query of data) {
      self.paginate.query[query.name] = query.value;
    }

    self.paginate.offset = 0;
    self.paginate.total = 0;
    self.paginate.length = $("#pagination").val() || 10;

    self.instance.ajax.reload();
  }

  /**
   * Change page.
   *
   * @param   object
   * @return  void
   */
  self.changePage = function (page) {
    swal({
      text: 'loading ...',
      buttons: false,
      closeOnClickOutside: false,
      closeOnEsc: false
    });

    self.paginate.offset = page.offset;

    self.instance.ajax.reload();
  }

  /**
   * Reload page.
   *
   * @param   object
   * @return  void
   */
  self.reloadPage = function (page) {
    swal({
      text: 'loading ...',
      buttons: false,
      closeOnClickOutside: false,
      closeOnEsc: false
    });

    self.instance.ajax.reload();
  }

  init();
};
