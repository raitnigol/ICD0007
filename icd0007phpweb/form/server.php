<?php

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Cannot create a socket");
socket_bind($socket, "127.0.0.1", "8080") or die("Could not bind to socket");
socket_listen($socket) or die("Could not listen to socket");

print "Server is running...";

while (($acceptedSocket = socket_accept($socket)) !== false) {

    //$input = socket_read($acceptedSocket, 2048);
    $output = shell_exec('php ../multiplication/main.php');

    socket_write($acceptedSocket, addHeader($output));
}

function addHeader($content): string {
    $template = "HTTP/1.1 200 OK
Host: localhost:8080
Content-Type: text/html; charset=UTF-8
Content-Length: %d

%s";

    return sprintf($template, strlen($content), $content);
}
