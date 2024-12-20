@extends('layouts.app')
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Agents') }}
    </h2>
@endsection
@section('content')
<div class="container">
    <a class="mr-3 add-btn" href="{{route('agent.create')}}" data-bs-toggle="modal" data-bs-target="#addLoanModal">Create Agent
    </a>
    <div class="table-title">Customer</div>
    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>NAME</th>
                <th>CODE</th>
                <th>CITY</th>
                <th>PASSWORD</th>
                {{-- <th>ACTION</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($agents as $index => $data)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$data->agent_name}}</td>
                <td>{{$data->agent_code}}</td>
                <td>{{$data->city->city_code ?? 'Unknown'}}</td>
                <td>{{$data->password }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
<div class="modal fade" id="addLoanModal" tabindex="-1" aria-labelledby="addLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLoanModalLabel">Add Agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to create a new loan -->
                <form action="{{ route('agent.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="agent_name" class="form-label">Agent Name</label>
                            <input type="text" name="agent_name" id="agent_name" class="form-control" placeholder="Enter Agent Name">
                        </div>
                        <div class="col-md-6">
                            <label for="agent_code" class="form-label">Agent Code</label>
                            <input type="text" name="agent_code" id="agent_code" class="form-control" placeholder="Enter Agent Code">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <select name="city" id="city" class="form-select form-control">
                                <option value="" selected>Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city_name }}-{{ $city->city_code }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="password" step="0.01">
                        </div>
                    </div>
                    <div class="text-left">
                        <button class="mr-3 add-btn" type="submit" class="btn btn-warning btn-lg">
                            Add Agent
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection