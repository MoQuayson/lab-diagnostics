<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab Test Results</title>

    <!--Bootstap -->
    <link rel="stylesheet" href="<?php echo public_path('bootstrap/css/bootstrap.min.css')?>">

    <style>
        /*.container{
            padding: 3%;
            
        }

        table{
            width: 100%;
            
        }

        

        .column2{
            float: right;
            
        }*/

        /*thead:before,thead:after,
        tbody:before,tbody:after,
    </style>
</head>
<body>
    <div class="container">
        <table>
            <tr>
                <td>
                    <h2>Test Result</h2>
                </td>
                <td>
                    <span style="float: right; font-size: 18px;"><strong>Date:</strong> {{today()->toDateString()}}</span>
                </td>
            </tr>

            <tr>
                <td colspan="2"><hr></td>
            </tr>

            <tr>
                <td><h3>Client Details</h3></td>
                <td><h3 style="float: right;">Test Details</h3></td>
            </tr>

            <tr>
                <td><span style="font-size: 18px;"><strong>Client Name: </strong>{{$lab_tests->fullname}}</span></td>
                <td><h3 style="float: right;">Test ID: {{$lab_tests->id}}</h3></td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Test Name</th>
                <th scope="col">Results</th>
                <th scope="col">Price</th>    
            </tr>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$lab_tests->name}}</td>
                    <td>{{$lab_tests->results}}</td>
                    <td>{{$lab_tests->price}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
</body>
</html>