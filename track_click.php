<?php
// Settings
$log_file = 'click_data.json'; // The file where data will be stored

// 1. Get User IP
$user_ip = $_SERVER['REMOTE_ADDR'];
// Handle proxies (Cloudflare, etc.)
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $user_ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

// 2. Load existing data
$current_data = [];
if (file_exists($log_file)) {
    $json_content = file_get_contents($log_file);
    $current_data = json_decode($json_content, true);
    if (!is_array($current_data)) {
        $current_data = [];
    }
}

// 3. Check if IP exists
$ip_exists = false;
foreach ($current_data as $entry) {
    if ($entry['ip'] === $user_ip) {
        $ip_exists = true;
        break;
    }
}

// 4. If IP is unique, record it
if (!$ip_exists) {
    // Get Country via API
    $api_url = "http://ip-api.com/json/" . $user_ip;
    $geo_data = @json_decode(file_get_contents($api_url));
    
    $country = "Unknown";
    if ($geo_data && $geo_data->status == 'success') {
        $country = $geo_data->country;
    }

    // Add new entry
    $new_entry = [
        'ip' => $user_ip,
        'country' => $country,
        'time' => date('Y-m-d H:i:s')
    ];

    $current_data[] = $new_entry;

    // Save back to file (using Lock to prevent errors if 2 people click at once)
    file_put_contents($log_file, json_encode($current_data, JSON_PRETTY_PRINT), LOCK_EX);
}
?>