<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="d-flex aligns-items-center justify-content-center">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Invoice</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Invoice</th>
                            <th>:</th>
                            <td>{{ $data->invoice }}</td>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <th>:</th>
                            <td>{{ $data->customer->name}}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <th>:</th>
                            <td>{{ $data->created_at->format('d M Y')}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th>:</th>
                            <td>@money($total)</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-lg-6 ps-3">
            <div class="card">
                <div class="card-header">Produk </div>
                <div class="card-body">
                    <form wire:submit.prevent="store" method="POST">

                        @csrf
                        <div class=" card-body">
                            <input type="hidden" name="order_id" wire:model="order_id" value="{{ $data->id }}">

                            <div class="form-group">
                                <label for="product_id">Produk</label>
                               <form class="form-control" wire:model="product_id" name="product_id">
                               <div class="form-group" method="post" action="">
                                <input type="text" class="from-control" placeholder="masukkan kode barang">
                               </div>
                                </form>

                            </div>
                            <div class="form-group">
                                <label for="qty">Jumlah</label>
                                <input type="number" class="form-control" wire:model="qty" name="qty">


                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i> Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
    <div class="d-flex aligns-items-center justify-content-center pt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Daftar Belanja</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub Total</th>
                                <th>Hapus</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataOrderDetail as $dt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dt->product->name }}</td>
                                <td>@money($dt->price)</td>
                                <td>{{ $dt->qty}}</td>
                                <td>@money($dt->price * $dt->qty)</td>
                                <td><button class="btn btn-sm btn-danger" wire:click="delete({{ $dt->id }})"><i class=" fas fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    
                    <table class="table table-sm">
                        <tr>
                            <th>
                                <h2>Total</h2>
                            </th>
                            <th>
                                    :
                            </th>
                            <th><h2>@money($total)</h2>
                            
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <h2>Uang</h2>
                            </th>
                            <th>
                                    :
                            </th>
                            <th>
                            <input type="number" class="mt-2" wire:model="uang">
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <h2>Kembali</h2>
                            </th>
                            <th>
                                    :
                            </th>
                            <th><h2>
                            @money($kembali)</h2>
                            </th>
                        </tr>
                    </table>
                    
                    <button class="btn btn-lg btn-success" wire:click="receipt({{ $data->id }})"><i class="fas fa-print"></i>  Cetak</button>
                 
                </div>
            </div>
        </div>
    </div>
</div>