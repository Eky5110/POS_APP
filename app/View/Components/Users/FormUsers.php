<?php

namespace App\View\Components\Users;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class formUsers extends Component
{
    public $name, $email, $id;
    public function __construct($id=null)
    {
        if($id){
            $user = User::find($id);
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    
    public function render(): View|Closure|string
    {
        return view('components.users.form-users');
    }
}
