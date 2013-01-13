# Generate short HREFs with ease

Project is live and is located under [http://hrf.li](http://hrf.li).

Go ahead and shorten your URLs!

## API

For now there is a [TweetBot-compliant](http://tapbots.net/tweetbot/custom_url/) API:

        GET http://hrf.li/api?url=%@

But you can use it for your other clients as well, since it returns a pretty standardized JSON:

        {"shortURL":"http:\/\/hrf.li\/BUI3Hl"}