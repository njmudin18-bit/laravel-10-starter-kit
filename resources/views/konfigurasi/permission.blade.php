<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ $SubTitle }} | {{ config('appsproperties.APPS_NAME') }}</title>
    <!-- Meta header and App favicon start -->
    <x-meta-header :subtitle="$SubTitle"></x-metas>
    <!-- Meta header and App favicon end -->
    <!-- DataTables start -->
    <x-css-datatable></x-css-datatable>
    <!-- DataTables end -->
    <!-- Css standard start -->
    <x-css-standard></x-css-standard>
    <!-- Css standard end -->
  </head>
  <body data-sidebar="dark" data-layout-mode="light">
    <!-- Begin page -->
    <div id="layout-wrapper">
      <!-- Topbar start -->
      <x-top-bar />
      <!-- Topbar start end -->

      <!-- Left Sidebar Start -->
      <x-left-side-bar />
      <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content">
        <div class="page-content">
          <div class="container-fluid">
            <!-- start page title -->
            <x-page-title :title="$Title" :subtitle="$SubTitle" />
            <!-- end page title -->

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <h5 class="card-header bg-transparent border-bottom">{{ $SubTitle }}</h5>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 dataTable">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="5%">No</th>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center" width="20%">Role</th>
                            <th class="text-center">Permission</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> <!-- end col -->
            </div> <!-- end row -->
          </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        
        <!-- Footer start -->
        <x-footer-bar />
        <!-- Footer end -->
      </div>
      <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <x-right-side-bar />
    <!-- /Right-bar -->

    <!-- JAVASCRIPT start -->
    <x-js-standard></x-js-standard>
    <!-- JAVASCRIPT end -->

    <!-- Datatable start -->
    <x-js-datatable></x-js-datatable>
    <!-- Datatable end -->

    <!-- Modal -->
    <x-modal id="modalAction" title="Modal title" size="fullscreen"></x-modal>
    <!-- <x-modal id="modalAction" title="Modal title" size="lg"></x-modal> -->
    
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @include('components.swaltoast')

    <script>
      $(function() {
        // CREATE
        $('#createRole').click(function() {
          $('#save-modal').text('Simpan');
          $('#save-modal').removeClass('disabled');
          $.get("{{ route('roles.create') }}", function(response) {
            $('#modalAction .modal-title').html('Tambah Role');
            $('#modalAction .modal-body').html(response);

            $('#modalAction').modal('show');
          })
        });

        // EDIT
        $('body').on('click', '.editRole', function() {
          $('#save-modal').text('Update');
          $('#save-modal').removeClass('disabled');
          var roleId = $(this).data('id');
          $.get("{{ route('permissions.index') }}" + '/' + roleId + '/edit', function(response) {
            $('#modalAction .modal-title').html('Edit Permission');
            $('#modalAction .modal-body').html(response);

            $('#modalAction').modal('show');
          })
        });

        // DELETE
        $(document).on('click', '.delete-permission', function(e) {
          var permissionId = $(this).data('permission-id');
          var roleId = $(this).data('role-id');

          Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang di hapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#82868',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                type: "DELETE",
                url: "{{ url('permissions') }}/" + permissionId,
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                  role_id: roleId
                },
                success: function(response) {
                  table.draw();
                  showToast('success', response.message);
                },
                error: function(response) {
                  var errorMessage = response.responseJSON.message;
                  showToast('error', errorMessage);
                }
              });
            }
          });
        });

        // SELECT ALL
        $(document).on('change', '#checkAll', function() {
          var isChecked = $(this).prop('checked');

          if (isChecked) {
            $('.permission-item:visible .permission-checkbox').prop('checked', true);
          } else {
            $('.permission-checkbox').prop('checked', false);
          }
        });

        // SEARCH PERMISSION
        $(document).on('input', '#searchPermission', function() {
          var searchValue = $(this).val().toLowerCase();
          var permissionItems = $('.permission-item');
          var showSelectAll = false;

          permissionItems.each(function() {
            var label = $(this).find('.form-check-label');
            var permissionName = label.text().toLowerCase();

            if (permissionName.includes(searchValue)) {
              $(this).show();
              showSelectAll = true;
            } else {
              $(this).hide();
            }
          });

          var selectAllCheckbox = $('#checkAll');
          if (selectAllCheckbox.length > 0) {
            selectAllCheckbox.closest('.row').css('display', showSelectAll ? 'block' : 'none');
          }
        });

        // SAVE
        $('#save-modal').click(function(e) {
          e.preventDefault();
          $(this).html('Sending..');
          $(this).addClass('disabled');

          $.ajax({
            data: $('#form-modalAction').serialize(),
            url: `{{ route('permissions.store') }}`,
            type: "POST",
            dataType: 'json',
            success: function(response) {
                $('#modalAction').modal('hide');
                table.draw();
                if (response.status == true) {
                    showToast('success', response.message);
                } else {
                    showToast('error', response.message);
                }
                $('#save-modal').html('Save');
                $('#save-modal').removeClass('disabled');
            },
            error: function(response) {
              if (response.responseJSON && response.responseJSON.errors) {
                var errors = response.responseJSON.errors;
                if (errors.hasOwnProperty('permissions')) {
                  var errorMessage = errors['permissions'][0];
                  $('#permissions-error').removeClass('d-none');
                  $('#permissions-error').text(errorMessage).show();
                }
              }

              $('#save-modal').html('Save');
              $('#save-modal').removeClass('disabled');
            }
          });
        });
      });

      $(document).ready(function () {
        table = $('#datatable-buttons').DataTable({ 
          pagingType: "full_numbers",
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          responsive: false,
          processing: true,
          serverSide: true,
          order: [[1, 'desc']],
          ajax: {
            "url": "{{ route('permissions.index') }}",
            "type": "GET",
          },
          columns: [
            {
              data: 'id',
              name: 'id',
              orderable: true,
              searchable: false,
              className: 'text-end',
              render: function(data, type, full, meta) {
                return meta.row + 1;
              }
            },
            {
              data: 'action',
              name: 'action',
              orderable: false,
              searchable: false,
              className: 'text-center'
            },
            {
              data: 'name',
              name: 'name',
              className: 'text-start'
            },
            {
              data: 'permissions',
              name: 'permissions',
              className: 'text-start'
            }
          ]
        });
      });
    </script>
  </body>
</html>
