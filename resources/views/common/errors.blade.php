@if (count($errors))
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <strong>@lang('apps.wrong')</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="box">
    @if (Session::has('messages'))
        <div class="alert alert-{{ Session::get('flash') }}">
            {{ Session::get('messages') }}
        </div>
    @endif
</div>  

