<?php

namespace Repository {

    use Entity\Todolist;
    use PDO;

    interface TodolistRepository
    {
        function save(Todolist $todolist): void;
        function remove(int $number): bool;
        function findAll(): array;
    }

    class TodolistRepositoryImpl implements TodolistRepository
    {
        public array $todolist = array();
        private PDO $connection;

        public function __construct(PDO $connection)
        {
            // buat connection PDO, jadi nanti jika ingin membuat connection tinggal panggil $connection dari sini
            $this->connection = $connection;
        }

        function save(Todolist $todolist): void
        {
            // kita bikin sql nya 
            $sql = "INSERT INTO todolist(todo) VALUES(?)";
            // pake preparestatement
            $statement = $this->connection->prepare($sql);
            // tinggal execute
            $statement->execute([$todolist->getTodo()]);
        }

        function remove(int $number): bool
        {
            // kita cek dulu apakah id nya ada di database
            $sql = "SELECT id FROM todolist WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            // jika script sql diatas balikannya ada datanya, berarti datanya ketemu
            if ($statement->fetch()) {
                // data todolist ada
                $sql = "DELETE FROM todolist WHERE id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return true;
            } else {
                // data todolist tidak ada
                return false; // sehingga tidak perlu melakukan delete
            }
        }
        function findAll(): array
        {
            // kita melakukan query ke database, untuk mengambil data nya
            $sql = "SELECT id, todo FROM todolist";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            // kita harus balikannya adalah array of todolist
            $result = [];

            // iterasi hasil statement
            foreach ($statement as $row) {
                $todolist = new Todolist();
                $todolist->setId($row['id']);
                $todolist->setTodo($row['todo']);
                // masukkan data todolist ke result array
                $result[] = $todolist;
            }
            return $result;
        }
    }
}
