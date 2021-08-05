@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table id='dataTable_wrapper' class="dataTables_wrapper dt-bootstrap4" style="width: 100%">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>Name</td>
                        <td>Amount</td>
                        <td>Duration</td>
                        <td>Commission</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("custom-script")
    <script type="text/javascript">
        $(document).ready(function(){
            // DataTable
            $('#dataTable_wrapper').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('plans-datatable')}}",
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'amount' },
                    { data: 'duration' },
                    { data: 'commission' },
                    { data: 'action' },
                ]
            });

        });
    </script>
@endsection
