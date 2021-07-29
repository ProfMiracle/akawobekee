@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Profile Page</h1>
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row gx-5">
            <div class="col-xl-4" style="margin-bottom: 10px">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <img class="img-fluid rounded-circle mb-1" src="https://source.unsplash.com/jSUsJWvnnEA/500x500" alt="..." style="max-width: 150px; max-height: 150px">
                        </div>
                        <div class="card-subtitle mb-4">This image will be publicly visible to other users.</div>
                        <div class="form-group">
                            <input type="file" name="image" class="form-control" placeholder="Upload new profile picture">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" name="fname" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="reset" class="btn-lg btn-secondary">Reset</button>
                        <button type="submit" class="btn-lg btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
