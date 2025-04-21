<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// 1. Захист за секретним ключем
$secret_key = "my-secret-key";
if (!isset($_POST['key']) || $_POST['key'] !== $secret_key) {
    http_response_code(403);
    echo json_encode(["ok" => false, "error" => "Access denied"]);
    exit;
}

// 2. Дані замовлення з форми
$order = $_POST['order'] ?? 'No data';

// 3. Надсилання повідомлення в Telegram
$token = "8183148351:AAGytuw_-K87F175JLUWiGan8J816pliJdY";
$chat_id = "2102040810";
$text = "Нове замовлення:\n" . $order;

// 4. Відправка
$response = file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode($text));

if ($response === false) {
    echo json_encode(["ok" => false, "error" => "Failed to connect to Telegram API"]);
    exit;
}

// 5. Успішна відповідь
echo json_encode(["ok" => true]);
?>
