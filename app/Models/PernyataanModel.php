<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PernyataanModel extends Model
{
  protected $table    = 'ms_pernyataan';
  public $timestamps  = false;

  protected $fillable = [
    'Id',
    'Pernyataan',
    'StatusAktivasi',
    'CreatedDate',
    'CreatedBy',
    'UpdatedDate',
    'UpdatedBy'
  ];

  use HasFactory;
}
