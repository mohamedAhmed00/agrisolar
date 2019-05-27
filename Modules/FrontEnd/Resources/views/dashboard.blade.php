@extends('frontend::layouts.master')
@section('content')
    <header class="bg-success">
        <div class="container mb-4 mt-4">
            <div class="row">
                <div class="col-sm-5">
                    <a href="{{ url('dashboard') }}">
                        <h2 class="h2 text-white font-weight-bold text-capitalize">AgriSolar</h2>
                    </a></div>
                <div class="col-sm-7">
                    <nav class="navbar navbar-expand-lg navbar-light bg-success">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ">
                                <li class="nav-item text-white">
                                    <a class="nav-link text-white text-capitalize" href="{{ url('logout') }}"
                                       tabindex="-1" aria-disabled="true">logout</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white text-capitalize" href="#"
                                       id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        {{ auth()->user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item text-capitalize" href="{{ url('profile') }}">Profile</a>
                                    </div>
                                </li>
                                <li class="nav-item text-white">
                                    <a class="nav-link text-white text-capitalize" href="{{ url('dashboard') }}"
                                       tabindex="-1" aria-disabled="true">dashboard</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid ">
            <div class="row my-5">
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <span>Pump Systems</span>
                            <select class="form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <span>PV Generator</span>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <span>PM Mounts</span>
                            <select class="form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <span>Accessories</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-2 mb-2">
                            <span>Cable</span>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                        <div class="col-sm-2 mb-2">
                            <span>Pipe <i>&#8709;</i> D</span>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                        <div class="col-sm-2 mb-2">
                            <span>Pipe <i>&#8709;</i> S</span>
                            <input type="number" class="form-control" placeholder="">
                        </div>
                        <div class="col-sm-2 mb-2">
                            <span>Head</span>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="col-sm-2 mb-2">
                            <span>Output</span>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="col-sm-2 mb-2">
                            <span>Efficiency</span>
                            <input type="text" class="form-control" placeholder="">
                        </div>

                    </div>
                </div>
                @if(!$pumps->isEmpty())
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Module</th>
                            <th scope="col">Motor</th>
                            <th scope="col">Stages</th>
                            <th scope="col">Q Min</th>
                            <th scope="col">Q Max</th>
                            <th scope="col">H Min</th>
                            <th scope="col">H Max</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pumps as $pump)
                            <tr>
                                <td>{{ $pump->model }}</td>
                                <td>{{ $pump->motor }}</td>
                                <td>{{ $pump->stages }}</td>
                                <td>{{ $pump->q_min }}</td>
                                <td>{{ $pump->q_max }}</td>
                                <td>{{ $pump->h_min }}</td>
                                <td>{{ $pump->h_max }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h2 class="text-capitalize h2 font-weight-bold mt-4 text-white">no pump matches your inputs</h2>
                @endif
            </div>
        </div>

    </header>
    <section>
        <div class="container-fluid p-5">
            <div class="row">
                <aside class="col-sm-3 search">
                    <h3 class="h3 font-weight-bold text-success text-capitalize">search</h3>
                    <hr>
                    <form action="{{ url('search') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputWater">Water Amount ( m<sup>3</sup>/hr )</label>
                            <input type="number" name="water_amount" class="form-control" id="exampleInputWater"
                                   placeholder="Water Amount" step=".1" value="{{ old('water_amount') }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputHead">Dynamic Head ( m )</label>
                            <input type="number" name="dynamic_head" class="form-control" id="exampleInputHead"
                                   placeholder="Dynamic Head" step=".1" value="{{ old('dynamic_head') }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputCableLength">Cable Length</label>
                            <input type="number" name="cable_length" class="form-control" id="exampleInputCableLength"
                                   placeholder="Cable Length" step=".1" value="{{ old('cable_length') }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlLocation">Select Location</label>
                            <select class="form-control" name="location" id="exampleFormControlLocation">
                                <option value="cairo">cairo</option>
                                <option value="giza">giza</option>
                                <option value="mina">mina</option>
                                <option value="assuit">assuit</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlMountingStructure">Mounting Structure</label>
                            <select class="form-control" name="mounting_structure"  id="exampleFormControlMountingStructure">
                                <option value="Fixed" > Fixed</option>
                                <option value="Tracking">Tracking</option>
                            </select>
                        </div>
                        <div class="form-group" id="module-name">
                            <label for="exampleFormControlSelectExistingOne">Select Existing One</label>
                            <select class="form-control" name="module_name" id="exampleFormControlSelectExistingOne">
                                <option value="pump 1">pump 1</option>
                                <option value="pump 2">pump 2</option>
                                <option value="pump 3">pump 3</option>
                                <option value="pump 4">pump 4</option>
                                <option value="pump 5">pump 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-dark btn-block mb-3" id="add-module">Enter New Modules</button>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-dark btn-block mb-3 d-none" id="exist-module">Enter Exist Modules
                            </button>
                        </div>
                        <div class="mt-3 d-none" id="module-config">
                            <div class="form-group">
                                <label for="exampleInputOpenCircuitVoltage">Open Circuit Voltage ( VOC )</label>
                                <input type="number" value="{{ old('voc') }}" step=".1" name="voc" class="form-control" id="exampleInputOpenCircuitVoltage"
                                       placeholder="Open Circuit Voltage">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputVoltageAtMaxPowerpoint">Voltage At Max Power point ( VMPP )</label>
                                <input type="number" name="vmpp" class="form-control"
                                       id="exampleInputVoltageAtMaxPowerpoint" step=".1" value="{{ old('vmpp') }}"
                                       placeholder="Voltage At Max Power point">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPowerMax">Power Max ( P )</label>
                                <input type="number" name="power_max" step=".1" class="form-control" id="exampleInputPowerMax" value="{{ old('power_max') }}"
                                       placeholder="Power Max">
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-success btn-block mb-3 text-capitalize btn-lg" type="submit" name="search" value="search">
                        </div>
                    </form>
                </aside>
                <section class="col-sm-9">
                    <div id="chartContainer" style="height: 700px; width: 100%;"></div>

                </section>
            </div>
        </div>
    </section>
@stop
