<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Yahan hum Laravel ko bata rahe hain ke in 4 columns mein data save karna allowed hai
    protected $fillable = [
        'user_id', 
        'media_id', 
        'media_type', 
        'review_text'
    ];

    // Ek review kisi ek user ka hota hai
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}