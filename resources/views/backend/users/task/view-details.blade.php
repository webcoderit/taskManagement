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
                    <div class="view-details-outer card p-4">
                        <div class="view-details-inner">
                            <h6 class="view-details-inner-item">
                                Name:
                                <span>
                                    Saidul Islam
                                </span>
                            </h6>
                            <h6 class="view-details-inner-item">
                                Email:
                                <a href="mailto:saidulislam@gmail.com">
                                    saidulislam@gmail.com
                                </a>
                            </h6>
                            <h6 class="view-details-inner-item">
                                Phone:
                                <a href="tel:+880123456789">
                                    +880123456789
                                </a>
                            </h6>
                            <h6 class="view-details-inner-item">
                                Facebook ID:
                                <a href="https://www.facebook.com/groups/161355777405329" target="_blank">
                                    https://www.facebook.com/groups/161355777405329
                                </a>
                            </h6>
                        </div>
                    </div>
                    <h4 class="view-details-form-title">
                        Interest and Note
                    </h4>
                    <div class="student-opinion-form-wrapper card p-4">
                        <form class="student-opinion-form form-group">
                            <label for="interest">Interest Level</label><br>
                            <select name="interested" class="form-control">
                                <option value="highly">Highly Interested</option>
                                <option value="not">Not Interested</option>
                                <option value="50%">50% Interested</option>
                            </select><br>
                            <label>Note</label><br>
                            <textarea rows="5" cols="50" class="form-control"></textarea>
                            <div class="update-btn-outer">
                                <button type="button" class="update-btn-inner btn btn-primary">
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
