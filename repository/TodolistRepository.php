<?php

namespace Repository {

    use Entity\Todolist;

    interface TodolistRepository
    {
        function save(Todolist $todolist): void;
        function remove(int $number): bool;
        function findAll(): array;
    }

    class TodolistRepositoryImpl implements TodolistRepository
    {
        public array $todolist = array();
        private \PDO $connection;

        public function __construct(\PDO $connection)
        {
            // buat connection PDO, jadi nanti jika ingin membuat connection tinggal panggil $connection dari sini
            $this->connection = $connection;
        }

        function save(Todolist $todolist): void
        {
            // $number = sizeof($this->todolist) + 1;
            // $this->todolist[$number] = $todolist;
            // kita bikin sql nya 
            $sql = "INSERT INTO todolist(todo) VALUES(?)";
            // pake preparestatement
            $statement = $this->connection->prepare($sql);
            // tinggal execute
            $statement->execute([$todolist->getTodo()]);
        }

        function remove(int $number): bool
        {
            if ($number > sizeof($this->todolist)) {
                return false;
            }
            for ($i = $number; $i < sizeof($this->todolist); $i++) {
                $todolist[$i] = $this->todolist[$i + 1];
            }

            unset($this->todolist[sizeof($this->todolist)]);

            return true;
        }
        function findAll(): array
        {
            return $this->todolist;
        }
    }
}
