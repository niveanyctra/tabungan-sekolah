<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transaksi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{route('transaksiBukti')}}" target="_blank" class="btn btn-primary">Download</a>
      </div>
    </div>
  </div>
</div>
