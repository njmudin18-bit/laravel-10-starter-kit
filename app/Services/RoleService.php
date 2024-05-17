<?php

namespace App\Services;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function dataTable()
    {
      $data = Role::select('*')->where('name', '!=', 'admin')->orderBy('created_at', 'DESC');

      return DataTables::of($data)
      ->addIndexColumn()
      ->editColumn('created_at', function ($row) {
        return Carbon::parse($row->created_at)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
      })
      ->editColumn('updated_at', function ($row) {
        return Carbon::parse($row->updated_at)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
      })
      ->addColumn('action', function ($row) {
        $actionBtn = '';
        if (Gate::allows('update roles')) {
          $actionBtn .= '<button type="button" name="edit" data-id="' . $row->id . '" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete roles')) {
          $actionBtn .= '<button type="button" name="delete" data-id="' . $row->id . '" class="deleteRole btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    // store
    public function store(array $data)
    {
        try {

            // create role
            $role = Role::create($data);

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan.',
                'role' => $role
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ];
        }
    }


    // update role
    public function update($id, $requestData)
    {
        try {
            // check role
            $role = Role::findOrFail($id);

            // update role
            $role->update([
                'name' => $requestData['name'],
                'guard_name' => $requestData['guard_name'],
            ]);

            return [
                'success' => true,
                'message' => 'Data berhasil diperbarui.'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function destroy(Role $role)
    {
        try {
            // delete role
            $role->delete();

            return [
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ];
        }
    }
}
