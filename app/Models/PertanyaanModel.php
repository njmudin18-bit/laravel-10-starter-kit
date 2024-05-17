<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanModel extends Model
{
  protected $table    = 'ms_pertanyaan';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Pertanyaan',
    'StatusAktivasi',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
