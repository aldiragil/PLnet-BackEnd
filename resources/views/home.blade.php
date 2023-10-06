@extends('layouts.app')
@section('content')
<script src="{{ url('app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="row justify-content-md-center">
            <div class="col-md-6 col-12 align-self-center">
                <div class="card box-shadow-3">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row" id="menu-user-token"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var homeUrl = "{{ url('/') }}";
    var apiKey  = '{{ $key }}';
    var userMenu= '';
    var headerAjax= {
        "Accept": "application/json",
        "Content-Type": "application/json",
        "Authorization": "Bearer "+apiKey
    };
    
    $(document).ready(function() {
        $.ajax({
            "url": homeUrl+"/api/user-token",
            "method": "POST",
            "timeout": 0,
            "headers": headerAjax
        }).done(function (response) {
            if (response.success) {
                var userMenu=response.data.menu;
                $('#menu-user-token').html(buildMenu(0,0,userMenu));
                $('.col-menu-0').css("display", "block");
                $('#app_name').html(response.data.name);
            }else{
                alert('gagal');
            }
        }).fail(function(response){
            alert('failed');
        });            
    });
    
    function buildMenu(parent,id,menu){
        var temp = '';
        var back = '';
        $.each(menu, function(index, element){
            temp = temp+
            '<div class="col-4 col-menu-user col-menu-'+id+'" style="display:none;">\
                <div class="form-group">\
                    <button type="button" class="btn btn-outline-secondary btn-block" onclick="javascript:setMenu('+element.id+')"><i class="la la-list font-large-3"></i><br>'+element.name+'</button>\
                </div>\
            </div>';
            temp = temp+(element.child?buildMenu(id,element.id,element.child):'');
        });
        return temp+(id!=0?'<div class="mt-1 col-12 col-menu-user col-menu-'+id+'" style="display:none;">\
            <div class="form-group">\
                <button type="button" class="btn btn-info btn-block box-shadow-3 btn-round" onclick="javascript:setMenu('+parent+')"><i class="la la-chevron-circle-left"></i> KEMBALI</button>\
            </div>\
        </div>':'');
    }
    
    function setMenu(id){
        $('.col-menu-user').css("display", "none");
        $('.col-menu-'+id).css("display", "block");
    }
</script>
@endsection
