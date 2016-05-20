<?php 
use mysqli;

class CRUD {
	
	public $conn;

	function __construct($server, $user, $password, $dbname, $port = 3306) 
	{
		$this->conn = new mysqli($server, $user, $password, $dbname, $port);

		if ($this->conn->connect_error) {
			die('A conexão com o Banco de Dados falhou: ' . $this->conn->connect_error);
		}

		$this->conn->query("SET CHARACTER SET utf8");
		
	}

	function create(array $data) 
	{
		$sQuery = 'INSERT INTO tb_books (name, author, year, edition, about, pages, isbn, color, grade, lang, resume, was_read, publisher, type) 
			VALUES (
			"'.$this->conn->real_escape_string($data['name']).'", 
			"'.$this->conn->real_escape_string($data['author']).'", 
			'. $data['year'].', 
			'. $data['edition'].', 
			"'.$this->conn->real_escape_string($data['about']).'", 
			'. $data['pages'].', 
			'. $data['isbn'].', 
			"'.$this->conn->real_escape_string($data['color']).'", 
			'. $data['grade'].', 
			'. $data['lang'].',
			"'.$this->conn->real_escape_string($data['resume']).'",
			'. $data['was_read'].',
			"'.$this->conn->real_escape_string($data['publisher']).'",
			'. $data['type'].'
		)';
		
		return $this->conn->query($sQuery);
	}
	
	function read($book_id)
	{
		$sQuery = 'SELECT * FROM tb_books';

		if (is_numeric($book_id)) {
			$sQuery .= ' WHERE id = '.$book_id;
		}

		$result = $this->conn->query($sQuery);
		$data = [];
		
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		
		return $data;
	}
	
	function update($data, $book_id) 
	{	/*
		$data['publisher']
		$data['was_read'] 
		$data['type']     
		*/
		$sQuery = 'UPDATE tb_books SET 
			name	 = "'.$this->conn->real_escape_string($data['name']).'",
			author	 = "'.$this->conn->real_escape_string($data['author']).'",
			year	 = '. $data['year'].',
			edition  = '. $data['edition'].',
			about	 = "'.$this->conn->real_escape_string($data['about']).'",
			pages	 = "'.$data['pages'].'",
			isbn	 = '. $data['isbn'].',
			color	 = "'.$this->conn->real_escape_string($data['color']).'",
			grade	 = '. $data['grade'].',
			publisher= "'. $this->conn->real_escape_string($data['publisher']).'",
			was_read = '. $data['was_read'].',
			resume	 = "'. $this->conn->real_escape_string($data['resume']).'",
			type	 = '. $data['type'].',
			lang	 = '. $data['lang'].'
		WHERE id = '.$book_id;
		
		return $this->conn->query($sQuery);
	}

	function delete($book_id) 
	{
		$sQuery = 'DELETE FROM tb_books WHERE id = '.$book_id;
		return $this->conn->query($sQuery);
	}
	
	function set_read($book_id, $value) 
	{
		$sQuery = 'UPDATE tb_books SET was_read = '.$value.' WHERE id = '.$book_id;
		return $this->conn->query($sQuery);
	}
}