<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Obj;
use Livewire\WithFileUploads;

class FileBrowser extends Component
{
    use WithFileUploads;

    public $upload;
    public $obj;
    public $ancestors;
    public $creatingNewFolder = false;
    public $newFolderState = [
        'name' => '',
    ] ;
    public $showFileUploadForm = false;

    //contiene l'id del folder a rinominare
    public $renamingObject;
    //per controllare quando lo stato di renaming object cambia
    public $renamingObjectState = [
        'name' => '',
    ];
        
    public function updatedUpload($upload){
        {
            $obj = $this->UserId->objs()->make(['parent_id' => $this->obj->id
            ]);

            $obj->objectable()->associate(
                $this->UserId->files()
                ->create([
                    'name' => $upload->getClientOriginalName(),
                    'size' => $upload->getSize(),
                    'path' => $upload->storePublicly(
                        auth()->user()->name, [
                            'disk' => 'local'
                        ]
                    )
                ])
                );
                $obj->save();
                $this->obj = $this->obj->fresh();
            /* $upload->storePublicly(auth()->user()->name, ['disk' => 'local']); */
        }
    }


    //updating: parola chiave
    public function updatingRenamingObject($id){

        if($id == null){
            $this->renamingObjectState = [
                'name' => '',
            ];
            return ;
        }

        if($obj = Obj::where('user_id',auth()->user()->id)->find($id)){
            $this->renamingObjectState = [
                'name' => $obj->objectable->name
            ];
        }
    }


    //per rinominare
    public function renameObject(){
        $this->validate([
            'renamingObjectState.name' => 'required|max:255'
        ]);

        obj::where('user_id',auth()->user()->id)->find($this->renamingObject)
        ->objectable->update($this->renamingObjectState);

        $this->obj = $this->obj->fresh(); 
        $this->renamingObject = null;
    }




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
 