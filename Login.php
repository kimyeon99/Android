<?php
    // $con = new mysqli("localhost", "tmdwoy7017", "qw0147QW!", "tmdwoy7017");
    $con = mysqli_connect("localhost", "tmdwoy7017", "qw0147QW!", "tmdwoy7017");
    mysqli_query($con,'SET NAMES utf8');

    $userID = $_POST["userID"];
    $userPassword = $_POST["userPassword"];
    $userName = $_POST["userName"];
    $userNumber = $_POST["userNumber"];
    
    $statement = mysqli_prepare($con, "SELECT * FROM USER WHERE userID = ? AND userPassword = ?");
    mysqli_stmt_bind_param($statement, "ss", $userID, $userPassword);
    mysqli_stmt_execute($statement);


    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $userPassword, $userName, $userNumber);

    $response = array();
    $response["success"] = true;
 
    while(mysqli_stmt_fetch($statement)) {
        $response["success"] = true;
        $response["userID"] = $userID;
        $response["userPassword"] = $userPassword;
        $response["userName"] = $userName;
        $response["userNumber"] = $userNumber;        
    }

    echo json_encode($response);
    echo mysqli_error($con);

    // 앱은 토큰이나 세션으로 아이디를 저장함
    // 그렇다면 만약에 세션을 이용해서 짠다고 하면
    // 얼마나 걸릴까요? => 웹으로는 세션은 3일 걸렸다. 대충(완벽하게 하려고 ㄴㄴ)
    // 또 어떻게 공부해야할까요? => 구글링
    // 세션은 db에 저장해야한다, 로그인 할 클라이언트를 가지고 있어야 한다
    // php가 그런 거 였구나.. 난 진짜 몰랐네 쓰레기같은 인생을 살다보니...

?>