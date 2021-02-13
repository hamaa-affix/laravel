<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Mypage\Profile\EditRequest;
use Psy\Command\EditCommand;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;

class ProfileController extends Controller
{
    public function showProfileEditForm()
    {
        return view('mypage.profile_edit_form')->with('user', Auth::user());
    }

    public function editProfile(EditRequest $request)
    {
        // dd($request);
        $user = Auth::user();
        $user->name = $request->name;

        if($request->has('avatar')) { //has() ->指定したname属性に値があるか
            // sevice containerを用いて画像ファイルをストレージに保存する。return value　をusers tableに上書き
            $file_name = $this->saveAvatar($request->file('avatar'));
            //file() 返り値はUploadedFileクラスのインスタンスになります。
            $user->avatar_file_name = $file_name;
        }

        $user->save();

        return redirect()->back()->with('status', 'プロフィールを変更しました。');
    }

    /**
     * アバター画像をリサイズして保存します
     * @param UploadeFile $file アップロードされたアバター画像
     * @return string ファイル名
     */

    private function saveAvatar(UploadedFile $file)
    {
        $temp_path = $this->makeTempPath();
        Image::make($file)->fit(200, 200)->save($temp_path);

        //putfile() -> 第一引数はフォルダ名を指定します。 publicディスクではstorage/app/public/[指定したフォルダ名]
        //第二引数は保存したい画像のFileインスタンスを指定します ここではstorage/app/public/avatarsフォルダに加工後の画像ファイルを保存しています。
        $file_path = Storage::disk('public')
                    ->putFile('avatars', new File($temp_path));

        return basename($file_path);
    }

    /**
     * 一時的なファイルを生成してパスを返します。
     *
     * @return string ファイルパス
     */
    private function makeTempPath()
    {
        // tmpfile() tmpに一時ファイルが生成され、そのファイルポインタが返されます。
        $tmp_fp = tmpfile();
        //stream_get_meta_data() 第一引数はファイルポインタを指定します。返り値はメタ情報が格納された連想配列です。
        $meta = stream_get_meta_data($tmp_fp);
        //メタ情報からURI(ファイルのパス)を取得し、返却
        return $meta['uri'];
    }
}
