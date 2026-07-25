<?php

function send_kea_command(string $command, array $services, array $arguments = [])
{
    $user = $_COOKIE['kea_user'] ?? '';
    $pass = $_SESSION['kea_pass'] ?? '';

    $payload = json_encode([
        'command' => $command,
        'service' => $services,
        'arguments' => $arguments
    ]);

    $ch = curl_init(KEA_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode("$user:$pass")
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // deprecated, not needed curl_close($ch);

    if ($http_code !== 200 || !$response) {
        return ['result' => 1, 'text' => "HTTP Error or Kea Unreachable ($http_code)"];
    }

    $decoded = json_decode($response, true);
    return $decoded[0] ?? ['result' => 1, 'text' => 'Invalid JSON from Kea'];
}
