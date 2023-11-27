<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting for Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .waiting-page {
            background-color: #fff;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        .waiting-page img {
            width: 100%;
            height: auto;
        }
        .waiting-page h1 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }
        .waiting-page p {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
        }
        @media (min-width: 480px) {
            .waiting-page {
                padding: 30px;
            }
            .waiting-page h1 {
                font-size: 24px;
            }
            .waiting-page p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="waiting-page">
        <img src="{{ asset('img/waiting.jpg') }}" alt="Waiting">
        <h1>Menunggu Konfirmasi</h1>
        <p>Admin kami sedang meninjau akun Anda. Ini mungkin memerlukan waktu beberapa saat, jadi harap bersabar.</p>
    </div>
</body>
</html>
