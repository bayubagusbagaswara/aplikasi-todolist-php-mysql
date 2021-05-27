<?php

namespace Entity {

    class Todolist
    {
        // buat properti
        // cuma butuh data todo nya
        private string $todo;

        // constructor, tapi optional parameternya
        public function __construct(string $todo = "")
        {
            $this->todo = $todo;
        }
        // getter dan setter
        public function getTodo(): string
        {
            return $this->todo;
        }

        public function setTodo(string $todo): void
        {
            $this->todo = $todo;
        }
    }
}
