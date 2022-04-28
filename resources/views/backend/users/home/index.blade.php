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
                       <p class="mb-1">Admission</p>
                       <h3 class="mb-3">876</h3>
                       <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Pending</p>
                      <h3 class="mb-3">4.5M</h3>
                      <div id="chart2"></div>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Total Task</p>
                      <h3 class="mb-3">64,835</h3>
                      <div id="chart3"></div>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Not Interested</p>
                      <h3 class="mb-3">42.68%</h3>
                      <div id="chart4"></div>
                   </div>
               </div>
           </div>
           <div class="col col-md-12">
               <div class="card radius-10">
                   <div class="card-body text-center">
                      <p class="mb-1">Highly Interested</p>
                      <h3 class="mb-3">00:04:60</h3>
                      <div id="chart5"></div>
                   </div>
               </div>
           </div>
        </div><!--end row-->
    </div>
   </div>
@endsection
