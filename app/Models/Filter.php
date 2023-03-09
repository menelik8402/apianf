<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gift;

class Filter extends Model
{
    use HasFactory;
    protected $table = 'filter';

    public function gifts()
    {
       return $this->hasMany(Gift::class);
    }
}
