<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <table id="datatable"
                class="table table-striped table-bordered custom-table-border dataTable no-footer"
                role="grid" aria-describedby="datatable_info">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th class="center">Name</th>
                        <th class="center">Phone</th>
                        <th class="center">User name</th>
                        <th class="center">BMDC Reg No</th>
                        <th class="center">Course</th>
                        <th class="center">Faculty</th>
                        <th class="center">Dept</th>
                        <th class="center">Email</th>
                        <th class="center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=1@endphp @foreach($users as $user)
                    <tr>
                        <td>{{$sl}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->contact_no}}</td>
                        <td style="color:blue">{{$user->email}}</td>
                        <td>{{$user->bmdc_no}}</td>
                        <td>{{$user->course_type}}</td>
                        <td>{{$user->department}}</td>
                        <td>{{$user->course_name}}</td>
                        <td>{{$user->email_address}}</td>
                        <td>
                            @if($user->active_status == 1)
                            <label>
                                <span type="" class="btn btn-primary btn-sm">Active</span>
                            </label>
                            @else
                            <label>
                                <span type="" class="btn btn-primary btn-sm">Inactive</span>
                            </label>

                            @endif
                        </td>
                    </tr>
                    @php $sl++;@endphp @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
