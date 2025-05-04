<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor QR Code Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet">
    <style>
        .full-screen-text {
            font-size: 5rem;
            margin-top: 20%;
        }
    </style>
    <script>
        setTimeout(function(){
           window.location.reload(1);
        }, 10000);
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo base_url('/'); ?>">QR Scanner</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('/'); ?>">Home</a></li>
                <li class="nav-item active"><a class="nav-link" href="<?php echo base_url('/monitor'); ?>">Monitor <span class="sr-only">(current)</span></a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('/view-all'); ?>">View All Data</a></li>
            </ul>
        </div>
    </nav>

    <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 40vh;">
        <h2 class="text-center full-screen-text">Total Registered: <?php echo $total; ?></h2>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <!-- Footer -->
   <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds. <br> &copy; 2024 TECHISSOLUTION. All rights reserved.</span>
        </div>
    </footer>

</body>
</html>
