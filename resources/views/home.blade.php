@extends('layouts.home')

@section('content')
    <section class="HOME-PAGE-SECTION">
        <h1>Buy And Sell Files</h1>
    </section>


    <section class="HOME-PAGE-SECTION-TWO">
        <div class="container no-padding-xs">
            <div class="col-sm-12 BORDER-LINE-BOX no-padding-xs">
                <div class="col-sm-12">
                    <h2>Browse through our selection of files, or upload your creation</h2>
                </div>
                <span class="hidden-xs">
                    <div class="col-sm-6">
                        <a href="/files" class="btn btn-primary pull-right">Browse Files</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="/register" class="btn btn-info pull-left">Upload Your Files</a>
                    </div>
                </span>
                <span class="visible-xs">
                    <div class="col-xs-12 no-padding">
                         <div class="col-xs-6">
                        <a href="/files" class="btn btn-primary pull-right">Browse Files</a>
                    </div>
                    <div class="col-xs-6">
                        <a href="/register" class="btn btn-info">Upload Files</a>
                    </div>
                    </div>
                </span>
            </div>
        </div>
    </section>


    <section class="HOME-PAGE-SECTION-THREE">
        <div class="container no-padding-xs">
            <div class="col-sm-12 PROCESS-BOX">
                <img src="/images/home/process/signup.svg" alt="Sign up" class="SVG-PROCESS" />
                <div class="PROCESS-TEXT-BOX">
                    <div class="col-sm-9 no-padding">
                        <h4>
                            Sign up with Marketplace
                        </h4>
                    </div>
                    <div class="col-sm-3 hidden-xs">
                        <img src="/images/home/process/one.svg" alt="First Step" class="SVG-PROCESS-NUMBER" />
                    </div>
                </div>
            </div>
            <div class="col-sm-12 PROCESS-BOX">
                <img src="/images/home/process/connect-stripe.svg" alt="Connect with Stripe" class="SVG-PROCESS" />
                <div class="PROCESS-TEXT-BOX">
                    <div class="col-sm-9 no-padding">
                        <h4>
                            Connect with Stripe through our website to receive payments
                        </h4>
                    </div>
                    <div class="col-sm-3 hidden-xs">
                        <img src="/images/home/process/two.svg" alt="Seconds Step" class="SVG-PROCESS-NUMBER" />
                    </div>
                </div>
            </div>
            <div class="col-sm-12 PROCESS-BOX">
                <img src="/images/home/process/create-files.svg" alt="Create files" class="SVG-PROCESS" />
                <div class="PROCESS-TEXT-BOX">
                    <div class="col-sm-9 no-padding">
                        <h4>
                            Upload all kinds of files from images, photoshop files, templates, code, to icons and fonts
                        </h4>
                    </div>
                    <div class="col-sm-3 hidden-xs">
                        <img src="/images/home/process/three.svg" alt="Third Step" class="SVG-PROCESS-NUMBER" />
                    </div>
                </div>
            </div>
            <div class="col-sm-12 PROCESS-BOX">
                <img src="/images/home/process/publish.svg" alt="Publish your creation" class="SVG-PROCESS" />
                <div class="PROCESS-TEXT-BOX">
                    <div class="col-sm-9 no-padding">
                        <h4>
                            Once created, your uploads will be published for review from our admins
                        </h4>
                    </div>
                    <div class="col-sm-3 hidden-xs">
                        <img src="/images/home/process/four.svg" alt="Fourth Step" class="SVG-PROCESS-NUMBER" />
                    </div>
                </div>
            </div>
            <div class="col-sm-12 PROCESS-BOX">
                <img src="/images/home/process/profits.svg" alt="Make revenue from sales" class="SVG-PROCESS" />
                <div class="PROCESS-TEXT-BOX">
                    <div class="col-sm-9 no-padding">
                        <h4>
                            Start making revenue from sales
                        </h4>
                    </div>
                    <div class="col-sm-3 hidden-xs">
                        <img src="/images/home/process/five.svg" alt="Fifth Step" class="SVG-PROCESS-NUMBER" />
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="HOME-PAGE-SECTION-FOUR">
           <div class="container no-padding-xs">
               <div class="col-sm-8 no-padding">
                   <div class="browser-mockup with-url">
                       <img src="/images/home/dashboard.jpg" />
                   </div>
               </div>
               <div class="col-sm-4 RIGHT-TEXT">
                   <p>Manage your account and files associated with them.</p>
                   <br /><br />
                   <p>Find this open source project on <a href="https://github.com/davidtrushkov/marketplace" target="_blank">GitHub</a></p>
               </div>
           </div>
    </section>
@endsection
