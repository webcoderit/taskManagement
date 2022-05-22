@extends('backend.admin.master')

@section('title')
@endsection
@push('style')
    <style>
        #grad1 {
            background-image: linear-gradient(red, yellow);
        }
        #grad2 {
            background-image: linear-gradient(green, yellow);
        }
        #grad3 {
            background-image: linear-gradient(darkblue, yellow);
        }
        #grad4 {
            background-image: linear-gradient(rebeccapurple, yellow);
        }
        #grad5 {
            background-image: linear-gradient(darkorange, deepskyblue);
        }
    </style>
@endpush
@section('content')
<div class="page-content">
    <div class="">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5">
            <div class="col">
                <div class="card radius-10" id="grad1">
                    <div class="card-body text-center">
                       <p class="mb-1 text-white" style="font-size: 24px;">Monthly Admission</p>
                       <h3 class="mb-3">{{ count(\App\Models\AdmissionForm::whereMonth('created_at', date('m'))->get()) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col">
               <div class="card radius-10" id="grad2">
                   <div class="card-body text-center">
                      <p class="mb-1 text-white" style="font-size: 24px;">Pending</p>
                      <h3 class="mb-3">{{ count(\App\Models\Task::where('status', 0)->whereMonth('created_at', date('m'))->get()) }}</h3>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="card radius-10" id="grad3">
                   <div class="card-body text-center">
                      <p class="mb-1 text-white" style="font-size: 24px;">Total Task</p>
                      <h3 class="mb-3">{{ count(\App\Models\Task::whereMonth('created_at', date('m'))->get()) }}</h3>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="card radius-10" id="grad4">
                   <div class="card-body text-center">
                      <p class="mb-1 text-white" style="font-size: 24px;">Not Interested</p>
                      <h3 class="mb-3">{{ count(\App\Models\Intereste::where('interest_level', 'not')->whereMonth('created_at', date('m'))->get()) }}</h3>
                   </div>
               </div>
           </div>
           <div class="col col-md-12">
               <div class="card radius-10" id="grad5">
                   <div class="card-body text-center">
                      <p class="mb-1 text-white" style="font-size: 24px;">Highly Interested</p>
                      <h3 class="mb-3">{{ count(\App\Models\Intereste::where('interest_level', 'highly')->whereMonth('created_at', date('m'))->get()) }}</h3>
                   </div>
               </div>
           </div>
        </div><!--end row-->
    </div>
   </div>
@endsection
