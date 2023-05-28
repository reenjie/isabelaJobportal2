{{-- data-bs-toggle="modal" data-bs-target="#add" --}}
{{-- 
    Usage : 
                                         @include('components.modal', [
                                                'id'        =>"btnid",
                                                'modalsize' => 'modal-lg',
                                                'modaltitle' => 'Title To put',
                                                'type' => 'Types',
                                            ])
    
    --}}
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog {{ $modalsize }}">
        <div class="modal-content" style="border-left: 10px solid rgb(158, 179, 196)">
            <div class="modal-body">
                <div class="modaltitle">
                    <h5 class="modal-title fs-6 fw-bold" id="exampleModalLabel">{{ $modaltitle }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modalbody">
                    @switch($type)
                        @case('addNewJobPostings')
                            @include('admin.components.jobpost_modal')
                        @break

                        @case('UpdateJobPostings')
                            @include('admin.components.jobpost_modal', ['edit' => true, 'data' => $data])
                        @break

                        @case('addNewUsers')
                        @include('admin.components.users_modal')
                        @break

                        @case('UpdateUsers')
                        @include('admin.components.users_modal',['edit'=> true, 'data' => $data])
                        @break;

                        @case('setinterview')
                        @include('admin.components.setInterview_modal')
                        @break;

                        @case('viewRequirements')
                     @include('admin.components.requirements_modal')
                        @break;
                        @case('changepasswordverify')
                        @include('admin.components.changepassword_modal')
                        @break;
                        @endswitch
                        

                    

                </div>
            </div>
        </div>
    </div>
</div>
