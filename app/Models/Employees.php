<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $guarded = [];


    /**
     * Get the company that owns the Employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function companyRelated()
    {
        return $this->belongsTo(Companies::class, 'company');
    }


    /**
     * Get the user that owns the Companies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
