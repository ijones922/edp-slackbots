blockspring = require('blockspring');

var webhook = function(team_domain, service_id, token, user_name, team_id, user_id, channel_id, timestamp, channel_name, text, trigger_word, raw_text) {

    // Basic bot will just echo back the message
    response = ["*", user_name, "* said _", text, "_"].join('')

    return {
        text: response,  // send a text response (replies to channel if not blank)
        attachments: [], // add attatchments: https://api.slack.com/docs/attachments
        username: "",    // overwrite configured username (ex: MyCoolBot)
        icon_url: "",    // overwrite configured icon (ex: https://mydomain.com/some/image.png
        icon_emoji: ""  // overwrite configured icon (ex: :smile:)
    }
}

var block = function(request, response) {
    var team_domain = request.params['team_domain'];
    var service_id = request.params['service_id'];
    var token = request.params['token'];
    var user_name = request.params['user_name'];
    var team_id = request.params['team_id'];
    var user_id = request.params['user_id'];
    var channel_id = request.params['channel_id'];
    var timestamp = request.params['timestamp'];
    var channel_name = request.params['channel_name'];
    var raw_text = text = request.params['text'];
    var trigger_word = request.params['trigger_word'];

    // ignore all bot messages
    if(user_id == 'USLACKBOT') return

    // Strip out trigger word from text if given
    if(trigger_word) {
        text = text.substr(trigger_word.length).trim()
    }

    // Execute bot function
    var output = webhook(team_domain, service_id, token, user_name, team_id, user_id, channel_id, timestamp, channel_name, text, trigger_word, raw_text);

    // set any keys that aren't blank
    Object.keys(output).forEach(function(k) {
        if(output[k]) {
        	response.addOutput(k, output[k]);
        }
    });

    response.end();
}

blockspring.define(block);
