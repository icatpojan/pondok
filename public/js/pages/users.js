var tableUsers;

/**
 * Render table users.
 *
 * @param   string
 * @param   object
 * @return  void
 */
function renderTableUsers(key, user) {
  let actions = '<button class="btn btn-danger btn-icon-split btn-sm" onClick="' + `confirmDeleteUser('${user.id}', '${user.username}')` + '">\
                  <span class="icon text-white-50">\
                    <i class="fas fa-trash"></i>\
                  </span>\
                 </button>\
                 <button class="btn btn-success btn-icon-split btn-sm" onClick="' + `editUser('${key}')` + '">\
                  <span class="icon text-white-50">\
                    <i class="fas fa-pen"></i>\
                  </span>\
                 </button>'
  let image = '<img src="/img/' + `${user.signature}` + '"width="150px">'

  return [
    (parseInt(key) + 1 + tableUsers.paginate.offset),
    (user.username || '-'),
    (user.email || '-'),
    (user.role_name || '-'),
    (image || '-'),
    actions
  ];
}

/**
 * Confirm delete selected user.
 *
 * @param   string
 * @param   string
 * @return  void
 */
function confirmDeleteUser(userId, userName) {
  swal({
    text: `Are you sure want to delete "${userName}" ?`,
    buttons: {
      confirm: 'Yes',
      cancel: 'Cancel'
    }
  }).then(function (result) {
    if (result) {
      swal({
        text: 'delete user...',
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false
      });

      $.ajax({
        type: 'DELETE',
        url: api1URL(`/user/${userId}`),
        processData: false,
        contentType: false,
        success: function (data) {
          swal({
            text: data.message,
            icon: 'success',
            button: 'OK'
          }).then(function () {
            openListUser();
          })
        },
        error: function (jqXHR, error, status) {
          if (jqXHR.status === 400) {
            swal({
              text: jqXHR.responseJSON.message,
              button: 'OK'
            });
          } else if (jqXHR.status === 422) {
            swal({
              text: jqXHR.responseJSON.message,
              button: 'OK'
            });
          } else {
            swal({
              icon: 'error',
              text: status.toString()
            });
          }
        }
      });
    };
  });
}

/**
 * Edit selected user.
 *
 * @param   string
 * @return  void
 */
function editUser(userKey) {
  const selectedUser = tableUsers.paginate.data[userKey];

  openFormUser(selectedUser);
}

/**
 * Open Form User.
 *
 * @param   mixed
 * @return  void
 */
var formUserOpened = false;

function openFormUser(user) {
  user = user || {};

  $('#ListUser').hide();
  $('#FormUser').show();

  setListRole('#SelectUserRole', user.role_name);
  $('#InputUserId').val(user.id || '');
  $('#InputFullname').val(user.fullname || '');
  $('#InputUsername').val(user.username || '');
  $('#InputUserEmail').val(user.email || '');

  if (user.id) {
    $('#InputUserPassword').removeAttr('required');
    $('#InputUserRePassword').removeAttr('required');
    $('#InputPassword').hide();
  } else {
    $('#InputUserPassword').attr('required');
    $('#InputUserRePassword').attr('required');
    $('#InputPassword').show();
  }

  formUserOpened = true;
}

/**
 * Confirm save user.
 *
 * @param   jquery
 * @return  void
 */
function confirmSaveUser(jq) {
  if (jq.preventDefault) {
    jq.preventDefault();
  }

  swal({
    text: 'save user ...',
    buttons: false,
    closeOnClickOutside: false,
    closeOnEsc: false
  });

  const data = new FormData(jq.target);
  let userId = '';

  if (data.get('id')) {
    userId = '/' + data.get('id');

    data.set('_method', 'PUT');
  }

  $.ajax({
    type: 'POST',
    url: api1URL(`/user${userId}`),
    data: data,
    processData: false,
    contentType: false,
    success: function (data) {
      swal({
        text: data.message,
        icon: 'success',
        button: 'OK'
      }).then(function () {
        openListUser();
      })
    },
    error: function (jqXHR, error, status) {
      if (jqXHR.status === 400) {
        swal({
          text: jqXHR.responseJSON.message,
          button: 'OK'
        });
      } else if (jqXHR.status === 422) {
        swal({
          text: jqXHR.responseJSON.message,
          button: 'OK'
        });
      } else {
        swal({
          icon: 'error',
          text: status.toString()
        });
      }
    }
  });
}

/**
 * Open list user
 * close all form and reload list.
 *
 * @return  void
 */
function openListUser() {
  $('#FormUser').hide();
  $('#ListUser').show();
  tableUsers.reloadPage();
}

$(document).ready(function () {
  tableUsers = new CustomDataTable({
    id: '#TableUsers',
    url: api1URL('/users'),
    dataSrc: 'users',
    render: renderTableUsers
  });

  $('#BtnAddUser').click(openFormUser);
  $('#FormSearch').on('submit', tableUsers.reloadDataWithForm);
  $('#FormUser form').on('submit', confirmSaveUser);
});
