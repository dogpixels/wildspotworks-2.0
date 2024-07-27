<?php declare(strict_types=1);

// prepare data
$input = ['name' => '', 'email' => '', 'telegram' => '', 'message' => ''];
$formDisabled = false;

// sanitize input
if (isset($_POST['name']))
    $input['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
if (isset($_POST['email']))
    $input['name'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
if (isset($_POST['telegram']))
    $input['telegram'] = filter_input(INPUT_POST, 'telegram', FILTER_SANITIZE_STRING);
if (isset($_POST['message']))
    $input['message'] = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// send
if (isset($_POST['submit'])) {
    $formDisabled = true;
}
?>


<?php

function report(array $telegram, string $message): void
{
    print($message);

    $data = [
        'chat_id' => $telegram['admin'],
        'text' => $message,
        'parse_mode' => 'MarkdownV2'
    ];

    $curl = curl_init($telegram['api']);

    curl_setopt_array($curl, [
            CURLOPT_POST => true,                           // set post request method
            CURLOPT_POSTFIELDS => http_build_query($data),  // attach url-encoded post data
            CURLOPT_RETURNTRANSFER => true                  // return response, rather than printing it to stdout
        ]
    );

    $response = curl_exec($curl);

    if (!json_decode($response)->ok)
    {
        print("\nAdditionally to the error above, telegram error reporting failed with the following reponse from Telegram Bot API:\n{$response}");
    }
}
