<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Order</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Notifikasi Order</h2>
    <p>Total Notifikasi: <span id="notif-count">0</span></p>

    <audio id="notification" src="{{ asset('audio/ding.mp3') }}" preload="auto"></audio>

    <ul id="order-list"></ul>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let lastCount = 0;

        function cekNotif() {
            $.get('/api/paid-orders', function(response) {
                if (response.count > lastCount) {
                    document.getElementById('notification').play();
                    $('#notif-count').text(response.count);

                    let html = '';
                    response.data.forEach(order => {
                        html += `<li>${order.nomor_order}</li>`;
                    });
                    $('#order-list').html(html);

                    lastCount = response.count;
                }
            });
        }

        setInterval(cekNotif, 3000); // Cek setiap 3 detik
    </script>
</body>
</html>
