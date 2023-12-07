<!DOCTYPE html>
<html>

<head>
    <title>CRUD de Time de Futebol</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        header {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: darkgreen;
            color: white;
            font-family: Arial, Helvetica, sans-serif;
            margin-bottom: 100px;
        }
        form{
            font-family: Arial, Helvetica, sans-serif;
        }
        form div{
            display: flex;
            flex-direction: column;
            margin-bottom: 30px;
            margin-left: 30%;
            margin-right: 30%;
        }
        form input{
            outline: unset;
            padding: 20px;
            width: 300px;
            border: 1px solid lightblue;
            border-radius: 20px;
        }
        form input:focus{
            background-color: lightgreen;
        }
        form input[type=submit]{
            background-color: lightblue;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>CRUD de Time de Futebol</h1>
    </header>
    <form id="teamForm">
        <div>
        <label for="teamName">Nome do Time:</label><br>
        <input type="text" id="teamName" name="teamName"><br>
        </div>
        <div>
        <input type="submit" value="Submit">
        </div>
    </form>
    <div id="teamList"></div>

    <script>
        $(document).ready(function() {
            $("#teamForm").submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'create.php',
                    type: 'post',
                    data: $("#teamForm").serialize(),
                    success: function(response) {
                        alert(response);
                        loadTeams();
                    }
                });
            });

            function loadTeams() {
                $.ajax({
                    url: 'read.php',
                    type: 'get',
                    success: function(response) {
                        $('#teamList').html(response);
                        $('.delete').click(function() {
                            var id = $(this).data('id');
                            $.ajax({
                                url: 'delete.php',
                                type: 'post',
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    alert(response);
                                    loadTeams();
                                }
                            });
                        });
                        $('.update').click(function() {
                            var id = $(this).data('id');
                            var name = prompt("Enter new team name");
                            if (name) {
                                $.ajax({
                                    url: 'update.php',
                                    type: 'post',
                                    data: {
                                        id: id,
                                        name: name
                                    },
                                    success: function(response) {
                                        alert(response);
                                        loadTeams();
                                    }
                                });
                            }
                        });
                    }
                });
            }

            loadTeams();
        });
    </script>
</body>

</html>