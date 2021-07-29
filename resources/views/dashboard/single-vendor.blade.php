@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">{{$vendor->franchise}}'s Page</h1>
            <div class="row gx-5">
                <div class="col-xl-4" style="margin-bottom: 10px">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle mb-1" src="https://source.unsplash.com/jSUsJWvnnEA/500x500" alt="..." style="max-width: 150px; max-height: 150px">
                            </div>
                            <div class="card-subtitle mb-4">This image will be publicly visible to other users.</div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-8" style="height:60vh; overflow-y: scroll;">
                    <h3>Plans</h3>
                    @forelse($plans as $plan)
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card {{random_color()}} shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                You Pay {{$plan->amount}} (Monthly) For {{$plan->duration}} month(s)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">N{{$plan->amount * $plan->duration}}</div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Commission: {{$plan->commission}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300" id="subscribe" data-id="{{$plan->id}}">Subscribe</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card {{random_color()}} shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        NO PLANS AVAILABLE
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </form>
    </div>
@endsection
@section("custom-script")
    <script>

    </script>
@endsection
