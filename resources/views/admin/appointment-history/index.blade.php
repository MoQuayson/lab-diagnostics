@extends('layouts.admin.appointment-history')
@section('content')
    <div id="admin_appointment_history"></div>

    <div class="card mb-5">
        <div class="card-header">
            <h5 class="text-primary">Appointment Details</h5>
        </div>

        <div class="card-body">
            <div class="container">
                <table class="table table-borderless p-0">
                    <thead>
                        <tr><th></th></tr>
                    </thead>

                    <tbody>
                        @if (count($appointment_history) == 0 )
                        <tr>
                            <td className="text-center" colSpan="12" style={{ color: 'red' }}>
                                No Details Found
                            </td>
                        </tr>
                        @else
                            @foreach ($appointment_history as $item)
                            <tr>
                                <td>
                                    <span class="fw-bold">Appointment ID:</span>
                                </td>
    
                                <td>
                                    <span>{{$item->appointment_id}}</span>
                                </td>
    
                                <td>
                                    <span class="fw-bold">Schedule Date</span>
                                </td>
    
                                <td>
                                    <span>{{$item->schedule}}</span>
                                </td>
                            </tr>
    
                            <tr>
                                <td>
                                    <span class="fw-bold">Client Name:</span>
                                </td>
    
                                <td>
                                    <span>{{$item->fullname}}</span>
                                </td>
    
                                <td>
                                    <span class="fw-bold">Gender:</span>
                                </td>
    
                                <td>
                                    <span>{{$item->gender}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="fw-bold">Email:</span>
                                </td>
    
                                <td>
                                    <span>{{$item->email}}</span>
                                </td>
    
                                <td>
                                    <span class="fw-bold">Telephone:</span>
                                </td>
    
                                <td>
                                    <span>{{$item->telephone}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="fw-bold">Test Results:</span>
                                </td>
    
                                <td>
                                    <span>
                                        @if (is_null($item->results))
                                            N/A
                                        @else
                                            {{$item->results}}
                                        @endif
                                    </span>
                                </td>
    
                                
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
            <table class="table table-responsive-md table-borderless" hidden>
                <tbody>
                    <tr class="p-0">
                        <td class="table-active bg-primary">
                            <span>Appointment #</span>
                        </td>
                        <td>123456</td>
                        <td>Schedule</td>
                        <td>12-05-2002</td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">Client Name</td>
                        <td>Moses Quayson</td> 
                    </tr>
                   
                    <tr>
                        <td>Appointment #</td>
                        <td>123456</td>
                        <td>Schedule</td>
                        <td>12-05-2002</td>
                        <td>Schedule</td>
                        <td>12-05-2002</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="text-primary">Test Details</h5>
        </div>

        <div class="card-body p-0">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Test Name</th>
                        <th scope="col">Results</th>
                        <th scope="col">Price</th>
                     </tr>
                 </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{mix('js/app.js')}}"></script>
@endsection