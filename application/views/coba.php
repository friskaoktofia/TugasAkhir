<?php
    $url = 'https://api.thingspeak.com/channels/811293/feeds.json';
    $jsondata = file_get_contents($url);
    $arrayData = json_decode($jsondata);

    //print_r($arrayData->feeds);

?>
<html>
    <head></head>
    <body>
        <div id="aku"></div>
        <?php
                echo "hai";
            ?>
            <?php //print_r( $arrayData ); ?>
        <script>
            var arrayLat = [];
            var arrayB = [];

            <?php foreach ($arrayData->feeds as $key => $value) { ?>
                arrayLat.push("<?php echo $value->field2; ?>");
                
            <?php } ?>
            document.getElementById("aku").innerHTML = arrayLat;
        </script>   
    </body>
    
</html>