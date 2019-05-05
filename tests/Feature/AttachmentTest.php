<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Attachment;
use Illuminate\Foundation\Auth\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class AttachmentTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        // Artisan::call('migrate');
        $this->cleanDirectories();
    }

    public function tearDown() : void
    {
        parent::tearDown();
        // $this->cleanDirectories();
    }

    public function cleanDirectories () {
        Storage::disk('public')->deleteDirectory('uploads');
    }

    public function getFileAttachment ($attachment) {
        return dirname(__DIR__) .'/fixtures/uploads/'.$attachment['name'];
    }

    private function callController($data = []){
        $path = dirname(__DIR__) . '/fixtures/maman.jpg';
        $files = new UploadedFile( $path,'maman.jpg','image/jpeg',null,true);
        $post = Post::first();
        $default =  [
            'attachable_type' => Post::class,
            'attachable_id' => $post->id,
            'image' => $files
        ];
        // return $this->post( route('attachments.store'),array_merge($default,$data));
        return $this->json('POST',route('attachments.store'),array_merge($default,$data));
    }

    public function testIncorectDataAttachable_type(){
        // factory(Post::class, 5)->create();

       $response = $this->callController(['attachable_type'=> 'POOO']);
        // dd($response->getContent());
        $response->assertJsonStructure(['attachable_type']);
        $response->assertStatus(422);
    }


    public function testIncorectDataAttachable_id(){
        $response = $this->callController(['attachable_id'=> 125]);
        $response->assertJsonStructure(['attachable_id']);
        $response->assertStatus(422);
    }

    public function testCorrectData(){
        $response = $this->callController();
        $attachment = $response->json();
        // Ajout du structure de fichier
            // $dir = dirname(__DIR__) .'\fixtures\uploads\\'.date('Y-m');
            // if(! file_exists($dir)){ mkdir($dir,0777); }
        // fin -- ofet cest pas icii
        $this->assertFileExists($this->getFileAttachment($attachment));
        $response->assertJsonStructure(['id','url']);
        $this->assertContains('/uploads',$attachment['url']);
        $response->assertStatus(201);
    }

    public function testDeleteAttachmentDeleteFile () {
        $response = $this->callController();
        $attachment = $response->json();
        // dd($attachment);
        $this->assertFileExists($this->getFileAttachment($attachment));
        Attachment::find($attachment['id'])->delete();
        $this->assertFileNotExists($this->getFileAttachment($attachment));
    }
    
    public function testDeletePostDeleteAllAttachment () {
        $response = $this->callController();
        $attachment = $response->json();

        // factory(Attachment::class, 3)->create();

        $this->assertFileExists($this->getFileAttachment($attachment));
        // $this->assertEquals(53, Attachment::count());
        Post::first()->delete();
        $this->assertFileNotExists($this->getFileAttachment($attachment));
        // $this->assertEquals(0, Attachment::count());

    }

    public function testChangePostContentAttachmentsAreDeleted () {
        $this->markTestIncomplete();
    }
}
