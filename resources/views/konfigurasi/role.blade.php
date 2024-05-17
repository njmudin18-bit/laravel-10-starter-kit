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
                  <h5 class="card-header bg-transparent border-bottom">
                    {{ $SubTitle }}

                    @can('create roles')
                    <button id="createRole" class="btn btn-primary btn-sm ms-3 float-end">
                      <i class="mdi mdi-plus"></i> Tambah
                    </button>
                    @endcan
                  </h5>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 dataTable">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="10%">No</th>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center" width="18%">Created</th>
                            <th class="text-center" width="18%">Updated</th>
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
    <x-modal id="modalAction" title="Modal title" size="lg"></x-modal>
    
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
          $.get("{{ route('roles.index') }}" + '/' + roleId + '/edit', function(response) {
            $('#modalAction .modal-title').html('Edit Role');
            $('#modalAction .modal-body').html(response);

            $('#modalAction').modal('show');
          })
        });

        // DEETE
        $('body').on('click', '.deleteRole', function() {
          var roleId = $(this).data('id');
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
                url: "{{ url('roles') }}/" + roleId,
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
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

        // SAVE
        $('#save-modal').click(function(e) {
          e.preventDefault();
          $(this).html('Sending..');
          $(this).addClass('disabled');
          var id = $('#roleId').val();

          $.ajax({
              data: $('#form-modalAction').serialize(),
              url: `{{ url('roles/') }}/${id}`,
              type: "POST",
              dataType: 'json',
              success: function(response) {
                $('#modalAction').modal('hide');
                table.draw();
                showToast('success', response.message);
                $('#save-modal').html('Save');
                $('#save-modal').removeClass('disabled');
              },
              error: function(response) {
                var errors = response.responseJSON.errors;
                if (errors) {
                  Object.keys(errors).forEach(function(key) {
                    var errorMessage = errors[key][0];
                    $('#' + key).siblings('.text-danger').text(errorMessage).show();
                  });
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
          order: [[1, 'desc']], //[2, 'desc']
          ajax: {
            "url": "{{ route('roles.index') }}",
            "type": "GET",
          },
          columns: [
            {
              data: 'DT_RowIndex', 
              name: 'DT_RowIndex',
              orderable: false, 
              searchable: false,
              className: 'text-end'
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
              data: 'created_at',
              name: 'created_at',
              className: 'text-center'
            },
            {
              data: 'updated_at',
              name: 'updated_at',
              className: 'text-center'
            }
          ]
        });
      });
    </script>
  </body>
</html>
