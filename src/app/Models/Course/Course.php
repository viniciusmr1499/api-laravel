<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * @var string
     */
    protected $table = 'courses';

    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'body',
        'price',
        'updated_at',
        'created_at'
    ];

    /**
     * @var array
     */
    public array $rules = [
        'description' => 'required:min:10|max:255',
        'name' => 'required|min:2|max:45|alpha',
        'body' => 'required|min:2|max:60',
        'price' => 'required|numeric'
    ];
}
