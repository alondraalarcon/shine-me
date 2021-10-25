@extends('rider/layout/template')

@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong></strong></h3>
        </div>
     
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Wallet</h5>
                                        </div>

                                        <div class="col-auto">
                                            <button type="button" class="btn btn-dark float-end" data-bs-toggle="modal" data-bs-target="#topupModal">Withdraw</button>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ auth()->user()->wallet}}</h1>
                                    
                                </div>
                            </div>
                        </div>
    


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <h4><strong>Wallet History</strong></h4>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#topupModal"><i class="align-middle me-2" data-feather="plus"></i> Top-Up</button>
                                        </div>
                                        
                                    </div>
                                </div>
                                    <table id="wallet" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th> Date </th>                                
                                                <th> Amount</th>                                
                                                <th> Balance </th>
                                                <th> Status</th>                                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $count = 1; @endphp
                                            @foreach($wallets as $wallet)
                                            <tr>
                                                <td style="font-size: 18px;">{{ $count++ }}</td>
                                                <td style="font-size: 18px;">{{ $wallet->date_time }}</td>
                                                <td style="font-size: 18px; color:{{($wallet->type == 1) ? 'orange': (($wallet->type == 2) ? '#00b300' : (($wallet->type == 3) ? 'red' : '#b30000' )) }}"><b>
                                                {{ ($wallet->type == 1) ? $wallet->amount: (($wallet->type == 2) ? $wallet->amount : (($wallet->type == 3) ? -$wallet->amount : $wallet->amount )) }}</b></td>
                                                <td style="font-size: 18px;">{{ $wallet->current }}</td>
                                                <td style="font-size: 18px;">{{ ($wallet->type == 1) ? 'Request': (($wallet->type == 2) ? 'Approved' : (($wallet->type == 3) ? 'Deducted' : 'Rejected' ))}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>     
                            </div>
                        </div>
                    </div>  <!-- END OF DIV ROW -->

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="topupModalLabel">Request Top-Up</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{route('topupRequest')}}" id="form-topup">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Enter Amount</label>
                    <input type="number" class="form-control" name="amount" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Request</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>
@stop