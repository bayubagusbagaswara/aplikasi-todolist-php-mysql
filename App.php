<?php

use Repository\TodolistRepositoryImpl;
use Service\TodolistServiceImpl;
use View\TodolistView;

require_once __DIR__ . "/entity/Todolist.php";
require_once __DIR__ . "/helper/InputHelper.php";
require_once __DIR__ . "/repository/TodolistRepository.php";
require_once __DIR__ . "/service/TodolistService.php";
require_once __DIR__ . "/view/TodolistView.php";

echo "Aplikasi Todolist" . PHP_EOL;

// bikin object-object nya
$todolistRepository = new TodolistRepositoryImpl();
$todolistService = new TodolistServiceImpl($todolistRepository);

$todolistView = new TodolistView($todolistService);

// tinggal jalankan halaman pertama
$todolistView->showTodolist();
