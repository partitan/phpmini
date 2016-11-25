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
					

			
			//Twitter APP
			$consumerKey    = 'LwjDAci8dZKpho1QhnV2PF6DN';
			$consumerSecret = 'TCWqkK073gt4grLCUilslRmS5NRoHvYJUMQuiCPIu6FNfMHzBC';
			$oAuthToken     = '802168980853006336-Xj52cmzoQvIUQLVXqvaebyCVwiqEamK';
			$oAuthSecret    = 'xXgODYhqMiljgooADDQHDyAjeIrwcVo00gzzs48aezDFi';
			require_once('twitteroauth.php');
			$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
			$tweet->post('direct_messages/new', array('screen_name' => 'krungthepCXP', 'text' =>$messages));
					
			//sleep(5);
			
			//$tweetreply = new TwitterOAuth2($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
			//$tweetreply ->get('direct_messages', array('count' => 1));
			$textx = 'from CXP Proxy';
			$msgReply = [
				'type' => 'text',
				'text' => $textx
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				//'messages' => [$messages],
				'messages' => [$msgReply],
			];		
			
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
//echo "OK";

