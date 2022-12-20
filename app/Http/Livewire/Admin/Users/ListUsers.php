<?php

namespace App\Http\Livewire\Admin\Users;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use Livewire\Component;

class ListUsers extends Component
{
    public $state=[];
    public $showeditmodal=false;
    public $user;
    public $userIdBeingRemoved;

    public function addNew(){
        $this->state=[];
        $this->showeditmodal=false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUsers(){
       $validatedata= Validator::make($this->state,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ])->validate();

        $validatedata['password']=bcrypt($validatedata['password']);

        user::create($validatedata);

        session::flash('message','User added Successfully!');

        $this->dispatchBrowserEvent('hide-form',['message'=>'User Added Successfully!']);
    }

    public function edit(User $id){
        $this->showeditmodal=true;
        $this->user=$id;
        $this->state=$id->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(){
         $validatedata= Validator::make($this->state,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$this->user->id,
            'password'=>'sometimes|confirmed'
        ])->validate();

        if(!empty($validatedata['password'])){
            $validatedata['password']=bcrypt($validatedata['password']);
        }

        $this->user->update($validatedata);
        session::flash('message','User Updated Successfully!');

        $this->dispatchBrowserEvent('hide-form',['message'=>'User Added Successfully!']);
       
    }

    public function confirmUserRemoval($user_id){
        $this->userIdBeingRemoved=$user_id;
        $this->dispatchBrowserEvent('show_delete_modal');
    }

    public function deleteUser(){

        $deleteusers=User::find($this->userIdBeingRemoved);

        $deleteusers->delete();

         $this->dispatchBrowserEvent('hide_delete_modal',['message'=>'User Deleted Successfully!']);
    }

    public function render()
    {
        $users=User::all();
        return view('livewire.admin.users.list-users',[
            'users'=>$users
        ]);
    }
}
