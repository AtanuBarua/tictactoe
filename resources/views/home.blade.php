<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <div class="container justify-content-center mt-3 p-4">
        <div style="float: left">
            <h3 class="mb-4 text-danger" id="result"></h3>
            <h4 class="mb-4 text-warning" id="playerindicator"></h4>
            <button onclick="playAgain()" style="display: none" class="btn btn-primary playagain">Play again</button>


            <div class="col p-4 board">
               
            </div>
        </div>
        <div style="float: right" class="mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Player 1</th>
                        <th scope="col">Player 2</th>
                        <th scope="col">Winner</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($matches as $item)
                    <tr>
                        <td>{{$item->player1}}</td>
                        <td>{{$item->player2}}</td>
                        <td>{{$item->winner}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>


    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var person1 = prompt("Player 1 name:")
        var person2 = prompt("Player 2 name:")
        var boardLength = prompt("Board Length: 3/4")

        if (boardLength !=3 && boardLength !=4) {
            boardLength = 3
        }

        if (boardLength == 3) {
            r1 = ["1", "2", "3"];
            r2 = ["4", "5", "6"];
            r3 = ["7", "8", "9"];
            r4 = ["1", "4", "7"];
            r5 = ["2", "5", "8"];
            r6 = ["3", "6", "9"];
            r7 = ["1", "5", "9"];
            r8 = ["3", "5", "7"];
        }

        else if(boardLength == 4){
            r1 = ["1", "2", "3", "4"];
            r2 = ["5", "6", "7", "8"];
            r3 = ["9", "10", "11", "12"];
            r4 = ["13", "14", "15", "16"];
            r5 = ["1", "5", "9", "13"];
            r6 = ["2", "6", "10", "14"];
            r7 = ["3", "7", "11", "15"];
            r8 = ["4", "8", "12", "16"];
            r9 = ["1", "6", "11", "16"];
            r10 = ["4", "7", "10", "13"];
        }

        var p = 1;
        var p1 = []; 
        var p2 = [];

        var txt = '';
        var txt2 = '';
        for(var i = 1; i <= boardLength;i++){
            txt += `
            <div class="row mt-2 boardrow${i}">
                    
            </div>
            `
            $(".board").html(txt);
        }

        let number = 1;
        for(var i = 1; i<=boardLength; i++){
            for(var j = 1; j<=boardLength; j++){
                $(`.boardrow${i}`).append(
                    ` 
                    <input style="width: 50px" onclick="ticked(this)" id="tiles_${number}" type="button" class="btn btn-success ml-2">
                    `
                )                              
                number++;
            }
        }

        
        $("#playerindicator").html(`${person1}'s turn`)
        

        function ticked(tictac){
            var tilesId = $(tictac).attr('id');
            tilesId = tilesId.substring(6);

            if (p % 2 != 0) {       
                tictac.value = 'X';
                p1.push(tilesId)
                p1 = p1.sort()
                p1.forEach(checkResult.bind(null, 1));
                $("#playerindicator").html(`${person2}'s turn`)

            }
            else{
                tictac.value = 'O';
                p2.push(tilesId)
                p2 = p2.sort()
                p2.forEach(checkResult.bind(null, 2));
                $("#playerindicator").html(`${person1}'s turn`)

            }  
            p++;
         
        } 

        var limit = 0;
        var winner;
        
        function checkResult(player, value, index, array){
      
            array = array.sort(function(a, b){return a-b});

            if (boardLength == 3) {
                if (JSON.stringify(r1) == JSON.stringify(array)) {
                limit++;
                winner = player
                }
                else if(JSON.stringify(r2) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r3) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r4) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r5) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r6) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r7) == JSON.stringify(array)){
                    limit++;
                    winner = player

                }
                else if(JSON.stringify(r8) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }

                else if(p1.length == 3 && p2.length == 3){
                    limit++;
                    winner = 0;
                }

                if (limit == 3) {
                    decision()               
                }  
            }
            else{
                if (JSON.stringify(r1) == JSON.stringify(array)) {
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r2) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r3) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r4) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r5) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r6) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r7) == JSON.stringify(array)){
                    limit++;
                    winner = player

                }
                else if(JSON.stringify(r8) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r9) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(JSON.stringify(r10) == JSON.stringify(array)){
                    limit++;
                    winner = player
                }
                else if(p1.length == 4 && p2.length == 4){
                    limit++;
                    winner = 0;
                }

                if (limit == 4) {
                    decision()               
                }  
            }
        }
        

        function decision(){
            if (limit != 0) {
                endGame(winner)         
            }
            else{
                winner = 0;
                endGame(winner)         
            }
        }

        function playAgain() {
            $("input").prop("disabled", false);
            $("input").val("");
            $("#result").hide();
            $(".playagain").hide();
            $("#playerindicator").show();
            $("#playerindicator").html(`${person1}'s turn`);
            p = 1;
            p1 = [];
            p2 = [];  
            limit = 0;         
        }

       function endGame(player){
            $("#result").show()
            if (player == 0) {
                $("#result").html(`It is a tie`)
            }
            else if(player == 1){
                $("#result").html(`${person1} winner`)
            }
            else{
                $("#result").html(`${person2} winner`)
            }
            $("input").prop("disabled", true);
            $(".playagain").show();
            $("#playerindicator").hide();

            $.ajax({
                type: "POST",
                url: "endgame",
                data: {
                    player1: person1,
                    player2: person2,
                    winner: player
                },
                dataType: "json",
                success: function(response){
                    $("#tbody").append(`
                    <tr>
                        <td>${response.player1}</td>
                        <td>${response.player2}</td>
                        <td>${response.winner}</td>
                    </tr>
                    `)
                }    
            });
       }

    </script>

</body>

</html>