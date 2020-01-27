<?php

    namespace App\Models;

    use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;
    use Vinelab\NeoEloquent\Eloquent\Relations\HasMany;
    use Vinelab\NeoEloquent\Eloquent\SoftDeletes;

    class AccessLevel extends NeoEloquent
    {
        use SoftDeletes;

        /**
         * Label name
         *
         * @var string
         */
        protected $label = 'AccessLevel';

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
        protected $fillable = ['uuid', 'name', 'level'];

        /**
         * items linked to this acl
         *
         * @return HasMany
         */
        public function items()
        {
            return $this->belongsToMany('App\Models\Item', 'HAS_ACCESS_LEVEL', null,
                null, 'uuid', null, null);
        }

        /**
         * folders linked to this acl
         *
         * @return HasMany
         */
        public function folders()
        {
            return $this->belongsToMany('App\Models\Folder', 'HAS_ACCESS_LEVEL', null,
                null, 'uuid', null, null);
        }

        /**
         * Teams linked to this acl
         *
         * @return HasMany
         */
        public function teams()
        {
            return $this->hasMany(
                'App\Models\Team',
                'HAS_ACCESS_LEVEL',
                null,
                null,
                'uuid'
            );
        }

        /**
         * Employees linked to this acl
         *
         * @return HasMany
         */
        public function employees()
        {
            return $this->belongsToMany(
                'App\Models\Employee',
                'HAS_ACCESS_LEVEL',
                null,
                null,
                'uuid',
                null,
                null);
        }

    }
