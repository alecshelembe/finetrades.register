<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRegistration extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'daily_registration';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'email',
        'login_time',
    ];

    // If you have created_at and updated_at fields and want them to be managed automatically
    public $timestamps = true;
}
