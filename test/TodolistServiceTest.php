<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../entity/Todolist.php";
require_once __DIR__ . "/../repository/TodolistRepository.php";
require_once __DIR__ . "/../service/TodolistService.php";

use Entity\Todolist;
use Repository\TodolistRepositoryImpl;
use Service\TodolistServiceImpl;

function testShowTodolist(): void
{
    $connection = \Config\Database::getConnection();
    $todolistRepository = new TodolistRepositoryImpl($connection);
    $todolistService = new TodolistServiceImpl($todolistRepository);
    // coba tambahkan data todolist dulu
    $todolistService->addTodolist("Belajar PHP");
    $todolistService->addTodolist("Belajar PHP OOP");
    $todolistService->addTodolist("Belajar PHP Database");

    $todolistService->showTodolist();
}

function testAddTodolist(): void
{
    // bikin connection nya dulu
    $connection = \Config\Database::getConnection();
    $todolistRepository = new TodolistRepositoryImpl($connection);

    $todolistService = new TodolistServiceImpl($todolistRepository);

    $todolistService->addTodolist("Belajar PHP");
    $todolistService->addTodolist("Belajar PHP OOP");
    $todolistService->addTodolist("Belajar PHP Database");
}

function testRemoveTodolist(): void
{
    // bikin connection nya dulu
    $connection = \Config\Database::getConnection();
    $todolistRepository = new TodolistRepositoryImpl($connection);

    $todolistService = new TodolistServiceImpl($todolistRepository);

    echo $todolistService->removeTodolist(5) . PHP_EOL; // hapus data yang tidak ada
    echo $todolistService->removeTodolist(4) . PHP_EOL; // hapus data yang tidak ada
    echo $todolistService->removeTodolist(3) . PHP_EOL; // hapus data ada
    echo $todolistService->removeTodolist(2) . PHP_EOL; // hapus data ada
    echo $todolistService->removeTodolist(1) . PHP_EOL; // hapus data ada
}
// testAddTodolist();
// testRemoveTodolist();
testShowTodolist();
