<?php
require_once './control.php';
require_once './inc/head.php';
?>
<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
<style>
	th {text-align: center;}
	td:nth-child(3), 
	td:nth-child(4), 
	td:nth-child(5),
	td:nth-child(6),
	td:nth-child(7), 
	td:nth-child(8) 
	{
		text-align: center;
	}
</style>
</head>
<body>
<?php require_once 'inc/nav.php'; ?>
	<div class="container starter-template">
		<table class="table table-hover table-bordered" id="mytable">
			<thead>
				<tr>
					<th style="text-align:left">Nome</th>
					<th style="text-align:left">Autor</th>
					<th>Ano</th>
					<th>Ed.</th>
					<th>Pags.</th>
					<th>Nota:</th>
					<th>Lido?</th>
					<th>Controle</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$book_data = $crud->read($book_id);
					if(!empty($book_data)){
						for($i = 0; $i < count($book_data); $i++){
							echo '<tr id="book_'.$book_data[$i]['id'].'">
									  <td>'.$book_data[$i]['name'].'</td>
									  <td>'.$book_data[$i]['author'].'</td>
									  <td>'.$book_data[$i]['year'].'</td>
									  <td>'.$book_data[$i]['edition'].'</td>
									  <td>'.$book_data[$i]['pages'].'</td>
									  <td>'.$book_data[$i]['grade'].'</td>';
							if($book_data[$i]['was_read'] == 0){
								echo '<td><input type="checkbox" id="'.$book_data[$i]['id'].'" onclick="readBook(this.id)" value="1">';

							} else {
								echo '<td><input type="checkbox" id="'.$book_data[$i]['id'].'" onclick="readBook(this.id)" value="1" checked="checked">';
							}
							
							echo '<td>
									<button type="button" onclick="window.location.href=\'http://localhost/homeadmin/view.register.php?id='.$book_data[$i]['id'].'\'" class="btn btn-info btn-xs">
										<span class="glyphicon glyphicon-pencil"></span>
									</button>
									<button type="button" onclick="deleteBook('.$book_data[$i]['id'].')" class="btn btn-danger btn-xs">
										<span class="glyphicon glyphicon-remove"></span>
									</button>
								</td>';
						}
					}
				?>
			</tbody>
		</table>

	</div><!-- /.container -->


	<script src="assets/js/jquery-latest.min.js"></script> 
	<script src="assets/js/bootstrap.min.js"></script> 
	<script src="assets/js/jquery.dataTables.min.js"></script> 
	<script>
		var myTable;
		$(document).ready(function(){
			myTable = $('#mytable').DataTable();
		});
		
		function readBook(id){
			var wasRead = document.getElementById(id).checked;
			var value = 0;
			if(wasRead){value = 1;}
			
			var ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function() {
				if (ajax.readyState === 4 && ajax.status === 200) {
					//alert(ajax.responseText);
				}
			};	
		
			ajax.open('GET', 'control.php?action=readbook&id='+parseInt(id)+'&value='+value, true);
			ajax.send();
			//ajax.responseText;
		}
		
		function deleteBook(id){
			var answer = confirm('Tem certeza que deseja deletar este livro? A exclusão não poderá ser desfeita.');
			if(answer){
				var ajax = new XMLHttpRequest();
				ajax.onreadystatechange = function() {
					if (ajax.readyState === 4 && ajax.status === 200) {
						var index = document.getElementById('book_'+id+'');
						var rowNum = ($('tr').index(index))-1;
						myTable.row(rowNum).remove().draw();
						
					}
				};	
			}
			
			ajax.open('GET', 'control.php?action=delete&id='+parseInt(id), true);
			ajax.send();
		}
		
	</script>
</body>
</html>
