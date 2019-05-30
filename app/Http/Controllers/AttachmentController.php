<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Requests\AttachmentRequest;
use Illuminate\Http\JsonResponse;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttachmentRequest $request)
    {
        // Verifier si attachable_type est bon
        $type = $request->get('attachable_type');
        $id = $request->get('attachable_id');
        $file = $request->file('image');
        if(class_exists($type) && method_exists($type, 'attachments')){
            $subject = call_user_func($type .'::find', $id);
            if($subject){
                $attachment = new Attachment(
                    $request->only('attachable_type','attachable_id')
                );
                $attachment->uploadFile($file);
                // dd($attachment);
                $attachment->save();
                return $attachment;
            }else{
            return new JsonResponse(['attachable_id' => 'Ce contenu ne peut pas recevoir de fichier attachés'],422);
            }
        } else {
            return new JsonResponse(['attachable_type' => 'Ce contenu ne peut pas recevoir de fichier attachés'],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
