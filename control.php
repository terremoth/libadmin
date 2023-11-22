<?php
require_once 'crud.class.php';
$crud = new CRUD('localhost', 'root', '', 'libadmin');

$action = (string)filter_input(INPUT_GET, 'action');//(string)filter_input(INPUT_GET, 'b');
$book_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (in_array($action, array('create', 'read', 'update', 'delete', 'readbook'))) {
	

	switch ($action) {
		case 'create':
		case 'update':

            $inputs = [
                'name' => FILTER_DEFAULT,
                'author' => FILTER_DEFAULT,
                'year' => FILTER_SANITIZE_NUMBER_INT,
                'edition' => FILTER_SANITIZE_NUMBER_INT,
                'about' => FILTER_DEFAULT,
                'pages' => FILTER_SANITIZE_NUMBER_INT,
                'isbn' => FILTER_SANITIZE_NUMBER_INT,
                'color' => FILTER_DEFAULT,
                'grade' => FILTER_SANITIZE_NUMBER_INT,
                'lang' => FILTER_SANITIZE_NUMBER_INT,
                'publisher' => FILTER_DEFAULT,
                'was_read' => FILTER_DEFAULT,
                'type' => FILTER_SANITIZE_NUMBER_INT,
                'resume' => FILTER_DEFAULT
            ];

			$validate = filter_input_array(INPUT_POST, $inputs);
            $validate['was_read'] = $validate['was_read'] == 'on' ? 1 : 0; 

            if ($action == 'create'){
				$crud->create($validate);
			} else {
				$crud->update($validate, $book_id);
			}

			header('Location: view.list.php');
			break;
			

		case 'read':
            $book_data = $crud->read($book_id);

			if (is_numeric($book_id)){
				echo json_encode($book_data, JSON_FORCE_OBJECT);
			}

			break;

		case 'delete':

			if (is_numeric($book_id)){
				$crud->delete($book_id);
			} else {
				header('Location: view.list.php?error=1'); // Não é um livro válido
			}

			break;

		case 'readbook':
            $value = filter_input(INPUT_GET, 'value', FILTER_VALIDATE_INT);

			if (in_array($value, [0,1])) {
				$crud->setRead($book_id, $value);
			} else {
				header('Location: view.list.php?error=2'); // Não foi possível realizar a marcação 
														   // de leitura pois foi feita uma alteração suspeita no código fonte
			}
			
			break;
	}
	
}