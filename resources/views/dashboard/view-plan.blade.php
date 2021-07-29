@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Users on plan</h1>
        <div class="card">
            <div class="card-body">
                <table id='empTable' class="dataTables_wrapper dt-bootstrap4">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
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
                ajax: "{{url("vendor/plan/$plan/users/ajax")}}",
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'phone' },
                    { data: 'join_date' },
                    { data: 'mature_date' },
                ]
            });

        });
    </script>
@endsection
