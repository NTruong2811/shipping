@extends('layouts.layout')

@section('content')
<div class="row" style="margin-top: 50px">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Shippings</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> Shipping Code</th>
                            <th>User Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th width="100px">Date</th>
                            <th style="text-align: center">Edit</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="pagination" style="display: flex; justify-content: right;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection