<?php
    error_reporting(E_ALL);
    set_time_limit(0);

    $address = "192.168.83.106"; // 대상 IP
    $port = 4096;                // 대상 Port

    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); // Socket 생성
    socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 5, 'usec' => 0)); // Socket 옵션 변경
    $result = socket_connect($socket, $address, $port); // TCP Socket 연결 시도
    
    if ($result === false) 
    {
        // 실패
        echo "통신 실패 : ".socket_strerror(socket_last_error());
    }

    $protocol = "FF FA 46 33 52 A1 00 FF FE";
    $hexProtocol = hex2bin(str_replace(" ", "", $protocol));

    // SEND
    $result = socket_write($socket, $hexProtocol, strlen($hexProtocol)); 
    if ($result === false) 
    {
        // 실패 thorw
    }

    // RECV
    $input = socket_read($socket, 1024) or die("Could not read from Socket\n");
    socket_close($socket);

    // 출력
    print_r($input);
?>