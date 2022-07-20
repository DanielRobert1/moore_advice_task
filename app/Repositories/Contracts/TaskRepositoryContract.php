<?php


namespace App\Repositories\Contracts;


use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryContract
{
    /**
     * @return Collection
     */
    public function getTask(): Collection;

    /**
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task;

    /**
     * @param Task $task
     * @param array $data
     * @return bool
     */
    public function updateTask(Task $task, array $data): bool;

    /**
     * @param Task $task
     * @return bool
     */
    public function deleteTask(Task $task): bool;


}
