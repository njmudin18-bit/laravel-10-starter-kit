<?php

namespace App\Http\Controllers;

use App\Http\Requests\PertanyaanRequest;
use App\Models\PertanyaanModel;
use Illuminate\Http\Request;
use App\Services\PertanyaanService;
use Validator;

class PertanyaanController extends Controller
{
  protected $pertanyaanService;

  public function __construct(PertanyaanService $pertanyaanService)
  {
    $this->middleware('can:read pertanyaan');
    $this->pertanyaanService = $pertanyaanService;
  }

  public function index(Request $request)
  {
    $Title    = "Master Data";
    $SubTitle = "Pertanyaan";
    if ($request->ajax()) {
      return $this->pertanyaanService->dataTable();
    }

    return view('pertanyaan.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Pertanyaan'      => 'required|string',
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

    $result = $this->pertanyaanService->store($request->all());

    return response()->json($result);
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->pertanyaanService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Pertanyaan'      => 'required|string',
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

    $result = $this->pertanyaanService->update($request->all());

    return $result;
  }

  public function hapus(PertanyaanModel $pertanyaan, Request $request)
  {
    $Id     = $request['id'];
    $result = $this->pertanyaanService->destroy($Id);

    return response()->json($result);
  }
}
