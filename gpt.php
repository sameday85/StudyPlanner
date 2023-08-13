<?php 

function talk2chatGPT(string $question): string {
    
    $apiKey = "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";
    $url = 'https://api.openai.com/v1/chat/completions';  
    
    $headers = array(
        "Authorization: Bearer {$apiKey}",
        "Content-Type: application/json"
    );
    
    // Define messages
    $messages = array();
    $message = array();
    $message["role"] = "assistant";
    $message["content"] = $question;
    $messages[] = $message;

    // Define data
    $data = array();
    $data["model"] = "gpt-3.5-turbo-0613";
    $data["messages"] = $messages;
    $data["max_tokens"] = 3000;

    // init curl
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);    
    curl_setopt($curl, CURLOPT_TIMEOUT, 400);
    $answer = "";
    $result = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);    
    if ($httpcode == "200") {
        $response = json_decode($result, true);
        $answer = nl2br($response['choices'][0]['message']['content']);
    }
    else if ($httpcode == "429") {
        $answer = "<span style='color:red'>Rate limit reached on requests per min. Please retry in a minute.</span>";
    }     
    else {
        //{ "error": { "message": "Rate limit reached for default-gpt-3.5-turbo in organization org-CMaH9FqdiLQE1LVAWT1AINwZ on requests per min. Limit: 3 / min. Please try again in 20s. Contact us through our help center at help.openai.com if you continue to have issues. Please add a payment method to your account to increase your rate limit. Visit https://platform.openai.com/account/billing to add a payment method.", "type": "requests", "param": null, "code": "rate_limit_exceeded" } } Error:429 
        $answer = 'Error:' . $httpcode;
    }
    
    curl_close($curl);
    return $answer;
}
set_time_limit(0);
$days = $_POST['days'];
$grade = $_POST['grade'];
$subject = $_POST['subject'];
$daily_time = $_POST['daily_time'];
$prompt = "I only have $days to prepare for an exam. I am in $grade. The exam is in $subject. I have $daily_time minutes each day. and it stays that way. Explain how many minutes should I study on what on each day. Be very specific (explain individual examples like what formulas to remember) but still have some broadness. Thank you!";

echo talk2chatGPT($prompt);

?>

