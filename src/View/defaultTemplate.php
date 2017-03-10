<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <title>Default Template</title>
    </head>
    <body>
        <div class="container">
            <h1>Hello!</h1>
            <i>Welcome to the framework default page</i>
            <hr>
            
            <h4>Click on the users to get more info!</h4>
            <ul>
                <?php foreach($users as $user): ?>
                    <li>
                        <?php $url = $app['router']->generateUrl('ajax_profile', ['id' => $user['id']]); ?>
                        <a href="<?php echo $url; ?>" class="user-link"><?php echo $user['username']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <hr>
            
            <h4>Last.fm top Artists</h4>
            <a href="<?php echo $app['router']->generateUrl('music_lastfm'); ?>">Here</a>!
        </div>
        
        <?php include __DIR__ . '/profileModal.php' ?>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <script type="text/javascript">
            $(function(){
                $('.user-link').on('click', function(e) {
                    e.preventDefault();
                    
                    $.getJSON($(this).attr('href'), function(response) {
                        $.each(response, function(k,v) {
                            $('#profileModal').find('#' + k).html(v);
                        });
                        
                        $('#profileModal').modal();
                    });
                });
            });
        </script>
    </body>
</html>
