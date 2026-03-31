<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    protected $casts = [
        'gender' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFUllNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getGenderLabelAttribute(): string
    {
        return match ($this->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        };
    }
}
