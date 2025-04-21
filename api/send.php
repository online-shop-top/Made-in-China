<?php
// 1. Захист за секретним ключем
$secret_key = "my-secret-key"; // Заміни на свій випадковий ключ
if (!isset($_POST['key']) || $_POST['key'] !== $secret_key) {
    http_response_code(403);
    echo "Access denied.";
    exit;
}

// 2. Дані замовлення з форми
$order = $_POST['order'] ?? 'No data';

// 3. Надсилання повідомлення в Telegram
$token = "8183148351:AAGytuw_-K87F175JLUWiGan8J816pliJdY"; // токен твого бота
$chat_id = "2102040810"; // твій Chat ID
$text = "Нове замовлення:\n" . $order;

// 4. Відправка
file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=" . urlencode($text));

// 5. Відповідь
echo "OK";
?>
