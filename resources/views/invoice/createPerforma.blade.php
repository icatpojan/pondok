@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('invoice.store') }}" method="POST">
            @csrf
            <div class="row mb-2">
                <div class="col">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Invoice
                                        No:</span>
                                </div>
                                <input type="text" name="invoice_no" id="nomer_invoice" value="{{ $Nomer }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group mb-2">
                                <div class="input-group mb-2">
                                    <select name="stempel" id="stempel" class="form-control">
                                        <option value="AIRTIME">AIRTIME</option>
                                        <option value="CCTV">CCTV</option>
                                        <option value="VMS" selected>VMS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Due Date
                                        :</span>
                                </div>
                                <input type="date" name="due_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Invoice
                                        Date:</span>
                                </div>
                                <input type="date" name="invoice_date" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Invoice
                                        Type:</span>
                                </div>
                                <select name="jenis" class="form-control">
                                    <option value="Renewal">Renewal</option>
                                    <option value="New Unit">New Unit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Description
                                        :</span>
                                </div>
                                <textarea required name="deskripsi" class="form-control"
                                    style="height: 90px"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Customer
                                        :</span>
                                </div>
                                <select name="customer_id" id="customer" class="form-control">
                                    <option value="">== Select Customer ==</option>
                                    @foreach ($Customer as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Transfer date
                                        :</span>
                                </div>
                                <input type="date" name="transfer_date" style="border: 2px solid red;"
                                    class="form-control" placeholder="geosat">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group mb-3">
                                <select name="bank" id="bank" style="border: 2px solid red;" class="form-control">
                                    <option value="BCA">BCA</option>
                                    <option value="BRI" selected>BRI</option>
                                    <option value="BNI">BNI</option>
                                    <option value="Mandiri">Mandiri</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Address
                                        :</span>
                                </div>
                                <textarea name="address" class="form-control" id="address" required
                                    style="height: 90px"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Transfer
                                        name:</span>
                                </div>
                                <input name="transfer_name" type="text" class="form-control"
                                    style="border: 2px solid red;" placeholder="Masukkan nama pentranfer">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Contact
                                        :</span>
                                </div>
                                <input type="number" value="{{ old('contact') }}" name="contact"
                                    class="form-control" style="border: 2px solid red;">
                                <span style="color: red; float: right">*Jika kotak merah tidak diisi lengkap maka
                                    dianggap
                                    belom lunas</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">NPWP Number:</span>
                                </div>
                                <input type="number" name="npwp" id="npwp" required class="form-control"
                                    placeholder="Masukkan Nomer NPWP">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px"
                                        id="basic-addon1">Tahun/Bulan:</span>
                                </div>
                                <select name="tahun" id="" class="form-control">
                                    <option value="tahun">tahun</option>
                                    <option value="bulan">bulan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Sign :</span>
                                </div>
                                <select name="user_id" id="user" class="form-control">
                                    <option value="">== Select User ==</option>
                                    @foreach ($User as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 140px" id="basic-addon1">Discount
                                        :</span>
                                </div>
                                <input type="number" name="discount" id="discount" required class="form-control"
                                    placeholder="discount" value="0" required>
                                <select name="persen" class="form-control" id="">
                                    <option value="rupiah">rupiah</option>
                                    <option value="persen">persen</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Ship Id</label>
                                <input type="number" name="ship_id" id="ship" required class="form-control"
                                    placeholder="Id Kapal">
                                <span style="color: green; float: right">*Pastikan id kapal</span>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Ship Name</label>
                                <select name="ship_name" id="ship_name" class="form-control haha">
                                    @foreach ($Ship as $ship)
                                        <option {{ $ship->name == $ship->name ? ' selected="selected"' : '' }}
                                            value="{{ $ship->name }}">{{ $ship->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input disabled type="text" id="ship_name" class="form-control" nama"
                                    placeholder="Nama Kapal"> --}}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Start Period</label>
                                <input style="border: 2px solid blue;" type="date" name="airtime_start"
                                    id="airtime_start" class="form-control" placeholder="Mulai Periode">
                                <span style="color: blue; float: right">*boleh kosong</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">End of Period</label>
                                <input style="border: 2px solid blue;" name="airtime_end" id="airtime_end" type="date"
                                    class="form-control" placeholder="Mulai Periode">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Unit Price</label>
                                <input type="number" required name="unit_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Airtime</label>
                                <input type="number" required name="airtime" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block mt-5">BUAT INVOICE</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection
