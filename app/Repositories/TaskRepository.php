<?php


namespace App\Repositories;


use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Recca0120\Repository\EloquentRepository;

class TaskRepository extends EloquentRepository implements TaskRepositoryContract
{
    public function __construct(Task $task)
    {
        parent::__construct($task);
    }

    /**
     * @return Collection
     */
    final public function getTask(): Collection
    {

        return Task::all();
    }

    /**
     * @param array $data
     * @return Model|Task
     */
    final public function createTask(array $data): Task
    {
        return $this->newQuery()->create($data);
    }

    /**
     * @param Task $task
     * @param array $data
     * @return bool
     */
    final public function updateTask(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    /**
     * @param Task $task
     * @return bool
     */
    final public function deleteTask(Task $task): bool
    {
        return !!$task->delete();
    }

}
