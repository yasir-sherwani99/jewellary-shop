@extends('layouts.app')

@section('content')

    @include('common.page-header', ['title' => 'Contact Us', 'subTitle' => ''])

    @include('common.breadcrumb', ['section' => 'Contact', 'page' => 'Contact'])

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Office</h3>

                        <address>1 New York Plaza, New York, <br>NY 10004, USA</address>
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Start a Conversation</h3>

                        <div><a href="mailto:#">info@Molla.com</a></div>
                        <div><a href="tel:#">+1 987-876-6543</a>, <a href="tel:#">+1 987-976-1234</a></div>
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Social</h3>

                        <div class="social-icons social-icons-color justify-content-center">
                            <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                            <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                        </div><!-- End .soial-icons -->
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->

            <hr class="mt-3 mb-5 mt-md-1">
            <div class="touch-container row justify-content-center">
                <div class="col-md-9 col-lg-7">
                    
                    @if(session()->has('success'))
                        <div class="alert alert-success fade show mb-2" role="alert">
                            <strong>Welldone! </strong>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <h2 class="title mb-1">Get In Touch</h2><!-- End .title mb-2 -->
                        <p class="lead text-primary mb-3">
                            Fill in the text to remind customers to fill in the form correctly so that your support team could contact them to help with the issues and answer all the questions.
                        </p><!-- End .lead text-primary -->
                    </div><!-- End .text-center -->

                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="contact-form mb-2 needs-validation" novalidate>
                        @csrf
                        <div class="row mb-1">
                            <div class="col-sm-4">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" name="name" class="form-control mb-0" id="cname" placeholder="Name *" required />
                                <div class="invalid-feedback">
                                    This is a required field.
                                </div>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-sm-4">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" name="email" class="form-control mb-0" id="cemail" placeholder="Email *" required />
                                <div class="invalid-feedback">
                                    This is a required field.
                                </div>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-sm-4">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" name="phone" class="form-control mb-0" id="cphone" placeholder="Phone *" required />
                                <div class="invalid-feedback">
                                    This is a required field.
                                </div>
                            </div><!-- End .col-sm-4 -->
                        </div><!-- End .row -->

                        <div class="row mb-1">
                            <div class="col-sm-12">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" name="subject" class="form-control mb-0" id="csubject" placeholder="Subject *" required />
                                <div class="invalid-feedback">
                                    This is a required field.
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-sm-12">
                                <label for="cmessage" class="sr-only">Message</label>
                                <textarea class="form-control mb-0" name="message" cols="30" rows="4" id="cmessage" required placeholder="Message *"></textarea>
                                <div class="invalid-feedback">
                                    This is a required field.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                    <span>SUBMIT</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div><!-- End .text-center -->
                        </div>
                    </form><!-- End .contact-form -->
                </div><!-- End .col-md-9 col-lg-7 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->

@endsection