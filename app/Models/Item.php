<?php

namespace App\Models;

use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;
use Vinelab\NeoEloquent\Eloquent\SoftDeletes;

class Item extends NeoEloquent
{
    use SoftDeletes;

    /**
     * Label name
     *
     * @var string
     */
    protected $label = 'Item';

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
    protected $fillable = ['uuid','name', 'description'];

    /**
     * Team that the employee belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function folder()
    {
        return $this->belongsTo('App\Models\Folder');
    }

    public function access()
    {
        return $this->belongsTo('App\Models\AccessLevel', 'HAS_ACCESS_LEVEL');
    }
}
