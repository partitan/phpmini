<?php
$access_token = 'CEdTKiv9KD/q/C4xWu9hEUbI/RxXH026qprWmcyqgGwuFz6fXfXPuo+ND2WPBNiGDgjSRjtXHiZDaKp62GfpwKjm5/GBdcI4LuvzkB1rFfTzSBtkLaN6/xxE9EU8A0/Mf4+rQb4ZiMOH9eij2kFeFQdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			
			$consumerKey    = '4MTtBPsekfyeS1gGLIndqbWbC';
			$consumerSecret = 'WGBrMsZacLjCp3KPGhxyvDHske0N9YS1ZZiewnaGOXVpfst04J';
			$oAuthToken     = '747679427291676673-vuIY9VA4WL1e0t0kBkqL5P4uF3S4GHZ';
			$oAuthSecret    = 'NUqaIFUzx5iiPkMsqlEvzhJe3hrO1JXxLQ2mwvYX36gph';
			require_once('twitteroauth.php');
			$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
			$tweet->post('direct_messages/new', array('screen_name' => 'prungkrae', 'text' => $messages ));
					
			
			
			///////////////////////////////////////////////////////
			//Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			/////////////////////////////////////////////////////
			//Twitter APP
			
			
			
			
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}
echo "OK";
