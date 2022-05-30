<?php

namespace App\Repositories\Eloquent;

use App\Models\Movie;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Repository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findBy($column, $attribute)
    {
        return $this->model->where($column, $attribute)->first();
    }

    // Get the associated model
    public function getModel(): Model
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model): Repository
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations): array|\Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with($relations)->get();
    }
}
