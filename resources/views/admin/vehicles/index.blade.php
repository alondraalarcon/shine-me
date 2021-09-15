@extends('admin/layout/template')

@section('title', 'Vehicles')
@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Vehicles</strong></h3>
        </div>
        <div class="col-auto ms-auto text-end mt-n1">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="align-middle me-2" data-feather="plus"></i> New Vehicle</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;"
                        role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr role="row">
                                <th>Type</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{$vehicle->Type}}</td>
                                <td>{{$vehicle->price}}</td>
                                <td>{{($vehicle->status == 0) ? 'Inactive' : 'Active'}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="editVehicle({{$vehicle->id}});"><i class="align-middle me-2" data-feather="edit"></i> Edit</button>
                                    <button type="button" class="btn btn-dark"  onclick="deleteVehicle({{$vehicle->id}});"><i class="align-middle me-2" data-feather="delete"></i>  Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- END OF DIV ROW -->
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Vehicle</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{route('store.vehicle')}}" id="form-vehicle">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Vehicle Type</label>
                    <select class="form-select" name="type">
                        <option value="Motorcycle">Motorcycle</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Multipurpose vehicle (MPV)">Multipurpose vehicle (MPV)</option>
                        <option value="Sport utility vehicle (SUV)">Sport utility vehicle (SUV)</option>
                        <option value="Pickup Truck">Pickup truck</option>
                        <option value="Station Wagon">Station Wagon</option>
                        <option value="Van">Van</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="form-delete">
            @csrf
            <div class="modal-body">
                <p>Are you sure you want to delete this Vehicle?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">
   function editVehicle(idx)
   {
        $.get('vehicles/show/'+idx, function (data) {
            $('#exampleModal').modal('show');
            $("#form-vehicle").attr("action", "/vehicles/update/" + data.id);
            $('select[name=type]').val(data.Type);
            $('input[name=price]').val(data.price);
            $('select[name=status]').val(data.status);
        });
   }

   function deleteVehicle(idx)
   {
        $.get('vehicles/show/'+idx, function (data) {
            $('#deleteModal').modal('show');
            $("#form-delete").attr("action", "/vehicles/destroy/" + data.id);
        });
   }
</script>
@stop