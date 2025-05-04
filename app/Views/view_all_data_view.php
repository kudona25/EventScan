<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All QR Codes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('/monitor'); ?>">Monitor</a></li>
                <li class="nav-item active"><a class="nav-link" href="<?php echo base_url('/view-all'); ?>">View All Data <span class="sr-only">(current)</span></a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">All QR Codes</h2>
        <h3 class="text-center">Total Registered: <?php echo $total; ?></h3>
        <div class="text-right mb-3">
            <a href="<?php echo base_url('/qr/downloadCsv'); ?>" class="btn btn-success">Download CSV</a>
        </div>

        <form method="get" class="form-inline mb-3">
            <label for="per_page" class="mr-2">Show</label>
            <select name="per_page" id="per_page" class="form-control" onchange="this.form.submit()">
                <option value="10" <?php echo ($perPage == 10) ? 'selected' : ''; ?>>10</option>
                <option value="50" <?php echo ($perPage == 50) ? 'selected' : ''; ?>>50</option>
                <option value="100" <?php echo ($perPage == 100) ? 'selected' : ''; ?>>100</option>
                <option value="300" <?php echo ($perPage == 300) ? 'selected' : ''; ?>>300</option>
                <option value="500" <?php echo ($perPage == 500) ? 'selected' : ''; ?>>500</option>
                <option value="1000" <?php echo ($perPage == 1000) ? 'selected' : ''; ?>>1000</option>
                <option value="all" <?php echo ($perPage == 'all') ? 'selected' : ''; ?>>All</option>
            </select>
            <label for="per_page" class="ml-2">entries</label>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code Data</th>
                    <th>Scan Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($qr_codes)) : ?>
                    <?php foreach ($qr_codes as $qr_code): ?>
                        <tr>
                            <td><?php echo $qr_code['id']; ?></td>
                            <td><?php echo $qr_code['code_data']; ?></td>
                            <td><?php echo $qr_code['scan_time']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="text-center">No data found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($perPage !== 'all') : ?>
            <div class="d-flex justify-content-center mt-3">
                <?php echo $pager->links(); ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Footer -->
    <footer class="mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds. <br> &copy; 2024 TECHISSOLUTION. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
