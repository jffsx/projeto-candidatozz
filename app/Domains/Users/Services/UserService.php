<?php

namespace Candidatozz\Domains\Users\Services;

use Candidatozz\Domains\Users\Models\User;
use Candidatozz\Domains\Users\Contracts\UserServiceContract;
use Candidatozz\Domains\Users\Contracts\UserRepositoryContract;

class UserService implements UserServiceContract
{
    /**
     * @var EasyCurriculo\Domains\Files\Repositories\FileRepository
     */
    private $userRepository;

    /**
     * Construct class
     *
     * @param userRepositoryContract $userRepository
     */
    public function __construct(userRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all
     *
     * @return mixed
     */
    public function all()
    {
        return $this->userRepository->all();
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
        return $this->userRepository->paginate($limit, $columns);
    }

    /**
     * Get by id
     *
     * @param  int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * Create a new resource
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->userRepository->create($attributes);
    }

    /**
     * Update resource
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return $this->userRepository->update($attributes, $id);
    }

    /**
     * Delete resource
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}
