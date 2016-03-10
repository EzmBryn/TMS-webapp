<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EntryRepository;
use App\Entities\Entry;

class EntryRepositoryEloquent extends BaseRepository implements EntryRepository
{

    protected $rules = [
        'company_id'      => 'required',
        'entry_type_id'   => 'required',
        'datetime_ini'  => 'min:3|required',
        'cost'      => 'min:3|required',
        ];

    public function model()
    {
        return Entry::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function results($filters = array())
    {
        $entries = $this->scopeQuery(function ($query) use ($filters) {
            
            if (!empty($filters['cost'])) {
                $query = $query->where('cost', $filters['cost']);
            }

            $query = $query->orderBy($filters['sort'], $filters['order']);
            
            return $query;
        })->paginate($filters['paginate']);
        
        return $entries;
    }
}
