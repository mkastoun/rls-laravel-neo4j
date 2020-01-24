<?php

namespace App\Models;

use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;
use Vinelab\NeoEloquent\Eloquent\SoftDeletes;

class Team extends NeoEloquent
{
    use SoftDeletes;

    /**
     * Label name
     *
     * @var string
     */
    protected $label = 'Team';

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
    protected $fillable = ['uuid', 'name'];

    /**
     * Members of a team
     *
     * @return \Vinelab\NeoEloquent\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany('Employee', 'IS_MEMBER_OF_TEAM');
    }

    public function access()
    {
        return $this->hasOne('App\Models\AccessLevel', 'HAS_ACCESS_LEVEL');
    }
}
