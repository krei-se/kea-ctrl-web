<?php

header('Content-Type: application/json');

$ctrl_agent_url = 'http://127.0.0.1:8000';


$input_data = file_get_contents('php://input');

if (empty($input_data)) {
    http_response_code(400);
    echo json_encode(['error' => 'No JSON payload provided']);
    exit;
}


$auth_header = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : '';

// 4. Forward request to kea-ctrl-agent using cURL
$ch = curl_init($ctrl_agent_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $input_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: ' . $auth_header
]);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
// deprecated, done automatically curl_close($ch);

if ($curl_error) {
    http_response_code(502);
    echo json_encode(['error' => 'Failed to reach kea-ctrl-agent: ' . $curl_error]);
    exit;
}

http_response_code($http_code);
echo $response;
