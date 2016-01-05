import blockspring

def webhook(team_domain, service_id, token, user_name, team_id, user_id, channel_id, timestamp, channel_name, text, trigger_word, raw_text):

    # Basic bot will just echo back the message
    response = "*%s* said _%s_" % (user_name, text)

    return {
        "text": response,  # send a text response (replies to channel if not blank)
        "attachments": [], # add attatchments: https://api.slack.com/docs/attachments
        "username": "",    # overwrite configured username (ex: MyCoolBot)
        "icon_url": "",    # overwrite configured icon (ex: https://mydomain.com/some/image.png
        "icon_emoji": ""  # overwrite configured icon (ex: :smile:)
    }

def block(request, response):
    team_domain = request.params.get("team_domain", "")
    service_id = request.params.get("service_id", "")
    token = request.params.get("token", "")
    user_name = request.params.get("user_name", "")
    team_id = request.params.get("team_id", "")
    user_id = request.params.get("user_id", "")
    channel_id = request.params.get("channel_id", "")
    timestamp = request.params.get("timestamp", "")
    channel_name = request.params.get("channel_name", "")
    raw_text = text = request.params.get("text", "")
    trigger_word = request.params.get("trigger_word", "")

    # ignore all bot messages
    if user_id == 'USLACKBOT':
        return

    # Strip out trigger word from text if given
    if trigger_word:
        text = text[len(trigger_word):].strip()

    # Execute bot function
    output = webhook(team_domain, service_id, token, user_name, team_id, user_id, channel_id, timestamp, channel_name, text, trigger_word, raw_text)

    # set any keys that aren't blank
    for k in output.keys():
        if output[k]:
	        response.addOutput(k, output[k])

    response.end()

blockspring.define(block)
