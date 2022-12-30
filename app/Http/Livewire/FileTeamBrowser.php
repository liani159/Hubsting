<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Team;
use App\Models\Obj;
use Livewire\WithFileUploads;


class FileTeamBrowser extends Component
{
    use WithFileUploads;

    public $upload;
    public $obj;
    public $team_id;
    public $ancestors;
    public $creatingNewFolder = false;
    public $newFolderState = [
        'name' => '',
    ] ;
    public $showFileUploadForm = false;
    public $confirmObjectDeletion;

    //contiene l'id del folder a rinominare
    public $renamingObject;
    //per controllare quando lo stato di renaming object cambia
    public $renamingObjectState = [
        'name' => '',
    ];

    public function render()
    {
        return view('livewire.file-team-browser');
    }

 
    //delete object
    public function deleteObject(){
        obj::where('team_id',$this->team_id)->find($this->confirmObjectDeletion)->delete();
        $this->confirmObjectDeletion = null;

        $this->obj = $this->obj->fresh(); 
    }

    // controllo sul numero di upload a fare qua dopo
    public function updatedUpload($upload){
        {
            $obj = $this->TeamId->objs()->make(['parent_id' => $this->obj->id
            ]);

            $team = Team::where('id', $this->team_id)->first();
            //dd($team->name);
            $obj->objectable()->associate(
                $this->TeamId->files()
                ->create([
                    'name' => $upload->getClientOriginalName(),
                    'size' => $upload->getSize(),
                    'path' => $upload->storePublicly(
                        $team->name. $this->team_id, [
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

        if($obj = Obj::where('team_id',$this->team_id)->find($id)){
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

        obj::where('team_id',$this->team_id)->find($this->renamingObject)
        ->objectable->update($this->renamingObjectState);

        $this->obj = $this->obj->fresh(); 
        $this->renamingObject = null;
    }


    public function getTeamIdProperty(){
        $team = Team::find($this->team_id);
        return $team;
    }
    


    public function createFolder(){

        //dd($this->TeamId->name);
        $obj = $this->TeamId->objs()->make(['parent_id' => $this->obj->id]);
        $obj->objectable()->associate($this->TeamId->folder()->create($this->newFolderState));
        
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
