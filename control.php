<?php
require_once 'crud.class.php';
$crud = new CRUD('localhost', 'root', 'masterkey', 'db_libadmin');

$data = [];

$action = (string)filter_input(INPUT_GET, 'action');//(string)filter_input(INPUT_GET, 'b');
$book_id = $_GET['id'];

if(in_array($action, array('create', 'read', 'update', 'delete', 'readbook'))) {
	switch ($action) {
		case 'create':
		case 'update':
			$data['name']	  = (string)filter_input(INPUT_POST, 'name');
			$data['author']   = (string)filter_input(INPUT_POST, 'author');
			$data['year']	  = (int)	filter_input(INPUT_POST, 'year');
			$data['edition']  = (int)	filter_input(INPUT_POST, 'edition');
			$data['about']	  = (string)filter_input(INPUT_POST, 'about');
			$data['pages']	  = (int)	filter_input(INPUT_POST, 'pages');
			$data['isbn']	  =	(int)	filter_input(INPUT_POST, 'isbn');
			$data['color']	  = (string)filter_input(INPUT_POST, 'color');
			$data['grade']	  =	(int)	filter_input(INPUT_POST, 'grade');
			$data['lang']	  = (int)	filter_input(INPUT_POST, 'lang');
			$data['publisher']= (string)filter_input(INPUT_POST, 'publisher');
			$data['was_read'] = (int)	filter_input(INPUT_POST, 'was_read');
			$data['type']     = (int)	filter_input(INPUT_POST, 'type');
			$data['resume']   = (string)filter_input(INPUT_POST, 'resume');
			
			if($action == 'create'){
				$crud->create($data);
			} else {
				$crud->update($data, $book_id);
			}

			header('Location: view.list.php');
			break;
			

		case 'read':
			$book_data = $crud->read($book_id);
			if(is_numeric($book_id)){
				echo json_encode($book_data, JSON_FORCE_OBJECT);
			}

			break;

		case 'delete':
			if(is_numeric($book_id)){
				$crud->delete($book_id);
			} else {
				header('Location: view.list.php?error=1'); // Não é um livro válido
			}
			break;

		case 'readbook':
			if(in_array($_GET['value'], array(0,1))){
				$crud->set_read($book_id, $value);
			} else {
				header('Location: view.list.php?error=2'); // Não foi possível realizar a marcação 
														   // de leitura pois foi feita uma alteração suspeita no código fonte
			}
			
			break;
	}
	
}