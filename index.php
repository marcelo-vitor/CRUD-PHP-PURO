<?php

session_start();

// Utils
require 'app/Utils/Router.php';
require 'app/Utils/Flash.php';
require 'app/Utils/Validate.php';
require 'app/Utils/Convert.php';
require 'app/Utils/View.php';

// DB
require 'app/Database/Connection.php';

// CONTROLLER
require 'app/Controller/AlunoController.php';

// MODEL
require 'app/Models/Model.php';
require 'app/Models/Aluno.php';

// LAYOUT MASTER
require 'app/Pages/app.php';
