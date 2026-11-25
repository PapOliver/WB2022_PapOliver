<?php

    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Name extends Model
    {
        protected $table = 'names';
        protected $primaryKey = 'id';
        public $incrementing = true;
        protected $keyType = 'integer';
        public $timestamps = true;
        const CREATED_AT = 'created_at';
        const UPDATED_AT = 'updated_at';

        public function family()
        {
            return $this->belongsTo('App\Models\Family');
        }
    }