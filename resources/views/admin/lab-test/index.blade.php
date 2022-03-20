@extends('layouts.admin.lab-test')
@section('content')
<div id="admin_test_list"></div>
@endsection
@section('scripts')
<script src="{{mix('js/app.js')}}"></script>
<script>
    function ClearInputs(){
        document.getElementById('name').value = "";
        document.getElementById('price').value = "";
        document.getElementById('user_id').value = "";
    }
</script>
@endsection

