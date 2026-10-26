<?php

interface TodoRepositoryInterface {
    public function findById(int $id): ?array;
    public function save(string $title): int;
    public function delete(int $id): bool;
}

class InMemoryTodoRepository implements TodoRepositoryInterface {
    private int $id = 1;
    private array $tasks = [];

    public function save(string $title): int {
        $this->tasks[$this->id] = $title;
        $this->id++;
        return $this->id - 1;
    }

    public function findById(int $task_id): ?array {
        $task_exists = array_key_exists($task_id, $this->tasks);

        return $task_exists ? ["id" => $task_id, "task" => $this->tasks[$task_id]] : null;
    }

    public function delete(int $id): bool {
        if ($this->findById($id)) {
            unset($this->tasks[$id]);
            return !key_exists($id, $this->tasks);
        }

        return false;
    }
}

class TodoService {
    public function __construct(
        private TodoRepositoryInterface $todoRepo
    ) {}

    public function createAndFetch(string $title): ?array {
        $id = $this->todoRepo->save($title);
        return $this->todoRepo->findById($id);
    }
}

$repo = new InMemoryTodoRepository();
$service = new TodoService($repo);

$task = $service->createAndFetch("Read PHP docs");
$another_task = $service->createAndFetch("Do the dishes");

print_r($task);
print_r($another_task);