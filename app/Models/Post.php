<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // If your table name is not the plural form of your model name
    protected $table = 'posts';

    // Define the attributes that are mass assignable
    protected $fillable = ['title', 'description', 'image_url', 'author','status'];

    // Define any relationships or custom methods here
}
