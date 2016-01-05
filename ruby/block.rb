require 'blockspring'

def webhook(team_domain, service_id, token, user_name, team_id, user_id, channel_id, timestamp, channel_name, text, trigger_word, raw_text)

    # Basic bot will just echo back the message
    response = "*#{user_name}* said _#{text}_"

    return {
        text: response,  # send a text response (replies to channel if not blank)
        attachments: [], # add attatchments: https://api.slack.com/docs/attachments
        username: "",    # overwrite configured username (ex: MyCoolBot)
        icon_url: "",    # overwrite configured icon (ex: https://mydomain.com/some/image.png
        icon_emoji: "",  # overwrite configured icon (ex: :smile:)
    }
end

block = lambda do |request, response|
    team_domain = request.params['team_domain']
    service_id = request.params['service_id']
    token = request.params['token']
    user_name = request.params['user_name']
    team_id = request.params['team_id']
    user_id = request.params['user_id']
    channel_id = request.params['channel_id']
    timestamp = request.params['timestamp']
    channel_name = request.params['channel_name']
    raw_text = text = request.params['text']
    trigger_word = request.params['trigger_word']

    # ignore all bot messages
    return if user_id == 'USLACKBOT'

    # Strip out trigger word from text if given
    if trigger_word
        text = text[trigger_word.length..text.length].strip
    end

    # Execute bot function
    output = webhook(team_domain, service_id, token, user_name, team_id, user_id, channel_id, timestamp, channel_name, text, trigger_word, raw_text)

    # set any keys that aren't blank
    output.keys.each do |k|
        response.addOutput(k, output[k]) unless output[k].nil? or output[k].empty?
    end

    response.end
end

Blockspring.define(block)
