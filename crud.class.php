<?php 

class CRUD 
{
	protected $conn;

	public function __construct($server, $user, $password, $dbname, $port = 3306) 
	{
		try {
			
			$this->conn = new mysqli($server, $user, $password, $dbname, $port);
			// $this->conn = new PDO("mysql:dbname=$dbname;host=$server;charset=utf8mb4;port=$port", $user, $password);

			// $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			// $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}
		catch(Exception $e) {
			die('A conexão com o Banco de Dados falhou: ' . $e->getMessage());
		}
	}

	public function create(array $data) 
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
	
	public function read($book_id)
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
	
	public function update($data, $book_id) 
	{	

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

	public function delete($book_id) 
	{
		$sQuery = 'DELETE FROM tb_books WHERE id = '.$book_id;
		return $this->conn->query($sQuery);
	}
	
	public function setRead($book_id, $value) 
	{
		$sQuery = 'UPDATE tb_books SET was_read = '.$value.' WHERE id = '.$book_id;
		return $this->conn->query($sQuery);
	}
}