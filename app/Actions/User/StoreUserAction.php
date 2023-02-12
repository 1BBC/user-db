<?php

namespace App\Actions\User;

use App\Actions\Contracts\StoreUserActionContract;
use App\Jobs\OptimizeUserPhotoJob;
use App\Models\User;
use Illuminate\Http\UploadedFile;

class StoreUserAction implements StoreUserActionContract
{
    /**
     * @param array $data
     * @return User
     */
    public function __invoke(array $data): User
    {
        $user = (new User)->fill($data);
        $file = request()->file('photo');

        if (!$file instanceof UploadedFile) {
            $user->save();
            return $user;
        }

        $user->photo = $file->storeAs(
            User::photoPath(), uniqid().'.'.$file->getClientOriginalExtension()
        );
        $user->save();

        dispatch(new OptimizeUserPhotoJob($user));

        return $user;
    }
}
