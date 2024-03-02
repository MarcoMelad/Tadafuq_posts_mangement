<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'contact_phone',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeByUser($query, $user_id = null)
    {
        $user_id = $user_id ?? getCurrentUser()->id;
        return $query->where('user_id', $user_id);
    }

}
