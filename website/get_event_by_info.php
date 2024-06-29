<?php
$useAPI = false;
// Query API
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $suburbs = isset($_POST["suburbs"]) ? $_POST["suburbs"] : [];
    $event_types = isset($_POST["event_types"]) ? $_POST["event_types"] : [];


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

    // filter through, location, title, event type, id, 
    // list of each entry
    $searchFor = "Brisbane";
    $entries = $xml->entry;
    for ($i = 0; $i < count($entries); $i++) {
        // Checking title
        $entry = $entries[$i];
        if ($title !== "") {
            if (!str_contains($entry->title, $title)) {
                continue;
            }
        }

        // Checking suburb
        if (count($suburbs) > 0) {
            $hasSuburb = false;
            foreach ($suburbs as $suburb) {
                if (str_contains($entry->xpath('//gc:venueaddress')[0], $suburb)) {
                    $hasSuburb = true;
                }
            }
            if (!$hasSuburb) {
                continue;
            }
        }
        

        print_r($entry);

        if (str_contains($entries[$i]->title, $searchFor)) {
            print_r($entries[$i]);
        }
    }
}