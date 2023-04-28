<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountRecoveryQuestion extends Model
{
    use HasFactory;

    protected $fillable = [ 'question'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
