@extends('backend.admin.master')

@section('content')
<div class="col col-md-10 col-lg-9 col-xl-8 mx-auto my-auto">
    <div class="card my-5 msgcard">
      <div class="card-body">
        <div class="container-fluid">
          <div id="messages_container" class="chat-log">



            <div class="chat-log_item chat-log_item-own z-depth-0">
              <div class="row justify-content-end mx-1 d-flex">
                <div class="col-auto px-0">
                  <span class="chat-log_author">
                    @James
                  </span>
                </div>
                <div class="col-auto px-0">
                </div>
              </div>
              <hr class="my-1 py-0 col-8" style="opacity: 0.5">
              <div class="chat-log_message">
                <p>Lorem Ipsum is simply dummy text of the printing</p>
              </div>
              <hr class="my-1 py-0 col-8" style="opacity: 0.5">
              <div class="row chat-log_time m-0 p-0 justify-content-end">
                23:15
              </div>
            </div>
                      <div class="chat-log_item chat-log_item-own z-depth-0">
              <div class="row justify-content-end mx-1 d-flex">
                <div class="col-auto px-0">
                  <span class="chat-log_author">
                    @James
                  </span>
                </div>
                <div class="col-auto px-0">
                </div>
              </div>
              <hr class="my-1 py-0 col-8" style="opacity: 0.5">
              <div class="chat-log_message">
                <p>Lorem Ipsum is simply dummy text of the printing</p>
              </div>
              <hr class="my-1 py-0 col-8" style="opacity: 0.5">
              <div class="row chat-log_time m-0 p-0 justify-content-end">
                23:15
              </div>
            </div>
                      <div class="chat-log_item chat-log_item z-depth-0">
              <div class="row justify-content-end mx-1 d-flex">
                <div class="col-auto px-0">
                  <span class="chat-log_author">
                    @MJavadSF
                  </span>
                </div>
                <div class="col-auto px-0">
                </div>
              </div>
              <hr class="my-1 py-0 col-8" style="opacity: 0.5">
              <div class="chat-log_message">
                <p>MjavadSF is my user ID in all social network like Twitter, instagram, facebook and ...
                Follow me ❤
                </p>
              </div>
              <hr class="my-1 py-0 col-8" style="opacity: 0.5">
              <div class="row chat-log_time m-0 p-0 justify-content-end">
                23:15
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer border-0 bottom-rounded z-depth-0" style="background-color: #97E3C2">
        <div class="row">
          <div class="col col-md-10 col-lg-9 mx-auto">
            <div class="row d-flex justify-content-center">
              <div class="col-12 col-md-9 align-self-center my-0">
                <div class="row d-flex align-self-center justify-content-center">
                  <div class="col-12 d-flex">
                    <div class="form-group col-12 my-0 mx-0">
                      <textarea rows="2" id="content" name="content" placeholder="what's up bro!" class="form-control textarea resize-ta"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-3 d-flex align-self-center justify-content-center p-0">
                <div class="md-form">
                    <button type="button" class="btn btn-success">Send Message</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
