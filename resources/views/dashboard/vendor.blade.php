@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Vendor List</h1>
        <div class="card">
            <div class="card-body">
                <table id='empTable' class="dataTables_wrapper dt-bootstrap4" style="width: 100%">
                    <thead>
                    <tr>
                        <td style="width: 61.6667px;">id</td>
                        <td style="width: 61.6667px;">franchise</td>
                        <td style="width: 61.6667px;">vendor name</td>
                        <td style="width: 61.6667px;">email</td>
                        <td style="width: 61.6667px;">action</td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection
@section("custom-script")
    <script type="text/javascript">
        $(document).ready(function(){
            // DataTable
            $('#empTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{url("search-vendors:ajax")}}",
                columns: [
                    { data: 'id' },
                    { data: 'franchise' },
                    { data: 'vendor name' },
                    { data: 'email' },
                    { data: 'action' },
                ]
            });

        });
    </script>
@endsection
