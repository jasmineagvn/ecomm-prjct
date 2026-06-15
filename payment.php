<?php
$snapToken = $_GET['token'] ?? null;
$orderId = $_GET['order_id'] ?? null;

if (!$snapToken) {
    die("Token kosong");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="Mid-client-tuSBlWCsw63FeJYp">
    </script>
</head>

<body>

<script>
window.onload = function () {

    snap.pay('<?= $snapToken ?>', {
onSuccess: function(result) {

    const paymentMethod = result.payment_type || 'unknown';

    fetch('update-order-status.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            order_id: '<?= $orderId ?>',
            status: 'paid',
            payment_method: paymentMethod
        })
    })
    .then(() => {
        alert('Pembayaran berhasil');
        window.location.href = 'orders.php';
    });

},

        onPending: function() {
            alert('Menunggu pembayaran');
            window.location.href = 'orders.php';
        },

        onError: function() {
            alert('Pembayaran gagal');
        }

    });

};
</script>

</body>
</html>