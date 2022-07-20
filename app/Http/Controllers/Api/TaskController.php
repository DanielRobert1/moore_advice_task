<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Repositories\Contracts\TaskRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller {
    /**
     * @var TaskRepositoryContract
     */
    private $taskRepository;


    public function __construct(TaskRepositoryContract $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get Tasks
     *
     * This lists all tasks
     *
     * @responseFile status=200 storage/responses/task/index.json
     * @responseFile status=422 storage/responses/errors/validation.json
     *
     * @return JsonResponse
     */
    final public function index(): JsonResponse
    {

        $task = $this->taskRepository->getTask();

        return response()->json(array_merge(
            [
                'status' => 'success',
                'data' => TaskResource::collection($task),
            ],
            
        ));
    }

    /**
     * Add a New Task
     *
     * This adds new task
     *
     * @responseFile status=201 storage/responses/task/store.json
     * @responseFile status=422 storage/responses/errors/validation.json
     *
     * @param CreateTaskRequest $request
     * @return JsonResponse
     */
    final public function store(CreateTaskRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'desc']);

        $task = $this->taskRepository->createTask($data);

        return response()->json([
            'status' => 'success',
            'message' => "The task has been added!",
            'data' => new TaskResource($task)
        ], 200);
    }

    /**
     * Get task
     *
     * Get a task
     *
     * @urlParam id int required The required task id
     *
     * @responseFile status=200 storage/responses/task/show.json
     *
     * @param Task $task
     * @return JsonResponse
     */
    final public function show(Task $task): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => new TaskResource($task)
        ]);
    }

    /**
     * Update An Existing Task
     * 
     * Update a task
     *
     * @urlParam id int required The id of the task to update
     *
     * @responseFile status=200 storage/responses/task/update.json
     * @responseFile status=422 storage/responses/errors/validation.json
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    final public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $data = $request->safe();

        $this->taskRepository->updateTask($task, $data);

        return response()->json([
            'status' => 'success',
            'message' => "The task has been updated!",
        ]);
    }

     /**
     * Delete an Existing Task
     *
     * Delete a task
     *
     * @urlParam id int required The id of the task to delete
     *
     * @responseFile status=200 storage/responses/task/delete.json
     * @responseFile status=400 storage/responses/errors/generic.json
     *
     * @param Task $task
     * @return JsonResponse
     */
    final public function destroy(Task $task): JsonResponse
    {
        $this->taskRepository->deleteTask($task);

        return response()->json([
            'status' => 'success',
            'message' => "The task has been deleted!",
        ]);
    }
}
