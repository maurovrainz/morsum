<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <title>last.fm top 10 Artists</title>
    </head>
    <body>
        <div class="container">
            <h1>last.fm top 10 artists!</h1>
            
            <hr>
            
            <h2>Artists:</h2>
            <ul>
                <?php foreach($artists as $artist): ?>
                    <li>
                        <?php echo $artist['name']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
