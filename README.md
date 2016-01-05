# Serverless Slackbot Templates
Serverless SlackBot Templates with Blockspring.

With Blockspring, users can load up Excel or Google Sheets, install a plugin, and voila: gain access to hundreds of web services. Without ever having to leave your spreadsheet, you can pull a self-updating database on competitors, download raw data — from census data to crime data, or weather, or any of the hundreds of available public data feeds — get real-time pricing for products on Amazon, compare Bitcoin with stock prices, or analyze the social sentiment on your company. Since Blockspring is pulling in a live data feed and then standardizing it, there’s no need to update it. It’s truly a real-time data source for any API.

For Slack, we can use these blocks with webhook Url's and get data in real time from trigger words within the chatroom.

Read More [Here](http://venturebeat.com/2015/10/26/blockspring-the-do-anything-in-a-spreadsheet-startup-partners-with-tableau/)

## Installing the Blockspring App in Slack
This App allows slash commands to search, view and use the webhooks of existing blocks on blockspring.com. Download that [here](https://www.blockspring.com/help/install_plugins)

## Installing to develop locally
For all Language setups go here for [documentation](https://www.blockspring.com/docs)

This setup is for NODE.JS

First, install Blockspring. Go to a working /dir that you want to store your bots in, From your command line, enter:

>npm install blockspring

Blockspring is installed. To initialize it, open your Node.js environment and enter:

>var blockspring = require("blockspring");

## Blockspring-CLI tool

1. Install the Blockspring-CLI tool

>$ gem install blockspring-cli

2. Login to Blockspring

We'll need to login with our Blockspring account. No Blockspring account yet? Sign up [here](https://api.blockspring.com/users/sign_up) first.

>$ blockspring login
```
Enter your Blockspring credentials.
Username or email: name@example.com
Password (typing will be hidden):
You are logged in as [name].
```

3. Create a new block

We can create blocks in ruby, python, javascript, php, or R (and more languages are coming soon). Let's create a node block.

>$ blockspring new node "My new node block"
```
Creating directory my-new-node-block
Creating script file my-new-node-block/block.js
Creating config file my-new-node-block/blockspring.json
```

4. Deploy your block

Let's enter our new block's directory and deploy.

>$ cd my-new-node-block
>$ blockspring push
```
Syncronizing script file ./block.js
Syncronizing config file ./blockspring.json
```

5. Visit your block's homepage

Now that our block is now deployed we can visit its homepage to see it in action.

>$ blockspring open

## Testing Locally

With certain params that you define within your blockspring.json and in block.js. You can run the block with node and pass in param data to get results.

Within your newly created block, run this in console. The --text is the param defined within my .json file and will be defined within my block.js. you should see a object returned thats optimized for slack, You can look at their API docs [here](https://api.slack.com/docs/attachments).
>$blockspring run node block.js --text=hello
```
{"_blockspring_spec":true,"_errors":[],"text":"Hi you","attachments":[null]}
```
