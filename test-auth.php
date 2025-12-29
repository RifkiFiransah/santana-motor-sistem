#!/usr/bin/env php
<?php
/**
 * Test Script untuk Login & Logout Flow
 * Usage: php test-auth.php
 */

$base_url = 'http://localhost:8080';
$username = 'pemilik';
$password = 'pemilik123';

echo "=== Auth Testing Script ===\n";
echo "Testing base URL: {$base_url}\n\n";

// Initialize curl session
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');

// Test 1: Get login page
echo "[1] Fetching login page...\n";
curl_setopt($ch, CURLOPT_URL, "{$base_url}/");
curl_setopt($ch, CURLOPT_HTTPGET, true);
$login_page = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($http_code !== 200) {
    echo "❌ Failed to fetch login page. HTTP Code: {$http_code}\n";
    exit(1);
}
echo "✅ Login page fetched successfully\n";

// Extract CSRF token from login form
if (preg_match('/<input[^>]*name=["\']csrf_test_name["\'][^>]*value=["\']([^"\']+)["\']/', $login_page, $matches)) {
    $csrf_token = $matches[1];
    echo "✅ CSRF token extracted: {$csrf_token}\n";
} else {
    echo "⚠️  Warning: Could not find CSRF token. Continuing anyway...\n";
    $csrf_token = '';
}

// Test 2: Login
echo "\n[2] Attempting login...\n";
$login_data = [
    'username' => $username,
    'password' => $password,
];
if ($csrf_token) {
    $login_data['csrf_test_name'] = $csrf_token;
}

curl_setopt($ch, CURLOPT_URL, "{$base_url}/login");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($login_data));
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "HTTP Code: {$http_code}\n";
if ($http_code === 302 || $http_code === 301) {
    echo "✅ Login redirect successful\n";
} else if ($http_code === 200) {
    if (strpos($response, 'dashboard') !== false) {
        echo "✅ Login successful (redirected to dashboard)\n";
    } else {
        echo "⚠️  Login page returned, but might have logged in\n";
    }
} else {
    echo "❌ Unexpected HTTP code: {$http_code}\n";
}

// Test 3: Access protected page
echo "\n[3] Accessing dashboard (protected page)...\n";
curl_setopt($ch, CURLOPT_URL, "{$base_url}/pemilik/dashboard");
curl_setopt($ch, CURLOPT_HTTPGET, true);
$dashboard = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($http_code === 200) {
    echo "✅ Dashboard access successful\n";
} else {
    echo "❌ Dashboard access failed. HTTP Code: {$http_code}\n";
}

// Test 4: Logout
echo "\n[4] Testing logout...\n";
curl_setopt($ch, CURLOPT_URL, "{$base_url}/logout");
curl_setopt($ch, CURLOPT_HTTPGET, true);
$logout_response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "HTTP Code: {$http_code}\n";
if ($http_code === 302 || $http_code === 301 || $http_code === 200) {
    echo "✅ Logout endpoint responded\n";
} else {
    echo "❌ Logout endpoint failed. HTTP Code: {$http_code}\n";
}

// Test 5: Try accessing protected page after logout
echo "\n[5] Verifying logout (trying to access dashboard)...\n";
curl_setopt($ch, CURLOPT_URL, "{$base_url}/pemilik/dashboard");
curl_setopt($ch, CURLOPT_HTTPGET, true);
$protected = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($http_code === 302 || $http_code === 301) {
    echo "✅ Logout verified - redirected to login page\n";
} else if ($http_code === 200) {
    if (strpos($protected, 'login') !== false || strpos($protected, 'Login') !== false) {
        echo "✅ Logout verified - login page shown\n";
    } else {
        echo "⚠️  Got 200 response but content unclear\n";
    }
} else {
    echo "❌ Unexpected response. HTTP Code: {$http_code}\n";
}

curl_close($ch);
echo "\n=== Test Complete ===\n";
?>
