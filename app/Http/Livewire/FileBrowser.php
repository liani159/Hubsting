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
    public $confirmObjectDeletion;

    //contiene l'id del folder a rinominare
    public $renamingObject;
    //per controllare quando lo stato di renaming object cambia
    public $renamingObjectState = [
        'name' => '',
    ];
        
    //delete object
    public function deleteObject(){
        /* obj::where('user_id',auth()->user()->id)->find($this->confirmObjectDeletion)->delete();
        $this->confirmObjectDeletion = null;

        $this->obj = $this->obj->fresh(); */ 

        if(auth()->user()->as_paid){
            obj::where('user_id',auth()->user()->id)->find($this->confirmObjectDeletion)->delete();
            $this->confirmObjectDeletion = null;

            $this->obj = $this->obj->fresh();
        }else if(!auth()->user()->as_paid && (auth()->user()->num_upload <=5)){

            $usr = User::find(Auth()->user()->id);
            $user_count = $usr->num_upload;
            if(!$user_count){
                $count = 0;
                //dd($count);
                $usr->num_upload = $count;
                $usr->save();
            }else{
                //dd($user_count+1);
                $usr->num_upload -= 1;
                $usr->save();
            }
            obj::where('user_id',auth()->user()->id)->find($this->confirmObjectDeletion)->delete();
            $this->confirmObjectDeletion = null;

            $this->obj = $this->obj->fresh();
        }
    }


    public function updatedUpload($upload){
        {
            if(auth()->user()->as_paid){
                //eseguiamo normalmente
                $obj = $this->UserId->objs()->make(['parent_id' => $this->obj->id
                ]);

                $obj->objectable()->associate(
                    $this->UserId->files()
                    ->create([
                        'name' => $upload->getClientOriginalName(),
                        'size' => $upload->getSize(),
                        'path' => $upload->storePublicly(
                            auth()->user()->name.auth()->user()->id, [
                                'disk' => 'local'
                            ]
                        )
                    ])
                    );
                    $obj->save();
                    $this->obj = $this->obj->fresh();

            }else if(!auth()->user()->as_paid && (auth()->user()->num_upload <5)){
               //altrimenti puo fare la upload solo 5 volte
               //aumentiamo il numero di upload
               $usr = User::find(Auth()->user()->id);
                $user_count = $usr->num_upload;
                if(!$user_count){
                    $count = 1;
                    //dd($count);
                    $usr->num_upload = $count;
                    $usr->save();
                }else{
                    //dd($user_count+1);
                    $usr->num_upload += 1;
                    $usr->save();
                }


                $obj = $this->UserId->objs()->make(['parent_id' => $this->obj->id
                ]);

                $obj->objectable()->associate(
                    $this->UserId->files()
                    ->create([
                        'name' => $upload->getClientOriginalName(),
                        'size' => $upload->getSize(),
                        'path' => $upload->storePublicly(
                            auth()->user()->name.auth()->user()->id, [
                                'disk' => 'local'
                            ]
                        )
                    ])
                    );
                    $obj->save();
                    $this->obj = $this->obj->fresh();

               
            }else{
                //se ha superato il suo numero massimo di upload, chiediamo all'utente
                //di passara al piano superiore (a pagamento: subscription).
                session()->flash('message', 'You have to update your plan to premium 
                for upload more files.');
            }
            
            //nella view se ha superato il suo numero di upload per il piano gratuito
                /* <div class="alert alert-success">
                {{ session('message') }}
                </div> */
           

            /* $obj = $this->UserId->objs()->make(['parent_id' => $this->obj->id
            ]);

            $obj->objectable()->associate(
                $this->UserId->files()
                ->create([
                    'name' => $upload->getClientOriginalName(),
                    'size' => $upload->getSize(),
                    'path' => $upload->storePublicly(
                        auth()->user()->name.auth()->user()->id, [
                            'disk' => 'local'
                        ]
                    )
                ])
                );
                $obj->save();
                $this->obj = $this->obj->fresh(); */
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
 