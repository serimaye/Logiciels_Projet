<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Logiciel extends Model
{
    use HasFactory;

    protected $table = 'logiciels';

    protected $fillable = [
        'name',
        'category_id',
        'image',
        'version',
        'description',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
