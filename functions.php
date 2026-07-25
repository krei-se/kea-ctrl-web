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



/**
 * Resolves the actual array value based on the user's selected sort order.
 */
function get_sort_value(array $item, string $sortorder): string
{
    // If user chose 'identifier', map to hw-address (v4) or duid (v6)
    if ($sortorder === 'identifier') {
        return $item['hw-address'] ?? $item['duid'] ?? '';
    }

    // If user chose 'ip-address', handle both string 'ip-address' and array 'ip-addresses'
    if ($sortorder === 'ip-address') {
        if (isset($item['ip-address'])) {
            return $item['ip-address'];
        }
        if (isset($item['ip-addresses'][0])) {
            return $item['ip-addresses'][0];
        }
        return '';
    }

    // Default (e.g. 'hostname')
    return $item[$sortorder] ?? '';
}

/**
 * Sorts Kea Leases or Reservations based on $_COOKIE['sortorder']
 */
function sort_kea_items(array $items): array
{
    $sortorder = $_COOKIE['sortorder'] ?? 'ip-address';

    usort($items, function ($a, $b) use ($sortorder) {
        $valA = get_sort_value($a, $sortorder);
        $valB = get_sort_value($b, $sortorder);

        // Natural IP comparison (v4 or v6)
        if ($sortorder === 'ip-address') {
            $binA = @inet_pton($valA);
            $binB = @inet_pton($valB);
            if ($binA !== false && $binB !== false) {
                return $binA <=> $binB;
            }
        }

        // Natural string comparison (for Hostnames, MACs, DUIDs)
        return strnatcasecmp($valA, $valB);
    });

    return $items;
}
