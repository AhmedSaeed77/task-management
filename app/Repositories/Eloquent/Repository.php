<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\RepositoryInterface;

class Repository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function first($column,$value): ?Model
    {
        return $this->model->where($column,$value)->first();
    }

    public function create(array $data): ?Model
    {
        foreach ($data as $field => $val)
        {
            $this->model->{$field} = $val;
        }
        $this->model->save();
        return $this->model;
    }

    public function update(array $data): ?Model
    {
        $model = $this->model->find($data['id'] ?? 0);
        if(!$model)
            return null;
        $model->update($data);
        return $model;
    }

    public function delete($id): bool
    {
        $this->model = $this->model->find($id);
        return $this->model->delete();
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function updateOrCreate(array $selectors, array $data): ?Model
    {
        $model = $this->model->updateOrCreate($selectors,$data);
        return $model;
    }
}
