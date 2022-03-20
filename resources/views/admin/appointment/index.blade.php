@extends('layouts.admin.appointment')
@section('content')
<div id="admin_appointment_list"></div>
@endsection

@section('scripts')
<script src="{{mix('js/app.js')}}"></script>
<script>
    function ClearInputs(){
        document.getElementById('schedule').value = "";
        document.getElementById('user_id').value = "";
    }
</script>
@endsection
