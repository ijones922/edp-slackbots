<?php
require('blockspring.php');

function webhook($team_domain, $service_id, $token, $user_name, $team_id, $user_id, $channel_id, $timestamp, $channel_name, $text, $trigger_word, $raw_text) {

    // Basic bot will just echo back the message
    $response = "*" . $user_name . "* said _" . $text . "_";

    return array(
        "text" => $response,  // send a text response (replies to channel if not blank)
        "attachments" => array(), // add attatchments: https://api.slack.com/docs/attachments
        "username" => "",    // overwrite configured username (ex: MyCoolBot)
        "icon_url" => "",    // overwrite configured icon (ex: https://mydomain.com/some/image.png
        "icon_emoji" => ""  // overwrite configured icon (ex: :smile:)
    );
}

Blockspring::define(function ($request, $response) {
    $team_domain = isset($request->params['team_domain']) ? $request->params['team_domain'] : "";
    $service_id = isset($request->params['service_id']) ? $request->params['service_id'] : "";
    $token = isset($request->params['token']) ? $request->params['token'] : "";
    $user_name = isset($request->params['user_name']) ? $request->params['user_name'] : "";
    $team_id = isset($request->params['team_id']) ? $request->params['team_id'] : "";
    $user_id = isset($request->params['user_id']) ? $request->params['user_id'] : "";
    $channel_id = isset($request->params['channel_id']) ? $request->params['channel_id'] : "";
    $timestamp = isset($request->params['timestamp']) ? $request->params['timestamp'] : "";
    $channel_name = isset($request->params['channel_name']) ? $request->params['channel_name'] : "";
    $raw_text = $text = isset($request->params['text']) ? $request->params['text'] : "";
    $trigger_word = isset($request->params['trigger_word']) ? $request->params['trigger_word'] : "";

    // ignore all bot messages
    if($user_id == 'USLACKBOT') {
        return;
    }

    // Strip out trigger word from text if given
    if($trigger_word) {
        $text = trim(substr($text, strlen($trigger_word)));
    }

    // Execute bot function
    $output = webhook($team_domain, $service_id, $token, $user_name, $team_id, $user_id, $channel_id, $timestamp, $channel_name, $text, $trigger_word, $raw_text);

    // set any keys that aren't blank
    foreach($output as $k => $v) {
        if($output[$k]) {
        	$response->addOutput($k, $output[$k]);
        }
    }

    $response->end();
});
