<?php
require_once 'controller/TestePersonalidadeController.php';
$testeController = new TesteController($pdo);
$testeController->responder($_POST['indice'], $_POST['resposta']);
