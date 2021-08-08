

<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
    <form id='target'>
        <input type='text' name="one" value="Hello there" style="vertical-align: middle;" />
        <img id="logo" src="logo.png" height="25" style="vertical-align: middle; display: none" />
    </form>
    <div id="result"></div>
    <script>
        $('#target').change(function(event) {
            $('#logo').show();
            var form = $('#target');
            var txt = form.find('input[name="one"]').val();
            window.console && console.log('SENDING POST');
            $.post('echo.php', {
                val: txt
            }, function(data) {
                window.console && console.log(data);
                $('#result').empty().append(data);
                $('#logo').hide();
            }).fail(function(){
                alert('Dang!');
            });
        });
    </script>
</body>


</html>