<div>
    <button type="button" class="btn {{ $id ? 'btn-warning' : 'btn-primary' }}" data-toggle="modal" data-target="#formProduct{{ $id ?? '' }}">
        @if ($id)
        <i class="fas fa-edit"></i>
        @else
        Tambah Produk
        @endif
    </button>
    <div class="modal fade" id="formProduct{{ $id ?? '' }}">
        <form action="{{ route('master-data.produk.store') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $id ?? '' }}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $id ? "Form Edit Produk" : "Form Tambah Produk" }}</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group my-1">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ $id ? $nama_produk : old('nama_produk') }}" required>
                    </div>
                    <div class="form-group my-1">
                        <label for="">Kategori Produk</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ( $kategori as $k )
                                <option value="{{ $k->id }}" {{ $kategori_id || old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-1">
                        <label for="harga_jual">Harga jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ $id ? $harga_jual : old('harga_jual') }}">
                    </div>
                    <div class="form-group my-1">
                        <label for="harga_beli_pokok">Harga Beli Pokok</label>
                        <input type="number" name="harga_beli_pokok" id="harga_beli_pokok" class="form-control" value="{{ $id ? $harga_beli_pokok : old('harga_beli_pokok') }}">
                    </div>
                    <div class="form-group my-1">
                        <label for="stok">Stok Persedian</label>
                        <input type="number" name="stok" id="stok" class="form-control" value="{{ $id ? $stok : old('stok') }}">
                    </div>
                    <div class="form-group my-1">
                        <label for="stok_minimal">Minimal Stok</label>
                        <input type="number" name="stok_minimal" id="stok_minimal" class="form-control" value="{{ $id ? $stok_minimal : old('stok_minimal') }}">
                    </div>
                    <div class="form-group my-1 d-flex flex-column" >
                        <div class="d-flex align-items-center">
                            <label for="is_active" class="mr-4">Produk Aktif ?</label>
                            <input type="checkbox" name="is_active" id="is_active"
                                {{ old('is_active', $id ? $is_active : false) ? 'checked' : '' }}
                            >
                        </div>
                        <small class="text-secondary">jika Aktif maka produk akan ditampilkan di halaman kasir</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            </form>
            <!-- /.modal-dialog -->
          </div>
</div>
