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

                    @can('create users')
                    <button onclick="window.location.href='/users-create'" id="createMenu" class="btn btn-primary btn-sm ms-3 float-end">
                      <i class="mdi mdi-plus"></i> Tambah
                    </button>
                    @endcan
                  </h5>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 dataTable" width="200%">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="10%">No</th>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">No HP</th>
                            <th class="text-center">Tanggal Lahir</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Alamat</th>
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
    
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @include('components.swaltoast')

    <script>
      $(function() {
        $('body').on('click', '.editUser', function() {
          $('#save-modal').text('Update');
          $('#save-modal').removeClass('disabled');
          var userID = $(this).data('id');
          $.ajax({
            data: {
              "id": userID,
              "_token": "{{ csrf_token() }}"
            },
            url: "{{ route('users.edit') }}",
            type: "POST",
            dataType: "JSON",
            success: function(data) {
              console.log(data);
              // $('[name="kode"]').val(data.data.Id);
              // $('[name="Name"]').val(data.data.Name);
              // $('[name="LinkUrl"]').val(data.data.LinkUrl);

              $('#modalAction').modal('show');
              $('#modalAction .modal-title').html('Edit User');
            },
            error: function(jqXHR, textStatus, errorThrown) {
              Swal.fire(
                'Oops...',
                jqXHR.responseJSON.message,
                textStatus
              );
            }
          });
          // $.get("{{ route('users.edit') }}" + '/' + roleId +, function(response) {
          //   $('#modalAction .modal-title').html('Edit Role');
          //   $('#modalAction .modal-body').html(response);

          //   $('#modalAction').modal('show');
          // })
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
            "url": "{{ route('users.index') }}",
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
              data: 'nama_user',
              name: 'nama_user',
              className: 'text-start'
            },
            {
              data: 'role',
              name: 'role',
              className: 'text-start'
            },
            {
              data: 'no_hp',
              name: 'no_hp',
              className: 'text-start'
            },
            {
              data: 'tanggal_lahir',
              name: 'tanggal_lahir',
              className: 'text-center'
            },
            {
              data: 'jenis_kelamin',
              name: 'jenis_kelamin',
              className: 'text-center'
            },
            {
              data: 'alamat',
              name: 'alamat',
              className: 'text-start'
            }
          ]
        });
      });
    </script>
  </body>
</html>
