<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);

    public function findBy($column,$attribute);
}
