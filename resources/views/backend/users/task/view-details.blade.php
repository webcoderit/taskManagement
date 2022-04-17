@extends('backend.admin.master')

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
