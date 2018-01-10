<?php

namespace App\Http\Controllers\Account;

use App\Image;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreAvatarFormRequest;

class AvatarController extends Controller
{


	/**
	 * @var ImageManager
	 */
	protected $imageManager;


	/**
	 * AvatarController constructor.
	 *
	 * @param ImageManager $imageManager
	 */
    public function __construct(ImageManager $imageManager) {
	    $this->imageManager = $imageManager;
    }


	/**
	 * Create image and store in database for user avatar.
	 * @param StoreAvatarFormRequest $request
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
    public function store(StoreAvatarFormRequest $request) {

	    $processedImage = $this->imageManager->make( $request->file( 'image' )->getPathName() )
             ->fit( 100, 100, function ( $c ) {
                 $c->aspectRatio();
             } )
             ->encode( 'png' )
             ->save( config( 'image.path.absolute' ) . $path = '/' . uniqid( true ) . '.png' );

	    //var_dump('test');

	    // create the image record
	    $image       = new Image;
	    $image->path = $path;
	    $image->user()->associate( $request->user() );
	    $image->save();

    	return response([
    		'data' => [
    			'id' => $image->id,
			    'path' => '/images/avatar/'.$path
		    ]
	    ], 200);
    }
}
