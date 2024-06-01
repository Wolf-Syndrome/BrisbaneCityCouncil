<!DOCTYPE html>
<html>
    <body>

    <?php
        $useAPI = false;
        // Query API
        if ($useAPI) {
            $url = 'http://www.trumba.com/calendars/brisbane-city-council.xml';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            // Check if request was successful
            if ($response === false) {
                die('Error fetching data: ' . curl_error($curl));
            }

            // Parse XML response
            $xml = simplexml_load_string($response);
        } else {
            $xml = simplexml_load_file("event.xml");
        }

        // Check if XML parsing was successful
        if ($xml === false) {
            die('Error parsing XML');
        }
        
        // Now you can access the XML data
        // For example, if the XML structure is like <data><item>...</item></data>
        // You can iterate over the items like this:
        print_r($xml);
    ?>

    <h1>Test</h1>

    </body>
</html>
