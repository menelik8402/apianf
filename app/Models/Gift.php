<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Filter;

class Gift extends Model
{
    use HasFactory;

    protected $table = 'gift';
    
    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }
}
