@extends('admin.layouts.layout')

@section('css')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.2/dist/bootstrap-table.min.css">
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css"> --}}
@endsection

@section('content')
    <div class="fresh-table toolbar-color-orange">
        <div class="toolbar">
            <button id="alertBtn" class="btn btn-default">Alert</button>
        </div>

        <table id="fresh-table" class="table">
            <thead>
                <th data-field="id">ID</th>
                <th data-field="user_id">User_ID</th>
                <th data-field="code">Code</th>
                <th data-field="type">Type</th>
                <th data-field="amount">Amount</th>
                <th data-field="disount">Discount</th>
                <th data-field="total">Total</th>
                <th data-field="status">Status</th>
                <th data-field="note">Note</th>
                <th data-field="created_at">Created_at</th>
                <th data-field="updated_at">Updated_at</th>
                <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
            </thead>

            <tbody>
                @foreach ($rechargeHistories as $history)
                    <tr>
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->user_id }}</td>
                        <td>{{ $history->code }}</td>
                        @if ($history->type == 1)
                            <td>Chuyển khoản</td>
                        @elseif ($history->type == 2)
                            <td>Tiền mặt</td>
                        @else
                            <td>VNPay</td>
                        @endif
                        <td>{{ number_format($history->amount, 0, '', '.') }}</td>
                        <td>{{ number_format($history->discount, 0, '', '.') }}</td>
                        <td>{{ number_format($history->total, 0, '', '.') }}</td>
                        <td>{{ $history->getStatus() }}</td>
                        <td>{{ $history->note }}</td>
                        <td>{{ $history->created_at }}</td>
                        <td>{{ $history->updated_at }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.min.js"></script> --}}

    <script type="text/javascript">
        var $table = $('#fresh-table')
        var $alertBtn = $('#alertBtn')

        window.operateEvents = {
            'click .like': function(e, value, row, index) {
                alert('You click like icon, row: ' + JSON.stringify(row))
                console.log(value, row, index)
            },
            'click .edit': function(e, value, row, index) {
                alert('You click edit icon, row: ' + JSON.stringify(row))
                console.log(value, row, index)
            },
            'click .remove': function(e, value, row, index) {
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                })
            }
        }

        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('')
        }

        $(function() {
            $table.bootstrapTable({
                classes: 'table table-hover table-striped',
                toolbar: '.toolbar',

                search: true,
                showRefresh: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                striped: true,
                sortable: true,
                pageSize: 8,
                pageList: [8, 10, 25, 50, 100],

                formatShowingRows: function(pageFrom, pageTo, totalRows) {
                    return ''
                },
                formatRecordsPerPage: function(pageNumber) {
                    return pageNumber + ' rows visible'
                }
            })

            $alertBtn.click(function() {
                alert('You pressed on Alert')
            })
        })
    </script>
@endsection
