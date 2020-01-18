<?php
//bartercoinUsers
// Telegram URL, token, API url
define('TOKEN', '***BOT_TOKEN***');
define('URL', 'https://api.telegram.org/bot'.TOKEN.'/');

// Bot input
$input = json_decode(file_get_contents('php://input'), true);

// User data
$chat_id = $input['message']['chat']['id'];
$username = $input['message']['from']['username'];
$full_name = $input['message']['from']['last_name'].' '.$input['message']['from']['first_name'];
$phone = $input['message']['phone'];

// User auth bartercoin

if ( explode( 'BarterGram', $text )[1] == SITE_TOKEN ){

  $user = $DB->select( 'users', $chat_id );

  if ( !$user ){

    $userPassword = generatePassword();

    $DB->insert( 'users', makeUser( $chat, $userPassword, $full_name, $date ) );

    send_keyb(
      $chat,
      "Добро пожаловать, {$full_name}. Вы зарегистрированы как {$username}!
      Пароль для доступа к сайту: {$userPassword}",
      mainMenu()
    );
  }

  else {
    send_keyb(
      $chat,
      "Вы уже зарегистрированы как {$username}!
      Чтобы восстановить пароль, нажмите: /forot_password",
      mainMenu()
    );
  }
}
?>
