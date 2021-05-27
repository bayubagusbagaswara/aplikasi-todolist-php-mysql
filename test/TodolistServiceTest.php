<?php

require_once __DIR__ . "/../entity/Todolist.php";
require_once __DIR__ . "/../repository/TodolistRepository.php";
require_once __DIR__ . "/../service/TodolistService.php";

use Entity\Todolist;
use Repository\TodolistRepositoryImpl;
use Service\TodolistServiceImpl;

function testShowTodolist(): void
{
    // coba tampilkan todolist hasilnya benar atau salah

    $todolistRepository = new TodolistRepositoryImpl;
    // misal kita tambahkan todolistnya dulu
    $todolistRepository->todolist[1] = new Todolist("Belajar PHP");

    $todolistRepository->todolist[2] = new Todolist("Belajar PHP OOP");

    $todolistRepository->todolist[3] = new Todolist("Belajar PHP Database");

    $todolistService = new TodolistServiceImpl($todolistRepository);

    // ngetestnya
    $todolistService->showTodolist();
}

function testAddTodolist(): void
{
    $todolistRepository = new TodolistRepositoryImpl;

    $todolistService = new TodolistServiceImpl($todolistRepository);

    $todolistService->addTodolist("Belajar PHP");
    $todolistService->addTodolist("Belajar PHP OOP");
    $todolistService->addTodolist("Belajar PHP Database");

    $todolistService->showTodolist();
}

function testRemoveTodolist(): void
{
    $todolistRepository = new TodolistRepositoryImpl;

    $todolistService = new TodolistServiceImpl($todolistRepository);

    // tambahkan datanya dulu 
    $todolistService->addTodolist("Belajar PHP");
    $todolistService->addTodolist("Belajar PHP OOP");
    $todolistService->addTodolist("Belajar PHP Database");

    $todolistService->showTodolist();
    // coba hapus todolist ke 1
    $todolistService->removeTodolist(1);

    $todolistService->showTodolist();
}
testRemoveTodolist();
