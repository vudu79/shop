<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'currencies';
    protected $fillable = ['rate'];

    public function scopeByCode($query, $currencyCode)
    {
        return $query->where('code', $currencyCode);
    }

    public function isMain()
    {
        return $this->is_main ===1;
    }
}
