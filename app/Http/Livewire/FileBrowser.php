<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class FileBrowser extends Component
{
    public $obj;
    public $ancestors;
    public $creatingNewFolder = false;
    public $newFolderState = [
        'name' => '',
    ] ;

    public function render()
    {
        return view('livewire.file-browser');
    }

    public function getUserIdProperty(){

        return auth()->user();
    }
    

    public function createFolder(){

        //dd($this->UserId);
        $obj = $this->UserId->objs()->make(['parent_id' => $this->obj->id]);
        $obj->objectable()->associate($this->UserId->folder()->create($this->newFolderState));
        
        $obj->save();

        $this->creatingNewFolder = false;
        $this->newFolderState = [
            'name' => '',
        ] ;

        $this->obj = $this->obj->fresh();


        $this->validate([
            'newFolderState.name' => 'required|max:255'
        ]);

        //dd('create');
    }

}
 