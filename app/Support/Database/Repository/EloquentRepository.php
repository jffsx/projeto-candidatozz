<?php

namespace Candidatozz\Support\Database\Repository;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements EloquentRepositoryContract
{
    /**
     * App container
     *
     * @var \Illuminate\Container\Container
     */
    protected $app;


    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Make model
     *
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    /**
     * Reset model
     *
     * @throws RepositoryException
     */
    public function resetModel()
    {
        $this->makeModel();
    }

    /**
     * Specify model class name
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract protected function model();

    /**
     * Get all
     *
     * @return mixed
     */
    public function all(array $columns = ['*'])
    {
        $model = $this->model->all($columns);
        $this->resetModel();

        return $model;
    }

    /**
     * Get paginate
     *
     * @param int $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = null, array $columns = ['*'])
    {
        $model = $this->model->paginate($limit, $columns);
        $this->resetModel();

        return $model;
    }

    /**
     * Get by id
     *
     * @param  int $id
     * @throws ModelNotFoundException
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $model = $this->model->find($id, $columns);

        if (!$model instanceof Model) {
            throw new ModelNotFoundException("Não foi possível encontrar o recurso desejado");
        }

        $this->resetModel();

        return $model;
    }

    /**
     * Create a new resource
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = $this->model->newInstance($attributes);
        $model->save();
        $this->resetModel();

        return $model;
    }

    /**
     * Update resource
     *
     * @param array $attributes
     * @param int $id
     * @throws ModelNotFoundException
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $model = $this->model->find($id);

        if (!$model instanceof Model) {
            throw new ModelNotFoundException("Não foi possível encontrar o recurso desejado");
        }

        $model->fill($attributes);
        $model->save();
        $this->resetModel();

        return $model;
    }

    /**
     * Delete resource
     *
     * @param int $id
     * @throws ModelNotFoundException
     * @return bool
     */
    public function delete($id)
    {
        $model = $this->find($id);

        if (!$model instanceof Model) {
            throw new ModelNotFoundException("Não foi possível encontrar o recurso desejado");
        }

        $deleted = $model->delete();
        $this->resetModel();

        return $deleted;
    }
}
