<?

namespace App\Http\Controllers\Traits;

use App\Flyer;
use Illuminate\Http\Request;

trait AuthorizesUsers {

    protected function userCreateFlyer(Request $request)
    {
        return Flyer::where([
                   'zip'     => $request->zip,
                   'street'  => $request->street,
                   'user_id' => $this->user->id
            ])->exists();

    }

    protected function unauthorized(Request $request)
    {
       if($request->ajax()) {

               return response(['message' =>'No Way'], 403); 
           }
           
           flash('No way.');
             
           return redirect('/');

    }



}
