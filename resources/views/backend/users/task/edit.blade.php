@extends('backend.admin.master')
@push('style')
<style type="text/css">
.view-details-section{
    padding: 40px 0;
}
.view-details-page-title,
.view-details-form-title {
    text-align: center;
    font-size: 20px;
    font-weight: 600;
    text-transform: capitalize;
    padding-bottom: 5px;
    margin-bottom: 20px;
    position: relative;
}
.view-details-page-title:after,
.view-details-form-title:after {
    content: '';
    position: absolute;
    width: 80px;
    height: 2px;
    background: #154360;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
}
.view-details-inner-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    font-size: 18px;
    font-weight: 500;
    color: #000;
}
.view-details-inner-item a {
    text-decoration: underline;
    display: inline-block;
    font-size: 16px;
    color: #154360;
}
.student-opinion-form label {
    font-size: 16px;
    color: #000;
    font-weight: 500;
    margin-bottom: 5px;
    text-transform: capitalize;
}
.update-btn-outer {
    margin-top: 15px;
    text-align: end;
}
.back-btn-outer {
    text-align: end;
    margin-bottom: 10px;
}
</style>
@endpush
@section('content')
<section class="view-details-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="view-details-page-wrapper">
                    <h4 class="view-details-page-title">
                        View Details
                    </h4>
                    <div class="back-btn-outer">
                        <a href="{{ url('/today/task') }}" class="btn btn-primary">
                            Back
                        </a>
                    </div>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="view-details-outer card p-4">
                        <div class="view-details-inner">
                            <h6 class="view-details-inner-item">
                                Name:
                                <span>
                                    {{ $interest->task->name ?? 'No name found' }}
                                </span>
                            </h6>
                            <h6 class="view-details-inner-item">
                                Email:
                                <a href="mailto:saidulislam@gmail.com">
                                    {{ $interest->task->email ?? 'No email found' }}
                                </a>
                            </h6>
                            <h6 class="view-details-inner-item">
                                Phone:
                                <a href="tel:+880123456789">
                                    {{ $interest->task->phone ?? 'No phone found' }}
                                </a>
                            </h6>
                            <h6 class="view-details-inner-item">
                                Facebook ID:
                                <a href="https://www.facebook.com/groups/161355777405329" target="_blank">
                                    {{ $interest->task->fb_id ?? 'No fb id found' }}
                                </a>
                            </h6>
                        </div>
                    </div>
                    <h4 class="view-details-form-title">
                        Interest and Note
                    </h4>
                    <div class="student-opinion-form-wrapper card p-4">
                        <form class="student-opinion-form form-group" action="{{ url('/interest/store') }}" method="post">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $interest->task->id }}" />
                            <label for="interest">Interest Level</label><br>
                            <select name="interest_level" class="form-control"
                             id="interest_level" onchange="admissionDone(this.value)">
                                <option selected disabled>----Select A Level----</option>
                                <option value="done">Admission Done</option>
                                <option value="highly">Highly Interested</option>
                                <option value="not">Not Interested</option>
                                <option value="50%">50% Interested</option>
                                <option value="others">Others</option>
                            </select><br>
                            <div id="admission">
                                <label for="course">Select Course</label><br>
                                <select name="select_course" class="form-control">
                                    <option selected disabled>----Select A Level----</option>
                                    <option value="web">Full Stack Web Development</option>
                                    <option value="digital">Digital Marketing</option>
                                    <option value="english">Communication English</option>
                                </select><br>
                                <label for="batch">Batch</label><br>
                                <input type="number" class="form-control" placeholder="Batch" name="batch_number" value="">
                            </div>
                            <label>Note</label><br>
                            <textarea rows="5" cols="50" name="note" class="form-control"></textarea>
                            <div class="update-btn-outer">
                                <button type="submit" class="update-btn-inner btn btn-primary">
                                    update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        $('#admission').hide();
        function admissionDone(e){
            if( e == 'done'){
                $('#admission').show();
            }
            else{
                $('#admission').hide();
            }
        }
    </script>
@endpush
