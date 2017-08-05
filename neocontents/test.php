<!DOCTYPE html>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>
    <body>
        <div id="result"></div>
        <input type="text" id="msg" />
        <input type="button" value="get result" id="getResult" />
        <script>
            $('#getResult').click( function() {
              console.log('ass');
                $('#result').html('');
                $.ajax({
                    url:'dbupdate.php',
                    dataType:'json',
                    type:'POST',
                    data: {option:'get_contents', id:'tdc_7'},
                    success:function(result){
                      console.log(result);
                        if(result['result']==true){
                          $('#result').html(result['msg']);
                        }
                    },
                    error: function (request, status, error) {
                        console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
                    }
                });
            })
        </script>
    </body>
</html>
