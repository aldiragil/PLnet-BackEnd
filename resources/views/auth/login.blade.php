@extends('layouts.login')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-md-4 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 m-0">
                        <div class="card-header pb-0">
                            <div class="card bg-info bg-accent-2 text-white text-center">
                                <div class="card-content box-shadow-2">
                                    <div class="card-body">
                                        <div class="card-header">
                                            <div class="card-title text-center">
                                                <div class="p-0">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Internet-icon.png/858px-Internet-icon.png" alt="branding logo" width="50%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>LOGIN</span>
                        </h6>                        
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST" class="form-horizontal" id="form_login" validate>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="email" class="form-control" id="username" name="username" placeholder="Your Username" required>
                                        <div class="form-control-position">
                                            <i class="ft-user"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                                        <div class="form-control-position">
                                            <i class="la la-key"></i>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-success round box-shadow-2 btn-block"><i class="ft-log-in"></i> {{ __('LOGIN') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    var homeUrl = "{{ url()->current() }}";
    
    $( "#form_login" ).on( "submit", function( event ) {
        event.preventDefault();
        // alert('sukses');
        setTimeout(function() {
            $.ajax({
                url: homeUrl+'/api/login',
                method: 'POST',
                dataType: 'json',
                data: {
                    email: $("input#username").val(),
                    password: $("input#password").val(),
                    device: 'website'
                },
                error: function()
                {
                    alert("An error occoured!");
                },
                success: function(response)
                {
                    var login_status  = response.success;
                    var login_data   = response.data;
                    
                    setTimeout(function()
                    {
                        if(login_status == true)
                        {
                            setTimeout(function()
                            {
                                window.location.href = homeUrl+'/home/'+login_data.access_token;
                            }, 400);
                        }
                        
                    }, 1000);
                }
            });
        }, 650);    
    });
</script>
@endsection