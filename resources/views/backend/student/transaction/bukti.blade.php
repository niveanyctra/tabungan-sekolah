<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Tabungan-Sekolah</title>
    <style>
        /* Define print styles */
        @media print {
            body {
                font-size: 14pt;
            }

            /* Hide header and footer in print */
            @page {
                margin-top: 1rem;
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="row" style="max-width: 100vh">
            <div class="col-2">
                <img src="{{asset('img/neper_new_logo.png')}}" alt="" width="40px" height="40px">
            </div>
            <div class="col-10">

                <h4>Bukti Transaksi</h4>
            </div>
        </div>
            <table class="table table-borderless" style="width: 50%">
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{$trans->created_at}}</td>
                </tr>
                <tr>
                    <td>No. Transaksi</td>
                    <td>:</td>
                    <td>{{$trans->no_transaksi}}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{$trans->user->name}}</td>
                </tr>
                @if($trans->type == "Transfer")
                <tr>
                    <td>Nama Penerima</td>
                    <td>:</td>
                    <td>{{$penerima->name}}</td>
                </tr>
                @endif
                {{-- <tr>
                    <td>Jurusan :</td>
                    <td>Tanggal :</td>
                </tr>
                <tr>
                    <td>Kelas :</td>
                    <td>Tanggal :</td>
                </tr> --}}
                <tr>
                    <td>Tipe</td>
                    <td>:</td>
                    <td>{{$trans->type}}</td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>:</td>
                    <td>{{$trans->amount}}</td>
                </tr>
            </table>
    </div>
    {{-- <img src="{{asset('img/neper_new_logo.png')}}" alt=""> --}}
        <script>
            window.print()
        </script>
</body>
</html>
