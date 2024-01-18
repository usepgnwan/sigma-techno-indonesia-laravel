<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">{{ $title }}</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<section>
    <div class="row ml-2 mr-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <!-- PAGE-CONTENT OPEN -->
                    <div class="page">
                        <div class="page-content error-page">
                            <div class="container text-center">
                                <div class="error-template p-4">
                                
                                    <h5 class="error-details pt-3">
                                        Hello <b>{{ auth()->user()->name }}</b>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <!-- PAGE-CONTENT OPEN CLOSED -->
                    </div>
                </div>
            </div>
        </div>
    </div>  
</section>
