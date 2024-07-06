<?php 
    session_start();
    $_SESSION["USER"] = "2";
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="website.css">
    <script>
        function subscribeToEvent(userID, eventID) {
            var query = `INSERT INTO userevents (user_id, event_id) VALUES ('${userID}', '${eventID}')`;
            var url = "query_db.php";
            var formData = new FormData();
            formData.append("query", query);
            fetch(url, {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('searchResults').innerHTML = data;
            })
            .catch(error => cosole.error('Error:', error));
        }
    </script>
    <body>
        <h2>ID Form</h2>
        <form action="get_event_by_id.php" method="post">
            <label for="id">ID:</label><br>
            <input type="text" id="id" name="id"><br><br>
            <input type="submit" value="Submit">
        </form>
        
        
        <h2>Event Form</h2>
        <div class="container">
            <div class="side-min">
                <form id="get_event_by_info" name="get_event_by_info" method="post">
                    <label for="title">Title:</label><br>
                    <input type="text" id="title" name="title"><br><br>

                    <label for="suburbs">Suburbs:</label><br>
                    <input type="checkbox" id="suburb1" name="suburbs[]" value="Suburb1">
                    <label for="suburb1">Suburb 1</label><br>
                    <input type="checkbox" id="suburb2" name="suburbs[]" value="Suburb2">
                    <label for="suburb2">Suburb 2</label><br>
                    <!-- Add more suburbs as needed -->

                    <br>

                    <label for="event_types">Event Types:</label><br>
                    <input type="checkbox" id="type1" name="event_types[]" value="Type1">
                    <label for="type1">Type 1</label><br>
                    <input type="checkbox" id="type2" name="event_types[]" value="Type2">
                    <label for="type2">Type 2</label><br>
                    <!-- Add more event types as needed -->

                    <br>

                    <input type="submit" value="Submit">
                </form>
            </div>
            <div id="searchResults" class="search-results">

            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var form = document.getElementById("get_event_by_info");

                    form.addEventListener("submit", function(event) {
                        event.preventDefault();

                        var formData = new FormData(form);

                        var url = "get_event_by_info.php";

                        fetch(url, {
                            method: "POST",
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('searchResults').innerHTML = data;
                        })
                        .catch(error => cosole.error('Error:', error));
                    });
                });
            </script>
        </div>

        

    </body>
</html>
