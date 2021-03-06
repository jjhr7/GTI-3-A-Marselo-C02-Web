<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['serial','model','description'];
    protected $guarded = [''];

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

}
