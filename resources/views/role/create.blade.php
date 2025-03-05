
    {{Form::open(array('url'=>'roles','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('name',__('Name'),['class' => 'col-form-label'])}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Role Name')))}}
                @error('name')
                <span class="invalid-name text-danger text-xs" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @if(!empty($permissions))
                    <label for="permissions" class="form-control-label">{{__('Assign Permission to Roles')}}</label>
                    <table class="table">
                        <tr>
                            <th class="text-dark">{{__('Module')}} </th>
                            <th class="text-dark">{{__('Permissions')}} </th>
                        </tr>
                        @php
                            $modules=['location','user','client','role','assets','parts','pms','vendor','pos','wos','logtime'];
                            if(Auth::user()->type == 'super admin'){
                                $modules[] = 'language';
                                $modules[] = 'permission';
                                $modules[] = 'system settings';
                            }
                        @endphp
                        @foreach($modules as $module)
                            <tr>
                                <td>{{ ucfirst(__($module)) }}</td>
                                <td>
                                    <div class="row ">
                                        @if(in_array('manage '.$module,(array) $permissions))
                                            @if($key = array_search('manage '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('create '.$module,(array) $permissions))
                                            @if($key = array_search('create '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('edit '.$module,(array) $permissions))
                                            @if($key = array_search('edit '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('delete '.$module,(array) $permissions))
                                            @if($key = array_search('delete '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('associate '.$module,(array) $permissions))
                                            @if($key = array_search('associate '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Associate',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('show '.$module,(array) $permissions))
                                            @if($key = array_search('show '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('move '.$module,(array) $permissions))
                                            @if($key = array_search('move '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Move',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('client permission',(array) $permissions))
                                            @if($key = array_search('client permission '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Client Permission',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('invite user',(array) $permissions))
                                            @if($key = array_search('invite user '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Invite User ',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('change password '.$module,(array) $permissions))
                                            @if($key = array_search('change password '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Change Password',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('buy '.$module,(array) $permissions))
                                            @if($key = array_search('buy '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'form-check-input isscheck isscheck_'.str_replace(' ', '', $module),'id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Buy',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
            {{Form::submit(__('Create'),array('class'=>'btn  btn-primary'))}}
        </div>
    </div>
    {{Form::close()}}
