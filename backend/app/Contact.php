<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
      'salesman_name',
      'enterprise_name',
      'contact_name',
      'email',
      'phone',
      'contact_date',
      'validate_date'
    ];
}
