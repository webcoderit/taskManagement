@extends('backend.admin.master')

@section('title')
@endsection

@section('content')
<div class="page-content">
    <div class="">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body text-center">
                       <p class="mb-1">Sessions</p>
                       <h3 class="mb-3">876</h3>
                       <p class="font-13"><span class="text-success"><i class="lni lni-arrow-up"></i>2.1%</span> vs last 7 days</p>
                       <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Total Users</p>
                      <h3 class="mb-3">4.5M</h3>
                      <p class="font-13"><span class="text-success"><i class="lni lni-arrow-up"></i> 4.2% </span> last 7 days</p>
                      <div id="chart2"></div>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Page Views</p>
                      <h3 class="mb-3">64,835</h3>
                      <p class="font-13"><span class="text-danger"><i class="lni lni-arrow-down"></i> 3.6%</span> vs last 7 days</p>
                      <div id="chart3"></div>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Bounce Rate</p>
                      <h3 class="mb-3">42.68%</h3>
                      <p class="font-13"><span class="text-success"><i class="lni lni-arrow-up"></i> 2.5%</span> vs last 7 days</p>
                      <div id="chart4"></div>
                   </div>
               </div>
           </div>
           <div class="col col-md-12">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Avg. Session Duration</p>
                      <h3 class="mb-3">00:04:60</h3>
                      <p class="font-13"><span class="text-danger"><i class="lni lni-arrow-down"></i> 5.2%</span> vs last 7 days</p>
                      <div id="chart5"></div>
                   </div>
               </div>
           </div>
        </div><!--end row-->
    </div>
   </div>
@endsection
