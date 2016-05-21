<?php 
require_once './control.php';
require_once 'inc/head.php'; ?>
</head>
<body>
<?php require_once 'inc/nav.php';?>

<div class="container starter-template">
	<form action="control.php?action=create" method="post">
		<h2>Cadastro de Livros</h2>
		<div class="col-lg-5">
			<label>Nome:</label>
			<input name="name" autocomplete="off" required="required" autofocus="autofocus" maxlength="100" class="form-control">
		</div>
		<div class="col-lg-3">
			<label>Autor:</label>
			<input name="author" autocomplete="on" required="required" maxlength="60" class="form-control">
		</div>
		<div class="col-lg-3">
			<label>Editora:</label>
			<input name="publisher" autocomplete="on" maxlength="60" class="form-control">
		</div>
		<div class="col-lg-1">
			<label>Edição:</label>
			<input name="edition" autocomplete="on" data-mask="0000" type="number" maxlength="4" min="1" max="9999" value="1" class="form-control">
		</div>
		<div class="col-lg-2">
			<label>Ano:</label>
			<input name="year" autocomplete="on" data-mask="0000" required="required" type="number" min="1000" value="<?php echo date("Y"); ?>" max="<?php echo date("Y"); ?>" class="form-control">
		</div>
		<div class="col-lg-5">
			<label>Tema:</label>
			<input name="about" autocomplete="on" maxlength="60" class="form-control">
		</div>
		<div class="col-lg-1">
			<label>Nº pags.:</label>
			<input name="pages" autocomplete="off" data-mask="00000" type="number" maxlength="5" min="0" max="20000" value="250" class="form-control">
		</div>
		<div class="col-lg-4">
			<label>Tipo do Livro:</label>
			<select name="type" class="form-control">
				<option value="0">Capa Comum</option>
				<option value="1">Capa Dura</option>
				<option value="2">Livro de Bolso</option>
				<option value="3">Livro Impresso</option>
				<option value="4">Apostila</option>
				<option value="5">Amazon Kindle</option>
				<option value="6">PDF</option>
				<option value="7">DOC</option>
				<option value="8">TXT</option>
				<option value="9">RTF</option>
			</select>
		</div>
		<div class="col-lg-4">
			<label>Cor:</label>
			<input name="color" autocomplete="on" maxlength="40" class="form-control">
		</div>
		<div class="col-lg-3">
			<label>ISBN:</label>
			<input name="isbn" maxlength="15" data-mask="000000000000000" title="Somente números" pattern="(\d)*" class="form-control">
		</div>
		<div class="col-lg-1">
		<label>Nota:</label>
			<input type="number" maxlength="2" data-mask="00"  name="grade" min="0" max="10" value="0" class="form-control">
		</div>
		<div class="col-lg-3">
			<label>Idioma:</label>
			<select name="lang" class="form-control">
				<option value="0">Português</option>
				<option value="1">Inglês</option>
				<option value="2">Espanhol</option>
				<option value="3">Francês</option>
				<option value="4">Italiano</option>
				<option value="5">Alemão</option>
				<option value="6">Russo</option>
				<option value="7">Japonês</option>
				<option value="8">Mandarim</option>
				<option value="9">Grego</option>
			</select>
		</div>
		<div class="col-lg-1">
			<label>Lido: <br>
				<input class="form-control" type="checkbox" name="was_read" value="1">
			</label> 
		</div>
		<div class="col-lg-12" style="margin-top: 30px">
			<label>Resenha/Descrição</label>
			<textarea class="form-control" name="resume" maxlength="1200" rows="7" style="resize: none" placeholder="Once upon a time..."></textarea>
		</div>
		<div class="col-lg-12" style="margin-top: 30px">
			<button type="submit" id="submit" class="btn btn-primary btn-flat">Cadastrar</button>
		</div>
	</form>
</div><!-- /.container -->


<script src="assets/js/jquery-latest.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/jquery.mask.min.js"></script> 
<script>
	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}
	
	var book_id = getUrlVars().id;
	
	if(book_id !== undefined){
		
		document.getElementById('submit').innerHTML = 'Atualizar';
		var ajax = new XMLHttpRequest();
		ajax.onreadystatechange = function() {
			
				if (ajax.readyState === 4 && ajax.status === 200) {
					var book_data = JSON.parse(ajax.responseText);
					var book = book_data[0];
					
					document.getElementsByName('name')[0].value	      = book.name;					
					document.getElementsByName('author')[1].value     = book.author;			
					document.getElementsByName('year'[0]).value	      = book.year;					
					document.getElementsByName('edition')[0].value    = book.edition;					
					document.getElementsByName('about')[0].value	  = book.about;					
					document.getElementsByName('pages')[0].value	  = book.pages;					
					document.getElementsByName('isbn')[0].value	      = book.isbn;					
					document.getElementsByName('color')[0].value	  = book.color;					
					document.getElementsByName('grade')[0].value	  = book.grade;					
					document.getElementsByName('lang')[0].value	      = book.lang;					
					document.getElementsByName('type')[0].value	      = book.type;					
					document.getElementsByName('resume')[0].value	  = book.resume;					
					document.getElementsByName('publisher')[0].value  = book.publisher;
					document.getElementsByName('was_read')[0].checked = book.was_read;
					
				}
		};	
		ajax.open('GET', 'control.php?action=read&id='+book_id, true);
		ajax.send();
		
		document.forms[0].action = 'control.php?action=update&id='+book_id+'';
	}
</script>
  </body>
</html>
