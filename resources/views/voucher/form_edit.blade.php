@extends('layouts.app')
@section('content')
<h1>Create New Voucher</h1>
@if($errors->any())
    <div class="flash alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{!! Form::model($voucher, ['method' => 'PATCH', 'route' => ['customer.voucher.update', $customer->id, $voucher->id], 'class' => 'form-horizontal']) !!}
<form id='create_voucher' action='javascript://' method='POST' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Voucher</td>
                <td><input type="number" name="credit" class='form-control' value="{{ $voucher->credit }}"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="{{ $voucher->description }}"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>
@endsection