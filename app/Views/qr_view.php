<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner and Manual Input</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo base_url('/'); ?>">QR Scanner</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active"><a class="nav-link" href="<?php echo base_url('/'); ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('/monitor'); ?>">Monitor</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('/view-all'); ?>">View All Data</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">QR Code Scanner and Manual Input</h2>
        <div class="form-group text-center">
            <div id="reader" style="width: 300px; height: 300px; margin: auto;"></div>
        </div>
        <div class="form-group">
            <label for="manualInput">Or enter QR code manually (8 characters):</label>
            <input type="text" class="form-control" id="manualInput" placeholder="Enter QR code data" maxlength="8">
        </div>
        <div class="form-group text-center">
            <button class="btn btn-secondary" onclick="submitManualInput()">Submit Manually</button>
        </div>

        <form id="qrForm" action="<?php echo base_url('/qr/processQr'); ?>" method="post" class="d-none">
            <input type="hidden" name="qr_data" id="qr_data">
        </form>
    </div>

    <script>
        let scannerRunning = false;

        function onScanSuccess(decodedText, decodedResult) {
            if (!scannerRunning) {
                scannerRunning = true;
                if (decodedText.length === 8) {
                    document.getElementById('qr_data').value = decodedText;
                    document.getElementById('qrForm').submit();
                } else {
                    alert('Scanned data must be exactly 8 characters.');
                    location.reload();
                }
            }
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        function startScanner() {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        function submitManualInput() {
            var manualInput = document.getElementById('manualInput').value;
            if (manualInput.length !== 8) {
                alert('Please enter exactly 8 characters.');
                return;
            }
            document.getElementById('qr_data').value = manualInput;
            document.getElementById('qrForm').submit();
        }

        window.addEventListener('load', startScanner);
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Flash message -->
    <script>
        <?php if(session()->getFlashdata('error')): ?>
            alert('<?php echo session()->getFlashdata('error'); ?>');
            location.reload();
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            alert('<?php echo session()->getFlashdata('success'); ?>');
            location.reload();
        <?php endif; ?>
    </script>

    <!-- Footer -->
    <footer class="mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Page rendered in <strong>{elapsed_time}</strong> seconds. <br>&copy; 2024 TECHISSOLUTION. All rights reserved.</span>
        </div>
    </footer>
</body>
</html>
