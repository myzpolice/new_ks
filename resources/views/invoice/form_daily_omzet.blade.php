@extends('layouts.app')
@section('content')
<h2>Daily Omzet</h2>
{!! Form::open(array('class' => 'form-inline', 'method' => 'GET', 'route' => array('print_daily_omzet'))) !!}
        <table class='table table-hover table-responsive table-bordered table-nonfluid'>
            <tr>
                <td>Date</td>
                <td><input id="fromDate" type="date" name="fromDate" class='form-control'></td>
            </tr>
            <tr>
                <td>Output</td>
                <td><select class="form-control" name="output">
                        <option value="pdf">PDF</option>
                        <option value="excel">EXCEL</option>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="submit" class="btn btn-success">Submit</button></td>
            </tr>       
        </table>    
{!! Form::close() !!}
@endsection