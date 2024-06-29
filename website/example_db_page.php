<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="website.css">
    <body>
        <form id="query_db" name="query_db" method="post">
            <label for="query">Query:</label><br>
            <input type="query" id="query" name="query">
            <input type="submit" value="Submit">
        </form>
        <div id="queryResults">

        </div>
        <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var form = document.getElementById("query_db");

                    form.addEventListener("submit", function(event) {
                        event.preventDefault();

                        var formData = new FormData(form);

                        var url = "query_db.php";

                        fetch(url, {
                            method: "POST",
                            body: formData
                        })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('queryResults').innerHTML = data;
                        })
                        .catch(error => cosole.error('Error:', error));
                    });
                });
            </script>

    </body>
</html>
