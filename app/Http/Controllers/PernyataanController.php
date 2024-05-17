<?php

namespace App\Http\Controllers;

// use App\Http\Requests\PertanyaanRequest;
use App\Models\PernyataanModel;
use Illuminate\Http\Request;
use App\Services\PernyataanService;
use Validator;

class PernyataanController extends Controller
{
  protected $pernyataanService;

  public function __construct(PernyataanService $pernyataanService)
  {
    $this->middleware('can:read pernyataan');
    $this->pernyataanService = $pernyataanService;
  }

  public function index(Request $request)
  {
    $Title    = "Master Data";
    $SubTitle = "Pernyataan";
    if ($request->ajax()) {
      return $this->pernyataanService->dataTable();
    }

    return view('pernyataan.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Pernyataan'      => 'required|string',
      'StatusAktivasi'  => 'required|string|max:5',
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $result = $this->pernyataanService->store($request->all());

    return response()->json($result);
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->pernyataanService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Pernyataan'      => 'required|string',
      'StatusAktivasi'  => 'required|string|max:5',
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $result = $this->pernyataanService->update($request->all());

    return $result;
  }

  public function hapus(PernyataanModel $pernyataan, Request $request)
  {
    $Id     = $request['id'];
    $result = $this->pernyataanService->destroy($Id);

    return response()->json($result);
  }
}
