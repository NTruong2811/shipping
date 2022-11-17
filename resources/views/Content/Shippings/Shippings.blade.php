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
                                {{-- <th style="text-align: center">Edit</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippings as $item)
                                <tr>
                                    <td>
                                        {{ $item->shipping_code }}
                                    </td>
                                    <td>{{ $item->shipping_name }}</td>
                                    <td>{{ $item->ship_from }}</td>
                                    <td>
                                        <select name="{{ $item->delivery_status_name }}" id="{{ $item->shippings_id }}"
                                            class="status">
                                            @foreach ($status as $itemj)
                                                <option style="background-color: transparent; padding: 4px 10px;"
                                                    {{ $itemj->id == $item->delivery_status_id ? 'selected' : '' }}
                                                    value="{{ $itemj->id }}">
                                                    {{ $itemj->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    {{-- <td style="text-align: center"><a href="{{ route('shippings_edit') }}"><i class="fa-solid fa-pen-to-square"></i></a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination" style="display: flex; justify-content: right;">
                        {{ $shippings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('.status').change(function() {
            var data = {
                id_change : $(this).val(),
                shipping_id :$(this).attr("id")
            }
            $.ajax({
                url: "/shippings",
                type: 'PUT',
                
                data: {
                    _token: "{{ csrf_token() }}",
                    update_shipping: data
                },
                success: function(data) {
                   alert(data)
                }
            });
        })
    });
</script>
