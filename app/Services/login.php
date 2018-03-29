<?php
$fb = new Facebook\Facebook([
    'app_id' => '149615715574904', // Replace {app-id} with your app id
    'app_secret' => '78a2570416d3c834f68eeda5d2e39611',
    'default_graph_version' => 'v2.9',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>