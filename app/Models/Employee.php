<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;
use Vinelab\NeoEloquent\Eloquent\SoftDeletes;

class Employee extends NeoEloquent
{
    use SoftDeletes;

    /**
     * Label name
     *
     * @var string
     */
    protected $label = 'Employee';

    /**
     * Date array
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Node properties
     *
     * @var array
     */
    protected $fillable = ['uuid', 'name', 'email'];

    /**
     * Team that the employee belongs to
     *
     * @return HasOne
     */
    public function team()
    {
        return $this->hasOne('App\Models\Team', 'IS_MEMBER_OF_TEAM');
    }

    public function access()
    {
        return $this->hasOne('App\Models\AccessLevel', 'HAS_ACCESS_LEVEL');
    }
}
