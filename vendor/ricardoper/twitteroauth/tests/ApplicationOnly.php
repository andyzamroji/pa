<?php

/**
 * TwitterOAuth - https://github.com/ricardoper/TwitterOAuth
 * PHP library to communicate with Twitter OAuth API version 1.1
 *
 * @author Ricardo Pereira <github@ricardopereira.es>
 * @copyright 2014
 */

require __DIR__ . '/../../../vendor/autoload.php';

use TwitterOAuth\Auth\ApplicationOnlyAuth;
use TwitterOAuth\Serializer\ArraySerializer;


date_default_timezone_set('UTC');

header('Content-Type: text/html; charset=utf-8');

?>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    window.onload = function(){
        $('pre.array')
            .addClass('closed')
            .click(function(){
                $(this).toggleClass('closed');
            });
    }
</script>
<style>
    pre{overflow:hidden;}
    .strip{margin-left:5px;width:90%;vertical-align:top;display:inline-block;word-wrap:break-word;}
    .closed{height:84px;cursor:pointer;}
</style>

<?php

$credentials = array(
    'consumer_key' => 'GzFUgivQyKdwW0s5ot2zOrPZ2',
    'consumer_secret' => 'gXxm5vRKpZpuKYPMeWyqgZzuiSswq5ND4ttuXilfkXVXWezYuY',
);

$auth = new ApplicationOnlyAuth($credentials, new ArraySerializer());

// ==== ==== ==== //

$params = array(
    'screen_name' => 'ricard0per',
    'count' => 3,
    'exclude_replies' => true,
);

$response = $auth->get('statuses/user_timeline', $params);

echo '<strong>statuses/user_timeline</strong><br />';
echo '<pre class="array">'; print_r($auth->getHeaders()); echo '</pre>';
echo '<pre class="array">'; print_r($response); echo '</pre><hr />';

// ==== ==== ==== //

$params = array(
    'q' => '#php',
    'count' => 3,
);

$response = $auth->get('search/tweets', $params);

echo '<strong>search/tweets</strong><br />';
echo '<pre class="array">'; print_r($auth->getHeaders()); echo '</pre>';
echo '<pre class="array">'; print_r($response); echo '</pre><hr />';

// ==== ==== ==== //

$params = array(
    'screen_name' => 'ricard0per',
    'count' => 10,
);

$response = $auth->get('followers/ids', $params);

echo '<strong>followers/ids</strong><br />';
echo '<pre class="array">'; print_r($auth->getHeaders()); echo '</pre>';
echo '<pre class="array">'; print_r($response); echo '</pre><hr />';
