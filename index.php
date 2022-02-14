<?php

session_start();

// Routes
require 'app/Router/Routes.php';
require 'app/Router/Router.php';

// Utils
require 'app/Utils/Flash.php';
require 'app/Utils/Validate.php';
require 'app/Utils/Convert.php';
require 'app/Utils/View.php';

// DB
require 'app/Database/Connection.php';

// CONTROLLER
require 'app/Controller/AlunoController.php';
require 'app/Controller/CursoController.php';

// MODEL
require 'app/Models/Model.php';
require 'app/Models/Aluno.php';
require 'app/Models/Curso.php';

// LAYOUT MASTER
require 'app/Pages/app.php';
