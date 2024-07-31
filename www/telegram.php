<?php declare(strict_types=1);

// configure endpoint
$config = [
    'bot_api_token' => "", // 
    'target_userid' => "", // 
];

// init data structures
$input = ['name' => '', 'email' => '', 'telegram' => '', 'message' => ''];
// track submission success and errors
$success = false;
$errors = [];

// sanitize input
if (isset($_POST['name']))
    $input['name'] = htmlspecialchars($_POST['name']);
if (isset($_POST['email']))
    $input['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
if (isset($_POST['telegram']))
    $input['telegram'] = htmlspecialchars($_POST['telegram']);
if (isset($_POST['message']))
    $input['message'] = htmlspecialchars($_POST['message']);

// submit on POST
if (!empty($_POST)) {
    // check for empty inputs
    if (empty($input['name']))
        $errors['name'] = true;
    if (empty($input['email']) && empty($input['telegram']))
        $errors['contact'] = true;
    if (empty($input['message']))
        $errors['message'] = true;

    if (empty($errors)) {
        { // prepare implodable array for optional contact strings
            $contacts = [];

            if (!empty($input['email'])) {
                $contacts[] = $input['email'];
            }

            // form correct telegram username from user input
            if (!empty($input['telegram'])) {
                // if user provided https://t.me/username or https://t.me/@username format, strip the http part
                if (str_starts_with($input['telegram'], 'http')) {
                    $input['telegram'] = end(explode('/', $input['telegram']));
                }
                // ensure that a @ symbol precedes the username in any case
                $contacts[] = str_starts_with($input['telegram'], '@')? $input['telegram'] : '@' . $input['telegram'];
            }
        }

        { // prepare telegram api payload
            $payload = [
                'chat_id' => $config['target_userid'],
                'text' => sprintf(
                    "%s \\(%s\\):\n\n```\n%s```",
                    filter_tg_markdown($input['name']),
                    filter_tg_markdown(implode(', ', $contacts)),
                    htmlspecialchars_decode($input['message'])
                ),
                'parse_mode' => 'MarkdownV2'
            ];
        }

        { // init & configure curl request
            $curl = curl_init("https://api.telegram.org/bot{$config['bot_api_token']}/sendMessage");

            curl_setopt_array($curl, [
                    CURLOPT_POST => true,                             // set post request method
                    CURLOPT_POSTFIELDS => http_build_query($payload), // attach url-encoded post data
                    CURLOPT_RETURNTRANSFER => true                    // return response, rather than printing it to stdout
                ]
            );
        }

        { // exec api call & eval response
            $response = curl_exec($curl);
            $success = json_decode($response)->ok;
        }
    }
}

function filter_tg_markdown(string $subject): string {
    return preg_replace('/([_\*\[\]\(\)~`>#\+\-=|{}.!])/', '\\\\$1', $subject);
}
