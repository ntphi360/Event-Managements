<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attendee;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','start_time','end_time','user_id']; 
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function attendees(){
        return $this->hasMany(Attendee::class);
    }
}