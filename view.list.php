<?php
require_once './control.php';
require_once './inc/head.php';
?>

</head>
<body>
    <?php require_once 'inc/nav.php'; ?>
    <div class="container starter-template">
        <table class="table table-hover table-bordered" id="mytable">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Ed.</th>
                    <th>Pages</th>
                    <th>Nota</th>
                    <th>Lido?</th>
                    <th>Controle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $book_data = $crud->read($book_id);
                if (!empty($book_data)) {
                    for ($i = 0; $i < count($book_data); $i++) {
                        echo '<tr id="book_' . $book_data[$i]['id'] . '">
                                      <td>' . $book_data[$i]['name'] . '</td>
                                      <td>' . $book_data[$i]['author'] . '</td>
                                      <td>' . $book_data[$i]['year'] . '</td>
                                      <td>' . $book_data[$i]['edition'] . '</td>
                                      <td>' . $book_data[$i]['pages'] . '</td>
                                      <td>' . $book_data[$i]['grade'] . '</td>';
                        if ($book_data[$i]['was_read'] == 0) {
                            echo '<td><input class="form-control" type="checkbox" id="' . $book_data[$i]['id'] . '" onclick="readBook(this.id)">';
                        } else {
                            echo '<td><input class="form-control" type="checkbox" id="' . $book_data[$i]['id'] . '" onclick="readBook(this.id)" checked="checked">';
                        }

                        echo '<td>
                                <a role="button" href="view.register.php?id=' . $book_data[$i]['id'] . '" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                <a role="button" href="#" onclick="deleteBook(' . $book_data[$i]['id'] . ')" class="btn btn-danger"><i class="fa fa-times"></i></a>
                             </td>';
                    }
                }
                ?>
            </tbody>
        </table>

    </div><!-- /.container -->

    <?php require_once 'inc/footer-scripts.php' ?>

    <script>
        var myTable;

        $(document).ready(function() {
            myTable = $("#mytable").dataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
                },
            });
        });

        function readBook(id) {
            let wasRead = document.getElementById(id).checked;
            let value = 0;
            if (wasRead) {
                value = 1;
            }

            let ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4 && ajax.status === 200) {
                    //alert(ajax.responseText);
                }
            };

            ajax.open('GET', 'control.php?action=readbook&id=' + parseInt(id) + '&value=' + value, true);
            ajax.send();
            //ajax.responseText;
        }

        function deleteBook(id) {

            let answer = confirm('Tem certeza que deseja deletar este livro? A exclusão não poderá ser desfeita.');

            if (answer) {
                let ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function() {
                    if (ajax.readyState === 4 && ajax.status === 200) {
                        document.getElementById('book_' + id + '').remove();
                    }
                };

                ajax.open('GET', 'control.php?action=delete&id=' + parseInt(id), true);
                ajax.send();
            }

            
        }
    </script>
</body>

</html>