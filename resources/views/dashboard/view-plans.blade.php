@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">My Plans</h1>
        <div class="card">
            <div class="card-body">
                <table id='empTable' class="dataTables_wrapper dt-bootstrap4" style="width: 100%">
                    <thead>
                    <tr>
                        <td>Franchise</td>
                        <td>Name</td>
                        <td>Amount</td>
                        <td>Duration</td>
                        <td>Join Date</td>
                        <td>Mature Date</td>
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
                cache: false,
                ajax: "{{route("ajaxMyPlan")}}",
                columns: [
                    { data: 'franchise' },
                    { data: 'name' },
                    { data: 'amount' },
                    { data: 'duration' },
                    { data: 'join date' },
                    { data: 'mature date' },
                ]
            });
        });
    </script>
@endsection
