<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Time de Futebol</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>CRUD de Time de Futebol</h1>
    <form id="teamForm">
        <label for="teamName">Nome do Time:</label><br>
        <input type="text" id="teamName" name="teamName"><br>
        <input type="submit" value="Submit">
    </form>
    <div id="teamList"></div>

    <script>
$(document).ready(function(){
    $("#teamForm").submit(function(event){
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
                $('.delete').click(function(){
                    var id = $(this).data('id');
                    $.ajax({
                        url: 'delete.php',
                        type: 'post',
                        data: { id: id },
                        success: function(response) {
                            alert(response);
                            loadTeams();
                        }
                    });
                });
            }
        });
    }

    loadTeams();
});
</script>
</body>
</html>