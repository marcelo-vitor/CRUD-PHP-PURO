<?php

session_start();

require 'app/Utils/Router.php';
require 'app/Utils/Flash.php';
require 'app/Utils/Validate.php';
require 'app/Utils/Convert.php';
require 'app/Utils/View.php';

require 'app/Controller/AlunoController.php';
require 'app/Database/Connection.php';
require 'app/Models/Aluno.php';


require 'app/Pages/app.php';
