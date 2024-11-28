<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Receipt</title>
</head>
<body>
    <h1>Upload Receipt</h1>
    <form id="upload-form" enctype="multipart/form-data">
        <label for="receipt">Upload Receipt Image:</label>
        <input type="file" id="receipt" name="receipt" accept="image/*" required>
        <button type="submit">Submit</button>
    </form>
    <script>
        document.getElementById('upload-form').addEventListener('submit', async (event) => {
            event.preventDefault();
            let formData = new FormData();
            formData.append('receipt', document.getElementById('receipt').files[0]);
            formData.append('transactionId', '<?php echo $_GET['transactionId']; ?>');
            formData.append('userId', '<?php echo $_GET['userId']; ?>');
            formData.append('amount', '<?php echo $_GET['amount']; ?>');

            try {
                const response = await fetch('verify_payment.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                if (result.success) {
                    alert('Receipt uploaded successfully! Thank you for your purchase.');
                } else {
                    alert('Receipt upload failed. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    </script>
</body>
</html>
