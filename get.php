<?php
//$url=$_GET['url'];
$url  = "https://animeflv.net/ver/51469/boogiepop-wa-warawanai-2019-14";
$page = getpage($url);
if ($page['status'] == "503") {
    exec('python scrapper.py "' . getHost($url) . '"');
    echo getpage($url)['body'];
} else {
    echo $page['body'];
}

function getpage($url)
{
    $domain = getHost($url);
    $curl   = curl_init();
    $Cookie = file_get_contents($domain . '-cookies.txt');
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_HEADER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => array(
            "Cookie: " . $Cookie,
            "Postman-Token: 80e5753d-e137-4cff-b51d-c19ea4d51db0",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36",
            "cache-control: no-cache"
        )
    ));
    
    $response['body']   = curl_exec($curl);
    $response['status'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $response['err']         = curl_error($curl);
    curl_close($curl);
    return $response;
}
function getHost($Address)
{
    $parseUrl = parse_url(trim($Address));
    return trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2)));
}