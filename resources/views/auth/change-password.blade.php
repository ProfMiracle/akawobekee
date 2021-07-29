@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Change Password</h1>
        <div class="card">
            <form action="">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Old password</label>
                        <input type="text" name="opass" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">New password</label>
                        <input type="password" name="npass" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </form>
        </div>
    </div>
@endsection
