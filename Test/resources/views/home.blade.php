@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Type</th>
                          <th scope="col">Address</th>
                          <th scope="col">Phone</th>

                          <th scope="col">Actions</th>

                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($user) && $user != '')
                        @foreach($user as $usr)
                        <tr>
                          <th scope="row">{{isset($usr->id) ? $usr->id : ''}}</th>
                          <td>{{isset($usr->name) ? $usr->name : ''}}</td>
                          <td>{{isset($usr->email) ? $usr->email : ''}}</td>
                          <td>{{isset($usr->type) ? $usr->type : ''}}</td>
                          <td>{{isset($usr->address) ? $usr->address : ''}}</td>
                          <td>{{isset($usr->phone) ? $usr->phone : ''}}</td>

                          <td>
                            <a href="#" onclick="edit({{$usr->id}}, '{{$usr->name}}', '{{$usr->email}}','{{$usr->type}}','{{$usr->address}}' ,'{{$usr->phone}}');" data-toggle="modal" data-target="#exampleModal">Edit</a> / 
                            <a href="{{route('home.delete',$usr->id)}}">Delete</a>
                          </td>

                        </tr>
                        @endforeach
                        @endif
                        
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
               <form method="POST" id="adduser" action="{{ route('adduser') }}">
                        @csrf
                  <div class="modal-body">
                       <div class="card-body">
                        <input type="hidden" name="id" value="" id="id">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}"  autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                   <textarea class="form-control" name="address" id="address"></textarea>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                                <div class="col-md-6">
                                   <select class="form-control" name="type" id="roles">
                                       <option value="">Select Type </option>
                                       <option value="1">Therapist</option>
                                       <option value="2">Patient</option>
                                   </select>

                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row showtherpist" style="display:none;">
                                <label for="therapist" class="col-md-4 col-form-label text-md-right">{{ __('Therapist') }}</label>

                                <div class="col-md-6">
                                   <select class="form-control" name="therapist" id="therapist">
                                       <option value="">Select therapist </option>
                                      @if(isset($therapist) && $therapist != '')
                                      @foreach($therapist as $thrp)
                                      <option value="{{$thrp->id}}">{{$thrp->name}}</option>
                                      @endforeach
                                    @endif
                                   </select>

                                    @if ($errors->has('therapist'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('therapist') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                        
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        
@endsection
