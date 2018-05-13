<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- <meta charset="utf-8" http-equiv="refresh" content = "10"> -->
    <title></title>
  </head>
  <body>
    <?php

    // //KONEKSI
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "db_e100";
    //
    // // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

        //connect to mysql db
        $con =mysqli_connect("localhost","root","","db_e100") or die("Not connected.");

         //mysqli_connect("root","","") or die('Could not connect: ' . mysql_error());
        //connect to the employee database
        //mysqli_select_db("db_e100", $con);


    /**
     * TwitterOAuth - https://github.com/ricardoper/TwitterOAuth
     * PHP library to communicate with Twitter OAuth API version 1.1
     *
     * @author Ricardo Pereira <github@ricardopereira.es>
     * @copyright 2014
     */

    require __DIR__ . '/../../../../vendor/autoload.php';

    use TwitterOAuth\Auth\ApplicationOnlyAuth;

    /**
     * Serializer Namespace
     */
    use TwitterOAuth\Serializer\ObjectSerializer;
    //use TwitterOAuth\Serializer\ObjectSerializer;


    date_default_timezone_set('UTC');


    /**
     * Array with the OAuth tokens provided by Twitter
     *   - consumer_key     Twitter API key
     *   - consumer_secret  Twitter API secret
     */
    $credentials = array(
        'consumer_key' => 'xxx',
        'consumer_secret' => 'xxx',
    );

    /**
     * Instantiate ApplicationOnly
     *
     * For different output formats you can set one of available serializers
     * (Array, Json, Object, Text or a custom one)
     */
    $auth = new ApplicationOnlyAuth($credentials, new ObjectSerializer());


    /**
     * Returns a collection of the most recent Tweets posted by the user
     * https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
     */
    $params = array(
        'screen_name'     => 'e100ss',
        'count'           => 5,
        //'exclude_replies' => true,
        //'max_id'          => 'xxx',
    );

    /**
     * Send a GET call with set parameters
     */
    $response = $auth->get('statuses/user_timeline', $params);

    //echo '<pre>'; print_r($auth->getHeaders()); echo '</pre>';

    // echo '<pre>'; print_r($response); echo '</pre><hr />';
    // print_r($response);


    // echo 'ID : ' . $response['0']['id_str'] . '<br />';
    // echo 'created_at : ' . $response['0']['created_at'] . '<br />';
    // echo 'text : ' . $response['0']['text'] . '<br />';
    // echo 'retweet_count : ' . $response['0']['retweet_count'] . '<br />';
    // echo 'favorite_count : ' . $response['0']['favorite_count'] . '<br />';
    // echo "<HR>";

    // foreach ($response as $key => $jsons) { // This will search in the 2 jsons
    //      foreach($jsons as $key => $values) {
    //          //echo $value; // This will show jsut the value f each key like "var1" will print 9
    //                        //And then goes print 16,16,8 ...
    //       if($key == 'id_str'){
    //         echo 'ID : ' . $value . '<br />';
    //       }
    //       if($key == 'created_at'){
    //         echo 'created_at : ' . $value . '<br />';
    //       }
    //       if($key == 'text'){
    //         echo 'text : ' . $value . '<br />';
    //       }
    //       if($key == 'retweet_count'){
    //         echo 'retweet_count : ' .$value . '<br />';
    //       }
    //       if($key == 'favorite_count'){
    //         echo 'favorite_count : ' . $value;
    //       }

            // echo $values->id_str . "\n";
            // echo $values->created_at . "\n";
            // echo $values->text . "\n";
            //echo $values->title . "\n";
            //$i++;
            //echo "<HR>";
    //     }
    // }

    foreach($response as $values)
    {

        //echo $values->id_str . "\n";
        // echo $values->created_at . "\n";
        // echo $values->text . "\n";
        // echo $values->retweet_count . "\n";
        // echo $values->favorite_count . "\n";
        // echo "<HR>";
        $sql = "SELECT * FROM persons";
        $id             = $values->id_str;
        $created_at     = $values->created_at;
        $text           = $values->text;
        $retweet_count  = $values->retweet_count;
        $favorite_count = $values->favorite_count;
        $tgl = date('Y-m-d', strtotime($created_at));

        $sql = mysqli_query($con,"INSERT INTO tweet (id_str, created_at, text, retweet_count,  favorite_count) VALUES ('$id','$tgl','$text','$retweet_count','$favorite_count')");

    }

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        //you need to exit the script, if there is an error
        exit();
    }
    ?>

  </body>
</html>
